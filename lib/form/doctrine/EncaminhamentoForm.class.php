<?php

/**
 * Encaminhamento form.
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Felipe Kaled
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EncaminhamentoForm extends BaseEncaminhamentoForm
{
  public function configure()
  {
    unset($this['created_at']
 
    );

    $this->widgetSchema['local'] = new sfWidgetFormChoice(array(
      'choices' => sfConfig::get('app_encaminha_enderecos'),
      'expanded' => true
      ));

    $this->validatorSchema['local'] = new sfValidatorChoice(array(
      'choices' => array_keys(sfConfig::get('app_encaminha_enderecos')),
      'required' => true

      ));

    $this->widgetSchema['assoc_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['tipo'] = new sfWidgetFormInputHidden();

    $this->validatorSchema['assoc_id'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['tipo'] = new sfValidatorString(array('required' => false));

  }
}
