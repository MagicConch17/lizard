<?php
/**
 * File: Controller.php
 * Description: 控制器基本类
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 16:19
 */

namespace App;

abstract class Controller
{
    /**
     * 抽象基本方法 程序入口
     */
    abstract function Index();

    /**
     * ========== public ==============
     * 程序基本公共方法
     */
    /**
     * 获取ip地址
     */
    public function getIp(string $ip) : string
    {
        if (empty($ip)){
            return "未知地点";
        }
        $url = 'https://m.so.com/position';
        $data = json_decode(curlData($url, ['ip' => $ip]), true);
        if (isset($data['data']['position']['city']) && !empty($data['data']['position']['city'])){
            return (string)$data['data']['position']['city'];
        }
        return "未知地点";
    }
}