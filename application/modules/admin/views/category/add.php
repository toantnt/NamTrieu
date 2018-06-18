<div class="col-lg-12">
    <div class="alertForm col-md-12 bg-success text-white hidden"></div>
    <div class="alertFormError bg-inverse text-white hidden"></div>
    <div class="box box-primary">
        <div class="box-body">
            <form id="addCat" class="form-horizontal" method="post">
                <fieldset>  
                    <?php if($this->admin_lang != 'en') { ?>
                    <div class="form-group">
	                    <label class="control-label col-lg-2"></label>
	                    <div class="col-lg-9">
		                    <div style="padding:10px 30px 10px 15px;" class="alert alert-warning alert-dismissible fade in" role="alert"> 
			                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                    	<span aria-hidden="true">&times;</span>
			                    </button> 
			                    You need to create category English first
			                </div>
	                    </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Category</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="title" type="text" name="cat_name" />
                        </div>
                    </div>
                    <?php if($this->admin_lang == 'en') { ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Url</label>
                        <div class="col-lg-7">
                            <input class="form-control" id="target" type="text" name="cat_slug" />
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
	                    <label class="col-lg-2 control-label">English category</label>
                        <div class="col-lg-7">
                            <?php if($list_en != null) { ?>
                            <select name="cat_slug" class="form-control">
	                            <?php foreach($list_en as $item) {
		                            echo '<option value="'.$item->cat_slug.'">'.$item->cat_name.'</option>';
	                            } ?>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <!--
                        <label class="col-lg-2 control-label">Hình ảnh</label>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <input type="text" name="image" class="form-control" id="ImageUrl" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" id="btnSelectImg"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </div>-->
                        <label class="col-lg-2 control-label">Parent</label>
                        <div class="col-lg-4">
                            <select name="cat_parent" id="select01" class="chzn-select form-control">
                                <option value="0">Not select</option>
                                <?php if($parent_cat != null): 
                                    foreach($parent_cat as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <input name="cat_ishome" type="hidden" id="optionsCheckbox" value="1" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-4">
                            <div class="checkbox">
                                <label>
                                    <input name="cat_ishome" type="checkbox" id="optionsCheckbox" value="1" />
                                    Home page
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Save</button>
                            <a href="<?php echo site_url('admin/category') ?>" class="btn btn-default">&larr; Back to category</a>
                            <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" /></span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_PATH.'category/assets/cat.js' ?>" type="text/javascript"></script>