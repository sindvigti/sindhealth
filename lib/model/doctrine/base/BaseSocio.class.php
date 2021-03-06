<?php

/**
 * BaseSocio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nome
 * @property string $num
 * @property date $inicio
 * @property Doctrine_Collection $Dependentes
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getNome()        Returns the current record's "nome" value
 * @method string              getNum()         Returns the current record's "num" value
 * @method date                getInicio()      Returns the current record's "inicio" value
 * @method Doctrine_Collection getDependentes() Returns the current record's "Dependentes" collection
 * @method Socio               setId()          Sets the current record's "id" value
 * @method Socio               setNome()        Sets the current record's "nome" value
 * @method Socio               setNum()         Sets the current record's "num" value
 * @method Socio               setInicio()      Sets the current record's "inicio" value
 * @method Socio               setDependentes() Sets the current record's "Dependentes" collection
 * 
 * @package    sindhealth
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSocio extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('socio');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nome', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('num', 'string', 30, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 30,
             ));
        $this->hasColumn('inicio', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Dependente as Dependentes', array(
             'local' => 'id',
             'foreign' => 'socio_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}