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
<<<<<<< HEAD
        $userId=$_SESSION['userId'];
        $query=@mysql_query("insert into message(userId,messageContent)VALUES ('$userId','$newLWord') WHERE NOT exists (select * from userList where userId='$userId') ;");
        if($query)
            return $newLWord."添加成功";
        else
            return "添加失败";
=======
        $sql="";
>>>>>>> origin/master
    }
};
return 0;
mysql_close($conn);
<<<<<<< HEAD
?>
=======
?>
>>>>>>> origin/master
