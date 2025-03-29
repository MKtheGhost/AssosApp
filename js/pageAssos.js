import { associations } from './dataAssociation.js';

// Récupère le paramètre d'URL
const urlParams = new URLSearchParams(window.location.search);
const assoParam = urlParams.get('asso');

// Trouve l'association correspondante
const association = associations.find(asso =>
    asso.nom.toLowerCase() === assoParam.toLowerCase()
);

const container = document.getElementById('association-container');

if (association) {
    // Affiche les détails de l'association
    container.innerHTML = `
                <div class="association-header">
                    <img src="${association.image}"
                         alt="Logo ${association.nom}"
                         class="association-logo"
                         onerror="this.src='images/assos/default-image.jpg'">
                    <div class="association-info">
                        <h1>${association.nom}</h1>
                        <p>${association.description || 'Pas de description disponible'}</p>
                    </div>
                </div>

                <section class="association-details">
                    <h2>Informations complémentaires</h2>
                    <p>Site web: <a href="${association.website || '#'}" target="_blank">
                        ${association.website || 'Non disponible'}
                    </a></p>
                    <p>Téléphone: ${association.phone || 'Non disponible'}</p>
                    <p>Email: ${association.email || 'Non disponible'}</p>
                </section>

                ${association.content || ''}
            `;

    // Mise à jour du titre
    document.title = `${association.nom} - Détails`;
} else {
    // Association non trouvée
    container.innerHTML = `
                <div class="error">
                    <h1>Association non trouvée</h1>
                    <p>L'association "${assoParam}" n'a pas été trouvée dans notre base de données.</p>
                    <a href="index.html">Retour à la liste des associations</a>
                </div>
            `;
}