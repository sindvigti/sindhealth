<?php

/**
 * Dependente form.
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DependenteForm extends BaseDependenteForm
{
  public function configure()
  {

    unset(
      $this['created_at'], $this['updated_at'], $this['data_expira']
      );

    $this->widgetSchema['parentesco'] = new sfWidgetFormChoice(array(
      'choices' => Doctrine_Core::getTable('Dependente')->getParentescos(),
      'expanded' => true
      ));

    $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array(
      'choices' => Doctrine_Core::getTable('Dependente')->getSexos(),
      'expanded' => true
      ));

    $this->widgetSchema['nasc'] = new sfWidgetFormDate(array(
      'format' => '%day%/%month%/%year%',
      'years' =>  Doctrine_Core::getTable('Dependente')->getYearsRange(sfConfig::get('app_max_age')),
      'empty_values' => array(
        'year' => 'Ano',
        'month' => 'Mês',
        'day' => 'Dia'
        )
      ));

    $this->validatorSchema['parentesco'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('Dependente')->getParentescos())
      ));

    $this->validatorSchema['sexo'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('Dependente')->getSexos())
      ));

    $this->widgetSchema['titular_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['titular_id'] = new sfValidatorString(array('required' => false));
    
  }
}
