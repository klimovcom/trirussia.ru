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

    $(document).on('keyup', '#post-label', function() {
        $('#post-url').val(cyr2lat($(this).val()));
    });

    $(document).on('keyup', '#race-label', function() {
        $('#race-url').val(cyr2lat($(this).val()));
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

        $('#published-field').val(val)
        return false;
    });

    $(document).on('change', '#race-sport_id', function(){

        $('.field-race-categoriesarray .select2-search__field')
            .val(null)
            .attr('placeholder', 'Выберите категорию')
            .css('width', '200px');
        $('.field-race-categoriesarray input[name="Race[categoriesArray]"]').val(null);
        $('.field-race-categoriesarray .select2-selection__choice').remove();

        $('.field-race-distancesarray .select2-search__field')
            .val(null)
            .attr('placeholder', 'Выберите дистанцию')
            .css('width', '200px');
        $('.field-race-distancesarray input[name="Race[distancesArray]"]').val(null);
        $('.field-race-distancesarray .select2-selection__choice').remove();

        $('select#race-categoriesarray').html('');
        $('select#race-distancesarray').html('');
        var val = $(this).val();
        if (val > 0){
            $.post('/race/race/get-categories-widget', {'sportId': val}, function(response){
                $('select#race-categoriesarray').removeAttr('disabled').html(response);
                $('.field-race-categoriesarray .select2-search__field')
                    .removeAttr('disabled')
            });
        }
    });




    $(document).on('change', '#race-categoriesarray', function(){
        var val = $(this).val();
        console.log('changed');
        $('.field-race-distancesarray .select2-search__field')
            .val(null)
            .attr('placeholder', 'Выберите дистанцию')
            .css('width', '200px');
        $('.field-race-distancesarray input[name="Race[distancesArray]"]').val(null);
        $('.field-race-distancesarray .select2-selection__choice').remove();

        $('select#race-distancesarray').html('');
        console.log('val');
        console.log(val);
        if (val.length > 0){
            console.log("more");
            $('#race-distancesarray').removeAttr('disabled');
            $('.field-race-distancesarray .select2-search__field').removeAttr('disabled');

            $.post('/race/race/get-distances-widget', {'distanceCategories': val}, function(response){
                $('select#race-distancesarray').html(response);
            });

        }
    });

    setTimeout(function () {
        $('.flash').fadeOut('slow');
    }, 4000)
});

$(document).ready(function() {
     $("#myTags").tagit();
});



