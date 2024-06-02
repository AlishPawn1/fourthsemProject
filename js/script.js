jQuery(function ($) {
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

        // Additional scroll handling
        if (currentScrollTop > 300) {
            $('.header').addClass("transform-sticky");
        } else {
            $('.header').removeClass("transform-sticky");
        }
    });

    // Header class based on pathname
    var pathname = window.location.pathname;
    if (pathname.endsWith("/index.php") || pathname === "/shop/") {
        $("header").addClass("index-page");
    }

    // Dropdown Button
    $(".primary-menu li.menu-dropdown > a").append('<span class="dropdown-btn"><i class="fa-solid fa-chevron-right"></i></span>');

    $('.dropdown-btn').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().parent().toggleClass('open').first().siblings().removeClass('open');
        $(this).parent().parent().find("ul").parent().find("ul.sub-menu").first().slideToggle();
        $(this).parent().parent().siblings().find("ul.sub-menu").slideUp().parent().removeClass('open');
        $(this).toggleClass('transform-90');
        $(this).parent().parent().siblings().find('.dropdown-btn').removeClass('transform-90');
    });

    $('.primary-menu li').has('ul').addClass('menu-dropdown');

    // Hamburger menu
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('.overlay').toggleClass('active');
        $('.primary-menu').toggleClass('active');
    });

    // Image change on click
    $('.for_change-image a').on('click', function (event) {
        event.preventDefault();
        var imageUrl = $(this).attr('href');
        $('#zoom1 img').attr('src', imageUrl);
    });

    // Fancybox for zoomable images
    if (document.querySelector('.zoomable-image')) {
        window.openFancybox = function (element) {
            var $image = $(element).closest('.image').find('.zoomable-image');
            var imageSrc = $image.attr('src');

            if (imageSrc) {
                $.fancybox.open({
                    src: imageSrc,
                    type: 'image',
                    opts: {
                        buttons: ["zoom", "fullScreen", "close"],
                        fullScreen: { autoStart: false },
                        touch: { vertical: true, momentum: true },
                        openEffect: 'none',
                        closeEffect: 'none',
                    }
                });
            } else {
                console.error('Image source not found.');
            }
        };
    }

    // Image zoom on hover
    const zoom = $('#zoom1');
    const s = 2;

    zoom.on('mousemove', function (e) {
        const x = e.pageX - $(this).offset().left - zoom.width() / 2;
        const y = e.pageY - $(this).offset().top - zoom.height() / 2;
        var xc = -x / s;
        var yc = -y / s;
        $('.zoomable-image').css('transform', 'translate(' + xc + 'px, ' + yc + 'px) scale(1.5)');
    });

    zoom.on('mouseleave', function () {
        $('.zoomable-image').css('transform', 'translate(0, 0) scale(1)');
    });

    // Search, cart, and user interactions
    $('.search-cart-user .side-btn button').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.slide-box').removeClass('active');
        $('.search-box input').focus();
        var index = $(this).closest('.side-btn').index();
        $('.slide-box').eq(index).addClass('active');
        $('.overlay-bg').toggleClass('active');
    });

    $('.overlay-bg').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.slide-box').removeClass('active');
        $('.overlay-bg').removeClass('active');
    });

    $('.search-cart-user-box .icon').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.slide-box').removeClass('active');
        $('.overlay-bg').removeClass('active');
    });

    $('.cart_wishlist').click(function () {
        $(this).toggleClass('active');
    });

    // WOW.js and Splide.js initializations
    new WOW().init();

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
            if (typeof $ !== 'undefined') {
                $(".banner-slide .wow").removeClass("animate__animated");
                $(".banner-slide .splide__slide.is-active .wow").addClass("animate__animated").css("animation-name", "fadeIn");
            }
        });

        splide.on("moved", function () {
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
    }

    if (document.querySelector('.footer-slide')) {
        var footer = new Splide('.footer-slide', {
            perPage: 1,
        });
        footer.mount();
    }

    // Show/Hide password
    const showPasswordCheckboxes = document.querySelectorAll('.showPassword');

    showPasswordCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const passwordField = checkbox.parentElement.querySelector('.password');
            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    });

});

    // User validation
    // function validateUsername() {
    //     const usernameInput = document.getElementById("user_name");
    //     const usernameError = document.getElementById("usernameError");
    //     if (usernameInput.value.trim().length < 3) {
    //         usernameError.textContent = "Username must be at least 3 characters long.";
    //         return false;
    //     } else {
    //         usernameError.textContent = "";
    //         return true;
    //     }
    // }

    // function validateEmail() {
    //     const emailInput = document.getElementById("user_email");
    //     const emailError = document.getElementById("emailError");
    //     if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
    //         emailError.textContent = "Enter a valid email address.";
    //         return false;
    //     } else {
    //         emailError.textContent = "";
    //         return true;
    //     }
    // }

    // function validatePassword() {
    //     const passwordInput = document.getElementById("user_password");
    //     const passwordError = document.getElementById("passwordError");
    //     if (passwordInput.value.trim().length < 6 || !/[A-Z]/.test(passwordInput.value) || !/[a-z]/.test(passwordInput.value) || !/\d/.test(passwordInput.value)) {
    //         passwordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.";
    //         return false;
    //     } else {
    //         passwordError.textContent = "";
    //         return true;
    //     }
    // }

    // function validateConfirmPassword() {
    //     const passwordInput = document.getElementById("user_password");
    //     const confirmPasswordInput = document.getElementById("conform_user_password");
    //     const confirmPasswordError = document.getElementById("confirmPasswordError");
    //     if (passwordInput.value.trim() !== confirmPasswordInput.value.trim()) {
    //         confirmPasswordError.textContent = "Passwords do not match.";
    //         return false;
    //     } else {
    //         confirmPasswordError.textContent = "";
    //         return true;
    //     }
    // }

    // function validateAddress() {
    //     const addressInput = document.getElementById("user_address");
    //     const addressError = document.getElementById("addressError");
    //     if (addressInput.value.trim().length < 5) {
    //         addressError.textContent = "Address must be at least 5 characters long.";
    //         return false;
    //     } else {
    //         addressError.textContent = "";
    //         return true;
    //     }
    // }

    // function validateContact() {
    //     const contactInput = document.getElementById("user_contact");
    //     const contactError = document.getElementById("contactError");
    //     const contactValue = contactInput.value.trim();

    //     if (contactValue.length !== 10 || isNaN(contactValue) || contactValue.charAt(0) !== '9' || !['8', '6', '7'].includes(contactValue.charAt(1))) {
    //         contactError.textContent = "Contact must be a 10-digit number starting with 9 and the second digit must be 8, 6, or 7.";
    //         return false;
    //     } else {
    //         contactError.textContent = "";
    //         return true;
    //     }
    // }

    // // Add event listeners for input events
    // document.getElementById("user_name").addEventListener("input", validateUsername);
    // document.getElementById("user_email").addEventListener("input", validateEmail);
    // document.getElementById("user_password").addEventListener("input", validatePassword);
    // document.getElementById("conform_user_password").addEventListener("input", validateConfirmPassword);
    // document.getElementById("user_address").addEventListener("input", validateAddress);
    // document.getElementById("user_contact").addEventListener("input", validateContact);

    // // Add event listener for form submission
    // document.getElementById("registrationForm").addEventListener("submit", function (event) {
    //     // Prevent form submission if any of the validations fail
    //     if (!validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmPassword() || !validateAddress() || !validateContact()) {
    //         event.preventDefault();
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        // User validation functions
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
    
        function validatePassword() {
            const passwordInput = document.getElementById("user_password");
            const passwordError = document.getElementById("passwordError");
            if (passwordInput.value.trim().length < 6 || !/[A-Z]/.test(passwordInput.value) || !/[a-z]/.test(passwordInput.value) || !/\d/.test(passwordInput.value)) {
                passwordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.";
                return false;
            } else {
                passwordError.textContent = "";
                return true;
            }
        }
    
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
        const usernameInput = document.getElementById("user_name");
        const emailInput = document.getElementById("user_email");
        const passwordInput = document.getElementById("user_password");
        const confirmPasswordInput = document.getElementById("conform_user_password");
        const addressInput = document.getElementById("user_address");
        const contactInput = document.getElementById("user_contact");
        const registrationForm = document.getElementById("registrationForm");
    
        if (usernameInput) {
            usernameInput.addEventListener("input", validateUsername);
        }
        if (emailInput) {
            emailInput.addEventListener("input", validateEmail);
        }
        if (passwordInput) {
            passwordInput.addEventListener("input", validatePassword);
        }
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener("input", validateConfirmPassword);
        }
        if (addressInput) {
            addressInput.addEventListener("input", validateAddress);
        }
        if (contactInput) {
            contactInput.addEventListener("input", validateContact);
        }
    
        // Add event listener for form submission
        if (registrationForm) {
            registrationForm.addEventListener("submit", function(event) {
                // Prevent form submission if any of the validations fail
                if (!validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmPassword() || !validateAddress() || !validateContact()) {
                    event.preventDefault();
                }
            });
        }
    });
    