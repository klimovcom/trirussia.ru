/**
 * Created by alfred on 22.02.16.
 */


$(document).ready(function(){


    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        minuteStep: 30,
        showMeridian: false
    });
    $(".textarea").wysihtml5();
    $('#tbl').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $('.sortable').sortable();

    function cyr2lat(str) {

        var cyr2latChars = new Array(
            ['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
            ['д', 'd'],  ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
            ['и', 'i'], ['й', 'y'], ['к', 'k'], ['л', 'l'],
            ['м', 'm'],  ['н', 'n'], ['о', 'o'], ['п', 'p'],  ['р', 'r'],
            ['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
            ['х', 'h'],  ['ц', 'c'], ['ч', 'ch'],['ш', 'sh'], ['щ', 'shch'],
            ['ъ', ''],  ['ы', 'y'], ['ь', ''],  ['э', 'e'], ['ю', 'yu'], ['я', 'ya'],

            ['А', 'A'], ['Б', 'B'],  ['В', 'V'], ['Г', 'G'],
            ['Д', 'D'], ['Е', 'E'], ['Ё', 'YO'],  ['Ж', 'ZH'], ['З', 'Z'],
            ['И', 'I'], ['Й', 'Y'],  ['К', 'K'], ['Л', 'L'],
            ['М', 'M'], ['Н', 'N'], ['О', 'O'],  ['П', 'P'],  ['Р', 'R'],
            ['С', 'S'], ['Т', 'T'],  ['У', 'U'], ['Ф', 'F'],
            ['Х', 'H'], ['Ц', 'C'], ['Ч', 'CH'], ['Ш', 'SH'], ['Щ', 'SHCH'],
            ['Ъ', ''],  ['Ы', 'Y'],
            ['Ь', ''],
            ['Э', 'E'],
            ['Ю', 'YU'],
            ['Я', 'YA'],

            ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
            ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
            ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
            ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
            ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
            ['z', 'z'],

            ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'],['E', 'E'],
            ['F', 'F'],['G', 'G'],['H', 'H'],['I', 'I'],['J', 'J'],['K', 'K'],
            ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'],['P', 'P'],
            ['Q', 'Q'],['R', 'R'],['S', 'S'],['T', 'T'],['U', 'U'],['V', 'V'],
            ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],

            [' ', '-'],['0', '0'],['1', '1'],['2', '2'],['3', '3'],
            ['4', '4'],['5', '5'],['6', '6'],['7', '7'],['8', '8'],['9', '9'],
            ['-', '-']

        );

        var newStr = new String();

        for (var i = 0; i < str.length; i++) {

            ch = str.charAt(i);
            var newCh = '';

            for (var j = 0; j < cyr2latChars.length; j++) {
                if (ch == cyr2latChars[j][0]) {
                    newCh = cyr2latChars[j][1];

                }
            }
            // Если найдено совпадение, то добавляется соответствие, если нет - пустая строка
            newStr += newCh;

        }
        // Удаляем повторяющие знаки - Именно на них заменяются пробелы.
        // Так же удаляем символы перевода строки, но это наверное уже лишнее
        return newStr.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '').toLowerCase();;
    }

    $(document).on('input', '#post-label', function() {
        $('#post-url').val(cyr2lat($(this).val()));
    });

    $(document).on('input', '#race-label', function() {
        $('#race-url').val(cyr2lat($(this).val()));
    });

    $(document).on('input', '#product-label', function() {
        $('#product-url').val(cyr2lat($(this).val()));
    });

    $('#news-header').on('change', function(){
        if (!($('#news-url').val().length > 0)){
            var value = cyr2lat($('#news-header').val());
            $('#news-url').attr('value', value);
        }
    });

    $('.generate-url').on('click', function(e){
        e.preventDefault();
        var val;
        if ($('#news-header').length > 0){
            val = $('#news-header').val();
        } else {
            val = $('#gallery-label').val()
        }
        var value = cyr2lat(val);

        if ($('#news-header').length > 0) {
            $('#news-url').attr('value', value);
            $('#news-url').val(value);
        } else  {
            $('#gallery-url').attr('value', value);
            $('#gallery-url').val(value);
        }
        return false;
    });

    $('.move').on('click', function(){
       window.location.href = $(this).attr('href');
    });

    $('#race-currency').on('change', function(){
        console.log($(this).val());

        $('#race-currency_en').val($(this).val());
    })

    $('.toggle-seo').on('click', function(e){
        e.preventDefault();
        $('#seo-form-widget').toggle();
        return false;
    })

    $('.seo-model-toggle').on('click', function(e){
        e.preventDefault();
        $('#seo-tab').toggle();
        return false;
    })

    $(document).on('click', '.btn-translate', function(){
        var dataTarget = $(this).data('target');
        $(dataTarget).toggle();
    });

    $(document).on('click', '.toggle-publication', function(e){
        e.preventDefault();
        var val = $('#published-field').val();

        if (val == 1) {
            $('.toggle-publication').val('Опубликовать');
            val = 0;
        } else {
            $('.toggle-publication').val('Снять с публикации');
            val = 1;
        }

        $('#published-field').val(val);
        return false;
    });

    $(document).on('click', '.toggle-registration', function(e){
        e.preventDefault();
        var val = $('#registration-field').val();
        var $registrationBlock = $('#registration');

        if (val == 1) {
            $('.toggle-registration').val('Добавить регистрацию');
            val = 0;
            $registrationBlock.hide();
        } else {
            $('.toggle-registration').val('Убрать регистрацию');
            val = 1;
            $registrationBlock.show();
        }

        $('#registration-field').val(val);
        return false;
    });

    (function createUserCanvas() {
        if (!$("#userChart").length) {
            return false;
        }
        var salesChartCanvas = $("#userChart").get(0).getContext("2d");
        var dates = $("#userChart").data('days');
        var users = $("#userChart").data('users');
        // This will get the first returned node in the jQuery collection.
        var chart = new Chart(salesChartCanvas);

        var ChartData = {
            labels: dates,//["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: users
                }
            ]
        };

        var ChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        //Create the line chart
        chart.Line(ChartData, ChartOptions);
    })();

    setTimeout(function () {
        $('.flash').fadeOut('slow');
    }, 4000);

    $(document).on('click', '.race-distance-list-btn-delete', function() {
        var id = $(this).data('id');
        $('#race-distance-list-item-' + id).remove();
    });

    $(document).on('click', '.race-distance-list-btn-add', function() {
        var sport_id = $('#race-sport-id').val();
        if (!sport_id) {
            alert('Выберите вид спорта');
            return false;
        }
        var $container = $('#race-distance-list');
        var counter = $container.data('count') + 1;
        $.post('/race/race/get-distances-widget', {'sport_id': sport_id, 'counter' : counter}, function(response){
            $container.append(response);
            $container.data('count', counter);
        });
    });

    $(document).on('change', '#race-sport-id', function(e) {
        if ($(this).data('value')) {
            if (confirm('Вы уверены что хотите изменить спорт? Все дистанции удалятся.')) {
                $('#race-distance-list').html('');
                $('#race-distance-list').data('count', 0);
                $(this).data('value', $(this).val());
            }else {
                $(this).val($(this).data('value'));
            }
        }else {
            $(this).data('value', $(this).val());
        }
    });
});

