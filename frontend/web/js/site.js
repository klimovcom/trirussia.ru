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
            $('.will-join,.already-joined').removeClass('hidden');
            $(that).addClass('hidden');
        });
    });


    $('#search-sumbit').on('click', function (e) {
        e.preventDefault;
        window.location = $('#search-race-form').attr('action');
        return false;
    })
});