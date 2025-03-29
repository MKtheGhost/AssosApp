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

// Le reste du code reste inchangé
// 1. Get Top 3 Associations based on total donations
const topAssociations = associationsData
    .slice() // copy array to avoid mutating original
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

// 3. Populate Dropdown with All Associations
const associationSelect = document.getElementById('associationSelect');
associationsData.forEach(asso => {
  const option = document.createElement('option');
  option.value = asso.id;
  option.textContent = asso.name;
  associationSelect.appendChild(option);
});

// 4. Update Details Card on Dropdown Change
associationSelect.addEventListener('change', (event) => {
  const selectedId = parseInt(event.target.value);
  const detailsCard = document.getElementById('associationDetails');

  if (!selectedId) {
    detailsCard.innerHTML = `<p>Sélectionnez une association pour voir les détails.</p>`;
    return;
  }

  const selectedAssociation = associationsData.find(asso => asso.id === selectedId);
  detailsCard.innerHTML = `
    <h3>${selectedAssociation.name}</h3>
    <p>Total des dons: <strong>${selectedAssociation.totalDonation} €</strong></p>
    <p>Dons récurrents: <strong>${selectedAssociation.recurringDonation} €</strong></p>
  `;
});