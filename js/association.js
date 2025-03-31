
//initialize assos list
var association;
const urlParams = new URLSearchParams(window.location.search);
const assoId = parseInt(urlParams.get('id'));
console.log(assoId);


  // Éléments du DOM
  const assoNameEl = document.getElementById('asso-name');
  const assoDescEl = document.getElementById('asso-desc');
  const assoImageEl = document.getElementById('asso-image');
  const assoSiteEl = document.getElementById('asso-site');

  function getAssociation () {
    fetch('../getAssos.php?asso_id='+assoId)
      .then(res => res.json())
      .then(assos => {
          association = assos;
          console.log(association);
          
      })
      .catch(error => {
          console.error("Erreur de récupération :", error);
          alert("Erreur lors du chargement des données.");
      })
      .finally(() => {
          loader.style.display = 'none'; // Cache le loader
      });
  
  }

  function fillPageWithAssosData () {
    console.log(association);
    
    if (association) {
      // Met à jour les informations
      assoNameEl.textContent = association.nom;
      assoDescEl.textContent = association.description || "Pas de description disponible";
      assoImageEl.src = association.image;
      assoImageEl.alt = `Logo ${association.nom}`;
  
  
      // Met à jour le titre de la page
      document.title = `${association.nom} - Détails`;
    } else {
      // Association non trouvée
      assoNameEl.textContent = "Association introuvable";
      assoDescEl.textContent = "Aucune association ne correspond à cet ID";
    }

  }

  Promise.all([getAssociation()])
    .then(() => {
        fillPageWithAssosData();
    })
    .catch(error => {
        console.error("Erreur de récupération des données:", error);
        alert("Erreur lors du chargement des données.");
    })
    .finally(() => {
        loader.style.display = 'none'; // Cache le loader after all fetches
    });



