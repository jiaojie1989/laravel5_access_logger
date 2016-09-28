<?php

/*
 * Copyright (C) 2016 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2016-09-28.
 * 
 * To see more infomation,
 *    visit our official website http://app.finance.sina.com.cn/.
 */

namespace Jiaojie\Laravel\AccessLogger\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of AccessLog
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2016-09-28 10:14 (CST) 
 * @version 0.1
 * @description 
 */
class AccessLog extends Model {

    protected $connection = "finapp_log";

    const TABLE_PREFIX = "access_log_";

    public $timestamps = false;
    protected $primaryKey = "id";

}
