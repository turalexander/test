<?php

/**
 * BaseOrderItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $order_id
 * @property string $product_name
 * @property decimal $product_price
 * @property integer $amount
 * @property Order $Order
 * 
 * @method integer   getOrderId()       Returns the current record's "order_id" value
 * @method string    getProductName()   Returns the current record's "product_name" value
 * @method decimal   getProductPrice()  Returns the current record's "product_price" value
 * @method integer   getAmount()        Returns the current record's "amount" value
 * @method Order     getOrder()         Returns the current record's "Order" value
 * @method OrderItem setOrderId()       Sets the current record's "order_id" value
 * @method OrderItem setProductName()   Sets the current record's "product_name" value
 * @method OrderItem setProductPrice()  Sets the current record's "product_price" value
 * @method OrderItem setAmount()        Sets the current record's "amount" value
 * @method OrderItem setOrder()         Sets the current record's "Order" value
 * 
 * @package    test.loc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrderItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('order_item');
        $this->hasColumn('order_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('product_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('product_price', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('amount', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Order', array(
             'local' => 'order_id',
             'foreign' => 'number',
             'onDelete' => 'CASCADE'));
    }
}