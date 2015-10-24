<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/17
 * Time: 18:43
 */
require_once ("BusinessLogicLayer.php");
// 外观层类
class LWordHomePage {
// 添加留言
    public function append($newWord) {
// 调用中间服务
        $serv = MyServiceFactory::create();
// 注意此时是操作 ILWordService 接口, 而非 LWordService 类
        $serv->append($newWord);
    }
};
?>
