
const modal = document.querySelector(".modal-map");
const areas = document.getElementsByClassName("area");

Array.from(areas).map((area) => {
  area.addEventListener("click", toggleModal);
});

const closeButton = document.querySelector(".close-button-map");

function toggleModal() {
  modal.classList.toggle("show-modal-map");
}

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal();
  }
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

