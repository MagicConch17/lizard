<?php
/**
 * File: Model.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 11:58
 */

namespace Lib\DataBases\Mysql;

use Medoo\Medoo;
use Lib\DataBases\Mysql as MysqlPdo;

class Model
{
    // 默认连接配置
    protected $connect = 'mysql';
    // 默认使用表
    protected $table = '';
    // 默认pdo 连接
    protected $pdo = null;
    // 默认配置容器
    protected $config;
    // 默认mysql 构造器
    protected $medoo;
    // 限制条件
    protected $_where = null;
    // join 关联方法
    protected $_join = null;
    // 设定列
    protected $_column = '*';

    /**
     * 自动构造方法配置全部需要的实例 并获取数据库连接
     */
    public function __construct()
    {
        if(defined('MYSQL_CONFIG')){
            $local_config_file = MYSQL_CONFIG;
        }else{
            $local_config_file = __DIR__."/../../../../application/config/mongodm.php";
        }

        if (!file_exists($local_config_file)) {
            throw new \Exception("文件不存在");
        }

        $this->config = require($local_config_file);

        $this->pdo = MysqlPdo::getInstance($this->config[$this->connect]);
        $this->medoo = new Medoo([
            'pdo' => $this->pdo,
            'database_type' => $this->config[$this->connect]['database_type']
        ]);
    }

    public function count()
    {
        return $this->medoo->count($this->table,$this->_join,$this->_column,$this->_where);
    }

    /**
     * 关联方法
     */
    public function join(array $join)
    {
        $this->_join = $join;
        return $this;
    }

    /**
     * 获取数据集合
     */
    public function select()
    {
        return $this->medoo->select($this->table,$this->_join,$this->_column,$this->_where);
    }

    /**
     * 获取单条数据集合
     */
    public function get()
    {
        return $this->medoo->get($this->table,$this->_join,$this->_column,$this->_where);
    }

    /**
     * 设置限制条件
     */
    public function where(array $where)
    {
        $this->_where = $where;
        return $this;
    }

    /**
     * 设置统计列
     */
    public function clomn(string $clomn)
    {
        $this->_column = $clomn;
        return $this;
    }

    public function table()
    {
        return $this->table;
    }

    /**
     * 对外提供模型方法
     */
    public function models()
    {
        return $this->medoo;
    }
}