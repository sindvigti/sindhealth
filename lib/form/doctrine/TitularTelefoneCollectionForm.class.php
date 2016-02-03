<?php

/**
 * TitularTelefoneCollection form.
 *
 * @package    sindhealth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TitularTelefoneCollectionForm extends sfForm
{
  public function configure()
  { 
    if(!$titular = $this->getOption('titular'))
    {
      throw new InvalidArgumentException('Titular é obrigatório');
    }

    $telefones = $titular->getTelefones();

    for($i=0; $i < 2 ; $i++)
    {
      if($telefones[$i])
      {
        $telefone = $telefones[$i];
      }else{
        $telefone = new Telefone();
        $telefone->Titular = $titular;
      }

      $tform = new TelefoneForm($telefone);

      $this->embedForm($i,$tform);
    }

    $this->mergePostValidator(new TitularTelefoneValidatorSchema());
  }
}
