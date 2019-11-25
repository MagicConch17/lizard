<?php
/**
 * File: Mongodb.php
 * User: yxk <//github.com/magicconch17>
 * Date: 2019/11/18
 * Time: 11:08
 */
namespace Lib\DataBases;

use Purekid\Mongodm\Model;

class Mongodb extends Model
{

    static $collection = "test";

    /** use specific config section **/
    public static $config = 'mongodb';

    /** specific definition for attributes, not necessary! **/
    protected static $attrs = array(

        // 1 to 1 reference
        'book_fav' => array('model'=>'Purekid\Mongodm\Test\Model\Book','type'=> Model::DATA_TYPE_REFERENCE),
        // 1 to many references
        'books' => array('model'=>'Purekid\Mongodm\Test\Model\Book','type'=> Model::DATA_TYPE_REFERENCES),
        // you can define default value for attribute
        'age' => array('default'=>16,'type'=> Model::DATA_TYPE_INTEGER),
        'money' => array('default'=>20.0,'type'=> Model::DATA_TYPE_DOUBLE),
        'hobbies' => array('default'=>array('love'),'type'=> Model::DATA_TYPE_ARRAY),
        'born_time' => array('type'=> Model::DATA_TYPE_TIMESTAMP),
        'family'=>array('type'=> Model::DATA_TYPE_OBJECT),
        'pet_fav' => array('model'=>'Purekid\Mongodm\Test\Model\Pet','type'=> Model::DATA_TYPE_EMBED),
        'pets' => array('model'=>'Purekid\Mongodm\Test\Model\Pet','type'=> Model::DATA_TYPE_EMBEDS),

    );

    public function setFirstName($name) {
        $name = ucfirst(strtolower($name));
        $this->__setter('firstName', $name);
    }

    public function getLastName($name) {
        $name = $this->__getter('name');
        return strtoupper($name);
    }

}