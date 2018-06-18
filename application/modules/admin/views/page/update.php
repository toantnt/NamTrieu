<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form class="form-horizontal" id="updatePage" method="post" accept-charset="utf-8">
                        <input type="hidden" name="page_id" value="<?php echo $page->page_id ?>" />
                        <div class="col-lg-12">
                            <div class="alertForm hidden"></div>
                            <div class="alertFormError hidden"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Page title</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="page_title" id="title" value="<?php echo $page->page_title ?>" />
                                <input type="hidden" name="page_slug" id="target" value="<?php echo $page->page_slug ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Summary</label>
                            <div class="col-lg-9">
                                <textarea class="form-control textarea" name="page_summary" rows="4"><?php echo $page->page_summary ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Content</label>
                            <div class="col-lg-9">
                                <textarea class="form-control ckeditor" name="page_detail" rows="4" id="ckeditor_full"><?php echo $page->page_detail ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">SEO keywords</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="page_keywords" value="<?php echo $page->page_keywords ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">SEO Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="page_description" rows="3"><?php echo $page->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2"></label>
                            <div class="col-lg-9">
                                <input type="submit" name="sm" value="Update Page" class="btn btn-primary btn-flat" />
                                <span class="loading hidden"><img src="/public/admin/dist/sending.gif" alt="sending" /></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo CPANEL_PATH.'page/assets/page.js' ?>" type="text/javascript"></script>