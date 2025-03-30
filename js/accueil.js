// Importez les données (assurez-vous que le chemin est correct)
import { dataDons } from './dataDons.js';

// Fonction pour calculer les statistiques
function calculateStats() {
    // Calcul du total des dons
    const totalDon = dataDons.reduce((sum, asso) => sum + asso.totalDon, 0);

    // Trouver l'ID le plus élevé (nombre d'associations)
    const totalAssociations = Math.max(...dataDons.map(asso => asso.id));

    // Calcul du total des dons récurrents
    const totalRecurrent = dataDons.reduce((sum, asso) => sum + asso.donsRec, 0);

    return { totalDon, totalAssociations, totalRecurrent };
}

// Fonction pour animer les chiffres
function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        obj.textContent = id === 'totalDonations' || id === 'totalRecurrent'
            ? value.toLocaleString('fr-FR')
            : value;
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Fonction principale pour afficher les stats
function displayImpactStats() {
    const stats = calculateStats();

    // Animation des chiffres
    animateValue('totalDonations', 0, stats.totalDon, 1000);
    animateValue('totalAssociations', 0, stats.totalAssociations, 1000);
    animateValue('totalRecurrent', 0, stats.totalRecurrent, 1000);
}

// Appeler la fonction lorsque la page est chargée
document.addEventListener('DOMContentLoaded', displayImpactStats);