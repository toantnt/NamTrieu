var site_url = location.protocol + '//' + location.host;
$(document).ready(function() {
    
    $("#wrapper").on("click", "#statusChange", function() {
        var id = $(this).attr("data-id");
        var status = $(this).attr("data-value");
        $.ajax({
            type: 'POST',
            url: site_url + '/admin/page/page_active',
            data: {
                page_id: id,
                active: status
            },
            success: function(res) {
                var data = '' + res + '',
                json = JSON.parse(data);
                if (json['success']) {
                    showalert(json['message']);
                    setTimeout(function () {
                        hiddenalert();
                    }, 1500);
                    $.ajax({
                        type: 'post',
                        url: site_url + '/' + json['url'],
                        data: {},
                        success: function (res1) {
                            var div = '#tblPage';
                            reloadPage(res1, div);
                        }
                    });
                } else {
                    showalertError(json['message']);
                    setTimeout(function () {
                        hiddenalertError();
                    }, 1500);
                    return false;
                }
            }
        });
    });
    $("#addPage").validate({
        rules: {
            page_title: {
                required: true
            }
        },
        messages: {
        },
        submitHandler: function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/admin/page/ajax_save',
                data: $(form).serialize(),
                beforeSend: function() {
                    $(".loading").removeClass('hidden');
                },
                success: function(res) {
                    var data = '' + res + '',
                    json = JSON.parse(data);
                    if(json['success']) {
                        setTimeout(function () {
                            $(".loading").addClass('hidden');
                            window.location = site_url + '/' + json['url'];
                        }, 1500);
                    } else {
                        return false;
                    }
                }
            });
        }
    });
    $("#updatePage").validate({
        rules: {
            page_title: {
                required: true
            }
        },
        messages: { },
        submitHandler: function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                type: $(form).attr('method'),
                url: '/admin/page/ajax_update',
                data: $(form).serialize(),
                beforeSend: function() {
                    $(".loading").removeClass('hidden');
                },
                success: function(res) {
                    var data = '' + res + '',
                    json = JSON.parse(data);
                    if(json['success']) {
                        setTimeout(function () {
                            $(".loading").addClass('hidden');
                            window.location = site_url + '/' + json['url'];
                        }, 1500);
                    } else {
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