<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/7/4
 * Time: 12:28
 */
header("content-type:text/html; charset=utf-8");
@mysql_connect("localhost","root","212212212")
or die("服务器连接失败");
@mysql_select_db("test")
or die("数据库不存在或不可用");
mysql_query("set names 'utf8'");
?>