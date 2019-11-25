<?php
/**
 * File: Model.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 11:57
 */

namespace Lib\DataBases\Mongodb;

use Purekid\Mongodm\Model as Mongodb;

class Model extends Mongodb
{
    public static $config = 'mongodb';

    public static $collection = "user";

    public function setFirstName($name) {
        $name = ucfirst(strtolower($name));
        $this->__setter('firstName', $name);
    }

    public function getLastName($name) {
        $name = $this->__getter('name');
        return strtoupper($name);
    }

    /**
     *
     * Description: Split limit and skip customization
     * @param int $limit limit
     * @param int $skip skip
     * @param array $array Conditions and sorting and arrays using fields
     *
     * @return Collection
     *
     * use model->paginate(limit,skip)
     */
    public function paginate(int $limit, int $skip = null,array $array = array())
    {
        $where = array();
        $sort = array();
        $field = array();

        if (array_key_exists("WHERE",$array)){
            $where = $array['WHERE'];
        }

        if (array_key_exists("SORT",$array)){
            $sort = $array['SORT'];
        }

        if (array_key_exists("FIELD",$array)){
            $field = $array['FIELD'];
        }

        return $this->find($where,$sort,$field,$limit,$skip);
    }
}