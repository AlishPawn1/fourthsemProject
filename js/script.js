jQuery(function ($) {
    // Sticky Header
    let lastScrollTop = 0;
    $(window).scroll(function () {
        let currentScrollTop = $(this).scrollTop();
        const header = $('.header');
        header.toggleClass("sticky", currentScrollTop < lastScrollTop && currentScrollTop > 100);
        header.toggleClass("transform-sticky", currentScrollTop > 300);
        lastScrollTop = currentScrollTop;
    });

    // Add class to header based on page
    if (window.location.pathname.endsWith("/index.php") || window.location.pathname === "/shop/") {
        $("header").addClass("index-page");
    }

    // Dropdown Menu
    // Add dropdown class to items with submenus
$('.primary-menu li').has('ul').addClass('menu-dropdown');

// Append dropdown button to menu-dropdown items
$('.primary-menu li.menu-dropdown > a').each(function () {
    if (!$(this).find('.dropdown-btn').length) {
        $(this).append('<span class="dropdown-btn"><i class="fas fa-chevron-down"></i></span>');
    }
});

// Handle dropdown toggle
$('.dropdown-btn').click(function (event) {
    event.preventDefault();
    const parentLi = $(this).closest('li');
    parentLi.toggleClass('open').siblings().removeClass('open').find('ul.sub-menu').slideUp();
    parentLi.find('ul.sub-menu').first().slideToggle();
});

// Close dropdowns when clicking outside
$(document).click(function (event) {
    if (!$(event.target).closest('.menu-dropdown').length) {
        $('.menu-dropdown').removeClass('open').find('ul.sub-menu').slideUp();
    }
});


    // Hamburger Menu Toggle
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('body').toggleClass('overflow-hidden');
        $('.overlay, .primary-menu').toggleClass('active');
    });

    // Image Change on Click
    $('.for_change-image a').click(function (event) {
        event.preventDefault();
        const imageUrl = $(this).attr('href');
        $('#zoom1 img').attr('src', imageUrl);
    });

    // Handle search, cart, and user interactions
    $('.search-cart-user .side-btn button').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        const index = $(this).closest('.side-btn').index();
        $('.slide-box').removeClass('active').eq(index).addClass('active');
        $('.overlay').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
        $('.search-box input').focus();
    });
    $('.overlay, .search-cart-user-box .icon').click(function (event) {
        event.preventDefault();
        $('.slide-box, .overlay').removeClass('active');
        $('body').removeClass('overflow-hidden');
    });

    // Fancybox
    if ($('.zoomable-image').length) {
        window.openFancybox = function (element) {
            const imageSrc = $(element).closest('.image').find('.zoomable-image').attr('src');
            if (imageSrc) {
                $.fancybox.open({
                    src: imageSrc,
                    type: 'image',
                    opts: {
                        buttons: ["zoom", "fullScreen", "close"],
                        touch: { vertical: true, momentum: true },
                    }
                });
            }
        };
    }

    // Image Zoom on Hover
    const zoom = $('#zoom1');
    const scale = 2;
    zoom.mousemove(function (e) {
        const x = (e.pageX - $(this).offset().left - zoom.width() / 2) / -scale;
        const y = (e.pageY - $(this).offset().top - zoom.height() / 2) / -scale;
        $('.zoomable-image').css('transform', `translate(${x}px, ${y}px) scale(1.5)`);
    }).mouseleave(function () {
        $('.zoomable-image').css('transform', 'translate(0, 0) scale(1)');
    });

    // Wishlist/Cart Toggle
    $('.cart_wishlist').click(function () {
        $(this).toggleClass('active');
    });

    // Show/Hide Password
    $('.showPassword').change(function () {
        $(this).siblings('.password').attr('type', this.checked ? 'text' : 'password');
    });

    // Isotope Filtering
    if ($('#isotope-container').length) {
        const $grid = $('#isotope-container').isotope({
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows'
        });

        $('#isotope-filters').on('click', 'button', function () {
            $grid.isotope({ filter: $(this).data('filter') });
            $(this).addClass('active').siblings().removeClass('active');
        });
    }

    // Active Link in Menu
    const currentPath = window.location.pathname.replace(/\/$/, '');
    $('.primary-menu a').each(function () {
        const href = $(this).attr('href').replace(/\/$/, '');
        $(this).toggleClass('active', currentPath.endsWith(href.substring(href.lastIndexOf('/') + 1)));
    });

    // Form Validation
    function validateInput(input, errorElement, validator, errorMessage) {
        const isValid = validator(input.val().trim());
        errorElement.text(isValid ? "" : errorMessage);
        return isValid;
    }

    $("#registerForm").submit(function (event) {
        const validations = [
            validateInput($("#user_name"), $("#usernameError"), val => val.length >= 3, "Username must be at least 3 characters long."),
            validateInput($("#user_email"), $("#emailError"), val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), "Enter a valid email address."),
            validateInput($("#user_password"), $("#passwordError"), val => val.length >= 6 && /[A-Z]/.test(val) && /[a-z]/.test(val) && /\d/.test(val),
                "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long."),
            validateInput($("#conform_user_password"), $("#confirmPasswordError"), val => val === $("#user_password").val().trim(), "Passwords do not match."),
        ];
        if (validations.some(valid => !valid)) {
            event.preventDefault();
        }
    });

    // Search Suggestions
    $(document).on('keyup', '.searchInput', function () {
        const searchInput = $(this);
        const searchQuery = searchInput.val();
        const suggestionsList = searchInput.siblings('.suggestions-list');
        if (searchQuery.length > 0) {
            $.get('search_suggestions.php', { search_keyword: searchQuery }, function (response) {
                suggestionsList.html(response).show();
            });
        } else {
            suggestionsList.hide();
        }
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.searchForm').length) {
            $('.suggestions-list').hide();
        }
    });

    $(document).on('click', '.suggestion-item', function () {
        const searchInput = $(this).closest('.searchForm').find('.searchInput');
        searchInput.val($(this).text());
        $(this).closest('.suggestions-list').hide();
    });

    // Initialize WOW.js
    new WOW().init();

    // Splide Initialization
    function initializeSplide(selector, options, extensions) {
        document.querySelectorAll(selector).forEach(element => {
            if (element.querySelector('.splide__track') && element.querySelector('.splide__list')) {
                new Splide(element, options).mount(extensions);
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
            updateOnMove: true,
        });
    }
});
