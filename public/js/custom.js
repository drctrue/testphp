$(document).ready(function () {

    $(".chosen-select").chosen();

    $("#region_select").change(function () {
        var region = $(this).val();
        var dataString = "ter_id=" + region;

        $.ajax({
            type: "POST",
            url: "registration/ajaxCities",
            data: dataString,
            success: function (result) {

                $(".chosen-select").chosen();

                $("#show_city").html(result);

                $('#city_select').ready(function () {

                    $(".chosen-select").chosen();

                    $("#city_select").change(function () {
                        var city = $(this).val();
                        var dataString = "city_id=" + city;

                        $.ajax({
                            type: "POST",
                            url: "registration/ajaxDistricts",
                            data: dataString,
                            success: function (result) {


                                $("#show_dist").html(result);

                                $(".chosen-select").chosen();

                                $("#dist_select").change(function () {
                                    var dist = $(this).val();
                                    var dataString = "dist_id=" + dist;

                                    $.ajax({
                                        type: "POST",
                                        url: "registration/ajaxInfo",
                                        data: dataString
                                        // success: function (result) {
                                        //     // $("#show_dist").html(result);
                                        // }
                                    });
                                });
                            }

                        });
                    });
                })
            }

        });
    });


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
                if(json['success']){
                    $('.user_info').html(json['success']);
                }
                if (json['error']) {
                    $.each(json['error'], function (index, value) {
                        $('span.error_' + index).text(value);
                        $('span.error_' + index).show();
                    });
                }

                if(json['user_info']) {
                    $('.user_info').html(json['user_info']);
                }
            }
        });
    });

});
