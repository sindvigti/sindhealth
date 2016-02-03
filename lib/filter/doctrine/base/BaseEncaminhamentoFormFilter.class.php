<?php

/**
 * Encaminhamento filter form base class.
 *
 * @package    sindhealth
 * @subpackage filter
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEncaminhamentoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'local'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'assoc_id'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gratuito'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'inicio_validade' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'local'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'assoc_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gratuito'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'inicio_validade' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('encaminhamento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Encaminhamento';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'local'           => 'Number',
      'assoc_id'        => 'Number',
      'tipo'            => 'Number',
      'gratuito'        => 'Boolean',
      'inicio_validade' => 'Date',
      'created_at'      => 'Date',
    );
  }
}
