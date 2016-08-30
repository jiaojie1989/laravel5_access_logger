<?php

/*
 * Copyright (C) 2016 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2016-08-29.
 * 
 * To see more infomation,
 *    visit our official website http://app.finance.sina.com.cn/.
 */

namespace Jiaojie\Laravel\AccessLogger\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Jiaojie\Laravel\AccessLogger\Models\Access;
use SinaRedis;

/**
 * Description of AccessLoggerEvent
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2016-08-29 15:50 (CST) 
 * @version 0.1
 * @description 
 */
class AccessLoggerEvent extends Event {

    use SerializesModels;

    /**
     *
     * @var \Jiaojie\Laravel\AccessLogger\Models\Access 
     */
    protected $model;

    public function __construct(Access $access) {
        $this->model = $access;
    }

    public function recordAccess() {
        $conn = SinaRedis::connection("event");
        $date = strtotime($this->model->queryTime);
        $conn->hincrby("finApi:{$date}", $this->model->uri, 1);
        $conn->pfadd("finApi:ips:{$date}", json_encode($this->model->ips));
    }

}
