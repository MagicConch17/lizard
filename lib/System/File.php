<?php
/**
 * File: File.php
 * Description: 操作文件类
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 16:52
 */

namespace Lib\System;

class File
{
    // 定义错误信息
    const ERROR = [
        '506' => "文件不存在"
        ,'510' => "文件读取错误"
    ];
    // 文件名字 带路径
    private $fileName;
    // 文件绝对路径
    private $pathName;
    // 文件拥有者
    private $fileOwner;
    // 上次修改时间
    private $fileCtime;
    // 文件类型
    private $fileType;
    // 文件后缀
    private $fileExt;
    // 上次修改时间
    private $fileMtime;
    // 文件内容
    private $fileData;
    /**
     * 构建类
     */
    public function __construct(String $file)
    {
        if (!file_exists($file)){
            return false;
        }

        $this->fileInfo($file);
    }

    public function __get($name)
    {
        if (!empty($this->fileData)){
            return $this->fileData[$name];
        }
        return "数据异常,请联系管理员!!!";
    }

    /**
     * 读取文件内容以及详细信息
     */
    public function fileInfo($file)
    {
        $this->fileName = basename($file); // 返回文件名部分
        $this->pathName = realpath($file); // 返回绝对路径
        $this->fileOwner = fileowner($file); // 返回文件拥有者
        $this->fileCtime = filectime($file); // 返回上次修改时间
        $this->fileType = filetype($file); // 返回文件类型
        $this->fileExt = is_file($file) ? pathinfo($file, PATHINFO_EXTENSION) : ''; // 返回文件后缀
        $this->fileMtime = filemtime($file); // 返回文件的上次修改时间
    }

    /**
     * 读取文件内容
     */
    private function setFileData()
    {
        $file = fopen($this->pathName,'r') or $this->Error(510);
        $this->fileData = json_decode(fread($file, filesize($this->pathName)),true);
        fclose($file);
    }

    /**
     * 错误信息
     */
    public function Error($code)
    {
        throw new \Exception($code, static::ERROR[$code]);
    }
    /**
     * 输出全部
     */
    public function fileData()
    {
        return $this->fileData;
    }
    /**
     * 返回上次修改时间
     */
    public function fileMtime()
    {
        return date("Y-m-d H:i:s",$this->fileMtime);
    }
}
