<div class="col-lg-12">
    <div class="alertForm bg-success text-white hidden"></div>
    <div class="alertFormError bg-inverse text-white hidden"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title"><?php echo $subtitle ?></div>
        </div>
        <div class="panel-body">
            <form id="editCat" class="form-horizontal" method="post">
                <input name="id" value="<?php echo $id; ?>" type="hidden" />
                <input id="back-url" value="<?php echo $url; ?>" type="hidden" />
                <fieldset>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Category name</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="title" type="text" name="cat_name" value="<?php echo $group->cat_name ?>" />
                        </div>
                    </div>
                    <?php if($this->admin_lang == 'en') { ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Url</label>
                        <div class="col-lg-7">
                            <input class="form-control" id="target" value="<?php echo $group->cat_slug ?>" type="text" name="cat_slug" />
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
	                    <label class="col-lg-2 control-label">English category</label>
                        <div class="col-lg-7">
                            <select name="cat_slug" class="form-control">
	                            <?php 
                                if($list_en != null):
                                foreach($list_en as $item) {
		                            if($item->cat_slug == $group->cat_slug) { 
		                            	echo '<option value="'.$item->cat_slug.'" selected="selected">'.$item->cat_name.'</option>';
		                            } else { 
		                            	echo '<option value="'.$item->cat_slug.'">'.$item->cat_name.'</option>';
		                            }
	                            } endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <!--
                        <label class="col-lg-2 control-label">Hình ảnh</label>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <input type="text" name="image" value="<?php //echo $group->image ?>" class="form-control" id="ImageUrl" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" id="btnSelectImg"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </div>-->
                        <label class="col-lg-2 control-label">Parent</label>
                        <div class="col-lg-4">
                            <select name="cat_parent" id="select01" class="chzn-select form-control">
                                <option value="0">Not select</option>
                                <?php foreach($parent_cat as $key => $value): 
                                    if($key == $group->cat_parent) { ?>
                                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php }
                                    endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-4">
                            <div class="checkbox">
                                <label>
                                    <input name="cat_ishome" type="checkbox" id="optionsCheckbox" value="1" <?php echo ($group->cat_ishome == 1 ? 'checked="checked"' : '') ?> />
                                    Home page
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-9">
                            <button type="submit" class="btn btn-primary">Update</button>
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