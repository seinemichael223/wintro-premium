document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelector('.slides');
    const slideElements = document.querySelectorAll('.slide');
    const manualBtns = document.querySelectorAll('.manual-btn');
    const radioInputs = document.querySelectorAll('input[name="radio-btn"]');
    let currentSlide = 0;
    let autoSlideInterval;

// Update slide and manual button active states
function updateSlide(index) {
// Move slides
slides.style.transform = `translateX(-${index * 100}%)`;

// Update radio buttons
radioInputs[index].checked = true;
        
// Update manual buttons
manualBtns.forEach((btn, i) => {
    btn.classList.toggle('active', i === index);
});

    currentSlide = index;
}

// Auto sliding
function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        currentSlide = (currentSlide + 1) % slideElements.length;
        updateSlide(currentSlide);
    }, 3000); // Change slide every 5 seconds
}

// Manual navigation
manualBtns.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        // Reset auto slide
        clearInterval(autoSlideInterval);
        updateSlide(index);
        startAutoSlide();
    });
});

// Start auto sliding
startAutoSlide();
});

// Swiper (Reuse in Contact Us)
new Swiper('.category-slider', {
    loop: true,
    spaceBetween: 20,
  
// Pagnigation bullets
pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true,
},
  
// Navigation arrows
navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
},

// Responsive breakpoints
breakpoints: {
    0:{
        slidesPerView: 3
    },
    768:{
        slidesPerView: 4
    },
    1024:{
        slidesPerView: 5
    },
    }
});

// Overlay of Product
document.getElementById('product-link').addEventListener('click', function (e) {
    e.preventDefault();
    const dropdown = document.getElementById('product-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

// Close the dropdown when clicking outside
document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('product-dropdown');
    const productLink = document.getElementById('product-link');

    if (!dropdown.contains(e.target) && e.target !== productLink) {
        dropdown.style.display = 'none';
    }
});
