// Swiper (Reuse in homepage)
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
