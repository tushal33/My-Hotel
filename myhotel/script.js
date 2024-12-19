// poopup for login section
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
   modal.style.display = "block";
};

span.onclick = function () {
   modal.style.display = "none";
};

window.onclick = function (event) {
   if (event.target == modal) {
      modal.style.display = "none";
   }
};
onclick = function (event) {
   if (event.target == modal) {
      modal.style.display = "none";
   }
};

// popup for register section
var modal2 = document.getElementById("myModal2");
var btn2 = document.getElementById("myBtn2");
var span2 = document.getElementsByClassName("close2")[0];

btn2.onclick = function () {
   modal2.style.display = "block";
};

span2.onclick = function () {
   modal2.style.display = "none";
};

window.onclick = function (event) {
   if (event.target == modal2) {
      modal2.style.display = "none";
   }
};
onclick = function (event) {
   if (event.target == modal2) {
      modal2.style.display = "none";
   }
};


// responsive navbar
function toggleMenu() {
   var menuIcon = document.querySelector('.menu-icon');
   var navItems = document.querySelector('#nav-items ul');
   var navRightItems = document.querySelector('#nav-right-items');
   menuIcon.classList.toggle('change');
   if (navItems.style.display === "flex") {
       navItems.style.display = "none";
       navRightItems.style.display = "none";
   } else {
       navItems.style.display = "flex";
       navRightItems.style.display = "flex";
   }
}
