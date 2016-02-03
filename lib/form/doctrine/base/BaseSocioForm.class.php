<?php

/**
 * Socio form base class.
 *
 * @method Socio getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSocioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nome'       => new sfWidgetFormInputText(),
      'num'        => new sfWidgetFormInputText(),
      'inicio'     => new sfWidgetFormDate(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'       => new sfValidatorString(array('max_length' => 255)),
      'num'        => new sfValidatorString(array('max_length' => 30)),
      'inicio'     => new sfValidatorDate(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Socio', 'column' => array('num')))
    );

    $this->widgetSchema->setNameFormat('socio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Socio';
  }

}
