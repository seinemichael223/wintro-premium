// Swiper-Cart (Reuse in Contact Us)
new Swiper('.category1-slider' , {
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

// Swiper-WishList (Reuse in Contact Us)
new Swiper('.category2-slider' , {
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

// Switch between MyCart and Wishlist
function switchTab(tabId) {
    // Hide all contents
    document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
    // Deactivate all tabs
    document.querySelectorAll('.tabs div').forEach(tab => tab.classList.remove('active'));
    // Show the selected content and activate the selected tab
    if (tabId === 'cart') {
        document.getElementById('MyCart').classList.add('active');
        document.getElementById('cartTab').classList.add('active');
    } else if (tabId === 'wishlist') {
        document.getElementById('WishList').classList.add('active');
        document.getElementById('wishlistTab').classList.add('active');
    }
}