let donsUniques = [];
let donsReccurents = [];
let associations = [];

let reccurenceOption = [{value : 1, name :'tous les mois'}, {value : 1, name :'tous les 3 mois'}, {value : 1, name :'tous les ans'}];

const currency = localStorage.getItem("currency");

const loader = document.getElementById('loader');
loader.style.display = 'block'; // Affiche la roue

const user_id = localStorage.getItem("user_id");

// get all dons uniques with the user_id
fetch('../getDonations.php?user_id='+user_id+"&recurrence=0")
    .then(res => res.json())
    .then(dons => {
        donsUniques = dons;      
    })
    .catch(error => {
        console.error("Erreur de récupération :", error);
        alert("Erreur lors du chargement des données.");
    })
    .finally(() => {
        loader.style.display = 'none'; // Cache le loader
    });

// get all dons reccurents with user id
fetch('../getDonations.php?user_id='+user_id+"&reccurence=1")
.then(res => res.json())
.then(dons => {
    donsReccurents = dons; 
})
.catch(error => {
    console.error("Erreur de récupération :", error);
    alert("Erreur lors du chargement des données.");
})
.finally(() => {
    loader.style.display = 'none'; // Cache le loader
});

// get all assos
fetch('../getAssos.php')
.then(res => res.json())
.then(assos => {
    associations = assos; 
})
.catch(error => {
    console.error("Erreur de récupération :", error);
    alert("Erreur lors du chargement des données.");
})
.finally(() => {
    loader.style.display = 'none'; // Cache le loader
});


document.addEventListener('DOMContentLoaded', function() {
    let donList = document.getElementById("don-unique");
    let donRecList = document.getElementById("don-rec");

    function createDonUnique() {
        donList.innerHTML = "";

        console.log(donsUniques);
        if (donsUniques) {
            for (let i = 0; i< 4; i++) {
                let currentDon = donsUniques[i];
                let currentAsso = associations.find( assos => assos.id == currentDon._id_assos);
    
                //create don container
                let donDiv = document.createElement("div");
                donDiv.classList.add("row-card");
    
                //create don name text 
                let donName = document.createElement("p");
                donName.classList.add("asso-name");
                console.log(currentAsso);
                //donName.innerHTML = currentAsso.nom;
    
                //create don amount
                let donAmount = document.createElement("p");
                donAmount.classList.add("asso-amount");
                donAmount.innerHTML = currentDon.montant_don+currency; // need to get the user's currency
    
                //create don date
                let donDate = document.createElement("p");
                donDate.classList.add("asso-date");
                donDate.innerHTML = currentDon.date_don;
    
                //append
                donDiv.appendChild(donName);
                donDiv.appendChild(donAmount);
                donDiv.appendChild(donDate);
    
                donList.appendChild(donDiv);
    
    
            }

        } else {
            donList.innerHTML = "vous n'avez pas effectué de dons";
        }
        
    }

    function createDonRec() {
        donRecList.innerHTML = "";

        if (donsReccurents) {
            donsReccurents.forEach(currentDon => {
                let currentAsso = assos.find( assos => assos.id == currentDon._id_assos);
    
                //create don container
                let donDiv = document.createElement("div");
                donDiv.classList.add("row-card");
    
                //create don name text 
                let donName = document.createElement("p");
                donName.classList.add("asso-name");
                //donName.innerHTML = currentAsso.nom;
    
                //create don amount
                let donAmount = document.createElement("p");
                donAmount.classList.add("asso-amount");
                donAmount.innerHTML = currentDon.montant_don + currency; // need to get the user's currency
    
                //create don reccurence
                let donDate = document.createElement("p");
                donDate.classList.add("asso-date");
                donDate.innerHTML = currentDon.recurrence_interval;
    
                // create edit button
                let donEditBtn = document.createElement("button");
                donEditBtn.classList.add("don-edit-btn");
                donEditBtn.innerHTML= "edit";
                
    
    
                //append
                donDiv.appendChild(donName);
                donDiv.appendChild(donAmount);
                donDiv.appendChild(donDate);
                donDiv.appendChild(donEditBtn);
    
                donList.appendChild(donDiv);
            
            })

        } else {
            donRecList.innerHtml = "vous n'avez pas effectué de dons récurrents";
        }
    }

        createDonUnique();
        createDonRec();
        
})