<?php

// 与其他入口文件的ID不冲突即可
define('APPTYPEID',10);
define('CURSCRIPT','tool');

// 引入核心文件
require './source/class/class_core.php';

// 初始化操作
$discuz = C::app();
$discuz->init();

// 引入第三方类库
require './source/class/upload/class_upload.php';

// 逻辑分发处理
if (empty($_GET['mod']) || !in_array($_GET['mod'], array('index')))
    $_GET['mod'] = 'index';

define('CURMODULE', $_GET['mod']);

// 设置全局变量
$_G['disabledwidthauto'] = 1;

//define('IN_DISCUZ','111');
// 根据mod参数分发到对应模块
require_once libfile('tool/'.$_GET['mod'], 'module');

