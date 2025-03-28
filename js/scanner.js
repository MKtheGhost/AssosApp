// Fonction de succès du scan
import {Html5Qrcode} from "../node_modules/html5-qrcode";

function onScanSuccess(decodedText, decodedResult) {
    document.getElementById("result").innerText = `QR Code Scanné: ${decodedText}`;
}

// Fonction d'erreur lors du scan
function onScanError(errorMessage) {
    console.warn("Erreur lors du scan : ", errorMessage);
}

// Initialisation du scanner de QR code
const html5QrCode = new Html5Qrcode("qr-reader");  // Associe la div pour afficher le scanner
html5QrCode.start(
    { facingMode: "environment" },  // Utiliser la caméra arrière
    {
        fps: 10,  // Frames par seconde pour le scan
        qrbox: 250  // Taille de la zone de scan
    },
    onScanSuccess,
    onScanError
).catch(err => {
    console.error("Erreur d'initialisation : ", err);
});