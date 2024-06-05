const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar && nav) {
    bar.addEventListener('click', () => {
        nav.classList.toggle('active'); // Toggle the 'active' class on each click
    });
}

if (close && nav) {
    close.addEventListener('click', () => {
        nav.classList.remove('active'); // Toggle the 'active' class on each click
    });
}

var acc = document.getElementsByClassName("accordion");
              var i;
        
              for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function () {
                  this.classList.toggle("active");
                  this.parentElement.classList.toggle("active");
        
                  var pannel = this.nextElementSibling;
        
                  if (pannel.style.display === "block") {
                    pannel.style.display = "none";
                  } else {
                    pannel.style.display = "block";
                  }
                });
              }
