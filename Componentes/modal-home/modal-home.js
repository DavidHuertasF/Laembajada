// Get the modal
var modal = document.getElementById("myModal");
var modalM = document.getElementById("myModal-m");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btnM = document.getElementById("myBtn-m");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var spanM = document.getElementsByClassName("close-m")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

btnM.onclick = function() {
  modalM.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

spanM.onclick = function() {
  modalM.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

window.onclick = function(event) {
  if (event.target == modalM) {
    modalM.style.display = "none";
  }
}


var sectionA =  document.getElementById("section-a");
var sectionB =  document.getElementById("section-b");
var sectionC =  document.getElementById("section-c");

var sectionAm =  document.getElementById("section-a-m");
var sectionBm =  document.getElementById("section-b-m");
var sectionCm =  document.getElementById("section-c-m");

sectionAm.onclick = function() {
    document.getElementById('pop-section-m').src='img/svg/pop-sections/s1.svg'
    document.getElementById('galery-modal-m').src='img/pop-sections/s1.png'
}
sectionBm.onclick = function() {
    document.getElementById('pop-section-m').src='img/svg/pop-sections/s2.svg'
    document.getElementById('galery-modal-m').src='img/pop-sections/s2.png'
}
sectionCm.onclick = function() {
    document.getElementById('pop-section-m').src='img/svg/pop-sections/s3.svg'
    document.getElementById('galery-modal-m').src='img/pop-sections/s3.png'
}