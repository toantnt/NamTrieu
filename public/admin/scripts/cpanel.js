jQuery(function ($) {
    $('#target').slugify('#title'); // Type as you slug
});
jQuery(function ($) {
    $('#targetEdit').slugify('#titleEdit'); // Type as you slug
});
$(document).ready(function () {
    $('#wrapper').on('click', '#selectAll', function (event) {

        if (this.checked) { // check select status
            $('#wrapper .checkbox').each(function () { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('#wrapper .checkbox').each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }
    });


    $("#btnSelectImg").click(function () {
        var finder = new CKFinder();
        finder.selectActionFunction = function (fileUrl) {
            $('#ImageUrl').val(fileUrl);
        };
        finder.popup();
    });
    $("#btnLogoFoot").click(function () {
        var finder = new CKFinder();
        finder.selectActionFunction = function (fileUrl) {
            $('#logoFooter').val(fileUrl);
        };
        finder.popup();
    });
});


function getImage(id) {
    var finder = new CKFinder();
    finder.selectActionFunction = function (fileUrl) {
        $('#'+id + '').val(fileUrl);
    };
    finder.popup();
}

function showalert(string) {
    $('.alertForm').removeClass('hidden');
    $('.alertForm').html('<h4>' + string + '</h4>');
}
function hiddenalert() {
    $('.alertForm').addClass('hidden');
}
function showalertError(string) {
    $('.alertFormError').removeClass('hidden');
    $('.alertFormError').html('<h4>' + string + '</h4>');
}
function hiddenalertError() {
    $('.alertFormError').addClass('hidden');
}
function resetForm(form) {
    $('#' + form + '')[0].reset();
    $('#' + form + ' input').removeClass('valid');
    $('#' + form + ' label.error').html('');
    return true;
}
function reloadPage(res, div) {
    $("#loading").addClass('hidden');
    var container = $('<div/>').append(res);
    var html = $(container).find(div).html();
    $(div).html(html);
    return false;
}


function sendAjax(form, url, div) {
    $.ajax({
        type: $(form).attr("method"),
        url: $(form).attr("data-url"),
        data: $(form).serialize(),
        beforeSend: function () {
            $(".sending").removeClass("hidden");
        },
        success: function (res) {
            if(div == null) {
                if(res === 'TRUE') {
                    setTimeout(function() {
                        $(".sending").addClass("hidden");
                        window.location = url;
                    }, 1500);
                } else {
                    alert("System error. Please reload page !");
                }
            } else {
                $(".sending").addClass("hidden");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {},
                    success: function(res1) {
                        setTimeout(function() {
                            $(".sending").addClass("hidden");
                        }, 900);
                        reloadPage(res1,div);
                    }
                });
            }
        }
    });
}