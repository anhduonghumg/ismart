$(document).ready(function() {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

    //  CHECK ALL
    $('input[name="checkAll"]').click(function() {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

    // EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function() {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
    // SHOW IMAGE
    show_upload_image = function() {
        var upload_image = document.getElementById("upload-thumb");
        if (upload_image.files && upload_image.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#upload-image').attr('src', e.target.result)
            };
            reader.readAsDataURL(upload_image.files[0]);
        }
    }

    // CHANGE COLOR STATUS 
    var status = $(".status span").text();
    if (status = "Chờ duyệt") {
        $(".status span").css("color", "blue");
    } else if (status = "Đã đăng") {
        $(".status span").css("color", "green");
    } else if (status = "Thùng rác") {
        $(".status span").css("color", "red");
    }

});