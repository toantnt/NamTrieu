<div class="row">
    <div class="col-lg-12">
        <p class="pull-left"><a class="btn btn-default" href="<?php echo site_url('admin/testominal/add') ?>"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a></p>

    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo site_url('admin/testominal/delete') ?>" method="post" onsubmit="return deleteConfirm();">
                    <input type="submit" class="btn btn-primary" name="btn_delete" value="Xóa"/>
                    <table class="table table-hover table-responsive" id="tblTestominal">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>H.ảnh</th>
                                <th>Tên khách hàng</th>
                                <th>Chức vụ</th>
                                <th>Nội dung</th>

                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $testominal) { ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $testominal->testominal_id ?>" /></td>
                                <td><img src="<?php echo $testominal->testominal_image;?>" height="100"></td>
                                <td><?php echo $testominal->testominal_name ?></td>
                                <td><?php echo $testominal->testominal_position ?></td>
                                <td><?php echo $testominal->testominal_content ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/testominal/edit/'.$testominal->testominal_id) ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="<?php echo site_url('admin/testominal/delete/'.$testominal->testominal_id) ?>" onclick="return confirm('You sure want to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
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