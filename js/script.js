jQuery(function ($) {

  // Back to Top Button
  $(document).ready(function(){
    var btn = $('#to_top_button');

    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });
  
    btn.on('click', function (e) {
      console.log('Button clicked!')
      e.preventDefault();
      $(this).addClass('click');
      $('html, body').animate({ scrollTop: 0 }, '300');
      $(this).addClass('click2');
  
    });
  });


  var lastScrollTop = 0;

  $(window).scroll(function () {
    var currentScrollTop = $(this).scrollTop();
  
    if (currentScrollTop > lastScrollTop) {
      // Scrolling down
      $('.header').removeClass("sticky");
    } else {
      // Scrolling up
      if (currentScrollTop > 100) {
        $('.header').addClass("sticky");
      } else {
        $('.header').removeClass("sticky");
      }
    }
  
    lastScrollTop = currentScrollTop;
  });

  $(window).scroll(function() {
    if ($(this).scrollTop() > 300){  
        $('.header').addClass("transform-sticky");
      }
      else{
        $('.header').removeClass("transform-sticky");
      }
  });
  

  $(document).ready(function() {
    var pathname = window.location.pathname;
    if (pathname.endsWith("/index.php") || pathname === "/shop/") {
      $("header").addClass("index-page");
    }
  });

  // Dropdown Button

  $(document).ready(function() {
    $(".primary-menu li.menu-dropdown > a").append('<span class="dropdown-btn"><i class="fa-solid fa-chevron-right"></i></span>');
    

    $('.dropdown-btn').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().parent().toggleClass('open').first().siblings().removeClass('open');
        $(this).parent().parent().find("ul").parent().find("ul.sub-menu").first().slideToggle();
        $(this).parent().parent().siblings().find("ul.sub-menu").slideUp().parent().removeClass('open');
        $(this).toggleClass('transform-90');
        $(this).parent().parent().siblings().find('.dropdown-btn').removeClass('transform-90');
    });
});


$('.primary-menu li').has('ul').addClass('menu-dropdown');

$(document).ready(function(){
  $('.hamburger').click( function(){
    $(this).toggleClass('active');
    $('.overlay').toggleClass('active');
    $('.primary-menu').toggleClass('active');
  });
});



  $(document).ready(function(){
    // Handle image change on click within the 'for-change-image' container
    $('.for_change-image a').on('click', function (event) {
        event.preventDefault();
        var imageUrl = $(this).attr('href');
        $('#zoom1 img').attr('src', imageUrl);
    });

    if (document.querySelector('.zoomable-image')) {
      window.openFancybox = function (element) {
      // console.log("hello");
      var $image = $(element).closest('.image').find('.zoomable-image');
      var imageSrc = $image.attr('src');
      
      if (imageSrc) {
        console.log('Image Source:', imageSrc);
        $.fancybox.open({
          src: imageSrc,
          type: 'image',
          opts: {
            buttons: [
              "zoom",
              "fullScreen",
              "close"
            ],
            fullScreen: {
              autoStart: false,
            },
            touch: {
              vertical: true,
              momentum: true
            },
            openEffect: 'none',
            closeEffect: 'none',
          }
        });
        // console.log("hi");
      } else {
        console.error('Image source not found.');
      }
    }
  }
    
 
  

    $(document).ready(function() {
        const zoom = $('#zoom1');
        const s = 2;
    

        
        zoom.on('mousemove', function(e) {
          const x = e.pageX - $(this).offset().left - zoom.width() / 2;
          const y = e.pageY - $(this).offset().top- zoom.height() / 2;

          var xc = - x / s;
          var yc = - y / s;
    
            $('.zoomable-image').css('transform', 'translate(' + xc + 'px, ' + yc + 'px) scale(1.5)');

        });

        zoom.on('mouseleave', function () {
            $('.zoomable-image').css('transform', 'translate(0, 0) scale(1)');
        });
      });
  });

  $(document).ready(function(){
    // AJAX to add product to cart
    $('.product-button-container a.add_to_cart_button').click(function(e){
        e.preventDefault();
        var container = $(this).closest('.product-button-container');
        container.addClass("loading");

        var href = 'index.php'; 
        var productId = $(this).data('product-id');
        var quantity = 1; // Set the default quantity to 1 or adjust as needed

        $.ajax({
            type: 'POST', // Use POST method for adding to cart
            url: href,
            data: { 
                add_to_cart: productId,
                quantity: quantity // Send product ID and quantity as parameters
            },
            success: function(response) {
                console.log("AJAX request successful");
                console.log("Response from server:", response);

                // Refresh the page after successful addition to the cart
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed");
                console.error("Error:", error);
            }
        });
    });
});





