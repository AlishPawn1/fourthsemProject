jQuery(function($){
    $(document).ready(function() {
        $(".primary-menu li.menu-dropdown > a").append('<span class="dropdown-btn"><i class="fa-solid fa-chevron-down"></i></span>');
        
    
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

    $(document).ready(function() {
        var currentPath = window.location.pathname.replace(/\/$/, '');

        $('.primary-menu a').each(function() {
            var href = $(this).attr('href').replace(/\/$/, '');
            var lastPartHref = href.substring(href.lastIndexOf('/') + 1);
            if (currentPath.endsWith(lastPartHref)) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    });
});