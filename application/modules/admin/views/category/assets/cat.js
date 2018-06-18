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
    $("#wrapper").on("click", "#homeStatus", function() {
        var id = $(this).attr("data-id");
        var home = $(this).attr("data-value");
        $.ajax({
            type: 'POST',
            url: site_url + '/admin/category/cat_ishome',
            data: {
                cat_id: id,
                ishome: home
            },
            success: function(res) {
                $(".sending").removeClass('hidden');
                if (res) {
                    setTimeout(function () {
                        $(".sending").addClass('hidden');
                    }, 1500);
                    $.ajax({
                        type: 'post',
                        url: site_url + '/admin/category',
                        data: {},
                        success: function (res1) {
                            var div = '#tblCategory';
                            reloadPage(res1, div);
                        }
                    });
                } else {
                    setTimeout(function () {
                        hiddenalertError();
                    }, 1500);
                    return false;
                }
            }
        });
    });
    $("#wrapper").on("click", "#activeCat", function() {
        var id = $(this).attr("data-id");
        var status = $(this).attr("data-value");
        $.ajax({
            type: 'POST',
            url: site_url + '/admin/category/cat_status',
            data: {
                cat_id: id,
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
                            var div = '#tblCategory';
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
    $("#addCat").validate({
        rules: {
            cat_name: {
               required: true
            }
        },
        messages: {
            
        },
        submitHandler: function(form) {
           $.ajax({
               type: $(form).attr('method'),
               url: site_url + '/admin/category/ajax_insert',
               data: $(form).serialize(),
               beforeSend: function() {
			    	$(".sending").removeClass('hidden');
               },
               success: function (res) {
                   var data = '' + res + '',
                    json = JSON.parse(data);
                    if(json['success']) {
                        window.location = site_url + '/' + json['url'];
                    } else {
                        alert(json['message']);
                        return false;
                    }
               }
           });
        }
    });
    $("#editCat").validate({
        rules: {
            cat_name: {
               required: true
            }
        },
        messages: {
            cat_name: {
               required: "Không được để trống"
            }
        },
        submitHandler: function(form) {
            
           $.ajax({
               type: $(form).attr('method'),
               url: site_url + '/admin/category/ajax_update',
               data: $(form).serialize(),
               beforeSend: function() {
			    	$(".sending").removeClass('hidden');
               },
               success: function (res) {
                   var data = '' + res + '',
                    json = JSON.parse(data);
                    if(json['success']) {
                        window.location = site_url + '/' + json['url'];
                    } else {
                        alert(json['message']);
                        return false;
                    }
               }
           });
        }
    });
    
    $("#wrapper").on("click", "#btnSave", function () {
        oSortable = $('.sortable').nestedSortable('toArray');
        $('#orderResult').slideUp(function () {
            $.ajax({
                type: 'post',
                url: site_url + '/admin/category/order_ajax',
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
});


