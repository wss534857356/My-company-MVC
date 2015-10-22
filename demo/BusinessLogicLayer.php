<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/16
 * Time: 17:05
 */
// 代码 10, 完整代码
// 扩展接口
// 留言服务接口
interface ILWordService {
    public function append($newWord);
};

// 服务工厂类
class MyServiceFactory {
// 创建留言服务
    public static function create() {
        if (include("DataAccessLayer.php")) {
// 返回中间服务层
            return new LWordServiceCore();
        } else {
// 返回临时实现
            return new TempService();
        }
    }
}

// 临时服务类
class TempService implements ILWordService {
// 添加留言
    public function append($newWord) {
        return $newWord."添加成功";
    }
};

interface AppExtension {
// 模块功能实现前
    public function beforeAppend($newWord);
// 模块功能实现后
    public function behindAppend($newWord);
};
// 检查权限
class CheckPowerExtension implements AppExtension {
// 添加留言前
    public function beforeAppend($newWord) {
// 在这里判断用户权限
    }
// 添加留言后
    public function behindAppend($newWord) {
    }
};
// 检查留言文本
class CheckContentExtension implements AppExtension {
// 添加留言前
    public function beforeAppend($newWord) {
        if (stristr($newWord, "fuck"))
            throw new Exception();
    }
// 添加留言后
    public function behindAppend($newWord) {
    }
};
// 用户积分
class AddScoreExtension implements AppExtension {
// 添加留言前
    public function beforeAppend($newWord) {
    }
// 添加留言后
    public function behindAppend($newWord) {
// 在这里给用户积分
    }
};
// 扩展家族
class LWordExtensionFamily implements AppExtension {
// 扩展数组
    private $_extensionArray = array();
// 添加扩展
    public function addExtension(AppExtension $extension) {
        $this->_extensionArray []= $extension;
    }
// 添加留言前
    public function beforeAppend($newWord) {
        foreach ($this->_extensionArray as $extension) {
            $extension->beforeAppend($newWord);
        }
    }
// 添加留言后
    public function behindAppend($newWord) {
        foreach ($this->_extensionArray as $extension) {
            $extension->behindAppend($newWord);
        }
    }
}
// 自定义扩展工厂
class MyExtensionFactory {
// 创建留言扩展
    public static function createLWordExtension() {
        $lwef = new LWordExtensionFamily();
// 添加扩展
        $lwef->addExtension(new CheckPowerExtension());
        $lwef->addExtension(new CheckLWordExtension());
        $lwef->addExtension(new AddScoreExtension());
        return $lwef;
    }
}
// 中间服务层
class LWordServiceCore implements ILWordService {
// 添加留言
    public function append($newLWord) {
// 获取扩展
        $ext = MyExtensionFactory::createLWordExtension();
        $ext->beforeAppend($newLWord);
// 调用数据访问层
        $dbTask = new LWordDBTask();
        $dbTask->append($newLWord);
        $ext->behindAppend($newLWord);
    }
};