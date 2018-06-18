<div class="row">
    <div class="col-lg-12">
        <p class="pull-left"><a class="btn btn-default btn-flat" href="<?php echo site_url('admin/user/edit') ?>">Add new</a></p>
    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo site_url('member/controlpanel/remove') ?>" method="=post">
                    <table class="table table-hover" id="tblUser">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" id="selectAll" /></th>-->
                                <th>Member</th>
                                <th>Account login</th>
                                <th>Email</th>
								<th>Phone</th>
								<th>Country</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $member) { ?>
                            <tr>
                                <!--<td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $member->member_id ?>" /></td>-->
                                <td><?php echo $member->member_name ?></td>
                                <td><?php echo $member->member_nicename ?></td>
                                <td><?php echo $member->member_email ?></td>
								<td><?php echo $member->member_phone ?></td>
								<td><?php echo $member->member_national ?></td>
                                <td>
                                    <a href="<?php echo site_url('member/controlpanel/update/'.$member->member_id) ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="<?php echo site_url('member/controlpanel/remove/'.$member->member_id) ?>" onclick="return confirm('You sure want to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
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