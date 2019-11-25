<?php
/**
 * File: Mysql.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 11:08
 */
namespace Lib\DataBases;

Class Mysql
{
    // 私有配置
    private $dbConfig = [
        'database_type'    => 'mysql', // Db driver
        'server'      => '127.0.0.1',
        'port' => '3306',
        'database_name'  => '',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8', // Optional
        'collation' => 'utf8_unicode_ci', // Optional
    ];
    // 数据库的链接
    private $conn = null;
    // 配置单例进行调用
    private static $instance = null;
    /**
     * 自动加载pdo 类型对象
     */
    private function __construct(array $dbConfig)
    {
        $this->dbConfig = array_merge($this->dbConfig,$dbConfig);
        $this->connect();
    }

    /**
     * ============= 私有的 ================
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function connect()
    {
        // 捕获异常使用通过
        try {
            //新建一个PDO对象
            $db = $this->dbConfig;
            $dsn = "{$db['database_type']}:host={$db['server']};
			port={$db['port']};
			dbname={$db['database_name']};
			charset={$db['charset']};";
            // 配置POD对象
            $this->conn = new \PDO($dsn,$db['username'],$db['password']);
            // 创建POD对象
            $this->conn->query("set names {$db['charset']}");
            // 设置默认字符集
        } catch (\PDOException $e) {
            // 设置异常后的信息提示
            throw new \Exception($e->getMessage());// 输出错误提示
        }
    }

    /**
     * ============ public ============
     * 对外提供唯一方法
     */
    public static function getInstance(array $dbConfig = [])
    {
        if (!self::$instance instanceof self){
            self::$instance = new self($dbConfig);
        }

        return self::$instance->conn
            ;
    }

}