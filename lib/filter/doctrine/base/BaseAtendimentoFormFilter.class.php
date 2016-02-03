<?php

/**
 * Atendimento filter form base class.
 *
 * @package    sindhealth
 * @subpackage filter
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAtendimentoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descricao'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titular_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'), 'add_empty' => true)),
      'tipo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'encaminhamento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Encaminhamento'), 'add_empty' => true)),
      'sf_guard_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'descricao'         => new sfValidatorPass(array('required' => false)),
      'titular_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titular'), 'column' => 'id')),
      'tipo'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'encaminhamento_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Encaminhamento'), 'column' => 'id')),
      'sf_guard_user_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('atendimento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Atendimento';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'descricao'         => 'Text',
      'titular_id'        => 'ForeignKey',
      'tipo'              => 'Number',
      'encaminhamento_id' => 'ForeignKey',
      'sf_guard_user_id'  => 'ForeignKey',
      'created_at'        => 'Date',
    );
  }
}
