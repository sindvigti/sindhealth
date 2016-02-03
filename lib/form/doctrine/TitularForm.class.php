<?php

/**
 * Titular form.
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TitularForm extends BaseTitularForm
{
  public function configure()
  { 
    unset(
      $this['created_at'], $this['updated_at'], $this['data_expira']
    );

    $this->widgetSchema['estado_civil'] = new sfWidgetFormChoice(array(
      'choices' =>  Doctrine_Core::getTable('Titular')->getEstadosCivis(),
      'expanded' => true
    ));

    $this->validatorSchema['estado_civil'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('Titular')->getEstadosCivis())
    ));

    $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array(
      'choices' =>  Doctrine_Core::getTable('Titular')->getSexos(),
      'expanded' => true
    ));

    $this->validatorSchema['sexo'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('Titular')->getSexos())
    ));
    $this->widgetSchema->setLabels(array(
      'data_nasc' => 'Nascimento'
    ));

    $this->widgetSchema['data_nasc'] = new sfWidgetFormDate(array(
      'format' => '%day%/%month%/%year%',
      'years' =>  Doctrine_Core::getTable('Dependente')->getYearsRange(sfConfig::get('app_max_age')),
      'empty_values' => array(
        'year' => 'Ano',
        'month' => 'Mês',
        'day' => 'Dia'
        )
    ));

  }

}
