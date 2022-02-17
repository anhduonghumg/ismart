
$(document).ready(function () {

    // price
    filter_data();
    filter_product();
    // filter_cat();
    $("#price_range").slider({
        range: true,
        min: 500000,
        max: 100000000,
        values: [500000, 100000000],
        step: 500000,
        stop: function (even, ui) {
            $('#price_show').html('Từ: ' + ui.values[0] + 'đ' + ' -' + ui.values[1] + 'đ');
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
            filter_product();
            // filter_cat();
        }
    });

    // filter
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };


    function filter_data() {
        var action = 'filter';
        var s = getUrlParameter('s');
        var brand = get_filter('brand');
        var price = get_filter('price');
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var select = $('.filter_select').val();
        // var page_no = page;
        // alert(page_no);

        $.ajax({
            url: "?mod=search&action=filter",
            method: "POST",
            data: { action: action, s: s, brand: brand, price: price, minimum_price: minimum_price, maximum_price: maximum_price, select: select, },
            dataType: "json",
            success: function (data) {
                $('.filter_data').html(data.output);
                $('.total_product').html(data.total_product);
                // console.log(data.query);
                // $("div#paging-wp").children("div").html(data.pagging);
            }
        });
    }

    function filter_product() {
        var action = 'filter';
        var brand = get_filter('brand');
        var price = get_filter('price');
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var select = $('.filter_select').val();
        // var page_no = page;
        // alert(page_no);

        $.ajax({
            url: "?mod=product&action=filter",
            method: "POST",
            data: { action: action, brand: brand, price: price, minimum_price: minimum_price, maximum_price: maximum_price, select: select, },
            dataType: "json",
            success: function (data) {
                $('.filter_product').html(data.output);
                $('.total_product_filter').html(data.total_product);
                // console.log(data.query);
            }
        });
    }

    // function filter_cat() {
    //     var action = 'filter_cat';
    //     var cat_id = getUrlParameter('cat_id');
    //     var parent_id = getUrlParameter('parent_id');
    //     var brand = get_filter('brand');
    //     var price = get_filter('price');
    //     var minimum_price = $('#hidden_minimum_price').val();
    //     var maximum_price = $('#hidden_maximum_price').val();
    //     var select = $('.filter_select').val();
    //     // var url_cat = "?mod=product&controller=category&cat_id=" + cat_id + "&parent_id=" + parent_id + "&action=filter_cat";
    //     $.ajax({
    //         url: "?mod=product&controller=category&action=filter_cat",
    //         method: "POST",
    //         data: { action: action, cat_id: cat_id, parent_id: parent_id, brand: brand, price: price, minimum_price: minimum_price, maximum_price: maximum_price, select: select, },
    //         dataType: "json",
    //         success: function (data) {
    //             $('.filter_cat').html(data.output);
    //             console.log(data.query);
    //             // $('.total_product').html(data.total_product);
    //         }
    //     });
    // }


    function get_filter(class_name) {
        var filter = [];
        $('#filter-product-wp table tbody tr td input.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.commom_selector').click(function () {
        filter_data();
        filter_product();
        // filter_cat();
    });

    $('.filter_select').change(function () {
        filter_data();
        filter_product();
        // filter_cat();
    })


    // $('ul#list-item li a').click(function (e) {
    //     // e.preventDefault();
    //     var page = $(this).parent("li").attr("data-page");
    //     // filter_data(page);
    // })


    // Update-cart
    $(".num-order").change(function () {
        var id = $(this).attr('data-id');
        var qty = $(this).val();
        var data = { id: id, qty: qty };

        $.ajax({
            url: "?mod=cart&action=update_ajax",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                $("#sub-total-" + id).text(data.sub_total);
                $("#total-price span").text(data.total);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    // autoComplete-search
    var myTimer = null;
    $("#s").keyup(function (e) {
        $('#loading').removeClass('hidden');
        clearTimeout(myTimer);
        myTimer = setTimeout(function () {
            var search_text = $('#s').val();
            if (search_text != "") {
                $.ajax({
                    url: "?mod=search&action=autocomplete",
                    method: "POST",
                    data: {
                        s: search_text,
                    },
                    dataType: "json",
                    success: function (data) {
                        if ((data.list_search).length > 0) {
                            $output = "";
                            $.each(data.list_search, function (key, value) {
                                let url_detail = value.friendly_detail;
                                let thumb = value.product_thumb;
                                let price = formatNumber(value.price, ".", ",");
                                let name = value.product_name;

                                $output += `<li>
                            <div class='img'>
                            <a href="${url_detail}".html><img src="admin/${thumb}" alt=''></a>
                            </div>
                            <div class='info'>
                            <a href="${url_detail}" class='name-product'>${name}</a>
                            <p class='price'>${price}đ</p>
                            </div>
                            </li>`;
                            });
                            $output += `<a href='tim-kiem?s=${data.input_text}' class='query-search'>Hiển thị kết quả cho <span>${data.input_text}</span></a>`;
                        } else {
                            $output = `<p class='query-search'>Không có kết quả nào!</p>`;
                        }
                        $('#show-list').html($output);
                        $('#loading').addClass('hidden');
                    }

                });
            } else {
                $('#loading').addClass('hidden');
                $("#show-list").html("");
            }
        }, 1000)

    });

    // Set searched text in input field on click of search button
    $(document).on("click", "ul#show-list li", function (e) {
        $a = $(this).find('.name-product').text();
        $b = $(this).find('.name-product').attr('href');
        $("#s").val($a);
        $("#show-list").html("");
        window.location.replace($b);
    });
})


// format tiền 
function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}


// Pagging ajax
// $(document).ready(function() {
//     $(".section-detail").on("click", "ul#list-item li a", function(e) {
//         e.stopPropagation(); // important
//         e.preventDefault();
//         // alert("hello");
//         var page = $(this).parent("li").attr("data-page");
//         var data = { page: page };
//         $.ajax({
//             url: "?mod=product&action=pagination",
//             method: "POST",
//             data: data,
//             dataType: "json",
//             success: function(data) {
//                 $("div#data-section").children("ul").html(data.list_product);
//                 $("div#paging-wp").children("div").html(data.pagging);
//             }
//         })

//     })

// select ajax
// $(".section").on("click", ".btn-submit", function(e) {
//     e.stopPropagation(); // important
//     e.preventDefault();
//     var select_filter = $(".select-filter").val();
//     var data = { select_filter: select_filter };
//     $.ajax({
//         url: "?mod=product&action=select",
//         method: "GET",
//         data: data,
//         dataType: "json",
//         success: function(data) {
//             $("div#data-section").children("ul").html(data.list_product);
//             // $("div#paging-wp").children("div").html(data.pagging);
//         }
//     })
// })

// });