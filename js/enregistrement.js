document.getElementById('form-inscription').addEventListener('submit', function(e) {
  e.preventDefault();

  const data = {
    user_mail: document.querySelector('[name="email"]').value,
    user_password: document.querySelector('[name="password"]').value,
    user_firstname: document.querySelector('[name="firstName"]').value,
    user_name: document.querySelector('[name="lastName"]').value,    
    user_address: document.querySelector('[name="address"]').value,
    user_city: document.querySelector('[name="city"]').value,
    user_zipcode: document.querySelector('[name="zipCode"]').value
    
  };

  fetch('http://localhost/SAE4/ASSOSAPP/API/users.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(response => {
    document.getElementById('message').textContent = response.message;
  })
  .catch(error => {
    document.getElementById('message').textContent = "Erreur lors de l'inscription";
    console.error(error);
  });
});
