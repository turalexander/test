<?php

/**
 * Order form base class.
 *
 * @method Order getObject() Returns the current form's model object
 *
 * @package    test.loc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'       => new sfWidgetFormInputHidden(),
      'created_date' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'number'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('number')), 'empty_value' => $this->getObject()->get('number'), 'required' => false)),
      'created_date' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }

}
