<div class="row">			
	<div class="col-md-12">
	    <p class="pull-left"><a class="btn btn-info btn-flat" href="javascript:;" data-toggle="modal" data-target=".modal-add"><i class="glyphicon glyphicon-plus"></i> Add slide</a></p>
	</div>
	<div class="col-md-12">
	    <div class="box box-primary">
	        <div class="box-body">
	            <form method="post" class="form-horizontal" accept-charset="utf-8" action="<?php echo site_url('admin/slide/remove') ?>" onsubmit="return confirm('Are you sure to delete ?')">
	                <table class="table table-hover" id="tblSlide">
	                    <thead>
	                        <tr>
	                            <th><input type="checkbox" id="selectAll" /></th>
	                            <th>Slider</th>
	                            <th>Name</th>
	                            <th>Options</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php if($list != NULL): 
	                        foreach($list as $item) {
	                    ?>
	                        <tr>
	                            <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $item->slide_id ?>" /></td>
	                            <td>
									<?php $file_parts = pathinfo($item->slide_image); 
									if($file_parts['extension'] == 'mp4' || $file_parts['extension'] == 'avi' || $file_parts['extension'] == 'flv' || $file_parts['extension'] == 'wmv') {
										echo '<strong>'.$file_parts['filename'].'.'.$file_parts['extension'].'</strong>';
									} else {
									?>
									<img src="<?php echo $item->slide_image ?>" height="100" />
									<?php } ?>
	                            </td>
	                            <td><strong><?php echo $item->slide_name ?></strong></td>
	                            <td>
	                                <a class="btn btn-default btn-flat" href="javascript:;" id="btneditSlide" data-id="<?php echo $item->slide_id; ?>"><i class="glyphicon glyphicon-edit"></i></a>
	                                <a class="btn btn-default btn-flat" href="<?php echo site_url('admin/slide/remove/'.$item->slide_id) ?>" onclick="return confirm('Are you sure to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
	                            </td>
	                        </tr>
	                    <?php } endif; ?>
	                    </tbody>
	                </table>
	                <br />
	                <input type="submit" class="btn btn-danger btn-flat" value="Delete selected" />
	            </form>
	        </div>
	        
	    </div>
	</div>
</div>
<div class="modal fade modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="addSlide" class="form-horizontal" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Banner slide</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control col-md-3">Slider title</label>
                        <div class="col-md-9">
                            <input type="text" name="slide_name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-md-3">Image</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="slide_image" class="form-control" id="ImageUrl" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="return getImage('ImageUrl');"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-md-3">Summary</label>
                        <div class="col-md-9">
                            <textarea name="slide_summary" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
					<div class="form-group">
					    <label class="label-control col-md-3">Collection</label>
					    <div class="col-md-6">
							<select name="slide_collection" class="form-control">
								<option value="">Select collection</option>
								<?php 
								if(isset($collection)) {
									foreach ($collection as $item) {
										echo '<option value="'.$item->cat_id.'">'.$item->cat_name.'</option>';
									}
								} ?>
							</select>
					    </div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade modal-update" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="editSlide" class="form-horizontal" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update slide</h4>
                </div>
                <div class="modal-body" id="mbody-res"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Update</button>
                </div>
            </div>
        </form>
    </div><!-- /.modal-dialog -->
</div>
<script>
    var site_url = location.protocol + '//' + location.host;
    $(document).ready(function() {
        $("#addSlide").validate({
            rules: {
            },
            messages: {
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: '/admin/slide/save',
                    data: $(form).serialize(),
                    success: function(res) {
                        $(".modal-add").modal("hide");
                        if(res==='TRUE') {
                            $.ajax({
                                type: 'post',
                                url: '/admin/slide',
                                data: {},
                                success: function(res1) {
                                    reloadPage(res1, "#tblSlide");
                                }
                            });
                        } else {
                            alert("System error!");
                        }
                        resetForm("addSlide");
                    }

                });
            }
        });
        $("#wrapper").on("click", "#btneditSlide", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: '/admin/slide/edit',
                data: {
                    slide_id: id
                },
                success: function(res) {
                    $("#mbody-res").html(res);
                    $(".modal-update").modal("show");
                }
            });
        });
        $("#editSlide").validate({
            rules: {
            },
            messages: {
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: '/admin/slide/ajax_edit',
                    data: $(form).serialize(),
                    success: function(res) {
                        $(".modal-update").modal("hide");
                        if(res==='TRUE') {
                            $.ajax({
                                type: 'post',
                                url: '/admin/slide',
                                data: {},
                                success: function(res1) {
                                    reloadPage(res1, "#tblSlide");
                                }
                            });
                        } else {
                            alert("System error !");
                        }
                        resetForm("editSlide");
                    }

                });
            }
        });
    });
</script>