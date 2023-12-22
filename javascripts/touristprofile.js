const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function showSlide() {
  slides.forEach((slide, index) => {
    if (index === currentSlide) {
      slide.classList.add('active');
    } else {
      slide.classList.remove('active');
    }
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide();
}

// Change slide every 3 seconds
setInterval(nextSlide, 3000);

// Show the initial slide
showSlide();


//hide and view the change details panel
function hideCd()
{
   let x = document.getElementById('cdf');
   x.classList.add('hide');
}
function viewCd()
{
  let x = document.getElementById('cdf');
  x.classList.remove('hide');
}
