<?php

/**
 * BaseOrder
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $number
 * @property datetime $created_date
 * @property Doctrine_Collection $OrderItem
 * 
 * @method integer             getNumber()       Returns the current record's "number" value
 * @method datetime            getCreatedDate()  Returns the current record's "created_date" value
 * @method Doctrine_Collection getOrderItem()    Returns the current record's "OrderItem" collection
 * @method Order               setNumber()       Sets the current record's "number" value
 * @method Order               setCreatedDate()  Sets the current record's "created_date" value
 * @method Order               setOrderItem()    Sets the current record's "OrderItem" collection
 * 
 * @package    test.loc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrder extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('orders');
        $this->hasColumn('number', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('created_date', 'datetime', null, array(
             'type' => 'datetime',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('OrderItem as orderItems', array(
             'local' => 'number',
             'foreign' => 'order_id'));
    }
}