$(document).ready(function() {
     $("#myTags").tagit();
});

function addAttrValue() {
    var $container = $('#product-attr-form-values');
    var valueCounter = parseInt($container.attr('data-attr-counter')) || 0;
    $container.attr('data-attr-counter', valueCounter + 1);
    var inputName = 'ProductAttr[values][new-' + valueCounter + ']';
    var blockId = 'product-attr-value-new' + valueCounter;

    var $input = '<div id="' + blockId +'" class="row">' +
        '<div class="col-xs-11">' +
        '<input type="text" name="' + inputName + '" class="form-control form-control-with-margin">' +
        '</div>' +
        '<div class="col-xs-1">' +
        '<a href="javascript:;" onclick="deleteAttrValue(\'#' + blockId + '\')" class="btn btn-danger">-</a>' +
        '</div>' +
        '</div>';
    $container.append($input);
}
function deleteAttrValue(id) {
    $(id).remove();
}
function deleteProductImage(id) {
    $.ajax({
        type: "POST",
        url: '/product/product/deleteimg',
        data: {
            id: id
        },
        dataType: "html",
        cache: false,
        success: function (data)
        {
            $('#product-images-' + id).remove();
        },
        error: function (data)
        {
            alert('Ошибка сервера, повторите позднее');
        }
    });
}

function deleteRaceFile(race_id, file_id) {
    $.ajax({
        type: "POST",
        url: '/race/race/delete-file',
        data: {
            race_id: race_id,
            file_id : file_id
        },
        dataType: "html",
        cache: false,
        success: function (data)
        {
            $('#race-file-' + file_id).remove();
        },
        error: function (data)
        {
            alert('Ошибка сервера, повторите позднее');
        }
    });
}

$('#product_category_id').on('change', function() {
   var id = $(this).val();
    $.ajax({
        type: "POST",
        url: '/product/product/getattrlist',
        data: {
            id: id
        },
        dataType: "html",
        cache: false,
        success: function (data)
        {
            $('#product-attr').html(data);
        },
        error: function (data)
        {
            $('#product-attr').html('Ошибка сервера, повторите позднее');
        }
    });
});