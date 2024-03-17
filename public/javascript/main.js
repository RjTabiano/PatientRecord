// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};


// ---------------------------- Open the modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

//----------------------------- Close the modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

// ---------------------------- Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// ---------------------------- END OF MODAL


// ---------------------------- Open the modal#2
function openModal2() {
  document.getElementById("myModal2").style.display = "block";
}

//----------------------------- Close the modal
function closeModal2() {
  document.getElementById("myModal2").style.display = "none";
}

// ---------------------------- Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById("myModal2");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// ---------------------------- END OF MODAL


function showForm() {
  var specialty = document.getElementById("specialty").value;
  var pediatricsForm = document.getElementById("pediatricsForm");
  var obgyneForm = document.getElementById("obgyneForm");

  if (specialty === 'pediatrics') {
      pediatricsForm.style.display = "block";
      obgyneForm.style.display = "none";
  } else if (specialty === 'obgyne') {
      obgyneForm.style.display = "block";
      pediatricsForm.style.display = "none";
  } else {
      pediatricsForm.style.display = "none";
      obgyneForm.style.display = "none";
  }
}
