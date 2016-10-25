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
use Jiaojie\Laravel\AccessLogger\Models\AccessLog;
use Log;

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
        /*
         * Works only in cli application to filter SYNC type queue.
         */
        if ("cli" === php_sapi_name()) {
            $conn = SinaRedis::connection("event");
            $date = date("Y-m-d", $this->model->queryTime);
            $conn->hincrby("finApi:{$date}", $this->model->uri, 1);
            $conn->pfadd("finApi:ips:{$date}", json_encode($this->model->ips));
            try {
                $accessLogModel = new AccessLog;
                $tableName = (date("Ym") > 201610) ? (AccessLog::TABLE_PREFIX . date("Ym", $this->model->queryTime)) : (AccessLog::TABLE_PREFIX . date("Y_m", $this->model->queryTime));
                $accessLogModel->setTable($tableName);
                $accessLogModel->uri = substr($this->model->uri, 0, 127);
                $accessLogModel->method = $this->model->method;
                $accessLogModel->ips = json_encode($this->model->ips);
                $accessLogModel->queryString = json_encode($this->model->queryString);
                $accessLogModel->queryTime = date("Y-m-d H:i:s", $this->model->queryTime);
                $accessLogModel->userAgent = substr(strval($this->model->ua), 0, 1023);
                $accessLogModel->save();
            } catch (\Exception $e) {
                Log::warning("Error Dealing LOGS: " . $e->getMessage());
            }
        }
    }

}
