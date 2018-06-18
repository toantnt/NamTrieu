var site_url = location.protocol + '//' + location.host;
$(document).ready(function() {
    $('input[type=radio][name=lang]').change(function() {
        var value = $(this).val();
        //alert(value);
        $.ajax({
            type:'post',
            url: '/admin/user/set_language',
            data: {
                lang: value
            },
            success: function(res) {
                if(res==='TRUE') {
                    location.reload();
                } else {
                    alert("Không chuyển được ngôn ngữ, vui lòng tải lại trang!");
                }
            }
        });
    });
    $("#wrapper").on("click", "#statusChange", function() {
        var id = $(this).attr("data-id");
        var status = $(this).attr("data-value");
        $.ajax({
            type: 'POST',
            url: site_url + '/admin/post/post_status',
            data: {
                pro_id: id,
                status: status
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
                            var div = '#tblPost';
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
    
    
    $("#addPost").validate({
        rules: {
            post_name: {
                required: true
            },
            post_summary: {
                required: true
            },
            post_keywords: {
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
                url: site_url + '/admin/post/ajax_save',
                data: $(form).serialize(),
                beforeSend: function() {
                    $(".sending").removeClass('hidden');
                },
                success: function(res) {
                    var json = JSON.parse(''+res+'');
                    if(json['success']) {
                        setTimeout(function () {
                            $(".sending").addClass('hidden');
                            window.location = json['url'];
                        }, 1200);
                    } else {
                        alert('Save error ! Please contact website admin.');
                        return false;
                    }
                }
            });
        }
    });
    
    $("#editPost").validate({
        rules: {
            post_name: {
                required: true
            },
            post_summary: {
                required: true
            },
            post_keywords: {
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
               url: site_url + '/admin/post/ajax_update',
               data: $(form).serialize(),
               beforeSend: function() {
                    $(".sending").removeClass('hidden');
                },
               success: function(res) {
                    //console.info(res);
                    var json = JSON.parse(''+res+'');
                    console.info(json);
                    if(json.success === true) {
                        setTimeout(function () {
                            $(".sending").addClass('hidden');
                            window.location = json.url;
                        }, 1200);
                    } else {
                        alert('Update error ! Please contact website admin.');
                        return false;
                    }
               }
            });
        }
    });
});