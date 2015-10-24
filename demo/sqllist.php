<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/24
 * Time: 0:47
 */
function inject_check($sql_str) {
    return eregi('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
}

function verify_id($id=null) {
    if(!$id) {
        exit('没有提交参数！');
    } elseif(inject_check($id)) {
        exit('提交的参数非法！');
    } elseif(!is_numeric($id)) {
        exit('提交的参数非法！');
    }
    $id = intval($id);

    return $id;
}


function str_check( $str ) {
    if(!get_magic_quotes_gpc()) {
        $str = addslashes($str); // 进行过滤
    }
    $str = str_replace("_", "\_", $str);
    $str = str_replace("%", "\%", $str);

    return $str;
}


function post_check($post) {
    if(!get_magic_quotes_gpc()) {
        $post = addslashes($post);
    }
    $post = str_replace("_", "\_", $post);
    $post = str_replace("%", "\%", $post);
    $post = nl2br($post);
    $post = htmlspecialchars($post);

    return $post;
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> origin/master
