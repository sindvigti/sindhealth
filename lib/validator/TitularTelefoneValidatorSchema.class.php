<?php
class TitularTelefoneValidatorSchema extends sfValidatorSchema
{
  protected function configure($options=array(), $message=array())
  {
    $this->addMessage('numero', 'Numero é obrigatório');
  }

  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
    foreach($values as $key=>$value)
    {
      if(!$value['numero'])
      {
        unset($values[$key]);
      }
    }
    return $values;
  }
}
?>
