// Sample data for associations
const associations = [
    { id: 1, name: 'Association A', totalDonation: 150, recurringDonation: 20 },
    { id: 2, name: 'Association B', totalDonation: 250, recurringDonation: 30 },
    { id: 3, name: 'Association C', totalDonation: 100, recurringDonation: 10 },
    { id: 4, name: 'Association D', totalDonation: 75, recurringDonation: 5 },
    { id: 5, name: 'Association E', totalDonation: 200, recurringDonation: 15 }
  ];
  
  // 1. Get Top 3 Associations based on total donations
  const topAssociations = associations
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
  associations.forEach(asso => {
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
    
    const selectedAssociation = associations.find(asso => asso.id === selectedId);
    detailsCard.innerHTML = `
      <h3>${selectedAssociation.name}</h3>
      <p>Total des dons: <strong>${selectedAssociation.totalDonation} €</strong></p>
      <p>Dons récurrents: <strong>${selectedAssociation.recurringDonation} €</strong></p>
    `;
  });
  