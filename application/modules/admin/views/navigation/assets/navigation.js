var site_url = location.protocol + '//' + location.host;
$(document).ready(function() {
    $.ajax({
        type: 'post',
        url: site_url + '/admin/navigation/order_ajax',
        data: {},
        success: function (res) {
            $("#orderResult").html(res);
        }
    });
    $("#wrapper").on("click", "#btnSave", function () {
        oSortable = $('.sortable').nestedSortable('toArray');
        $('#orderResult').slideUp(function () {
            $.ajax({
                type: 'post',
                url: site_url + '/admin/navigation/order_ajax',
                data: {
                    sortable: oSortable
                },
                success: function (res) {
                    $("#orderResult").html(res);
                    $('#orderResult').slideDown();
                }
            });

        });
    });
    $('.selectType').on('change', function () {
        var val = this.value;
        //alert(val);
        $.ajax({
            type: 'post',
            url: site_url + '/admin/navigation/select/'+val,
            data: {},
            success: function(res1) {
                $("#selectResult").html(res1);
            }
        });
    });
    $("#formAddNav").validate({
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/admin/navigation/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.box_image_loading').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        location.href = site_url + '/admin/navigation';
                    } else {
                        $('.modal-excel-error').show();
                    }
                }
            });
        }
    });
    $("#formEditNav").validate({
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/admin/navigation/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.box_image_loading').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        location.href = site_url + '/admin/navigation';
                    } else {
                        $('.modal-excel-error').show();
                    }
                }
            });
        }
    });
});