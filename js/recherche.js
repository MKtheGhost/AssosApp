import { associations } from './dataAssociation.js';

const form = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');

// Fonction pour créer un article pour chaque association
document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("assos-container");

    associations.forEach(asso => {

      const article = document.createElement("article");
      article.classList.add("association");

      const img = document.createElement("img");
      img.src = "default-image.jpg"; // Remplacez par une vraie URL si disponible
      img.alt = asso.nom;

      const h2 = document.createElement("h2");
      h2.textContent = asso.nom;

      const p = document.createElement("p");
      p.textContent = asso.description;

      article.appendChild(img);
      article.appendChild(h2);
      article.appendChild(p);

      container.appendChild(article);
    });
  });


searchInput.addEventListener("input",(e)=>{
    const searchedLetter = e.target.value.toLowerCase();
    const card = document.querySelectorAll('.association');
    console.log(card);
    filterElements(searchedLetter,card);
})

function filterElements(letters,elements){
    console.log(elements);

        for(let i=0;i<elements.length;i++){
            if(elements[i].textContent.toLowerCase().includes(letters))
                elements[i].style.display="block";
            else
                elements[i].style.display="none";



    }
}
