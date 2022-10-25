
const modal = document.querySelector(".modalMap");
const modalNAQ = document.querySelector(".modalMap");
const areas = document.getElementsByClassName("area");

Array.from(areas).map((area) => {
  area.addEventListener("click", toggleModal);
});

const closeButton = document.querySelector(".closeButtonMap");

function toggleModal() {
  modal.classList.toggle("showModalMap");
}

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal();
  }
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

