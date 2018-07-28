<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/28
 * Time: 17:24
 */

// 安全语句
if (!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_tool_info extends discuz_table {

    public function __construct(){
        $this->_table = 'tool_info';
        $this->_pk = 'tool_id';
        parent::__construct();
    }

    public function get_tool_list($pageNum, $pageSize){
        $start = ($pageNum-1)*$pageSize;
        $sql = 'select * from %t where tool_state=%d order by '.DB::order('tool_uid','desc').DB::limit($start,$pageSize);
        $result = DB::fetch_all($sql,array($this->_table, 10));
        return $result;
    }

    public function delete_tool($data){
        $result = DB::delete($this->_table, 'tool_id='.$data);
        return $result;
    }

    public function modify_tool($data,$tool_id){
        $result = DB::update($this->_table, $data,'tool_id='.$tool_id);
        return $result;
    }

    public function get_tool_one($tool_id ){
        $result = DB::fetch_first('select * from %t where tool_id=%d',array($this->_table, $tool_id));
        return $result;
    }

    public function add_tool($data){
        $result = DB::insert($this->_table, $data, true);
        return $result;
    }

    public function get_tool_result_first(){
        $result = DB::result_first('select count(*) from %t ',array($this->_table));
        return $result;
    }
}