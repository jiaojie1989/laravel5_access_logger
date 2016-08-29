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

namespace Jiaojie\Laravel\AccessLogger\Handlers;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Jiaojie\Laravel\AccessLogger\Events\AccessLoggerEvent;

/**
 * Description of AccessLoggerHandler
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2016-08-29 15:50 (CST) 
 * @version 0.1
 * @description 
 */
class AccessLoggerHandler implements ShouldBeQueued {

    use InteractsWithQueue;

    public function __construct() {
        
    }

    /**
     * Handle the event.
     *
     * @param  \Jiaojie\Laravel\AccessLogger\Events\AccessLoggerEvent  $event
     * @return void
     */
    public function handle(AccessLoggerEvent $event) {
        $event->recordAccess();
    }

}
