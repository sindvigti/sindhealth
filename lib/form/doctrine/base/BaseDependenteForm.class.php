<?php

/**
 * Dependente form base class.
 *
 * @method Dependente getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDependenteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nome'        => new sfWidgetFormInputText(),
      'parentesco'  => new sfWidgetFormInputText(),
      'sexo'        => new sfWidgetFormInputText(),
      'nasc'        => new sfWidgetFormDate(),
      'data_expira' => new sfWidgetFormDate(),
      'data_renova' => new sfWidgetFormDate(),
      'titular_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'), 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'        => new sfValidatorString(array('max_length' => 255)),
      'parentesco'  => new sfValidatorString(array('max_length' => 50)),
      'sexo'        => new sfValidatorString(array('max_length' => 1)),
      'nasc'        => new sfValidatorDate(),
      'data_expira' => new sfValidatorDate(),
      'data_renova' => new sfValidatorDate(array('required' => false)),
      'titular_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('dependente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dependente';
  }

}
