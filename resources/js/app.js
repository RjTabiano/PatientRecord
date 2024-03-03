import './bootstrap';

import Alpine from 'alpinejs';

import '@dmuy/timepicker/dist/mdtimepicker.css';
import mdtimepicker from '@dmuy/timepicker';

window.Alpine = Alpine;

Alpine.start();

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

