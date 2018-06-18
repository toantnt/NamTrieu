var site_url = location.protocol + '//' + location.host;
$(document).ready(function() {
    $("#addSlide").validate({
        rules: {},
        messages: {},
        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/cpanel/slide/save',
                data: $(form).serialize(),
                success: function(res) {
                    var data = '' + res + '',
                    json = JSON.parse(data);
                    if (json['success']) {
                        $('.modal-add').modal('hide');
                        showalert(json['message']);
                        setTimeout(function () {
                            hiddenalert();
                        }, 1500);
                        $.ajax({
                            type: 'post',
                            url: site_url + '/' + json['url'],
                            data: {},
                            success: function (res1) {
                                var div = '#tblSlide';
                                reloadPage(res1, div);
                            }
                        });
                    } else {
                        $('.modal-add').modal('hide');
                        showalertError(json['message']);
                        setTimeout(function () {
                            hiddenalertError();
                        }, 1500);
                        return false;
                    }
                }
            });
        }
    });
    $("#wrapper").on("click", "#editSlide", function() { 
        var id = $(this).attr('data-id');
        $.ajax({
           type: 'POST',
           data: {
               slide_id: id
           },
           url: site_url + '/cpanel/slide/update',
           success: function(res) {
               $("#mbody-res").html(res);
               $(".modal-update").modal('show');
           }
        });
    });
    
    $("#editSlide").validate({
        rules: {},
        messages: {},
        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/cpanel/slide/save',
                data: $(form).serialize(),
                success: function(res) {
                    var data = '' + res + '',
                    json = JSON.parse(data);
                    if (json['success']) {
                        $('.modal-update').modal('hide');
                        showalert(json['message']);
                        setTimeout(function () {
                            hiddenalert();
                        }, 1500);
                        $.ajax({
                            type: 'post',
                            url: site_url + '/' + json['url'],
                            data: {},
                            success: function (res1) {
                                var div = '#tblSlide';
                                reloadPage(res1, div);
                            }
                        });
                    } else {
                        $('.modal-update').modal('hide');
                        showalertError(json['message']);
                        setTimeout(function () {
                            hiddenalertError();
                        }, 1500);
                        return false;
                    }
                }
            });
        }
    });
});


