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

namespace Jiaojie\Laravel\AccessLogger\Models;

use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

/**
 * Description of Access
 *
 * @encoding UTF-8 
 * @author jiaojie <jiaojie@staff.sina.com.cn> 
 * @since 2016-08-29 15:54 (CST) 
 * @version 0.1
 * @description 
 */
class Access {

    use SerializesModels;

    protected $uri;
    protected $method;
    protected $ips;
    protected $queryString;
    protected $queryTime;

    public function __construct(Request $request) {
        $this->uri = $request->path();
        $this->method = $request->method();
        $this->ips = $request->getClientIps();
        $this->queryString = $request->getQueryString();
        $this->queryTime = time();
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }

}
