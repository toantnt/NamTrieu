<div class="row">
    <div class="col-lg-12">
        <p class="pull-left"><a class="btn btn-default btn-flat" href="<?php echo site_url('admin/user/edit') ?>">Add new</a></p>
    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo site_url('admin/user/delete') ?>" method="=post">
                    <table class="table table-hover" id="tblUser">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>User</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $user) { ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $user->id ?>" /></td>
                                <td><?php echo $user->user_firstname.' '.$user->user_lastname ?></td>
                                <td><?php echo $user->user_username ?></td>
                                <td><?php echo $user->user_email ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/user/edit/'.$user->user_id) ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="<?php echo site_url('admin/user/delete/'.$user->user_id) ?>" onclick="return confirm('You sure want to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>