// Fonction pour démarrer le scanner QR
function startScanner() {
    const videoElement = document.getElementById('preview');
    const resultElement = document.getElementById('result');

    // Accéder à la caméra
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(function(stream) {
            videoElement.srcObject = stream;
            videoElement.setAttribute("playsinline", true); // Pour iOS
            videoElement.play();

            // Scanner le QR code à chaque frame de la vidéo
            requestAnimationFrame(scanQRCode);
        })
        .catch(function(err) {
            console.error("Erreur d'accès à la caméra : ", err);
            resultElement.innerText = "Impossible d'accéder à la caméra.";
        });

    function scanQRCode() {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        // Vérifie si la vidéo est bien lue
        if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Décode l'image pour trouver un QR Code
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, canvas.width, canvas.height, {
                inversionAttempts: "dontInvert",
            });

            if (code) {
                window.location.href = `${code.data}`;
                // Si un QR Code est trouvé
                resultElement.innerText = `QR Code Scanné: ${code.data}`;
            } else {
                // Si aucun QR Code n'est trouvé
                resultElement.innerText = "Aucun QR Code détecté. Veuillez essayer à nouveau.";
            }
        }

        // Refaire une autre demande de scan
        requestAnimationFrame(scanQRCode);
    }
}

// Démarrer le scanner lorsque la page est prête
window.onload = startScanner;