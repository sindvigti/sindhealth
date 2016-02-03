<?php

/**
 * Encaminhamento form base class.
 *
 * @method Encaminhamento getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEncaminhamentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'local'           => new sfWidgetFormInputText(),
      'assoc_id'        => new sfWidgetFormInputText(),
      'tipo'            => new sfWidgetFormInputText(),
      'gratuito'        => new sfWidgetFormInputCheckbox(),
      'inicio_validade' => new sfWidgetFormDate(),
      'created_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'local'           => new sfValidatorInteger(),
      'assoc_id'        => new sfValidatorInteger(),
      'tipo'            => new sfValidatorInteger(),
      'gratuito'        => new sfValidatorBoolean(array('required' => false)),
      'inicio_validade' => new sfValidatorDate(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('encaminhamento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Encaminhamento';
  }

}
