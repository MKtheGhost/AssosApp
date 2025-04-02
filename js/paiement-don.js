document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  const assoId = parseInt(urlParams.get('id_assos'));
  const inputMontant = document.getElementById('montantPaiement');
  let montantPaiement = inputMontant.value;
  let currency;
  const currencyScript = localStorage.getItem("currency");

  function loadPaypalSDK(currencyScript) {
    return new Promise((resolve, reject) => {
      if (currencyScript === '€') currencyScript = 'EUR';
      else if (currencyScript === '$') currencyScript = 'USD';
      else if (currencyScript === '£') currencyScript = 'GBP';
      else currencyScript = 'EUR';
      
      const existingScript = document.getElementById('paypal-sdk');
      if (existingScript) {
        existingScript.parentNode.removeChild(existingScript);
      }
    
      const script = document.createElement('script');
      script.id = 'paypal-sdk';
      script.src = `https://www.paypal.com/sdk/js?client-id=AWC7PJYo6u0NuJhFDSYq4HC7oMQN7gTp_YesPV-ns47b2uatFwdKeSmXQp4RfhNRUU1VB-keVbV3Gj8z&currency=${currencyScript}`;
      
      script.onload = () => {
        resolve();
      };
    
      script.onerror = () => {
        reject(new Error("Échec du chargement du SDK PayPal"));
      };
      
      document.head.appendChild(script);
    });
  }

  
  if (localStorage.getItem("user_id") != null){
    const userId = localStorage.getItem("user_id");
    
    fetch(`./getInfosCompte.php?user_id=${userId}`)
    .then(res => res.json())
    .then(user => {
      document.getElementById('currencyDisplay').textContent = user.currency;

      if (user.currency === '€') currency = 'EUR';
      else if (user.currency === '$') currency = 'USD';
      else if (user.currency === '£') currency = 'GBP';
      else currency = 'EUR';

      inputMontant.addEventListener('input', (e) => {
        montantPaiement = e.target.value;
        console.log('montant:', montantPaiement);
      });

      loadPaypalSDK(currencyScript)
      .then(() => {
      paypal.Buttons({
        createOrder: function(data, actions) {
          let recurrence;
          let date = new Date();

          if(document.getElementById('recurrence').checked){
            recurrence = document.getElementById('recurrence-frequence').value
          }
          else{
            recurrence = 0;
          }

          const montant = parseFloat(document.getElementById('montantPaiement').value);

          const dataToSend = {
            montant_don: montant,
            recurrence: recurrence,
            id_assos: assoId,
            currency: user.currency,
            date_don: date
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
    })});
  }else{
    const userId = 0;
    currency = 'EUR'
    document.getElementById('currencyDisplay').textContent = "€";
    document.getElementsByClassName('checkbox-mensuetude')[0].style.display = 'none';

    loadPaypalSDK(currencyScript)
      .then(() => {
    paypal.Buttons({ 
      createOrder: function(data, actions) {
        const recurrence = 0;
        const montant = parseFloat(document.getElementById('montantPaiement').value);

        let date = new Date();

        const dataToSend = {
          montant_don: montant,
          recurrence: recurrence,
          id_assos: assoId,
          currency: "€",
          date_don: date
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
    }).render("#paypal-btn-container")
    .catch(error => {
      console.error("Erreur lors du chargement des infos utilisateur :", error);
      alert("Erreur lors du chargement des données.");
    });})
  }
})
