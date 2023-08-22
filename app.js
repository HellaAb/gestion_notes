// // Sélectionne les éléments de menu et les pages correspondantes
// const rapportsLink = document.getElementById('tb_use');
// const clientsLink = document.getElementById('use_page');
// const rapportsPage = document.getElementById('tb_etud');
// const clientsPage = document.getElementById('etud_page');

// // Ajoute un gestionnaire d'événements pour le clic sur l'élément de menu Rapports
// rapportsLink.addEventListener('click', function() {
//   // Affiche la page Rapports et masque la page Clients
//   rapportsPage.style.display = 'block';
// //   clientsPage.style.display = 'none';
// });

// // Ajoute un gestionnaire d'événements pour le clic sur l'élément de menu Clients
// clientsLink.addEventListener('click', function() {
//   // Affiche la page Clients et masque la page Rapports
//   clientsPage.style.display = 'block';
//   rapportsPage.style.display = 'none';
// });
// Sélectionne le lien et la fenêtre modale
const inscriptionLink = document.getElementById("tb_use");
const maFenetreModale = document.getElementById("use_page");

// Sélectionne le bouton de fermeture de la fenêtre modale
const span = document.getElementsByClassName("close")[0];

// Ajoute un écouteur d'événement de clic au lien pour afficher la fenêtre modale
inscriptionLink.addEventListener("click", function(event) {
  event.preventDefault(); // Empêche la page de se recharger
  maFenetreModale.style.display = "block";
});

// Ajoute un écouteur d'événement de clic au bouton de fermeture pour masquer la fenêtre modale
span.addEventListener("click", function() {
  maFenetreModale.style.display = "none";
});
