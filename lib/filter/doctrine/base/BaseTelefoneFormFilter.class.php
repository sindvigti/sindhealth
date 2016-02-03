<?php

/**
 * Telefone filter form base class.
 *
 * @package    sindhealth
 * @subpackage filter
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTelefoneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titular_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titular'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'     => new sfValidatorPass(array('required' => false)),
      'tipo'       => new sfValidatorPass(array('required' => false)),
      'titular_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titular'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('telefone_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Telefone';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'numero'     => 'Text',
      'tipo'       => 'Text',
      'titular_id' => 'ForeignKey',
    );
  }
}
