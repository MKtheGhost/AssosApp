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
    return fetch('../getDonations.php?user_id=' + user_id + "&recurrence=1"), fetch('../getDonations.php?user_id=' + user_id + "&recurrence=2")
        .then(res => res.json())
        .then(dons => {
            donsReccurents = dons;
        })
        .catch(error => {
            console.error("Erreur de récupération dons récurrents:", error);
            alert("Erreur lors du chargement des dons récurrents.");
        });
}

// Function to fetch associations
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

// Function to create and display unique donations
function createDonUnique() {
    let donList = document.getElementById("don-unique");
    donList.innerHTML = "";

    if (donsUniques.length !== 0) {
        for (let i = 0; i < 4; i++) {
            let currentDon = donsUniques[i];
            let currentAsso = associations.find(assos => assos.id == currentDon.id_assos);

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

            // Create donation date
            let donDate = document.createElement("p");
            donDate.classList.add("asso-date");
            donDate.innerHTML = currentDon.date_don;

            // Append elements to the donation container
            donDiv.appendChild(donName);
            donDiv.appendChild(donAmount);
            donDiv.appendChild(donDate);

            donList.appendChild(donDiv);
        }
    } else {
        donList.innerHTML = "vous n'avez pas effectué de dons";
    }
}

// Function to create and display recurring donations
function createDonRec() {
    let donRecList = document.getElementById("don-rec");
    donRecList.innerHTML = "";

    if (donsReccurents.length !== 0) {
        donsReccurents.forEach(currentDon => {
            let currentAsso = associations.find(assos => assos.id == currentDon.id_assos);

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
            let donDate = document.createElement("p");
            donDate.classList.add("asso-date");
            donDate.innerHTML = currentDon.recurrence_interval;

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
            donDiv.appendChild(donDate);
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
