<?php

function get_sort($arrObj, $parent = 0, $check = TRUE) {

    $str = ($check ? '<ol class="sortable">' : '<ol>');
    foreach ($arrObj as $item) {
        if ($item->nav_parent == $parent) {
            $substr = '<p class="pull-right"><a href="/admin/navigation/update/' . $item->nav_id . '"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
            $substr .= '<a href="/admin/navigation/delete/' . $item->nav_id . '" onclick="return confirm(\'Bạn chắc chắn muốn xóa\');"><i class="glyphicon glyphicon-trash"></i></a></p>';
            $str .= '<li id="list_' . $item->nav_id . '">';
            $str .= '<div>' . $item->nav_name . $substr . '</div>';
            $str .= get_sort($arrObj, $item->nav_id, FALSE);
        }
        $str .= '</li>';
    }
    $str .= '</ol>';
    return $str;
}

echo get_sort($menu, 0, TRUE);
?>
<script type="text/javascript">
    $(document).ready(function () {

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 3
        });

    });
</script>