


const navBar = document.querySelector("nav"),
       menuBtns = document.querySelectorAll(".menu-icon"),
       overlay = document.querySelector(".overlay");

     menuBtns.forEach((menuBtn) => {
       menuBtn.addEventListener("click", () => {
         navBar.classList.toggle("open");
       });
     });

     overlay.addEventListener("click", () => {
       navBar.classList.remove("open");
     });




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


