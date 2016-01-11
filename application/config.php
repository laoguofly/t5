<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$
if (!IS_CLI) {
    // 当前文件名
    if (!defined('_PHP_FILE_')) {
        if (IS_CGI) {
            //CGI/FASTCGI模式下
            $_temp = explode('.php', $_SERVER['PHP_SELF']);
            define('_PHP_FILE_', rtrim(str_replace($_SERVER['HTTP_HOST'], '', $_temp[0] . '.php'), '/'));
        } else {
            define('_PHP_FILE_', rtrim($_SERVER['SCRIPT_NAME'], '/'));
        }
    }
    if (!defined('__ROOT__')) {
        $_root = rtrim(dirname(_PHP_FILE_), '/');
        define('__ROOT__', (($_root == '/' || $_root == '\\') ? '' : $_root));
    }
    define('PHP_FILE', _PHP_FILE_);
}
if(!defined('__APP__'))
    define('__APP__', strip_tags(PHP_FILE));
// URL常量
if(!defined('__SELF__'))
    define('__SELF__', strip_tags($_SERVER[C('URL_REQUEST_URI')]));

if(!defined('__HOME__'))
    define('__HOME__',__APP__."/index");

if(!defined('__ADMIN__'))
    define('__ADMIN__',__APP__."/fjxiamenkk");
return [
    'url_route_on' => true,
    'log'          => [
        'type'             => 'socket',
        'host'             => '111.202.76.133',
        //日志强制记录到配置的client_id
        'force_client_id'  => '',
        //限制允许读取日志的client_id
        'allow_client_ids' => [],
    ],
];
