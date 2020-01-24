<?php

/**
 * OrderItem form base class.
 *
 * @method OrderItem getObject() Returns the current form's model object
 *
 * @package    test.loc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'order_id'      => new sfWidgetFormInputText(),
      'product_name'  => new sfWidgetFormInputText(),
      'product_price' => new sfWidgetFormInputText(),
      'amount'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'order_id'      => new sfValidatorInteger(array('required' => false)),
      'product_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'product_price' => new sfValidatorNumber(array('required' => false)),
      'amount'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderItem';
  }

}
