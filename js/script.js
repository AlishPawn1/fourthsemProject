jQuery(function ($) {
    // Handle sticky header and scroll behavior
    let lastScrollTop = 0;

    $(window).scroll(function () {
        let currentScrollTop = $(this).scrollTop();
        const header = $('.header');

        // Toggle sticky class based on scroll direction and position
        header.toggleClass("sticky", currentScrollTop < lastScrollTop && currentScrollTop > 100);
        lastScrollTop = currentScrollTop;

        // Toggle transform-sticky class based on scroll position
        header.toggleClass("transform-sticky", currentScrollTop > 300);
    });

    // Add class to header based on pathname
    const pathname = window.location.pathname;
    if (pathname.endsWith("/index.php") || pathname === "/shop/") {
        $("header").addClass("index-page");
    }

    // Handle dropdown menu
    const menuDropdownSelector = '.primary-menu li.menu-dropdown > a';
    $(menuDropdownSelector).append('<span class="dropdown-btn"><i class="fas fa-chevron-down"></i></span>');

    $('.dropdown-btn').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        const $parentLi = $(this).closest('li');
        $parentLi.toggleClass('open').siblings().removeClass('open');
        $parentLi.find("ul.sub-menu").first().slideToggle();
        $parentLi.siblings().find("ul.sub-menu").slideUp().parent().removeClass('open');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('.menu-dropdown').length) {
            $('.menu-dropdown').removeClass('open');
            $('.sub-menu').slideUp();
        }
    });

    // Add dropdown class to items with submenus
    $('.primary-menu li').has('ul').addClass('menu-dropdown');

    // Handle hamburger menu toggle
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('.overlay, .primary-menu').toggleClass('active');
    });

    // Change image on click
    $('.for_change-image a').click(function (event) {
        event.preventDefault();
        const imageUrl = $(this).attr('href');
        $('#zoom1 img').attr('src', imageUrl);
    });

    // Fancybox for zoomable images
    if ($('.zoomable-image').length) {
        window.openFancybox = function (element) {
            const $image = $(element).closest('.image').find('.zoomable-image');
            const imageSrc = $image.attr('src');

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
    const scale = 2;

    zoom.mousemove(function (e) {
        const x = e.pageX - $(this).offset().left - zoom.width() / 2;
        const y = e.pageY - $(this).offset().top - zoom.height() / 2;
        const xc = -x / scale;
        const yc = -y / scale;
        $('.zoomable-image').css('transform', `translate(${xc}px, ${yc}px) scale(1.5)`);
    }).mouseleave(function () {
        $('.zoomable-image').css('transform', 'translate(0, 0) scale(1)');
    });

    // Handle search, cart, and user interactions
    $('.search-cart-user .side-btn button').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        const index = $(this).closest('.side-btn').index();
        $('.slide-box').removeClass('active').eq(index).addClass('active');
        $('.overlay').toggleClass('active');
        $('.search-box input').focus();
    });

    $('.overlay, .search-cart-user-box .icon').click(function (event) {
        event.preventDefault();
        $('.slide-box, .overlay').removeClass('active');
    });

    // Toggle wishlist/cart active state
    $('.cart_wishlist').click(function () {
        $(this).toggleClass('active');
    });

    // Initialize WOW.js for animations

    // Show/Hide password toggle
    $('.showPassword').change(function () {
        const passwordField = $(this).parent().find('.password');
        passwordField.attr('type', this.checked ? 'text' : 'password');
    });

    // Initialize Isotope for filtering items
    if ($('#isotope-container').length) {
        const $grid = $('#isotope-container').isotope({
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows'
        });

        $('#isotope-filters').on('click', 'button', function () {
            const filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
    }

    var currentPath = window.location.pathname.replace(/\/$/, '');
        // console.log("Current Path:", currentPath);

    $('.primary-menu a').each(function() {
        var href = $(this).attr('href').replace(/\/$/, '');
        // console.log(href);
        var lastPartHref = href.substring(href.lastIndexOf('/') + 1);
        // console.log(lastPartHref);
        if (currentPath.endsWith(lastPartHref)) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });

    // Form validation functions
    function validateUsername() {
        const usernameInput = $("#user_name");
        const usernameError = $("#usernameError");
        const isValid = usernameInput.val().trim().length >= 3;
        usernameError.text(isValid ? "" : "Username must be at least 3 characters long.");
        return isValid;
    }

    function validateEmail() {
        const emailInput = $("#user_email");
        const emailError = $("#emailError");
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.val().trim());
        emailError.text(isValid ? "" : "Enter a valid email address.");
        return isValid;
    }

    function validatePassword() {
        const passwordInput = $("#user_password");
        const passwordError = $("#passwordError");
        const isValid = passwordInput.val().trim().length >= 6 &&
                        /[A-Z]/.test(passwordInput.val()) &&
                        /[a-z]/.test(passwordInput.val()) &&
                        /\d/.test(passwordInput.val());
        passwordError.text(isValid ? "" : "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.");
        return isValid;
    }

    function validateConfirmPassword() {
        const passwordInput = $("#user_password");
        const confirmPasswordInput = $("#conform_user_password");
        const confirmPasswordError = $("#confirmPasswordError");
        const isValid = passwordInput.val().trim() === confirmPasswordInput.val().trim();
        confirmPasswordError.text(isValid ? "" : "Passwords do not match.");
        return isValid;
    }

    // Validate form on submit
    $("#registerForm").submit(function (event) {
        if (!validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmPassword()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // AJAX search with suggestions
    $('#searchInput').on('keyup', function () {
        const searchQuery = $(this).val();

        if (searchQuery.length > 0) {
            $.ajax({
                url: 'search_suggestions.php',
                method: 'GET',
                data: { search_keyword: searchQuery },
                success: function (response) {
                    $('#suggestionsList').html(response).show();
                }
            });
        } else {
            $('#suggestionsList').hide();
        }
    });

    // Hide suggestions when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest('#searchForm').length) {
            $('#suggestionsList').hide();
        }
    });

    // Populate search input with the clicked suggestion
    $(document).on('click', '.suggestion-item', function () {
        $('#searchInput').val($(this).text());
        $('#suggestionsList').hide();
    });

    $('#isotope-filters button').click(function () {
        // Remove 'active' class from all buttons
        $('#isotope-filters button').removeClass('active');
        
        // Add 'active' class to the clicked button
        $(this).addClass('active');
    });

});

new WOW().init();

function initializeSplide(selector, options, extensions) {
    document.querySelectorAll(selector).forEach(element => {
        if (element.querySelector('.splide__track') && element.querySelector('.splide__list')) {
            new Splide(element, options).mount(extensions);
        } else {
            console.error(`Splide initialization failed: Missing required elements in ${selector}`);
        }
    });
}
if (document.querySelector('.banner-slide')) {
    initializeSplide('.banner-slide', {
        type: 'fade',
        rewind: true,
        perPage: 1,
        pagination: true,
        arrows: false,
    });
}