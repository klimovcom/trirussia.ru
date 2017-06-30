/**
 * Created by alfred on 5/21/16.
 */
$(document).ready(function(){
    $(window).on("load", function(){
        $(".grid").masonry({
            itemSelector: ".grid-item",
            columnWidth: ".grid-sizer",
            percentPosition: true
        });
    });

    $("#option2").click(function(){
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-default");
        $("#option1").addClass("btn-secondary");
        $("#card").hide();
        $("#list").fadeIn(100);
    });

    $("#option1").click(function(){
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-default");
        $("#option2").addClass("btn-secondary");
        $("#list").hide();
        $("#card").fadeIn(100);
    });

    $(".sidebar").theiaStickySidebar({
        additionalMarginTop: 30
    });

    $(function () {
        $("[data-toggle='tooltip']").tooltip()
    });

    $(document).on('change', '#search-race-form #searchraceform-sport', function () {
        var sportId = $(this).val();

        var url = $('#search-race-form').data('update-distances-url');
        $.post(url, {sportId: sportId}, function (response) {
            $('#searchraceform-distance').html(response);
        });
    })

    $(document).on('change', '#search-race-form select', function () {
        var params = {};
        var form = $('#search-race-form').serializeArray();
        $.each(form, function() {
            if (params[this.name] !== undefined) {
                if (!params[this.name].push) {
                    params[this.name] = [params[this.name]];
                }
                params[this.name].push(this.value || '');
            } else {
                params[this.name] = this.value || '';
            }
        });
        var url = $('#search-race-form').data('update-url');
        $.post(url, params, function (response) {
            $('#search-race-form').attr('action', response);
        });
    });

    if ($('#googleMap').length > 0){
        var lat = $('#googleMap').data('lat');
        var lon = $('#googleMap').data('lon');
        var mapProp = {
            center:new google.maps.LatLng(lat,lon),
            zoom:13,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        window.map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        window.marker = null;
        if (lat && lon){
            marker = new google.maps.Marker({
                position: {'lat':lat, 'lng':lon},
                map: map
            });
        }
    }

    //pagination
    /*  var page = 1;
     $(window).scroll(function() {
     if($(window).scrollTop() + $(window).height() >= ( $(document).height() - 350 )) {
     console.log('request to:');
     console.log(window.location.href);
     if (page == 1){
     $.post(window.location.href, {page: page}, function (response) {
     $('.grid').last().html($('.grid').last().html() + response);
     });
     $(".grid").masonry({
     itemSelector: ".grid-item",
     columnWidth: ".grid-sizer",
     percentPosition: true
     });
     }

     page++;
     }
     });*/

    $(document).on('click', '.will-join,.already-joined', function(){
        var url = $(this).data('url');
        var raceId = $(this).data('id');
        var that = this;
        $.post(url, {raceId: raceId}, function(response){
            $(that).parent().parent().find('.will-join,.already-joined').removeClass('hidden');
            $(that).addClass('hidden');
            $('#race_attendance_counter_' + raceId).html(response);
            if ($('i.gold').length > 0){
                console.log($(that));
                var dataMessage = $(that).data('message');
                console.log(dataMessage);
                console.log('message-'+dataMessage);
                var message = $('span.span-join').data('message-'+dataMessage);
                console.log(message);
                console.log($(that).parent());
                $(that).parent().attr('title', message);
            }
        });
    });


    $('#search-sumbit').on('click', function (e) {
        e.preventDefault;
        window.location = $('#search-race-form').attr('action');
        return false;
    })

    $("#calc").click(function(){
        var weight = $("#weight").val();
        var height = $("#height").val();
        var height = height / 100;
        var height = height * height;
        var bmi = weight / height;
        $(".bmi-result, .bmi-result-mobile").text("BMI: " + Math.round(bmi));
        $("#bmi-comment").fadeIn(100);
    });

    $("#swim").click(function(){
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-default");
        $("#run").addClass("btn-secondary");
        $("#run-block").hide();
        $("#swim-block").fadeIn(300);
    });
    $("#run").click(function(){
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-default");
        $("#swim").addClass("btn-secondary");
        $("#swim-block").hide();
        $("#run-block").fadeIn(300);
    });
    $("#calc").click(function(){
        if(!$("#timeHour").val()) {
            var timeHour = 0;
        } else {
            var timeHour = parseInt($("#timeHour").val());
        }
        if(!$("#timeMin").val()) {
            var timeMin = 0;
        } else {
            var timeMin = parseInt($("#timeMin").val());
        }
        if(!$("#timeSec").val()) {
            var timeSec = 0;
        } else {
            var timeSec = parseInt($("#timeSec").val());
        }

        var distance = parseInt($("#distance").val());

        var totalSec = parseInt((timeHour * 3600) + (timeMin * 60) + timeSec);
        var paceSec = totalSec / (distance / 1000);

        var intPaceMin = parseInt(paceSec / 60);
        if(intPaceMin.toString().length < 2) {
            var intPaceMin = "0".concat(intPaceMin);
        }

        var intPaceSec = parseInt(paceSec - (intPaceMin * 60));
        if(intPaceSec.toString().length < 2) {
            var intPaceSec = "0".concat(intPaceSec);
        }
        $(".resultRun").show();
        $("#paceMin").text(intPaceMin);
        $("#paceSec").text(intPaceSec);
    });
    $("#calcSwim").click(function(){
        if(!$("#timeHourSwim").val()) {
            var timeHour = 0;
        } else {
            var timeHour = parseInt($("#timeHourSwim").val());
        }
        if(!$("#timeMinSwim").val()) {
            var timeMin = 0;
        } else {
            var timeMin = parseInt($("#timeMinSwim").val());
        }
        if(!$("#timeSecSwim").val()) {
            var timeSec = 0;
        } else {
            var timeSec = parseInt($("#timeSecSwim").val());
        }

        var distance = parseInt($("#distanceSwim").val());

        var totalSec = parseInt((timeHour * 3600) + (timeMin * 60) + timeSec);
        var paceSec = totalSec / (distance / 100);

        var intPaceMin = parseInt(paceSec / 60);
        if(intPaceMin.toString().length < 2) {
            var intPaceMin = "0".concat(intPaceMin);
        }

        var intPaceSec = parseInt(paceSec - (intPaceMin * 60));
        if(intPaceSec.toString().length < 2) {
            var intPaceSec = "0".concat(intPaceSec);
        }
        $(".resultSwim").show();
        $("#paceMinSwim").text(intPaceMin);
        $("#paceSecSwim").text(intPaceSec);
    });

    page = 0;
    $('.more-races').on('click', function(){
        var lock = $(this).data('lock');
        var sport = $(this).data('sport');
        var date = $(this).data('date');
        var distance = $(this).data('distance');
        var country = $(this).data('country');
        var organizer = $(this).data('organizer');
        var url = $(this).data('url');
        var target = $(this).data('target');
        var targetList = $(this).data('target-list');
        var renderType = $(this).data('render-type');
        var sort = $(this).data('sort');
        var append = $(this).data('append');
        var limit = $(this).data('limit');

        if (lock == 0){
            lock = 1;
            page++;
            $(this).attr('data-lock', lock);
            $(this).attr('disabled', 'disabled');
            var that = $(this);
            $.post(
                url,
                {
                    page: page,
                    sport: sport,
                    date: date,
                    distance: distance,
                    country: country,
                    organizer: organizer,
                    sort: sort,
                    limit: limit,
                    renderType: renderType
                },
                function (response) {
                    /*console.log(response);*/
                    var result = JSON.parse(response).result;
                    var data = JSON.parse(response).data;
                    var dataList = JSON.parse(response).list;
                    if (result*1 < limit){
                        $(that).fadeOut();
                    } else {
                        $(that).removeAttr('disabled');
                        $(that).attr('data-lock', 0);
                    }
                    if (result > 0){
                        if (renderType == 'search'){
                            $(target).append(data);
                            $(targetList).append(dataList);
                            $('.card').matchHeight();
                        }else{
                            $(target).before(data);
                        }



                        $(".grid").masonry({
                            itemSelector: ".grid-item",
                            columnWidth: ".grid-sizer",
                            percentPosition: true
                        });

                        initLazy();
                    }
                }
            );
        }
    });

    $('.sort-select').on('change', function(){
        var href = $(this).data($(this).val());
        window.location.href = href;
    });


    if ($("#logout-button").length > 0){
        $("#register").click(function(){
            $(this).hide();
            $("#register-question").fadeIn(300);
        });
        $(".register-button").click(function(){
            $("#register-question").hide();
            $("#register-link").fadeIn(300);
        });
    }

    $(document).on('click', '.btn-shop-add-cart', function() {
        var product_id = $(this).attr('data-product-id');
        var attr_block_id = $(this).attr('data-attr-block-id');
        var quantity_id = $(this).attr('data-attr-quantity-id');
        AddProductToCart(product_id, attr_block_id, quantity_id);
        if (!attr_block_id) {
            $(this).html('В корзине');
            $(this).addClass('disabled');
        }
    });

    skickPrepare($('.cart-container'));

    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        language: "ru",
        autoclose: true,
        startDate: "d",
        todayHighlight: true
    });

    $(document).on('change', '#race-create-sport_id', function() {
        $.ajax({
            type: "POST",
            url: '/race/default/render-distance-list',
            data: {
                'id' : $(this).find('option:selected').val()
            },
            dataType: "html",
            cache: false,
            success: function (data)
            {
                $('#race-create-distance').html(data);
            },
            error: function (data)
            {
                alert('Ошибка сервера, повторите позднее');
            }
        });
    });

    $(document).on('mouseenter', '.rating-input--star', function(e) {
        var $container = $(this).parents('.rating-input');
        var $stars = $(this).parent().find('.rating-input--star');
        var index = $stars.index($(this)) + 1;
        $container.attr('data-rate', index);
    });

    $(document).on('click', '.rating-input--star', function(e) {
        var $container = $(this).parents('.rating-input');

        if ($container.hasClass('rating-input-active')) {
            var race = $container.attr('data-race');
            var $stars = $(this).parent().find('.rating-input--star');
            var index = $stars.index($(this)) + 1;
            $container.find('.rating-input--value').val(index);

            $.ajax({
                type: "POST",
                url: '/race/default/set-rating',
                data: {
                    rate : index,
                    race : race
                },
                dataType: "html",
                cache: false,
                success: function (data)
                {
                    $container.find('.rating-input--text').html(data);
                },
                error: function (data)
                {
                    alert('Ошибка сервера, повторите позднее');
                }
            });
        }else {
            $('#openUser').modal();
        }

    });

    $(document).on('mouseleave', '.rating-input', function(e) {
        var index = $(this).find('.rating-input--value').val();
        $(this).attr('data-rate', index);
    });

    $(document).on('click', '.promocode-item--promocode--button', function(e) {
        $text = $(this).parent().find('.promocode-item--promocode--text');
        $(this).fadeOut(300, function() {
            $text.fadeIn(300);
        });
    });


    $('.coach-item--bg').each(function() {
        var label = $(this).attr('data-label');
        var pattern = GeoPattern.generate(label);
        $(this).css('background-image', pattern.toDataUrl());
    });

    initLazy();

    initFancybox();

    $('.js-tilt').tilt({
        glare: true,
        maxGlare: .5,
        perspective: 1000
    });

    $('.race-relay-modal-time').mask('Z0:Z0', {
        placeholder: "__:__",
        translation: {
            'Z': {
                pattern: /[0-5]/,
                optional: false
            }
        }
    });

    $('#form-training-add-time').mask('Z0:X0', {
        placeholder: "__:__",
        translation: {
            'Z': {
                pattern: /[0-2]/,
                optional: false
            },
            'X': {
                pattern: /[0-6]/,
                optional: false
            }
        }
    });

    $(document).on('click', '.race-register', function(e) {
        var race_id = $(this).attr('data-race-id');
        var distance_id = $(this).attr('data-distance-id');
        var type = $(this).attr('data-type');
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: '/race/default/register',
            data: {
                race_id : race_id,
                distance_id : distance_id,
                type : type
            },
            dataType: "json",
            cache: false,
            success: function (data)
            {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }else {
                    $this.after('<span>Вы успешно зарегистрированны</span>');
                    $this.remove();
                }
            },
            error: function (data)
            {
                alert('Ошибка сервера, повторите позднее');
            }
        });
    });

    $(document).on('click', '.btn-race-relay-register', function() {
        var race_id = $(this).data('race-id');
        var distance_id = $(this).data('distance-id');
        var $block = $('#race-relay-register-modal-content');
        $.post(
            '/race/race-relay-registration/get-relay-modal',
            {
                race_id : race_id,
                distance_id : distance_id
            },
            function(response) {
                $block.html(response);
                $('#race-relay-register-modal').modal();
            }
        );
    });

    $(document).on('click', '.btn-race-relay-modal-show-time', function() {
        var group = $(this).data('group');
        var position = $(this).data('position');

        $(this).hide();
        $('.race-relay-modal-form-' + group + '-' + position).show();
    });

    $(document).on('click', '.btn-race-relay-modal-register', function() {
        var race_id = $(this).data('race-id');
        var distance_id = $(this).data('distance-id');
        var position = $(this).data('position');
        var group = $(this).data('group');
        var time = $('#race-relay-modal-time-' + group + '-' + position).val();

        var $block = $('#race-relay-register-modal-content');

        $.post(
            '/race/race-relay-registration/create',
            {
                race_id : race_id,
                distance_id : distance_id,
                position : position,
                group : group,
                time : time
            },
            function(response) {
                response = JSON.parse(response);
                if (response['status'] == 'error') {
                    $('.race-relay-modal-form').hide();
                    $('.btn-race-relay-modal-show-time').show();

                    showRaceRelayModalAlert(response['message']);
                }else {
                    $block.html(response['message']);
                }
            }
        );
    });

    $(document).on('click', '.btn-race-relay-modal-unregister', function() {
        var race_id = $(this).data('race-id');
        var distance_id = $(this).data('distance-id');
        var position = $(this).data('position');
        var group = $(this).data('group');
        var $block = $('#race-relay-register-modal-content');
        $.post(
            '/race/race-relay-registration/delete',
            {
                race_id : race_id,
                distance_id : distance_id,
                position : position,
                group : group
            },
            function(response) {
                response = JSON.parse(response);
                if (response['status'] == 'error') {
                    showRaceRelayModalAlert(response['message']);
                }else {
                    $block.html(response['message']);
                }
            }
        );
    });

    $(document).on('click', '#race-relay-modal-alert-close', function() {
        $('#race-relay-modal-alert').hide();
    });

    $(document).on('click', '.btn-race-slot-sell-add', function() {
        var type = $(this).data('type');
        $.post(
            '/race/race-slot-sell/get-modal',
            {
                type : type
            },
            function(response) {
                response = JSON.parse(response);
                $('#race-slot-sell-label').html(response['header']);
                $('#race-slot-sell-content').html(response['content']);
                $('#race-slot-sell-modal').modal();
            }
        );
    });

    $(document).on('click', '.btn-race-slot-sell-modal-create', function() {
        var race_id = $('#race-slot-sell-modal-race_id').val();
        var distance_id = $('#race-slot-sell-modal-distance_id').val();
        var price = $('#race-slot-sell-modal-price').val();
        var type = $(this).data('type');
        $.post(
            '/race/race-slot-sell/create',
            {
                race_id : race_id,
                distance_id : distance_id,
                price : price,
                type : type
            },
            function(response) {
                response = JSON.parse(response);
                $('#race-slot-sell-content').html(response['message']);
                if (response['status'] == 'success') {
                    var $listItem = $('#race-slot-sell-sell-block-' + race_id + '-' + distance_id + '-' + type);
                    if ($listItem.length) {
                        $listItem.replaceWith(response['content']);
                    }else {
                        $('#race-slot-sell-list-' + type).append(response['content']);
                    }

                }
            }
        );
    });

    $(document).on('click', '.btn-race-slot-sell-delete', function() {
        var race_id = $(this).data('race_id');
        var distance_id = $(this).data('distance_id');
        var user_id = $(this).data('user_id');
        var type = $(this).data('type');

        $.post(
            '/race/race-slot-sell/delete',
            {
                race_id : race_id,
                distance_id : distance_id,
                user_id : user_id,
                type : type
            },
            function(response) {
                response = JSON.parse(response);
                if (response['status'] == 'success') {
                    $('#race-slot-sell-sell-block-' + race_id + '-' + distance_id + '-' + type).replaceWith(response['message']);
                }else {
                    alert(response['message']);
                }
            }
        );
    });

    $(document).on('click', '.btn-race-slot-sell-view', function() {
        var race_id = $(this).data('race_id');
        var distance_id = $(this).data('distance_id');
        var user_id = $(this).data('user_id');
        var type = $(this).data('type');

        $.post(
            '/race/race-slot-sell/get-user-modal',
            {
                race_id : race_id,
                distance_id : distance_id,
                user_id : user_id,
                type : type
            },
            function(response) {
                response = JSON.parse(response);
                $('#race-slot-sell-label').html(response['header']);
                $('#race-slot-sell-content').html(response['message']);
                $('#race-slot-sell-modal').modal();
            }
        );
    });

    $(document).on('click', '.btn-training-send-message', function(e) {
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: '/user/default/toggle-training-message',
            cache: false,
            success: function (data)
            {
                $this.html(data);
            },
            error: function (data)
            {
                alert('Ошибка сервера, повторите позднее');
            }
        });
    });
});

