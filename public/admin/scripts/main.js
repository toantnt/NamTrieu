var site_url = location.protocol + '//' + location.host;
$(document).ready(function() {
	$("#createPost").validate({
		rules: {
			post_name: {
				required: true
			},
			c_id: {
				required: true
			},
			post_detail: { required: true },
			post_keywords: { required: true },
			post_descriptions: { required: true }
		},
		messages: {},
		submitHandler: function(form) {
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type: $(form).attr("method"),
				url: '/posts/controlpanel/ajax_save',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					//var json = JSON.parse(''+res+'');
					if(res==='TRUE') {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/posts/controlpanel';
						}, 1500);
					} else {
						alert('System error!');
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
			c_id: {
				required: true
			},
			post_detail: { required: true },
			post_keywords: { required: true },
			post_descriptions: { required: true }
		},
		messages: {},
		submitHandler: function(form) {
			for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
            	type: $(form).attr("method"),
            	url: '/posts/controlpanel/ajax_save',
            	data: $(form).serialize(),
            	beforeSend: function() {
            		$('.sending').removeClass('hidden');
            	},
            	success: function(res) {
            		if(res==='TRUE') {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/posts/controlpanel';
						}, 1500);
					} else {
						alert('System error!');
					}
            	}
            });
		}
	});

	$("#add-category").validate({
		rules: {
			cat_name: { required: true }
		},
		message: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr('method'),
				url: '/posts/category/ajax_save',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					$(".modal-add").modal('hide');
					setTimeout(function() {
						$('.sending').addClass('hidden');
					}, 1500);
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						$.ajax({
							type: 'post',
							url: '/posts/category/index',
							data: {},
							success: function(res1) {
								reloadPage(res1, '#list-category');
							}
						});
					}
					resetForm("add-category");
				}  
			});
		}
	});

	$("#wrapper").on('click', '.click-update', function() {
		var id = $(this).attr('data-id');
        //alert(id);
        $.ajax({
        	type: 'post',
        	url: '/posts/category/update',
        	data: {
        		cat_id: id
        	},
        	success: function(res) {
        		$("#cat-content-update").html(res);
        		$(".modal-update").modal('show');
        	}
        });
        
    });
    $("#update-category").validate({
    	rules: {
			cat_name: { required: true }
		},
		message: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr('method'),
				url: '/posts/category/ajax_save',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending-update').removeClass('hidden');
				},
				success: function(res) {
					$(".modal-update").modal('hide');
					setTimeout(function() {
						$('.sending-update').addClass('hidden');
					}, 1500);
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						$.ajax({
							type: 'post',
							url: '/posts/category/index',
							data: {},
							success: function(res1) {
								reloadPage(res1, '#list-category');
							}
						});
					}
					resetForm("update-category");
				}  
			});
		}
    });
    

    $("#createSlide").validate({
		rules: {
			slide_name: {
				required: true
			},
			slide_image: { required: true },
		},
		messages: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr("method"),
				url: '/admin/slide/ajax_save',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/admin/slide';
						}, 1500);
					} else {
						alert('System error!');
					}
				}
			});
		}
	});

	$("#editSlide").validate({
		rules: {
			slide_name: {
				required: true
			},
			slide_image: { required: true },
		},
		messages: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr("method"),
				url: '/admin/slide/ajax_edit',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/admin/slide';
						}, 1500);
					} else {
						alert('System error!');
					}
				}
			});
		}
	});

	$("#createClient").validate({
		rules: {
			client_name: {
				required: true
			},
			client_image: { required: true },
		},
		messages: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr("method"),
				url: '/admin/client/ajax_save',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/admin/client';
						}, 1500);
					} else {
						alert('System error!');
					}
				}
			});
		}
	});

	$("#editClient").validate({
		rules: {
			client_name: {
				required: true
			},
			client_image: { required: true }
		},
		messages: {},
		submitHandler: function(form) {
			$.ajax({
				type: $(form).attr("method"),
				url: '/admin/client/ajax_edit',
				data: $(form).serialize(),
				beforeSend: function() {
					$('.sending').removeClass('hidden');
				},
				success: function(res) {
					var json = JSON.parse(''+res+'');
					if(json['success']) {
						setTimeout(function() {
							$('.sending').addClass('hidden');
							window.location = '/admin/client';
						}, 1500);
					} else {
						alert('System error!');
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
                url: '/admin/navigation/order_ajax',
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

