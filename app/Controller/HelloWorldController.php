<?php
/**
 * File: HelloWorldController.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/25
 * Time: 16:39
 */

namespace App\Controller;

use App\Controller;

class HelloWorldController extends Controller
{
    public function Index()
    {
        $server_hostname = gethostname();
        $server_ip = gethostbyname($server_hostname.'.');
        echo $this->getIp($server_ip);
    }
}