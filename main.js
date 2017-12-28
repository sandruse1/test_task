/**
 * Created by sandruse on 27.12.2017.
 */
//масив чекнутих чекбоксів
let contract_status_array = [];


// Запис в масив чекнутих чекбоксів
$( "input[type='checkbox']" ).on( "click", function() {
    contract_status_array = [];
    $('input:checked').each(function() {
        contract_status_array.push($(this).val());
    });
});

// валідація поля пошуку і чекбоксів і виведення помилок
function prepare_data() {
    $('#error_p').text('');
    $( "#list" ).empty();
    let search = $('#search').val().trim();
    search = search.replace(/(^,)|(,$)/g, "");
    // Якщо є вибраний хоч один чекбокс і в полі пошуку тільки цифри або тільки букви
    if (contract_status_array.length > 0 && search.match(/^([a-zа-яё,]+|[\d,]+)$/i) ){
        let str_or_int = isNaN(search.split(',')[0] ) ? 1 : 0;
        find(search, contract_status_array, str_or_int);
    }
    // якщо жоден чекбокс не вибрано
    else if (contract_status_array.length <= 0){
        $('#error_p').text('Выберите статус договора');
    }
    // якщо поле пошуку пусте
    else if (search == ''){
        $('#error_p').text('Заполните поле поиска');
    }
    // якщо в полі пошуку і цифри і букви
    else if (!search.match(/^([a-zа-яё,]+|[\d,]+)$/i)){
        $('#error_p').text('Заполните корректно поле поиска');
    }
}

// Запит в базу диних

function find(search, status, search_type) {
    $.ajax({
        type: "POST",
        url: 'request_function.php',
        dataType: 'json',
        data: {
            'search': search,
            'contract_status': status,
            'search_type': search_type
        },
        // Вивід в карточку
        success: function( response ) {
            if (response.length != 0) {
                $.each(response, function (i, item) {
                    $('#list').append('<table border="1" id="' + i + '"><tr><td colspan=2><b>информация про клиента</b></td></tr>' +
                        '<tr><td>название клиента</td><td>' + item.name_customer + '</td></tr>' +
                        '<tr><td>компания</td><td>' + item.company + '</td></tr>' +
                        '<tr><td colspan=2><b>информация про договор</b></td></tr>' +
                        '<tr><td>номер договора</td><td>' + item.number + '</td></tr>' +
                        '<tr><td >дата подписания</td><td >' + item.date + '</td></tr>' +
                        '<tr><td colspan=2><b>информация про сервисы</b></td></tr>' +
                        '<tr><td colspan=2>' + item.service_title.replace(",", "<br>") + '</td></tr>' +
                        '</table><br><br>');
                })
            }
            else {
                $('#error_p').text('Нет такого клиента');
            }
        }
    });
}