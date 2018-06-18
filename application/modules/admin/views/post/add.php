<div class="">
    <div class="box box-primary">
        <div class="box-body">
            <form id="addPost" method="post" class="form-horizontal" accept-charset="utf-8">
                <fieldset>
                    <input type="hidden" name="back_uri" value="<?php echo $back_uri ?>" />
                    <div class="form-group">
                        <label class="control-label col-lg-2">Post name</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_name" id="title" class="form-control" />
                        </div>
                    </div>
                    <?php if($lang == 'en') { ?>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Url</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_slug" id="target" class="form-control" />
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
	                    <label class="control-label col-lg-2">English post</label>
	                    <div class="col-lg-9">
		                    <select name="post_slug" class="form-control">
			                    <?php 
                                if($list_en != NULL):
                                foreach($list_en as $item) {
				                    echo '<option value="'.$item->post_slug.'">'.$item->post_name.'</option>';
			                    } endif; ?>
		                    </select>
	                    </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Image</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="text" name="post_image" class="form-control" id="ImageUrl" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" id="btnSelectImg"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Category</label>
                        <div class="col-lg-5">
                            <select name="cat_id" class="form-control">
                                <?php 
                                if($cat != null):
                                foreach($cat as $k => $v) { ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php } 
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Post summary</label>
                        <div class="col-lg-9">
                            <textarea id="ckeditor_full" name="post_summary" class="textarea form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Detail</label>
                        <div class="col-lg-9">
                            <textarea id="textarea1" name="post_detail" class="form-control ckeditor"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">SEO Keyword</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_keywords" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">SEO Description</label>
                        <div class="col-lg-9">
                            <textarea name="post_descriptions" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2"></label>
                        <div class="col-lg-9">
                            <label class="uniform">
                                <input class="uniform_on" name="post_ishome" type="checkbox" id="optionsCheckbox" value="1" />
                                Home page
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2"></label>
                        <div class="col-lg-9">
                            <input type="submit" name="submit" value="Save" class="btn btn-primary" />
                            <a href="<?php echo site_url('admin/post') ?>" class="btn btn-default">&larr; Back to news</a>
                            <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" /></span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_PATH.'post/assets/post.js' ?>" type="text/javascript"></script>