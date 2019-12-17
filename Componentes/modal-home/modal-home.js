// Get the modal

function modalMobile() {
      var modalM = document.getElementById("myModal-m");
      var btnM = document.getElementById("myBtn-m");
      var spanM = document.getElementsByClassName("close-m")[0];

      btnM.onclick = function() {
        modalM.style.display = "block";
      };

      spanM.onclick = function() {
        modalM.style.display = "none";
      };

      window.onclick = function(event) {
        if (event.target == modalM) {
          modalM.style.display = "none";
        }
      };

      var sectionAm = document.getElementById("section-a-m");
      var sectionBm = document.getElementById("section-b-m");
      var sectionCm = document.getElementById("section-c-m");

      sectionAm.onclick = function() {
        document.getElementById("pop-section-m").src =
          "img/svg/pop-sections/s1.svg";
        document.getElementById("galery-modal-m").src = "img/pop-sections/s1.png";
      };
      sectionBm.onclick = function() {
        document.getElementById("pop-section-m").src =
          "img/svg/pop-sections/s2.svg";
        document.getElementById("galery-modal-m").src = "img/pop-sections/s2.png";
      };
      sectionCm.onclick = function() {
        document.getElementById("pop-section-m").src =
          "img/svg/pop-sections/s3.svg";
        document.getElementById("galery-modal-m").src = "img/pop-sections/s3.png";
      };
}

function modalDesktop() {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    };

    span.onclick = function() {
      modal.style.display = "none";
    };

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };

    var sectionA = document.getElementById("section-a");
    var sectionB = document.getElementById("section-b");
    var sectionC = document.getElementById("section-c");

    sectionA.onclick = function() {
      document.getElementById("pop-section").src = "img/svg/pop-sections/s1.svg";
      document.getElementById("galery-modal").src = "img/pop-sections/s1.png";
    };
    sectionB.onclick = function() {
      document.getElementById("pop-section").src = "img/svg/pop-sections/s2.svg";
      document.getElementById("galery-modal").src = "img/pop-sections/s2.png";
    };
    sectionC.onclick = function() {
      document.getElementById("pop-section").src = "img/svg/pop-sections/s3.svg";
      document.getElementById("galery-modal").src = "img/pop-sections/s3.png";
    };
}

// When the user clicks on <span> (x), close the modal

// When the user clicks anywhere outside of the modal, close it
