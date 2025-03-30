function startScanner() {
    const videoElement = document.getElementById('preview');
    const resultElement = document.getElementById('result');
    resultElement.innerText = "EN ATTENTE DE SCAN";

    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(function(stream) {
            videoElement.srcObject = stream;
            videoElement.setAttribute("playsinline", true);
            videoElement.play();
            scanQRCode();
        })
        .catch(function(err) {
            resultElement.innerText = "Erreur : " + err.message;
        });

    function scanQRCode() {
        if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, canvas.width, canvas.height, {
                inversionAttempts: "dontInvert",
            });

            if (code) {
                try {
                    new URL(code.data); // Valide l'URL
                    window.location.href = code.data;
                    return; // Arrête le scanner après redirection
                } catch (e) {
                    resultElement.innerText = "URL invalide dans le QR Code.";
                }
            }
        }
        setTimeout(requestAnimationFrame, 100, scanQRCode);
    }
}

window.onload = startScanner;