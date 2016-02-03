<?php

/**
 * Titular form base class.
 *
 * @method Titular getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTitularForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'nome'         => new sfWidgetFormInputText(),
      'matricula'    => new sfWidgetFormInputText(),
      'data_admiss'  => new sfWidgetFormDate(),
      'data_expira'  => new sfWidgetFormDate(),
      'data_nasc'    => new sfWidgetFormDate(),
      'data_renova'  => new sfWidgetFormDate(),
      'estado_civil' => new sfWidgetFormInputText(),
      'sexo'         => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'         => new sfValidatorString(array('max_length' => 255)),
      'matricula'    => new sfValidatorString(array('max_length' => 30)),
      'data_admiss'  => new sfValidatorDate(array('required' => false)),
      'data_expira'  => new sfValidatorDate(array('required' => false)),
      'data_nasc'    => new sfValidatorDate(array('required' => false)),
      'data_renova'  => new sfValidatorDate(array('required' => false)),
      'estado_civil' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'sexo'         => new sfValidatorString(array('max_length' => 1)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Titular', 'column' => array('matricula')))
    );

    $this->widgetSchema->setNameFormat('titular[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Titular';
  }

}
