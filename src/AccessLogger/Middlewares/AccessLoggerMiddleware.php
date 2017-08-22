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

namespace Jiaojie\Laravel\AccessLogger\Middlewares;

use Illuminate\Http\Request;
use Jiaojie\Laravel\AccessLogger\Models\Access;
use Jiaojie\Laravel\AccessLogger\Events\AccessLoggerEvent;
use Event;
use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;

/**
 * Description of AccessLoggerMiddleware
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2016-08-29 15:42 (CST) 
 * @version 0.1
 * @description 
 */
class AccessLoggerMiddleware implements TerminableMiddleware
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $event = new AccessLoggerEvent(new Access($request));
        Event::fire($event);
    }

}
