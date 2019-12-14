// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


var sectionA =  document.getElementById("section-a");
var sectionB =  document.getElementById("section-b");
var sectionC =  document.getElementById("section-c");

sectionA.onclick = function() {
    document.getElementById('pop-section').src='img/svg/pop-sections/s1.svg'
    document.getElementById('galery-modal').src='img/pop-sections/s1.png'
}
sectionB.onclick = function() {
    document.getElementById('pop-section').src='img/svg/pop-sections/s2.svg'
    document.getElementById('galery-modal').src='img/pop-sections/s2.png'
}
sectionC.onclick = function() {
    document.getElementById('pop-section').src='img/svg/pop-sections/s3.svg'
    document.getElementById('galery-modal').src='img/pop-sections/s3.png'
}