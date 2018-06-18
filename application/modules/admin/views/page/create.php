<div class="row">
    <div class="col-md-12">

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                <div class="row">
                    <form class="form-horizontal" id="addPage" method="post" accept-charset="utf-8">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Page title</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="page_title" id="title" />
                                <input type="hidden" name="page_slug" id="target" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Summary</label>
                            <div class="col-lg-9">
                                <textarea class="form-control textarea" name="page_summary" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Page content</label>
                            <div class="col-lg-9">
                                <textarea class="form-control ckeditor" name="page_detail" rows="4" id="ckeditor_full"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">SEO keyword</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="page_keywords" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">SEO Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="page_description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2"></label>
                            <div class="col-lg-9">
                                <input type="submit" name="sm" value="Create page" class="btn btn-primary btn-flat" />
                                <span class="loading hidden"><img src="/public/admin/dist/sending.gif" alt="sending" height="24" /></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo CPANEL_PATH.'page/assets/page.js' ?>" type="text/javascript"></script>