// update cart

$(document).ready(function () {
  var x = parseInt($(".quantity-product").val());

  $(".plus").click(function () {
      $(".quantity-product").val(++x);
      $('#updateButton').prop('disabled', false); 
  });

  $(".minus").click(function () {
      if (x > 1) {
          $(".quantity-product").val(--x);
          $('#updateButton').prop('disabled', false); 
      } else {
          x = 1;
      }
  });

  var updateButton = $('#updateButton');
  var quantityInputs = $('.quantity-product');
  var initialQuantities = [];
  // var productPrices = $('.product-price .product-amount');
  // var productSubtotals = $('.product-subtotal .product-amount');
  // var subtotalElement = $('#subtotal .product-amount');
  // var totalElement = $('#total .product-amount');

  quantityInputs.each(function () {
      initialQuantities.push($(this).val());
  });

  updateTotals();

  quantityInputs.on('input', function () {
      updateButton.prop('disabled', false);
  });

  updateButton.on('click', function () {
      updateTotals();
      $(this).prop('disabled', true);
      $(".update-message").addClass("active");
  });

  // function updateTotals() {
  //     var subtotal = 0;

  //     quantityInputs.each(function (index) {
  //         var quantity = parseInt($(this).val());
  //         var productPrice = parseFloat(productPrices.eq(index).text().replace('$', ''));
  //         var productSubtotal = quantity * productPrice;

  //         productSubtotals.eq(index).html('<span class="price-symbol">$</span>' + productSubtotal.toFixed(2));

  //         subtotal += productSubtotal;
  //     });

  //     subtotalElement.html('<span class="price-symbol">$</span>' + subtotal.toFixed(2));
  //     totalElement.html('<span class="price-symbol">$</span>' + subtotal.toFixed(2));
  // }
});

$(document).ready(function () {

  $('.search-cart-user .side-btn button').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    
    $('.slide-box').removeClass('active');
    $('.search-box input').focus();
    var index = $(this).closest('.side-btn').index();
    $('.slide-box').eq(index).addClass('active');
    $('.overlay-bg').toggleClass('active');

  });
  
  $('.overlay-bg').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    $('.slide-box').removeClass('active');
    $('.overlay-bg').removeClass('active');
  });

  $('.search-cart-user-box .icon').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    $('.slide-box').removeClass('active');
    $('.overlay-bg').removeClass('active');
  });

  $('.cart_wishlist').click(function(){
    $(this).toggleClass('active');
  });

});

});

// WOW.js Initialization
new WOW().init();



// Splide Slider Initialization
if (document.querySelector('.banner-slide')) {
  var splide = new Splide('.banner-slide', {
      type: 'fade',
      rewind: true,
      perPage: 1,
      pagination: false,
      interval: 3000,
      breakpoints: {
          1024: {
              interval: 2000,
              arrows: false,
              pagination: true,
          },
      },
  });

  splide.on("active", function (slide) {
      console.log("Slide with index", slide.index, "is now active.");

      if (typeof $ !== 'undefined') {
          $(".banner-slide .wow").removeClass("animate__animated");
          $(".banner-slide .splide__slide.is-active .wow").addClass("animate__animated").css("animation-name", "fadeIn");
      }
  });

  splide.on("moved", function () {
      console.log("Slide has moved.");

      if (typeof $ !== 'undefined') {
          $(".banner-slide .wow").removeClass("animate__animated");

          var activeSlideWowElements = $(".banner-slide .splide__slide.is-active .wow");
          activeSlideWowElements.addClass("animate__animated").css("animation-name", "fadeIn");

          activeSlideWowElements.one("animationend", function () {
              $(".banner-slide .splide__slide:not(.is-active) .wow").css("animation-name", "none");
          });

          setTimeout(function () {
              $(".banner-slide .splide__slide:not(.is-active) .wow").css("animation-name", "none");
          }, 1000);
      }
  });

  splide.mount();
  new WOW().init();
}

if (document.querySelector('.footer-slide')){
  var footer = new Splide('.footer-slide', {
    perPage: 1,
  });
  footer.mount();
}

