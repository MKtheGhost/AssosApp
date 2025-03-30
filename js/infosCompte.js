const loader = document.getElementById('loader');
loader.style.display = 'block'; // Affiche la roue

fetch('./getInfosCompte.php')
  .then(res => res.json())
  .then(user => {
    console.log("Valeur currency dans la DB :", user.currency);
    // Remplir les champs
    document.getElementById('prenom').value = user.user_firstname || '';
    document.getElementById('nom').value = user.user_name || '';
    document.getElementById('adresse-post').value = user.user_address || '';
    document.getElementById('ville').value = user.user_city || '';
    document.getElementById('code-post').value = user.user_zipcode || '';
    document.getElementById('adresse-mail').value = user.user_mail || '';
    document.getElementById('newsletter').checked = (user.newsletter == 1);
    document.getElementById('currency').value = user.currency || '';
    document.getElementById('user_id').value = localStorage.getItem("user_id");
    console.log(localStorage.getItem("user_id"));
  })
  .catch(error => {
    console.error("Erreur de récupération :", error);
    alert("Erreur lors du chargement des données.");
  })
  .finally(() => {
    loader.style.display = 'none'; // Cache le loader
  });

  document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();
  
    const data = {
      firstname: document.getElementById('prenom').value,
      lastname: document.getElementById('nom').value,
      address: document.getElementById('adresse-post').value,
      city: document.getElementById('ville').value,
      zipcode: document.getElementById('code-post').value,
      email: document.getElementById('adresse-mail').value,
      password: document.getElementById('mdp').value.trim(), // sera vide si non modifié
      newsletter: document.getElementById('newsletter').checked,
      currency: document.getElementById('currency').value,
    };
  
    fetch('./updateInfosCompte.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
      .then(res => res.json())
      .then(response => {
        alert(response.message || response.error || "Réponse inconnue");
      })
      .catch(err => {
        console.error(err);
        alert("Une erreur est survenue.");
      });
  });
  