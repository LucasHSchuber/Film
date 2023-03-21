"user strict";



function openCity(evt, infotoggle) {
    let i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(infotoggle).style.display = "block";
    evt.currentTarget.className += " active";
  }

// let iconEl = document.getElementById("icon");
// let style = window.getComputedStyle(iconEl);

  function Navbar() {
    let x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";

      iconEl
    } else {
      x.className = "topnav";


    }
  }