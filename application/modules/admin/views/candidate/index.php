<div class="row">
    <div class="col-lg-12">
        <p class="pull-left"><a class="btn btn-default" href="<?php echo site_url('admin/candidate/add') ?>"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a></p>

    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo site_url('admin/candidate/delete') ?>" method="post" onsubmit="return deleteConfirm();">
                    <input type="submit" class="btn btn-primary" name="btn_delete" value="Xóa"/>
                    <table class="table table-hover table-responsive" id="tblCandidate">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Tên ứng viên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Tên người dùng</th>
                                <th>Trạng thái</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $candidate) { ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $candidate->member_id ?>" /></td>
                                <td><?php echo $candidate->member_name ?></td>
                                <td><?php echo $candidate->member_email ?></td>
                                <td><?php echo $candidate->member_phone ?></td>
                                <td><?php echo $candidate->member_username ?></td>
                                <td><?php echo $candidate->member_status ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/candidate/edit/'.$candidate->member_id) ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="<?php echo site_url('admin/candidate/delete/'.$candidate->member_id) ?>" onclick="return confirm('Bạn có thực sự muốn xóa bản ghi này?');"><i class="glyphicon glyphicon-trash"></i></a>
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
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Bạn có thực sự muốn xóa bản ghi này?");
    if(result){
        return true;
    }else{
        return false;
    }
}
</script>