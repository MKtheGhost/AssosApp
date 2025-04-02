document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  const assoId = parseInt(urlParams.get('id_assos'));
  const inputMontant = document.getElementById('montantPaiement');
  let montantPaiement = inputMontant.value;
  let currency;

  if (localStorage.getItem("user_id") != null){
    const userId = localStorage.getItem("user_id");}
  else{
    const userId = null
  };

  inputMontant.addEventListener('input', (e) => {
    montantPaiement = e.target.value;
    console.log('montant:', montantPaiement);
  });

  fetch(`./getInfosCompte.php?user_id=${userId}`)
    .then(res => res.json())
    .then(user => {
      document.getElementById('currencyDisplay').textContent = user.currency;

      if (user.currency === '€') currency = 'EUR';
      else if (user.currency === '$') currency = 'USD';
      else if (user.currency === '£') currency = 'GBP';
      else currency = 'EUR';

      paypal.Buttons({
        createOrder: function(data, actions) {
          const recurrence = document.getElementById('mensuetude').checked ? 1 : 0;
          const montant = parseFloat(document.getElementById('montantPaiement').value);

          const dataToSend = {
            montant_don: montant,
            recurrence: recurrence,
            id_assos: assoId,
            currency: user.currency
          };

          fetch(`./updateTableDon.php?user_id=${userId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(dataToSend)
          })
          .then(res => res.json())
          .then(response => {
            console.log("Don simulé enregistré :", response);
          })
          .catch(error => {
            console.error("Erreur lors de l'enregistrement simulé :", error);
          });

          return actions.order.create({
            purchase_units: [{
              amount: {
                value: montant.toFixed(2),
                currency_code: currency
              }
            }]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert("Paiement simulé !");
          });
        },

        onError: function(err) {
          console.error('Erreur PayPal (simulation) :', err);
          alert("Une erreur est survenue pendant la simulation.");
        }
      }).render("#paypal-btn-container");
    })
    .catch(error => {
      console.error("Erreur lors du chargement des infos utilisateur :", error);
      alert("Erreur lors du chargement des données.");
    });
});
