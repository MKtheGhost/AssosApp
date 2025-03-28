import { associations } from './dataAssociation.js';

const form = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');

// Fonction pour créer un article pour chaque association
document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("assos-container");

    associations.forEach(asso => {

      const article = document.createElement("article");
      article.classList.add("association-card");

      const img = document.createElement("img");
      img.src = asso.image; // Remplacez par une vraie URL si disponible
      img.alt = asso.nom;
      img.onerror = () => { img.src = "images/assos/default-image.jpg"; };

      //create wrapper for text content
      const infoDiv = document.createElement("div");
      infoDiv.classList.add("association-info");


      const h2 = document.createElement("h2");
      h2.textContent = asso.nom;

      const p = document.createElement("p");
      p.textContent = asso.description;

      article.appendChild(img);
      infoDiv.appendChild(h2);
        infoDiv.appendChild(p);
      article.appendChild(infoDiv);

      container.appendChild(article);
    });
  });


searchInput.addEventListener("input",(e)=>{
    const searchedLetter = e.target.value.toLowerCase();
    const card = document.querySelectorAll('.association-card');
    console.log(card);
    filterElements(searchedLetter,card);
})

function filterElements(letters,elements){
    console.log(elements);

        for(let i=0;i<elements.length;i++){
            if(elements[i].textContent.toLowerCase().includes(letters))
                elements[i].style.display="flex";
            else
                elements[i].style.display="none";
    }
}
