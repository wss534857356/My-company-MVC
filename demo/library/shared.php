<?php
/**
 * Created by PhpStorm.
 * User: wengshenshun
 * Date: 2015/10/28
 * Time: 0:06
 */
    /* 检查是否为开发环境并设置是否记录错误日志 */
    function setReporting(){
        if (DEVELOPMENT_ENVIRONMENT == true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors','On');
            ini_set('error_log',ROOT.DS. 'tmp' .DS. 'logs' .DS. 'error.log');
        }
    }

    /* 检测敏感字符转义（Magic Quotes）并移除他们 */
    function stripSlashDeep($value){
        $value = is_array($value) ? array_map('stripSlashDeep',$value) : stripslashes($value);
        return $value;
    }
    function removeMagicQuotes(){
        if (get_magic_quotes_gpc()) {
            $_GET = stripSlashDeep($_GET);
            $_POST = stripSlashDeep($_POST);
            $_COOKIE = stripSlashDeep($_COOKIE);
        }
    }

    /* 检测全局变量设置（register globals）并移除他们 */
    function unregisterGlobals(){
        if (ini_get('register_globals')) {
            $array = array('_SESSION','_POST','_GET','_COOKIE','_REQUEST','_SERVER','_ENV','_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /* 主请求方法，主要目的拆分URL请求 */
    function callHook() {
        global $url;
        $urlArray = array();
        $urlArray = explode("/",$url);
        $controller = $urlArray[0];
        array_shift($urlArray);
        $action = $urlArray[0];
        array_shift($urlArray);
        $queryString = $urlArray;
        $controllerName = $controller;
        $controller = ucwords($controller);
        $model = rtrim($controller, 's');
        $controller .= 'Controller';
        $dispatch = new $controller($model,$controllerName,$action);
        if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatch,$action),$queryString);
        } else {
            /* 生成错误代码 */
        }
    }

    /* 自动加载控制器和模型 */
    function __autoload($className) {
        if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
            require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
            require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
            require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
        } else {
            /* 生成错误代码 */
        }
    }

    setReporting();
    removeMagicQuotes();
    unregisterGlobals();
    callHook();