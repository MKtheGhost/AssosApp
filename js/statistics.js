// Import des données
import { associations } from './dataAssociation.js';
import { dataDons } from './dataDons.js';


// Préparation des données: fusionner les informations
const prepareAssociationsData = () => {
  // Créer un map pour accéder facilement aux dons par ID d'association
  const donationsMap = new Map();

  dataDons.forEach(don => {
    donationsMap.set(don.id, {
      totalDonation: don.totalDon,
      recurringDonation: don.donsRec
    });
  });

  // Fusionner avec les informations des associations
  return associations.map(asso => {
    const donations = donationsMap.get(asso.id) || {
      totalDonation: 0,
      recurringDonation: 0
    };

    return {
      id: asso.id,
      name: asso.nom,
      totalDonation: donations.totalDonation,
      recurringDonation: donations.recurringDonation
    };
  });
};

const associationsData = prepareAssociationsData();

// 1. Get Top 3 Associations
const topAssociations = associationsData
    .slice()
    .sort((a, b) => b.totalDonation - a.totalDonation)
    .slice(0, 3);

// 2. Populate Top Associations Section as Cards
const topAssociationsList = document.getElementById('topAssociationsList');
topAssociations.forEach(asso => {
    const card = document.createElement('div');
    card.classList.add('association-card');
    card.innerHTML = `
        <div class="name">${asso.name}</div>
        <div class="amount">${asso.totalDonation} €</div>
    `;
    topAssociationsList.appendChild(card);
});

// 3. Populate Datalist with All Associations
const associationInput = document.getElementById('associationInput');
const associationsList = document.getElementById('associations-list');
const associationId = document.getElementById('associationId');
const detailsCard = document.getElementById('associationDetails');

// Vider et peupler le datalist
associationsList.innerHTML = '';
associationsData.forEach(asso => {
    const option = document.createElement('option');
    option.value = asso.name;
    option.dataset.id = asso.id; // Stocker l'ID dans data-id
    associationsList.appendChild(option);
});

// 4. Update Details Card on Input Change
associationInput.addEventListener('change', (event) => {
    const selectedName = event.target.value;
    const selectedAssociation = associationsData.find(asso => asso.name === selectedName);
    
    if (!selectedAssociation) {
        detailsCard.innerHTML = `<p>Sélectionnez une association valide pour voir les détails.</p>`;
        associationId.value = '';
        return;
    }
    
    associationId.value = selectedAssociation.id;
    detailsCard.innerHTML = `
        <h3>${selectedAssociation.name}</h3>
        <p>Total des dons: <strong>${selectedAssociation.totalDonation} €</strong></p>
        <p>Dons récurrents: <strong>${selectedAssociation.recurringDonation} €</strong></p>
    `;
});

// Optionnel: Gérer la sélection via clavier
associationInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        const selectedName = event.target.value;
        const selectedAssociation = associationsData.find(asso => asso.name === selectedName);
        if (selectedAssociation) {
            associationId.value = selectedAssociation.id;
            detailsCard.innerHTML = `
                <h3>${selectedAssociation.name}</h3>
                <p>Total des dons: <strong>${selectedAssociation.totalDonation} €</strong></p>
                <p>Dons récurrents: <strong>${selectedAssociation.recurringDonation} €</strong></p>
            `;
        }
    }
});