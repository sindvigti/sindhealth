<?php

/**
 * Encaminhamento
 * .
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sindhealth
 * @subpackage model
 * @author     Felipe Kaled
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Encaminhamento extends BaseEncaminhamento
{
  public function __toString()
  {
   return sprintf("Mat: %s data: %s", $this->getTitular()->getMatricula(), $this->getDateTimeObject('created_at')->format('d/m/Y'));
  }

  public function isTitular()
  {
    if($this->getTipo() == sfConfig::get('app_assoc_titular'))
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function isDependente()
  {
    if($this->getTipo() == sfConfig::get('app_assoc_dependente'))
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function isGratuito()
  {
    if($this->getGratuito())
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function getAssociado()
  {
    if($this->isTitular())
    {
      $tipo = "Titular";
    }
    elseif($this->isDependente())
    {
      $tipo = "Dependente";
    }

    return Doctrine_Core::getTable($tipo)->find($this->getAssocId());
  }

  public function gdata_insert_row()
  {
    ProjectConfiguration::registerZend();

    Zend_Loader::loadClass('Zend_Gdata_AuthSub');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
    Zend_Loader::loadClass('Zend_Gdata_Docs');

    $username = "sindvig.dentista";
    $password = "@bcd1234";

    //Chave do arquivo
    $key = "0Ak_oCZQf3sTidEJnZGQ4MHdhS0R1NUlSeG1ORkpnalE";

    //Carregando o serviço do arquivo
    $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
    $client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
    $spreadSheetService = new Zend_Gdata_Spreadsheets($client);

    //Pegando as planilhas do arquivo
    $query = new Zend_Gdata_Spreadsheets_DocumentQuery();
    $query->setSpreadsheetKey($key);
    $feed = $spreadSheetService->getWorksheetFeed($query);

    //Escolhendo a planilha correta
    foreach($feed->entries as $entry)
    {
      if($entry->getTitle() == 'Disponiveis')
      {
        $worksheetId = basename($entry->getId());
      }
    }

    //Configura variaveis da nova linha na planilha
    $assoc = $this->getAssociado();
    $matricula = $this->isTitular() ? $assoc->getMatricula() : $assoc->getTitular()->getMatricula();
    $dependenteId = $this->isDependente()? $assoc->getId() : '0';

    //Monta array para o serviço do arquivo
    $rowData = array("data"=> $this->getDateTimeObject('created_at')->format('Y-m-d'), "matricula"=> $matricula ,"nome"=> $assoc->getNome() ,"dependenteid"=> $dependenteId , "encaminhaid"=> $this->getId() );

    //Insere na Planilha
    $insertedListEntry = $spreadSheetService->insertRow($rowData, $key, $worksheetId);

  }
}