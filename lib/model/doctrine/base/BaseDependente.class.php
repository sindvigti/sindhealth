<?php

/**
 * BaseDependente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nome
 * @property string $parentesco
 * @property string $sexo
 * @property date $nasc
 * @property date $data_expira
 * @property date $data_renova
 * @property integer $titular_id
 * @property Titular $Titular
 * 
 * @method integer    getId()          Returns the current record's "id" value
 * @method string     getNome()        Returns the current record's "nome" value
 * @method string     getParentesco()  Returns the current record's "parentesco" value
 * @method string     getSexo()        Returns the current record's "sexo" value
 * @method date       getNasc()        Returns the current record's "nasc" value
 * @method date       getDataExpira()  Returns the current record's "data_expira" value
 * @method date       getDataRenova()  Returns the current record's "data_renova" value
 * @method integer    getTitularId()   Returns the current record's "titular_id" value
 * @method Titular    getTitular()     Returns the current record's "Titular" value
 * @method Dependente setId()          Sets the current record's "id" value
 * @method Dependente setNome()        Sets the current record's "nome" value
 * @method Dependente setParentesco()  Sets the current record's "parentesco" value
 * @method Dependente setSexo()        Sets the current record's "sexo" value
 * @method Dependente setNasc()        Sets the current record's "nasc" value
 * @method Dependente setDataExpira()  Sets the current record's "data_expira" value
 * @method Dependente setDataRenova()  Sets the current record's "data_renova" value
 * @method Dependente setTitularId()   Sets the current record's "titular_id" value
 * @method Dependente setTitular()     Sets the current record's "Titular" value
 * 
 * @package    sindhealth
 * @subpackage model
 * @author     Felipe Kaled
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDependente extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dependente');
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
        $this->hasColumn('parentesco', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('sexo', 'string', 1, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('nasc', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('data_expira', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('data_renova', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('titular_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Titular', array(
             'local' => 'titular_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}