jQuery(document).ready(function($){
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 300,
    //duration of the top scrolling animation (in ms)
        scroll_top_duration = 900;

    console.log('init');
    //hide or show the "back to top" link
    $(window).scroll(function(){
        if ( $(this).scrollTop() > offset ) {

            $('.cd-top').addClass('cd-is-visible')
        } else {

            $('.cd-top').removeClass('cd-is-visible cd-fade-out')
        }
        if( $(this).scrollTop() > offset_opacity ) {

            $('.cd-top').addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $('.cd-top').on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
                scrollTop: 0 ,
            }, scroll_top_duration
        );
    });

    setTimeout(function(){
        $('.cd-top').appendTo('body');
    }, 1000);
});

function AddProductToCart(id, attr_block_id, quantity_id) {

    var formdata;
    var quantity;

    if (attr_block_id) {
        formdata = $('#' + attr_block_id).serialize();
    }else {
        formdata = null;
    }

    if (quantity_id) {
        quantity = $('#' + quantity_id).val();
    }else {
        quantity = 1;
    }

    var params = {
        product_id : id,
        quantity : quantity,
        info: formdata
    };
    $.ajax({
        type: "POST",
        url: '/product/default/add-product-to-cart',
        data: params,
        dataType: "json",
        cache: false,
        success: function (data)
        {
            $('.product_cart_count').html(data['count']);
            $('.product_cart_cost').html(data['cost']);
        },
        error: function (data)
        {
            alert('Ошибка сервера, повторите позднее');
        }
    });
}

