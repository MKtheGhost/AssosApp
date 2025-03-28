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
    document.getElementById('mdp').value = user.user_password || '';
  })
  .catch(error => {
    console.error("Erreur de récupération :", error);
    alert("Erreur lors du chargement des données.");
  })
  .finally(() => {
    loader.style.display = 'none'; // Cache la roue quoi qu'il arrive
  });
