<?php

/**
 * Telefone form base class.
 *
 * @method Telefone getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTelefoneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'numero'     => new sfWidgetFormInputText(),
      'tipo'       => new sfWidgetFormInputText(),
      'titular_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'     => new sfValidatorString(array('max_length' => 12)),
      'tipo'       => new sfValidatorString(array('max_length' => 12)),
      'titular_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'))),
    ));

    $this->widgetSchema->setNameFormat('telefone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Telefone';
  }

}
