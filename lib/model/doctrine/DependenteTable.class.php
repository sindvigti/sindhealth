<?php

/**
 * DependenteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DependenteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DependenteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Dependente');
    }

    static public $parentescos = array(
      'filho' => 'Filho(a)',
      'conjuge' => 'Conjuge',
      'enteado' => 'Enteado(a)',
      'pai' => 'Pai',
      'mae' => 'Mãe'
      );

    public function getParentescos()
    {
      return self::$parentescos;
    }

    static public $sexos = array(
      'M' => 'Masculino',
      'F' => 'Feminino'
      );

    public function getSexos()
    {
      return self::$sexos;
    }

    public function getYearsRange($maxAge)
    {
      $years = range(date('Y') , date('Y') - $maxAge);
      return array_combine($years, $years);
    }

}
