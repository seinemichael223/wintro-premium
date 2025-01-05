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

// Categories Menu
$('.award-btn').click(function(e){
    e.preventDefault();
    $('nav ul .award-show').toggleClass("show");
    $('nav ul .first').toggleClass("rotate");
});

$('.gift-btn').click(function(e){
    e.preventDefault();
    $('nav ul .gift-show').toggleClass("show1");
    $('nav ul .second').toggleClass("rotate");
});

$('.nametag-btn').click(function(e){
    e.preventDefault();
    $('nav ul .nametag-show').toggleClass("show2");
    $('nav ul .third').toggleClass("rotate");
});

$('.cloth-btn').click(function(e){
    e.preventDefault();
    $('nav ul .cloth-show').toggleClass("show3");
    $('nav ul .forth').toggleClass("rotate");
});

$('.print-btn').click(function(e){
    e.preventDefault();
    $('nav ul .print-show').toggleClass("show4");
    $('nav ul .fifth').toggleClass("rotate");
});

$('.office-btn').click(function(e){
    e.preventDefault();
    $('nav ul .office-show').toggleClass("show5");
    $('nav ul .sixth').toggleClass("rotate");
});

$('.sport-btn').click(function(e){
    e.preventDefault(); //prevent default action of button
    $('nav ul .sport-show').toggleClass("show6"); // show drop-down menu of each category
    $('nav ul .seventh').toggleClass("rotate"); //arrow icon rotation
});

$('nav ul li').click(function(){
    $(this).addClass("active").siblings().removeClass("active"); //category title add colored boxed when clicked n remove clicked other
});

// Filter
// Get references to the range inputs, tooltips, and input fields
const minSlider = document.querySelector('input[name="min_val"]');
const maxSlider = document.querySelector('input[name="max_val"]');
const minInput = document.querySelector('input[name="min_input"]');
const maxInput = document.querySelector('input[name="max_input"]');
const sliderTrack = document.querySelector('.slider-track');

// Minimum gap between the two thumbs
const minGap = 50; // Set the minimum gap

function updatePrice() {
    // Update the min and max input fields with the slider values
    minInput.value = minSlider.value;
    maxInput.value = maxSlider.value;

    // Position the tooltips based on the slider values (below the sliders)
    const minLeft = (minSlider.value / minSlider.max) * 100;
    const maxLeft = (maxSlider.value / maxSlider.max) * 100;

    // Adjust the horizontal position of the tooltips
    minTooltip.style.left = `calc(${minLeft}% - 20px)`; 
    maxTooltip.style.left = `calc(${maxLeft}% - 20px)`; 

    // Update the range track color and width
    const trackWidth = maxLeft - minLeft; // Calculate the width between the thumbs
    const trackStart = minLeft; // Starting position of the track (from the min thumb)
    
    sliderTrack.style.left = `${trackStart}%`; // Set the left position of the track
    sliderTrack.style.width = `${trackWidth}%`; // Set the width of the colored track
}

// Function to update the slider value based on input field
function updateSliderFromInput(slider, input) {
    // Get the value from the input field, removing "RM" prefix
    let value = input.value;

    // Allow an empty input field to reset the slider to 0 if nothing is typed
    if (value === '') {
        value = 0;
    }

    // Convert value to a number and ensure it's within the valid range for the slider
    value = parseInt(value, 10);

    // If the value is valid and within the slider range, update the slider
    if (!isNaN(value) && value >= slider.min && value <= slider.max) {
        slider.value = value;
    }

    // Call updatePrice to reflect the changes
    updatePrice();
}

// Ensure minimum gap between sliders
function enforceMinGap() {
    const minValue = parseInt(minSlider.value);
    const maxValue = parseInt(maxSlider.value);

    if (maxValue - minValue < minGap) {
        if (minSlider === document.activeElement) {
            minSlider.value = maxValue - minGap;
        } else {
            maxSlider.value = minValue + minGap;
        }
    }
    
    updatePrice();
}

// Attach the update function to the 'input' event on the sliders
minSlider.addEventListener('input', () => {
    enforceMinGap();
    updatePrice();
});

maxSlider.addEventListener('input', () => {
    enforceMinGap();
    updatePrice();
});

// Attach the function to the input fields to update the sliders
minInput.addEventListener('input', () => updateSliderFromInput(minSlider, minInput));
maxInput.addEventListener('input', () => updateSliderFromInput(maxSlider, maxInput));

// Initial call to set the values on page load
updatePrice();
