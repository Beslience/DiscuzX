<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/28
 * Time: 16:44
 */

// 定义安全常量
if (!defined('IN_DISCUZ')){
    exit('Access Denied');
}

if (empty($_GET['action'])){
    $_GET['action'] = 'index';
}

if ($_GET['action'] == 'index'){
    $page = intval($_GET['page']);
    if ($page < 1)
        $page = 1;
    $pageSize = 2;
    $tool_list= c::t('tool_info')->get_tool_list($page,$pageSize);
    $count_tool = C::t('tool_info')->get_tool_result_first();
    $page_html = multi($count_tool, $pageSize, $page, 'tool.php?mod=index&action=index');
    include template('tool/tool_index');
    // tool.php?mod=index&action=index
}elseif($_GET['action'] == 'upload'){
    if ($_G['uid'] == 0){
        // 未登陆
        showmessage('请先登录',"member.php?mod=logging&action=login",array(),array('alert'=>'error','msgtype'=>2));
    }
    include template('tool/tool_upload');
}elseif($_GET['action'] == 'save_upload_tool'){
    $add_tool = array(
        'tool_user' => $_G['username'],
        'tool_uid' => $_G['uid'],
        'tool_tag' => $_POST['tool_tag'],
        'tool_cat' => $_POST['tool_cat'],
        'tool_cost' => $_POST['tool_cost'],
        'tool_desc' => $_POST['tool_desc'],
        'tool_type' => 1,
        'tool_state' => 20,
        'tool_time' =>  time(),
        'tool_name' => $_POST['tool_name']
    );
    // 处理上传图片
    $up = new FileUpload();
    $up->set('path', DISCUZ_ROOT. './data/attachment/tool/tool_pic/');
    $up->set('maxsize',10485760);
    $up->set('allowtype',array('gif','png','jpg','jpeg'));
    $up->set('israndname',true);
    $up->upload('tool_pic');
    $add_tool['tool_pic'] = $up->getFileName();

    // 处理上传文件
    $up = new FileUpload();
    $up->set('path', DISCUZ_ROOT.'./data/attachment/tool/tool_file/');
    $up->set('maxsize',10485760);
    $up->set('allowtype',array('zip','rar'));
    $up->set('israndname',true);
    $up->upload('tool_filename');
    $add_tool['tool_fileNAME'] = $up->getFileName();
    $result = C::t('tool_info')->add_tool($add_tool);
    if($result){
        showmessage('上传成功, 请等待审核',"tool.php?mod=index&action=index",array(),array('alert'=>'right','msgtype'=>2));
    }else{
        showmessage('上传失败',"tool.php?mod=index&action=index",array(),array('alert'=>'error','msgtype'=>2));
    }
}elseif($_GET['action'] == 'sql'){
    /*$insert_arr = array(
        'tool_user' => 'lalala',
        'tool_uid' => '888',
        'tool_cat' => '1',
        'tool_cost' => '10',
        'tool_desc' => '1111',
        'tool_type' => 1,
        'tool_state' => 10,
        'tool_time' =>  1486392001,
        'tool_name' => '1111',
        'tool_summary' => '1111'
    );
    $tool_info = C::t('tool_info')->get_tool_list($insert_arr);
    debug($tool_info);*/
    $page = intval($_GET['page']);
    if ($page < 1)
        $page = 1;
    $pageSize = 2;
    $tool_info = c::t('tool_info')->get_tool_list($page,$pageSize);
    var_dump($tool_info);
    $count_tool = C::t('tool_info')->get_tool_result_first();
    $page_html = multi($count_tool, $pageSize, $page, 'tool.php?mod=index&action=sql');
    echo $page_html;
}