// user image error
$(function () {
  $('.user-image img').each(function() {
      if (!$(this).attr('src')) {
          $(this).attr({src: 'https://pixsector.com/cache/517d8be6/av5c8336583e291842624.png', alt: 'default image'});
      }
  });
});


// // show password
// const passwordInput = document.querySelector('.password'); // Using querySelector to select the password input field
// const showPasswordCheckbox = document.querySelector('.showPassword'); // Using querySelector to select the showPassword checkbox

// showPasswordCheckbox.addEventListener('change', function() {
//     if (showPasswordCheckbox.checked) {
//         passwordInput.type = 'text';
//     } else {
//         passwordInput.type = 'password';
//     }
// });

const showPasswordCheckboxes = document.querySelectorAll('.showPassword');

showPasswordCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const passwordField = checkbox.parentElement.querySelector('.password'); // Select the password field within the same form group

        if (checkbox.checked) {
            passwordField.type = 'text'; // Show password
        } else {
            passwordField.type = 'password'; // Hide password
        }
    });
});


// Function to validate username
function validateUsername() {
  const usernameInput = document.getElementById("user_name");
  const usernameError = document.getElementById("usernameError");
  if (usernameInput.value.trim().length < 3) {
      usernameError.textContent = "Username must be at least 3 characters long.";
      return false;
  } else {
      usernameError.textContent = "";
      return true;
  }
}

// Function to validate email
function validateEmail() {
  const emailInput = document.getElementById("user_email");
  const emailError = document.getElementById("emailError");
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
      emailError.textContent = "Enter a valid email address.";
      return false;
  } else {
      emailError.textContent = "";
      return true;
  }
}

// Function to validate password
function validatePassword() {
  const passwordInput = document.getElementById("user_password");
  const passwordError = document.getElementById("passwordError");
  if (passwordInput.value.trim().length < 8 || !/[A-Z]/.test(passwordInput.value) || !/[a-z]/.test(passwordInput.value) || !/\d/.test(passwordInput.value) || !/[@$!%*?&]/.test(passwordInput.value)) {
      passwordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, 1 number, 1 special character, and be 8 characters long.";
      return false;
  } else {
      passwordError.textContent = "";
      return true;
  }
}

// Function to validate confirm password
function validateConfirmPassword() {
  const passwordInput = document.getElementById("user_password");
  const confirmPasswordInput = document.getElementById("conform_user_password");
  const confirmPasswordError = document.getElementById("confirmPasswordError");
  if (passwordInput.value.trim() !== confirmPasswordInput.value.trim()) {
      confirmPasswordError.textContent = "Passwords do not match.";
      return false;
  } else {
      confirmPasswordError.textContent = "";
      return true;
  }
}

// Function to validate address
function validateAddress() {
  const addressInput = document.getElementById("user_address");
  const addressError = document.getElementById("addressError");
  if (addressInput.value.trim().length < 5) {
      addressError.textContent = "Address must be at least 5 characters long.";
      return false;
  } else {
      addressError.textContent = "";
      return true;
  }
}

// Function to validate contact
function validateContact() {
  const contactInput = document.getElementById("user_contact");
  const contactError = document.getElementById("contactError");
  const contactValue = contactInput.value.trim();

  if (contactValue.length !== 10 || isNaN(contactValue) || contactValue.charAt(0) !== '9' || !['8', '6', '7'].includes(contactValue.charAt(1))) {
      contactError.textContent = "Contact must be a 10-digit number starting with 9 and the second digit must be 8, 6, or 7.";
      return false;
  } else {
      contactError.textContent = "";
      return true;
  }
}

// Add event listeners for input events
document.getElementById("user_name").addEventListener("input", validateUsername);
document.getElementById("user_email").addEventListener("input", validateEmail);
document.getElementById("user_password").addEventListener("input", validatePassword);
document.getElementById("conform_user_password").addEventListener("input", validateConfirmPassword);
document.getElementById("user_address").addEventListener("input", validateAddress);
document.getElementById("user_contact").addEventListener("input", validateContact);

// Add event listener for form submission
document.getElementById("registrationForm").addEventListener("submit", function(event) {
  // Prevent form submission if any of the validations fail
  if (!validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmPassword() || !validateAddress() || !validateContact()) {
      event.preventDefault();
  }
});