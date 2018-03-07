$(document).on('change', '#region_select', function() {

    $('div.show_city').show();
    $('div.show_dist').hide();
    var region = $(this).val();
    var dataString = "ter_id=" + region;

    $.ajax({
        type: "POST",
        url: "registration/ajaxCities",
        data: dataString,
        dataType: 'json',
        success: function (json) {

            if(json['success'] === true) {

                $('#city_select option').remove();
                for (var x in json['response']) {
                    $('select#city_select')
                        .prepend($("<option></option>")
                            .attr("value", json['response'][x].city_id)
                            .text(json['response'][x].city_name));

                }

                $("#city_select").trigger("chosen:updated");
            } else {
                console.log(json['error']);
            }
        }
    });
});



    $(document).on('change', '#city_select', function () {
        $('div.show_dist').show();
        var city = $(this).val();
        var dataString = "city_id=" + city;
        // console.log('HERE');
        $.ajax({
            type: "POST",
            url: "registration/ajaxDistricts",
            data: dataString,
            dataType: "json",
            success: function (json) {

                if(json['success'] === true) {

                    $('#dist_select option').remove();

                    for (var x in json['response']) {
                        $('select#dist_select')
                            .prepend($("<option></option>")
                                .attr("value", json['response'][x].district_id)
                                .text(json['response'][x].district_name));
                    }


                    $('#dist_select').change();
                    $("#dist_select").trigger("chosen:updated");
                } else {
                    // if there are no districts in the database
                    if(json['error']) {
                        $('#dist_select option').remove();
                        $('div.show_dist').hide();
                    }
                }
            }


        });
    });


$(document).ready(function () {

    $("select#region_select.chosen-select").chosen();
    $("select#city_select.chosen-select").chosen();
    $("select#dist_select.chosen-select").chosen();
    $("div.show_city").hide();
    $("div.show_dist").hide();


    // Register form
    $('#form-register').submit(function (e) {
        e.preventDefault();
        var data = $('#form-register').serialize();

        $.ajax({
            url: 'registration/ajaxRegistration',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (json) {
                $('.user_info').empty();
                if (json["success"] === 'false') {
                    console.log("SPAN");
                    $('.user_info').html('<span style=\'color: red; \'><b>Пользователь с таким email\'ом уже зарегистрирован</b></span>' +
                        "<p><b>Username: </b>" + json['user_info']['name'] + "</p>" +
                        "<p><b>Email: </b>" + json['user_info']['email'] + "</p>" +
                        "<p><b>Address: </b> " + json['user_info']['ter_address'] + "</p>");

                }else {
                    $('.user_info').html('<span style=\'color: green; \'><b>Пользователь зарегистрирован</b></span>');
                    $("div.show_city").hide();
                    $("div.show_dist").hide();
                }
                if (json['error']) {
                    $.each(json['error'], function (index, value) {
                        $('span.error_' + index).text(value);
                        $('span.error_' + index).show();
                    });
                }

            }
        });
    });

});
