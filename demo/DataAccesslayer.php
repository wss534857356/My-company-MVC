<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/17
 * Time: 18:40
 */
include_once("conn.php");
class LWordDBTask {
// 添加留言
    public function append($newLWord) {
        session_start();
        $userId=$_SESSION['userId'];
        $query=@mysql_query("insert into message(userId,messageContent)VALUES ('$userId','".$newLWord."');");
        if($query)
            return "添加成功";
        else
            return "添加失败";
        $sql="";
    }
};
return 0;
mysql_close($conn);

?>
