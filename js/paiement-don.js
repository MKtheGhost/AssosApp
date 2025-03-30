document.addEventListener('DOMContentLoaded', function () {
    const inputMontant = document.getElementById('montantPaiement');
    let montantPaiement = inputMontant.value;
    let currency;
  

    inputMontant.addEventListener('input', (e) => {
      montantPaiement = e.target.value;
      console.log('montant:', montantPaiement);
    });
  
    fetch('./getInfosCompte.php')
      .then(res => res.json())
      .then(user => {
        console.log("Valeur currency dans la DB :", user.currency);
        document.getElementById('currencyDisplay').textContent = user.currency;

  
        if (user.currency === '€') currency = 'EUR';
        else if (user.currency === '$') currency = 'USD';
        else if (user.currency === '£') currency = 'GBP';
        else currency = 'EUR';
  
        
        paypal.Buttons({
          createOrder: function(data, actions){
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: montantPaiement,
                  currency_code: currency
                }
              }]
            });
          },
          onApprove: function(data, actions){
            return actions.order.capture().then(function(details){
              alert("Paiement effectué!");
            });
          },
          onError: function(err){
            console.error('Payment Error:', err);
            alert("Paiement échoué !");
          }
        }).render("#paypal-btn-container");
      })
      .catch(error => {
        console.error("Erreur de récupération :", error);
        alert("Erreur lors du chargement des données.");
      });
  });
  