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

    $('.will-join,.already-joined').on('click', function(){
        var url = $(this).data('url');
        var raceId = $(this).data('id');
        var that = this;
        $.post(url, {raceId: raceId}, function(response){
            $(that).parent().parent().find('.will-join,.already-joined').removeClass('hidden');
            $(that).addClass('hidden');
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
                    renderType: renderType
                },
                function (response) {
                    /*console.log(response);*/
                    var result = JSON.parse(response).result;
                    var data = JSON.parse(response).data;
                    var dataList = JSON.parse(response).list;
                    if (result*1 < 12){
                        $(that).fadeOut();
                    } else {
                        $(that).removeAttr('disabled');
                        $(that).attr('data-lock', 0);
                    }
                    if (result > 0){
                        if (renderType == 'search'){
                            $(target).append(data);
                            $(targetList).append(dataList);
                        }else{
                            $(target).before(data);
                        }



                        $(".grid").masonry({
                            itemSelector: ".grid-item",
                            columnWidth: ".grid-sizer",
                            percentPosition: true
                        });
                    }
                }
            );
        }
    });

    $('.sort-select').on('change', function(){
        var href = $(this).data($(this).val());
        window.location.href = href;
    });
});