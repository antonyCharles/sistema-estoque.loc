$(document).ready(function(){
    $('.hamburger--elastic').click(function(){
        $('.app-container').removeClass('closed-sidebar');

        if($(this).hasClass('is-active')){
            $(this).removeClass('is-active');
            $('.app-container').removeClass('sidebar-mobile-open');
            $('.app-container').addClass('closed-sidebar');
        }else{
            $(this).addClass('is-active');
            $('.app-container').addClass('sidebar-mobile-open');
        }
    });

    $('.dropdown-toggle').click(function(){
        $(this).next().toggle();
    });

    $('.app-header__menu').click(function(){
        if($('.app-header__content').hasClass('header-mobile-open')){
            $('.app-header__content').removeClass('header-mobile-open');
        }else{
            $('.app-header__content').addClass('header-mobile-open');
        }
    });
});