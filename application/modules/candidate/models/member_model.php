<?php

class member_model extends Truong_Model {
    
    protected $_table = 'tbl_member';
    protected $_id = 'mem_id';
    protected $_date ='mem_create';
            
    function __construct() {
        parent::__construct();
    }
}
