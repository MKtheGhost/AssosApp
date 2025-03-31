var association;
const urlParams = new URLSearchParams(window.location.search);
const assoId = parseInt(urlParams.get('id'));
console.log(assoId);

// Éléments du DOM
const assoNameEl = document.getElementById('asso-name');
const assoDescEl = document.getElementById('asso-desc');
const assoImageEl = document.getElementById('asso-image');
const assoSiteEl = document.getElementById('asso-site');

// Fetch the association data from the server
async function getAssociation() {
    try {
        const res = await fetch('../getAssos.php?asso_id=' + assoId);
        if (!res.ok) throw new Error('Failed to fetch association data');
        const assos = await res.json();
        association = assos;
        console.log(association);
    } catch (error) {
        console.error("Erreur de récupération :", error);
        alert("Erreur lors du chargement des données.");
    } finally {
        loader.style.display = 'none'; // Cache le loader
    }
}

// Fill the page with the association data
function fillPageWithAssosData() {
    console.log(association);

    if (association) {
        // Update the DOM elements with association data
        assoNameEl.textContent = association.nom;
        assoDescEl.textContent = association.description || "Pas de description disponible";
        assoImageEl.src = association.image;
        assoImageEl.alt = `Logo ${association.nom}`;

        // Update the page title
        document.title = `${association.nom} - Détails`;
    } else {
        // Handle the case where the association was not found
        assoNameEl.textContent = "Association introuvable";
        assoDescEl.textContent = "Aucune association ne correspond à cet ID";
    }
}

// Run everything
async function init() {
    await getAssociation(); // Wait for the association data to be fetched
    fillPageWithAssosData(); // Fill the page with the fetched data
}

// Initialize the page
init();