function ChangeCartPositionCount(id, diff) {
    $.ajax({
        type: "POST",
        url: '/product/default/change-cart-position-count',
        data: {
            id : id,
            diff : diff
        },
        dataType: "json",
        cache: false,
        success: function (data)
        {
            $('#cart_order_item_quantity_' + id).html(data['quantity']);
            $('#cart_order_item_cost_' + id).html(data['cost']);
            UpdateTotalCost(data['total']);
        },
        error: function (data)
        {
            alert('Ошибка сервера, повторите позднее');
        }
    });
}

function RemoveFromCart(id) {
    $.ajax({
        type: "POST",
        url: '/product/default/remove-cart-position',
        data: {
            id : id
        },
        dataType: "json",
        cache: false,
        success: function (data)
        {
            $('#cart_order_item_' + id).remove();
            UpdateTotalCost(data);
        },
        error: function (data)
        {
            alert('Ошибка сервера, повторите позднее');
        }
    });
}

function UpdateTotalCost(cost) {
    $('#cart_total').html(cost);
}

function skickPrepare($el) {
    if ($el.length) {
        $el.addClass('original').clone().appendTo($('body')).addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

        scrollIntervalID = setInterval(stickIt, 10);
    }
}

function stickIt() {

    var orgElementPos = $('.original').offset();
    orgElementTop = orgElementPos.top;

    if ($(window).scrollTop() >= (orgElementTop)) {
        // scrolled past the original position; now only show the cloned, sticky element.

        // Cloned element should always have same left position and width as original element.
        orgElement = $('.original');
        coordsOrgElement = orgElement.offset();
        leftOrgElement = coordsOrgElement.left;
        widthOrgElement = orgElement.css('width');
        $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
        $('.original').css('visibility','hidden');
    } else {
        // not scrolled past the menu; only show the original menu.
        $('.cloned').hide();
        $('.original').css('visibility','visible');
    }
}
function initLazy() {
    $("img.lazy").lazyload({
        effect : "fadeIn"
    });
}
function initFancybox() {
    var $imgs = $('.fancybox_container img').not('.lazy').not('.not-fancy');
    var srcArray = [];
    $imgs.each(function() {
        srcArray.push({src : $(this).attr('src')});
    });

    $imgs.click(function() {
        var index = $imgs.index($(this));
        $.fancybox.open(srcArray, {
        }, index);
    });
}

function showRaceRelayModalAlert(message) {
    $('#race-relay-modal-alert-content').html(message);
    $('#race-relay-modal-alert').show();
}