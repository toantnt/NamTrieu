<div class="col-lg-12">
    <h3 class="pull-left"><a href="<?php echo site_url('admin/category/add') ?>" class="btn btn-default">Add category</a></h3>
</div>
<div class="col-lg-12">
    <div class="box box-primary">
        <div class="box-heading">
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="<?php echo site_url('admin/category/remove') ?>" method="post" accept-charset="utf-8" onsubmit="return confirm('You sure want to delete ?')">
                <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" /></span>
                <table class="table table-hover" id="tblCategory">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll" /></th>
                            <th>Category</th>
                            <th>Url</th>
                            <th>Home page</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $category; ?>
                    </tbody>
                </table>
                <br>
                <div class="form-inline">
                    <input class="btn btn-primary" type="submit" name="submit" value="Delete selected" />
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_PATH.'category/assets/cat.js' ?>" type="text/javascript"></script>