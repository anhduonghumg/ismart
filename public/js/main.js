$(document).ready(function () {
    //  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });
    // VIEW MORE
    $("#view-more-content").click(function (event) {
        event.preventDefault();
        this.blur();
        var n = $(this).text() == "Thu g???n" ? "Xem th??m" : "Thu g???n";
        $(this).text(n);
        n == "Thu g???n" ? $("#product-content").css({ height: "auto", overflow: "auto" }) : $("#product-content").css({ height: "650px", overflow: "hidden" })
    })

    //  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        value++;
        $('#num-order').attr('value', value);
        update_href(value);
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

    // ACTIVE SEARCH
    // $(document).on('click', 'ul#show-list li', function () {
    //     var a = $(this).find('name_product').attr('value');
    //     alert(a);
    // });

    // SEARCH
    $(document).keypress(function (e) {
        $('.result-search').css('display', 'block');
    });
    // BUY NOW
    // $(document).on('click', '.buy-now', function (e) {
    //     $('.modal-buy-now').css('display', 'block');
    //     return false;
    // });

    // ADD CART
    // $(document).on('click', '.add-cart', function(e) {
    //     // e.preventDefault();
    //     if ($(this).hasClass('disabled')) {
    //         return false;
    //     }
    //     $(document).find('.add-cart').addClass('disabled');

    //     var parent = $(this).parents('li');
    //     var cart = $(document).find('#btn-cart');
    //     var src = parent.find('img').attr('src');
    //     var parTop = parent.offset().top;
    //     var parLeft = parent.offset().left;

    //     $('<img />', {
    //         class: 'img-product-fly',
    //         src: src
    //     }).appendTo('body').css({ 'top': parTop, 'left': parLeft + parent.width() - 50 });
    //     setTimeout(function() {
    //         $(document).find('.img-product-fly').css({ 'top': cart.offset().top, 'left': cart.offset().left })
    //         setTimeout(function() {
    //             $(document).find('.img-product-fly').remove();
    //             $(document).find('.add-cart').removeClass('disabled');
    //         }, 1000);
    //     }, 500);

    //     var id = parent.attr('data-id');
    //     // var product_name = parent.find('.product-name').text();
    //     // var product_thumb = parent.find('img').attr('src');
    //     // var price = parent.find('span').attr('data-price');
    //     var data = { id: id }
    //     $.ajax({
    //         url: "?mod=cart&action=add_cart",
    //         method: "GET",
    //         data: data,
    //         dataType: "json",
    //         success: function(data) {

    //         }
    //     })
    // });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
});

function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
}