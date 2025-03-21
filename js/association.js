import { associations } from './dataAssociation.js';

document.addEventListener('DOMContentLoaded', () => {
  // 1. Parse the 'name' parameter from the URL
  const params = new URLSearchParams(window.location.search);
  const assoName = params.get('name'); // e.g., "AAAVAM"

  // 2. Find the association in the array
  let currentAsso = associations.find(asso => asso.nom === assoName);

  // Fallback if not found
  if (!currentAsso) {
    currentAsso = {
      nom: "Association introuvable",
      description: "Aucune description disponible",
      site: "#" // or any fallback URL
    };
  }

  // 3. Fill the content
  document.getElementById('asso-name').textContent = currentAsso.nom;
  document.getElementById('asso-desc').textContent = 
    currentAsso.description || "Description non disponible";

  // If you have a real site URL, add it to the association object
  // e.g. { nom: "AAAVAM", description: "...", site: "https://exemple.com" }
  const siteLink = document.getElementById('asso-site');
  siteLink.href = currentAsso.site || "#";
});
