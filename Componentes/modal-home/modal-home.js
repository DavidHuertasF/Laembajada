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
        document.getElementById("galery-modal-m").src = "https://drive.google.com/uc?id=1ouSFlKSPS-IrgbE4NQl8kUg6p0WFCvms";
      };
      sectionBm.onclick = function() {
        document.getElementById("pop-section-m").src =
          "img/svg/pop-sections/s2.svg";
        document.getElementById("galery-modal-m").src = "https://drive.google.com/uc?id=1866ao6GQPQ02Jowe-9ZLOoN1ZZmk_m56";
      };
      sectionCm.onclick = function() {
        document.getElementById("pop-section-m").src =
          "img/svg/pop-sections/s3.svg";
        document.getElementById("galery-modal-m").src = "https://drive.google.com/uc?id=1tIMfIljNviIDmq0s1HBPSdE4GuSBgWJm";
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
      document.getElementById("galery-modal").src = "https://drive.google.com/uc?id=1ouSFlKSPS-IrgbE4NQl8kUg6p0WFCvms";
    };
    sectionB.onclick = function() {
      document.getElementById("pop-section").src = "img/svg/pop-sections/s2.svg";
      document.getElementById("galery-modal").src = "https://drive.google.com/uc?id=1866ao6GQPQ02Jowe-9ZLOoN1ZZmk_m56";
    };
    sectionC.onclick = function() {
      document.getElementById("pop-section").src = "img/svg/pop-sections/s3.svg";
      document.getElementById("galery-modal").src = "https://drive.google.com/uc?id=1tIMfIljNviIDmq0s1HBPSdE4GuSBgWJm";
    };
}




