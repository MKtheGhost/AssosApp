
//initialize assos list
var associations = [];
fetch('../getAssos.php')
    .then(res => res.json())
    .then(assos => {
        associations = assos;
        
    })
    .catch(error => {
        console.error("Erreur de récupération :", error);
        alert("Erreur lors du chargement des données.");
    })
    .finally(() => {
        loader.style.display = 'none'; // Cache le loader
    });

document.addEventListener('DOMContentLoaded', () => {
  // Récupère l'ID depuis l'URL
  const urlParams = new URLSearchParams(window.location.search);
  const assoId = parseInt(urlParams.get('id'));

  // Trouve l'association correspondante
  const currentAsso = associations.find(asso => asso.id === assoId);

  // Éléments du DOM
  const assoNameEl = document.getElementById('asso-name');
  const assoDescEl = document.getElementById('asso-desc');
  const assoImageEl = document.getElementById('asso-image');
  const assoSiteEl = document.getElementById('asso-site');

  if (currentAsso) {
    // Met à jour les informations
    assoNameEl.textContent = currentAsso.nom;
    assoDescEl.textContent = currentAsso.description || "Pas de description disponible";
    assoImageEl.src = currentAsso.image;
    assoImageEl.alt = `Logo ${currentAsso.nom}`;


    // Met à jour le titre de la page
    document.title = `${currentAsso.nom} - Détails`;
  } else {
    // Association non trouvée
    assoNameEl.textContent = "Association introuvable";
    assoDescEl.textContent = "Aucune association ne correspond à cet ID";
  }
});

