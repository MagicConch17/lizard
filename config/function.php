<?php
/**
 * function.php
 * author          :  yxk
 * createTime      : 2019/11/19 13:43
 * descripition    :
 */

/**
 * 助手函数 curl 请求
 */
if (! function_exists('curlData')){
    function curlData(string $url, array $data, string $method = 'GET', string $type = 'json')
    {
        //初始化
        $ch = curl_init();
        $headers = [
            'form-data' => ['Content-Type: multipart/form-data'],
            'json' => ['Content-Type: application/json'],
        ];
        if ($method == 'GET') {
            if ($data) {
                $querystring = http_build_query($data);
                $url = $url . '?' . $querystring;
            }
        }
        // 请求头，可以传数组
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers[$type]);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         // 执行后不直接打印出来
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');     // 请求方式
            curl_setopt($ch, CURLOPT_POST, true);               // post提交
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);              // post的变量
        }
        if ($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 不从证书中检查SSL加密算法是否存在
        $output = curl_exec($ch); //执行并获取HTML文档内容
        curl_close($ch); //释放curl句柄
        return $output;
    }
}
/**
 * 助手函数
 */
if (! function_exists('dd')){
    function dd($data){
        var_dump($data);
        exit(0);
    }
}