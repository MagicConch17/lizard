<?php
/**
 * File: Input.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 16:11
 */

namespace Lib\System;

class Input
{
    // 获取用户输入内容
    private $argv;
    // 配置内容
    public $_config;
    /**
     * 命令处理类 自动加载
     */
    public function __construct(array $arge = null)
    {
        $this->getConfig();

        if (null === $arge){
            $arge = $_SERVER['argv'];
        }
        array_shift($arge);
        $this->argv = $arge;
        if (empty($arge))
            $this->help();
        $this->send();
    }

    /**
     * 帮助方法
     */
    public function help()
    {
        printf("---------------------\n");
        printf("您输入的命令有误,请参考命令模式：\n");
        foreach ($this->_config as $key => $value){
            printf("目前命令：%s => %s\n",$key,$value);
        }
        printf("---------------------\n");
        exit(0);
    }

    /**
     * 获取配置
     */
    public function getConfig()
    {
        if (!file_exists(__DIR__.'/../../config/command.php')){
            throw new \Exception("没有找到命令配置文件");
        }

        $this->_config = require __DIR__.'/../../config/command.php';
    }

    /**
     * 执行命令文件
     */
    public function send()
    {
        try{
            if (!array_key_exists($this->argv[0],$this->_config)){
                $this->help();
            }

            $controller = new $this->_config[$this->argv[0]];
            $controller->Index();
//            @$msg = file_get_contents(APP_PATH.'/success.log');
//            @file_put_contents(APP_PATH,$msg.date('Y-m-d H:i:s')."执行成功\n");

        }catch (\Exception $e){
            echo $e->getMessage();
            throw new \Exception($e->getMessage());
        }
    }

    public function error(string $message = "夭寿了，俺异常了!!!")
    {
        throw new \Exception($message);
    }
}