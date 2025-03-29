const loader = document.getElementById('loader');
loader.style.display = 'block'; // Affiche la roue

fetch('./getInfosCompte.php')
  .then(res => res.json())
  .then(user => {
    // Remplir les champs
    document.getElementById('prenom').value = user.user_firstname || '';
    document.getElementById('nom').value = user.user_name || '';
    document.getElementById('adresse-post').value = user.user_address || '';
    document.getElementById('ville').value = user.user_city || '';
    document.getElementById('code-post').value = user.user_zipcode || '';
    document.getElementById('adresse-mail').value = user.user_mail || '';
    document.getElementById('newsletter').checked = (user.newletter == 1);

    console.log(user.newletter)
  })
  .catch(error => {
    console.error("Erreur de récupération :", error);
    alert("Erreur lors du chargement des données.");
  })
  .finally(() => {
    loader.style.display = 'none'; // Cache la roue quoi qu'il arrive
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
      newletter: document.getElementById('newsletter').checked

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
  