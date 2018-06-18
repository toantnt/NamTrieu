<div class="">
    <div class="box box-primary">
        <div class="panel-body">
            <form id="editPost" method="post" class="form-horizontal" accept-charset="utf-8">
                <fieldset>
                    <input type="hidden" name="post_id" value="<?php echo $post->post_id ?>" />
                    <input type="hidden" name="back_uri" value="<?php echo $back_uri ?>" />
                    <div class="form-group">
                        <label class="control-label col-lg-2">Post name</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_name" value="<?php echo $post->post_name ?>" id="title" class="form-control" />
                        </div>
                    </div>
                    <?php if($this->admin_lang == 'en') { ?>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Url</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_slug" value="<?php echo $post->post_slug ?>" id="target" class="form-control" />
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
	                    <label class="control-label col-lg-2">English post</label>
	                    <div class="col-lg-9">
		                    <select name="post_slug" class="form-control">
			                    <?php 
                                if($list_en != null):
                                    foreach($list_en as $item) {
    				                    if($item->post_slug == $post->post_slug)
    				                    	echo '<option value="'.$item->post_slug.'" selected="selected">'.$item->post_name.'</option>';
    				                    else 
    				                    	echo '<option value="'.$item->post_slug.'">'.$item->post_name.'</option>';
			                        } 
                                endif; ?>
		                    </select>
	                    </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Image</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="text" name="post_image" class="form-control" value="<?php echo $post->post_image ?>" id="ImageUrl" />
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
                                if($cat != NULL) {
                                    foreach($cat as $k => $v) { 
                                        if($post->cat_id == $k) {
                                            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
                                        } else {
                                    ?>
                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                    <?php } 
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Summary</label>
                        <div class="col-lg-9">
                            <textarea id="ckeditor_full" name="post_summary" class="textarea form-control"><?php echo $post->post_summary ?></textarea>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label col-lg-2">Detail</label>
                        <div class="col-lg-9">
                            <textarea id="textarea1" name="post_detail" class="form-control ckeditor"><?php echo $post->post_detail ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">SEO Keyword</label>
                        <div class="col-lg-9">
                            <input type="text" name="post_keywords" value="<?php echo $post->post_keywords ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">SEO Description</label>
                        <div class="col-lg-9">
                            <textarea name="post_descriptions" class="form-control" rows="4"><?php echo $post->post_descriptions ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2"></label>
                        <div class="col-lg-9">
                            <label class="uniform">
                                <input class="uniform_on" name="post_ishome" <?php if($post->post_ishome == 1) echo 'checked="checked"' ?> type="checkbox" id="optionsCheckbox" value="1" />
                                Home page
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2"></label>
                        <div class="col-lg-9">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary" />
                            <a href="<?php echo site_url('admin/post'); ?>" class="btn btn-default">&larr; Back to news</a>
                            <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" /></span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_PATH.'post/assets/post.js' ?>" type="text/javascript"></script>