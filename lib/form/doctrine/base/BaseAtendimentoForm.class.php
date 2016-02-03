<?php

/**
 * Atendimento form base class.
 *
 * @method Atendimento getObject() Returns the current form's model object
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAtendimentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'descricao'         => new sfWidgetFormInputText(),
      'titular_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'), 'add_empty' => false)),
      'tipo'              => new sfWidgetFormInputText(),
      'encaminhamento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Encaminhamento'), 'add_empty' => true)),
      'sf_guard_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'descricao'         => new sfValidatorString(array('max_length' => 100)),
      'titular_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'))),
      'tipo'              => new sfValidatorInteger(),
      'encaminhamento_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Encaminhamento'), 'required' => false)),
      'sf_guard_user_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'created_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('atendimento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Atendimento';
  }

}
