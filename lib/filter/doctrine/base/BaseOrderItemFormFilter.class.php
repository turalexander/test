<?php

/**
 * OrderItem filter form base class.
 *
 * @package    test.loc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrderItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'order_id'      => new sfWidgetFormFilterInput(),
      'product_name'  => new sfWidgetFormFilterInput(),
      'product_price' => new sfWidgetFormFilterInput(),
      'amount'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'order_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_name'  => new sfValidatorPass(array('required' => false)),
      'product_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('order_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderItem';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'order_id'      => 'Number',
      'product_name'  => 'Text',
      'product_price' => 'Number',
      'amount'        => 'Number',
    );
  }
}
