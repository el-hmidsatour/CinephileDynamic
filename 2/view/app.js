
const arrows = document.querySelectorAll(".arrow");
const movieLists = document.querySelectorAll(".movie-list");
/*
Ceci est le code du bouton du white mode 
arrows.forEach((arrow, i) => {
  const itemNumber = movieLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 270);
    clickCounter++;
    if (itemNumber - (4 + clickCounter) + (4 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });

  console.log(Math.floor(window.innerWidth / 270));
});

const ball = document.querySelector(".toggle-ball");
const items = document.querySelectorAll(
  ".container,.movie-list-title,.navbar-container,.sidebar,.left-menu-icon,.toggle"
);

ball.addEventListener("click", () => {
  items.forEach((item) => {
    item.classList.toggle("active");
  });
  //ball.classList.toggle("active");
});

*/

// Gestion du menu profil
const profileTrigger = document.querySelector('.profile-trigger');
const profileDropdown = document.querySelector('.profile-dropdown-menu');

profileTrigger.addEventListener('click', (e) => {
    e.stopPropagation();
    profileTrigger.classList.toggle('active');
    profileDropdown.classList.toggle('active');
});

// Fermer le menu quand on clique ailleurs
document.addEventListener('click', () => {
    profileTrigger.classList.remove('active');
    profileDropdown.classList.remove('active');
});

// Empêcher la fermeture quand on clique dans le menu
profileDropdown.addEventListener('click', (e) => {
    e.stopPropagation();
});







