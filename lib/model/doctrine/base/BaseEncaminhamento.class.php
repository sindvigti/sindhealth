<?php

/**
 * BaseEncaminhamento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $local
 * @property integer $assoc_id
 * @property integer $tipo
 * @property boolean $gratuito
 * @property date $inicio_validade
 * @property Doctrine_Collection $Atendimento
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method integer             getLocal()           Returns the current record's "local" value
 * @method integer             getAssocId()         Returns the current record's "assoc_id" value
 * @method integer             getTipo()            Returns the current record's "tipo" value
 * @method boolean             getGratuito()        Returns the current record's "gratuito" value
 * @method date                getInicioValidade()  Returns the current record's "inicio_validade" value
 * @method Doctrine_Collection getAtendimento()     Returns the current record's "Atendimento" collection
 * @method Encaminhamento      setId()              Sets the current record's "id" value
 * @method Encaminhamento      setLocal()           Sets the current record's "local" value
 * @method Encaminhamento      setAssocId()         Sets the current record's "assoc_id" value
 * @method Encaminhamento      setTipo()            Sets the current record's "tipo" value
 * @method Encaminhamento      setGratuito()        Sets the current record's "gratuito" value
 * @method Encaminhamento      setInicioValidade()  Sets the current record's "inicio_validade" value
 * @method Encaminhamento      setAtendimento()     Sets the current record's "Atendimento" collection
 * 
 * @package    sindhealth
 * @subpackage model
 * @author     Felipe Kaled
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEncaminhamento extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('encaminhamento');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('local', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('assoc_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('tipo', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('gratuito', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             'default' => false,
             ));
        $this->hasColumn('inicio_validade', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Atendimento', array(
             'local' => 'id',
             'foreign' => 'encaminhamento_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}