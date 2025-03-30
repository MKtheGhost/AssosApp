//import { associations } from './dataAssociation.js';
let associations = [];
const loader = document.getElementById('loader');
loader.style.display = 'block'; // Affiche la roue


document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById("assos-container");
    const searchInput = document.getElementById('searchInput');
    const selectHandi = document.getElementById('selectHandi');
    const searchForm = document.getElementById('searchForm');

    // 1. Création des cartes d'associations
    function createAssociationCards(assosList) {
        container.innerHTML = ''; // Vide le conteneur

        assosList.forEach(asso => {
            // Création du lien qui entoure toute la carte
            const link = document.createElement("a");
            link.href = `https://assos-app-315f0d174de7.herokuapp.com/association.php?id=${asso.id}`;
            link.classList.add("association-link"); // Pour le style CSS si besoin

            const article = document.createElement("article");
            article.classList.add("association-card");
            article.dataset.categories = asso.handicaps ? asso.handicaps.join(' ') : '';

            const img = document.createElement("img");
            img.src = asso.image;
            img.alt = asso.nom;
            img.onerror = () => { img.src = "images/assos/default-image.jpg"; };

            const infoDiv = document.createElement("div");
            infoDiv.classList.add("association-info");

            const h2 = document.createElement("h2");
            h2.textContent = asso.nom;

            const p = document.createElement("p");
            p.textContent = asso.description;

            article.appendChild(img);
            infoDiv.appendChild(h2);
            infoDiv.appendChild(p);
            article.appendChild(infoDiv);

            link.appendChild(article);
            container.appendChild(link);
        });
    }

    // 2. Configuration du select des handicaps
    const handicapsAssociations = {
        'Handicap auditif': ['AFSA', 'UAFLMV'],
        'Handicap visuel': ['A.M.I', 'FNATH', 'UNAPEI'],
        'Handicap moteur': ['APF France handicap', 'FNATH', 'UNAFTC', 'ADEPA'],
        'Handicap mental': ['UNAPEI', 'Unapei', 'Autisme France'],
        'Troubles du spectre autistique': ['Autisme France', 'Fédération Française Sésame Autisme'],
        'Handicap psychique': ['UNAFAM', 'FNAPSY', 'Schizo-oui'],
        'Maladies neurologiques': [
            'AFSEP',
            'France Parkinson',
            'France Alzheimer',
            'ARSLA',
            'AFM-Téléthon'
        ],
        'Déficience intellectuelle': ['UNAPEI', 'AFSA'],
        'Polyhandicap': ['APF France handicap', 'UNAPEI'],
        'Maladies rares': ['Alliance Maladies Rares', 'AMALYSTE'],
        'Traumatisme crânien': ['UNAFTC'],
        'Handicap invisible': ['FibromyalgieSOS', 'ASFC', 'E3M'],
        'Troubles dys': ['HyperSupers – TDAH France'],
        'Déficience viscérale': ['France Rein', 'FGCP', 'TRANSHÉPATE'],
        'Cancer': ['La Ligue contre le cancer', 'UNAPECLE'],
        'Addictions': [
            'Addictions Alcool Vie Libre',
            'Alcool Ecoute Joie & Santé',
            'Entraid\'addict',
            'La Croix Bleue'
        ],
        'Douleurs chroniques': ['AFVD', 'FibromyalgieSOS'],
        'Maladies inflammatoires': ['AFA Crohn RCH France', 'ANDAR', 'AFPric']
    };

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = '-- Tous les handicaps --';
    defaultOption.selected = true;
    selectHandi.appendChild(defaultOption);

    Object.keys(handicapsAssociations).sort().forEach(handicap => {
        const option = document.createElement('option');
        option.value = handicap;
        option.textContent = handicap;
        selectHandi.appendChild(option);
    });

    // 3. Fonction de filtrage combinée
    function filterAssociations() {
        const searchText = searchInput.value.toLowerCase();
        const selectedHandicap = selectHandi.value;

        const filtered = associations.filter(asso => {
            // Filtre par texte
            const textMatch = asso.nom.toLowerCase().includes(searchText) ||
                (asso.description && asso.description.toLowerCase().includes(searchText));

            // Filtre par handicap si sélectionné
            let handicapMatch = true;
            if (selectedHandicap) {
                const assosForHandicap = handicapsAssociations[selectedHandicap];
                handicapMatch = assosForHandicap.includes(asso.nom);
            }

            return textMatch && handicapMatch;
        });

        createAssociationCards(filtered);
    }

    // 4. Écouteurs d'événements
    searchInput.addEventListener('input', filterAssociations);
    selectHandi.addEventListener('change', filterAssociations);
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        filterAssociations();
    });

    // 5. Initialisation
    fetch('../getAssos.php')
    .then(res => res.json())
    .then(assos => {
        associations = assos;
        createAssociationCards(assos);
        
    })
    .catch(error => {
        console.error("Erreur de récupération :", error);
        alert("Erreur lors du chargement des données.");
    })
    .finally(() => {
        loader.style.display = 'none'; // Cache le loader
    });
});

