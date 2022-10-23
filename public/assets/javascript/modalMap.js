// const modal = document.querySelector(".modalMap");
// const trigger = document.querySelector(".mapBtn");
// const closeButton = document.querySelector(".closeButtonMap");

// function toggleModalMap() {
//   modal.classList.toggle("showModal");
// }

// function windowOnClick(event) {
//   if (event.target === modal) {
//     toggleModalMap();
//   }
// }

// trigger.addEventListener("click", toggleModalMap);
// closeButton.addEventListener("click", toggleModalMap);
// window.addEventListener("click", windowOnClick);


const modal = document.querySelector(".modalMap");
const modalNAQ = document.querySelector(".modalMap");

const GES = document.querySelector(".mapBtnGES");
const NAQ= document.querySelector(".mapBtnNAQ");
const ARA= document.querySelector(".mapBtnARA");
const BFC= document.querySelector(".mapBtnBFC");
const BRE= document.querySelector(".mapBtnBRE");
const CVL= document.querySelector(".mapBtnCVL");
const COR= document.querySelector(".mapBtnCOR");
const IDF= document.querySelector(".mapBtnIDF");
const OCC= document.querySelector(".mapBtnOCC");
const HDF= document.querySelector(".mapBtnHDF");
const NOR= document.querySelector(".mapBtnNOR");
const PDL= document.querySelector(".mapBtnPDL");
const PAC= document.querySelector(".mapBtnPAC");

const closeButton = document.querySelector(".closeButtonMap");

function toggleModal() {
  modal.classList.toggle("showModalMap");
}

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal();
  }
}

GES.addEventListener("click", toggleModal);
NAQ.addEventListener("click", toggleModal);
ARA.addEventListener("click", toggleModal);
BFC.addEventListener("click", toggleModal);
BRE.addEventListener("click", toggleModal);
CVL.addEventListener("click", toggleModal);
COR.addEventListener("click", toggleModal);
IDF.addEventListener("click", toggleModal);
OCC.addEventListener("click", toggleModal);
HDF.addEventListener("click", toggleModal);
NOR.addEventListener("click", toggleModal);
PDL.addEventListener("click", toggleModal);
PAC.addEventListener("click", toggleModal);

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);




