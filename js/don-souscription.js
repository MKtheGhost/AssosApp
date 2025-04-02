let donsUniques = [];
let donsReccurents = [];
let associations = [];

const currency = localStorage.getItem("currency");
const loader = document.getElementById('loader');
loader.style.display = 'block'; // Affiche la roue

const user_id = localStorage.getItem("user_id");

// Function to fetch unique donations
function fetchDonsUniques() {
    return fetch('../getDonations.php?user_id=' + user_id + "&recurrence=0")
        .then(res => res.json())
        .then(dons => {
            donsUniques = dons;
        })
        .catch(error => {
            console.error("Erreur de récupération dons uniques:", error);
            alert("Erreur lors du chargement des dons uniques.");
        });
}

// Function to fetch recurring donations
function fetchDonsReccurents() {
    return Promise.all([
      fetch('../getDonations.php?user_id=' + user_id + "&recurrence=1").then(res => res.json()),
      fetch('../getDonations.php?user_id=' + user_id + "&recurrence=2").then(res => res.json())
    ])
    .then(([dons1, dons2]) => {
      donsReccurents = dons1.concat(dons2); // Combine les deux tableaux
    })
    .catch(error => {
      console.error("Erreur de récupération dons récurrents:", error);
      alert("Erreur lors du chargement des dons récurrents.");
    });
  }

function fetchAssociations() {
    return fetch('../getAssos.php')
        .then(res => res.json())
        .then(assos => {
            associations = assos;
        })
        .catch(error => {
            console.error("Erreur de récupération des associations:", error);
            alert("Erreur lors du chargement des associations.");
        });
}

function createDonUnique() {
    let donList = document.getElementById("don-unique");
    donList.innerHTML = "";
    let count = 0;
    
    donsUniques.forEach(currentDon => {
      if (count < 4 && currentDon) {
        let currentAsso = associations.find(assos => assos.id == currentDon.id_assos) || { nom: "Association inconnue" };
  
        let donDiv = document.createElement("div");
        donDiv.classList.add("row-card");
  
        let donName = document.createElement("p");
        donName.classList.add("asso-name");
        donName.innerHTML = currentAsso.nom;
  
        let donAmount = document.createElement("p");
        donAmount.classList.add("asso-amount");
        donAmount.innerHTML = currentDon.montant_don + currency;
  
        let donDate = document.createElement("p");
        donDate.classList.add("asso-date");
        donDate.innerHTML = currentDon.date_don;
  
        donDiv.appendChild(donName);
        donDiv.appendChild(donAmount);
        donDiv.appendChild(donDate);
  
        donList.appendChild(donDiv);
        
        count++;
      }
    });
    
    if (count === 0) {
      donList.innerHTML = "vous n'avez pas effectué de dons";
    }
  }
  
function createDonRec() {
    let donRecList = document.getElementById("don-rec");
    donRecList.innerHTML = "";

    console.log(donsReccurents);
    
    if (donsReccurents.length !== 0) {
        donsReccurents.forEach(currentDon => {
            let currentAsso = associations.find(assos => assos.id == currentDon.id_assos);

            if (!currentDon) return;
            // Create donation container
            let donDiv = document.createElement("div");
            donDiv.classList.add("row-card");

            // Create donation name text
            let donName = document.createElement("p");
            donName.classList.add("asso-name");
            donName.innerHTML = currentAsso.nom;

            // Create donation amount
            let donAmount = document.createElement("p");
            donAmount.classList.add("asso-amount");
            donAmount.innerHTML = currentDon.montant_don + currency;

            // Create donation recurrence interval
            let donRecurr = document.createElement("p");
            donRecurr.classList.add("asso-recurr");
            if(currentDon.recurrence == 1){
                donRecurr.innerHTML = "mois"
            } else if(currentDon.recurrence == 2){
                donRecurr.innerHTML = "année"
            }
        

            // Create edit button
            let donEditBtn = document.createElement("button");
            donEditBtn.classList.add("don-edit-btn");
            donEditBtn.setAttribute("id", "don-edit-btn");
            donEditBtn.innerHTML = "edit";

            //create delete button
            let donDeleteBtn = document.createElement("button");
            donDeleteBtn.classList.add("don-delete-btn");
            donDeleteBtn.setAttribute("id", "don-edit-btn");
            donDeleteBtn.innerHTML = 'delete';

            // Append elements to the donation container
            donDiv.appendChild(donName);
            donDiv.appendChild(donAmount);
            donDiv.appendChild(donRecurr);
            donDiv.appendChild(donEditBtn);
            donDiv.appendChild(donDeleteBtn);

            donRecList.appendChild(donDiv);
        });
    } else {
        donRecList.innerHTML = "vous n'avez pas effectué de dons récurrents";
    }
}

function initEditDonModal() {
    if (donsReccurents.length !== 0) {
        const editDonBtn = document.getElementById("don-edit-btn");
        const modal = document.getElementById("editDonModal");
        const closeModal = document.getElementById("closeeditModal");  

        editDonBtn.addEventListener("click", () => {
            modal.style.display = "flex";
        });
    
        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });
    
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    }  
}


// Ensure all data is fetched before calling the functions
Promise.all([fetchDonsUniques(), fetchDonsReccurents(), fetchAssociations()])
    .then(() => {
        createDonUnique();  // Call this function after all data has been fetched
        createDonRec();     // Call this function after all data has been fetched
        initEditDonModal();
    })
    .catch(error => {
        console.error("Erreur de récupération des données:", error);
        alert("Erreur lors du chargement des données.");
    })
    .finally(() => {
        loader.style.display = 'none'; // Cache le loader after all fetches
    });
