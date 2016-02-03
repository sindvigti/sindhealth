<?php

/**
 * atendimento actions.
 *
 * @package    sindhealth
 * @subpackage atendimento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class atendimentoActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

  public function executeSearch(sfWebRequest $request)
  {

    if($request->getParameter('tipobusca') == 'nome')
    {
      $this->titulares = Doctrine_Core::getTable('Titular')->getByName($request->getParameter('keyword'));
    }
    else
    {

      $this->titulares = Doctrine_Core::getTable('Titular')->getByMatricula($request->getParameter('keyword'));
    }

    $this->lstLinks = array(
      "atendimento_titular_novo" => "Novo"
    );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares"
    );

  }

  public function executeEtiquetaconfirma(sfWebRequest $request)
  {
    $this->forward404Unless($this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('O titular %s não existe.', $request->getParameter('titular')));

    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $this->titular->getId() => "Voltar",
        );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "@atendimento_titular_show?id=" . $this->titular->getId() => $this->titular->getNome(),
      "#" => "Impressão de Etiqueta" 
    );


  }

  public function executeEtiquetaconfirmadependente(sfWebRequest $request)
  {
    $this->forward404Unless($this->depend = Doctrine_Core::getTable('Dependente')->find(array($request->getParameter('id'))), sprintf('O dependente %s não existe.', $request->getParameter('id')));

    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $this->depend->getTitularId() => "Voltar",
        );

    $this->breadcrumbs = array(
        "@homepage" => "Início",
        "@atendimento_titular" => "Titulares",
        "@atendimento_titular_show?id=" . $this->depend->getTitularId() => $this->depend->getTitular()->getNome(),
        "#" => "Impressão de Etiqueta" 
        );
  }

  public function executeTitular(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('Atendimento',10);
    $this->pager->getQuery()->from('atendimento a')->orderBy('created_at DESC');
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->init();

    $this->lstLinks = array("atendimento_titular_novo"=> "Novo");
    $this->breadcrumbs = array("atendimento_titular" => "Início");
  }

  public function executeNovotitular(sfWebRequest $request)
  {
    $this->form = new TitularForm();
    $this->lstLinks = array(
      "atendimento_titular" => "Titulares"
    );
    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares"
    );
  }

  public function executeNovodependente(sfWebRequest $request)
  {
    $this->forward404Unless($titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('titular'))), sprintf('O titular %s não existe.', $request->getParameter('titular')));

    $dependente = new Dependente();
    $dependente->setTitularId($titular->getId());

    $this->form = new DependenteForm($dependente);
    $this->lstLinks = array(
      "@atendimento_titular_show?id=" . $titular->getId() => "Cancelar",
    );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "@atendimento_titular_show?id=" . $titular->getId() => $titular->getNome(),
      "#" => 'Novo Dependente',
    );
  }

  public function executeEdittitular(sfWebRequest $request)
  {
    $this->forward404Unless($this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('O titular %s não existe.', $request->getParameter('id')));
    $this->form = new TitularForm($this->titular);

    $this->lstLinks = array(
	"@atendimento_dependente_novo?titular=" . $this->titular->getId() => "Insere Dependente",
	"@atendimento_titular_delete?id=" . $this->titular->getId() => "Apagar",
	"@atendimento_titular" => "Titulares"
	);
    $this->breadcrumbs = array(
	"@homepage" => "Início",
	"@atendimento_titular" => "Titulares",
	"@atendimento_titular_show?id=" . $this->titular->getId() => $this->titular->getNome(),
	"#" => 'Edição',
	);
  }

  public function executeEditdependente(sfWebRequest $request)
  {
    $this->forward404Unless($this->dependente = Doctrine_Core::getTable('Dependente')->find(array($request->getParameter('id'))), sprintf('O dependente %s não existe.', $request->getParameter('id')));
    $this->form = new DependenteForm($this->dependente);

    $this->lstLinks = array(
	"@atendimento_delete_dependente?id=" . $this->dependente->getId() => "Apagar",
	"@atendimento_titular_show?id=" . $this->dependente->getTitularId() => "Voltar",
	);

    $this->breadcrumbs = array(
	"@homepage" => "Início",
	"@atendimento_titular" => "Titulares",
	"@atendimento_titular_show?id=" . $this->dependente->getTitularId() => $this->dependente->getTitular()->getNome(),
	"#" => 'Edição do Dependente ' . $this->dependente->getNome()
	);
  }

  public function executeUpdatetitular(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('Object titular does not exist (%s).', $request->getParameter('id')));
    $this->form = new TitularForm($this->titular);

    $this->processFormTitular($request, $this->form, 'update');

    $this->setTemplate('edittitular');
    $this->lstLinks = array(
      "@atendimento_titular" => "Titulares",
    );
  }

  public function executeUpdatedependente(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($this->dependente = Doctrine_Core::getTable('Dependente')->find(array($request->getParameter('id'))), sprintf('O Dependente %s não existe', $request->getParameter('id')));
    $this->form = new DependenteForm($this->dependente);

    $this->processFormDependente($request, $this->form, 'update');

    $this->setTemplate('editdependente');
    $this->lstLinks = array(
	"@atendimento_delete_dependente?id=" . $this->dependente->getId() => "Apagar",
	"@atendimento_titular_show?id=" . $this->dependente->getTitularId() => "Voltar",
	);

    $this->breadcrumbs = array(
	"@homepage" => "Início",
	"@atendimento_titular" => "Titulares",
	"@atendimento_titular_show?id=" . $this->dependente->getTitularId() => $this->dependente->getTitular()->getNome(),
	"#" => 'Edição do Dependente ' . $this->dependente->getNome()
	);
  }

  public function executeShowtitular(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->titular);
    
    $this->encaminhamentos = Doctrine_Core::getTable('Encaminhamento')->findByTitular($this->titular->getId());

    $this->lstLinks = array(
        "@atendimento_titular_edit?id=" . $this->titular->getId() => "Editar",
        "@atendimento_titular_renew?id=" . $this->titular->getId() => "Renovar",
        "@atendimento_dependente_novo?titular=" . $this->titular->getId() => "Insere Dependente",
        "@atendimento_titular_delete?id=" . $this->titular->getId() => "Apagar",
        "@atendimento_titular" => "Voltar"
        );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "#" => $this->titular->getNome()
    );

  }

  public function executeShowencaminha(sfWebRequest $request)
  {
    $this->encaminhamento = Doctrine_Core::getTable('Encaminhamento')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->encaminhamento);

    $this->assoc = $this->encaminhamento->getAssociado();

    $this->lstLinks = array(
        "@atendimento_titular_show?id=" .  $this->assoc->getId() => "Voltar"
        );

    $this->breadcrumbs = array(
        "@homepage" => "Início",
        "@atendimento_titular" => "Titulares",
        "@atendimento_titular_show?id=" . $this->assoc->getId() => "Dados do Dependente" 
        );
  }

  public function executeRenewtitular(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->titular);

    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $this->titular->getId() => "Voltar",
        "@atendimento_titular" => "Titulares"
        );

    $this->periodos = array(
        "30" => "Um mês",
        "60" => "Dois meses",
        "90" => "Três meses",
        "180" => "Seis meses"
        );

  }

  public function executeRenovaexpira(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('titular')));

    $this->forward404Unless($this->titular);

    $this->renova = $request->getParameter('renova');
    if($request->getParameter('renewall'))
    {
      foreach($this->titular->getDependentes() as $depend)
      {

        $depend->renewValidade($request->getParameter('periodo'));
        $depend->save();
      }
    }
    else
    {
      foreach($request->getParameter('renova') as $dependId)
      {
        $depend = Doctrine_Core::getTable('Dependente')->find(array($dependId));
        $depend->renewValidade($request->getParameter('periodo'));
        $depend->save();
      }
    }

    $this->titular->renewValidade($request->getParameter('periodo'));

    $this->titular->save();

    $descricao = 'Renovada a data de validade do titular '. $this->titular->getNome() . 'para ' . $this->titular->getDateTimeObject('data_expira')->format('d/m/Y');
    $tipo = sfConfig::get('app_atend_tipo_renovacao');
    $titular_id = $this->titular->getId();

    $this->saveAtendimento($descricao, $tipo, $titular_id);

    $this->redirect('@atendimento_titular_show?id=' . $this->titular->getId());

  }

  public function executeImprimeetiqueta(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find($request->getParameter('id'));

    $File = "uploads/cart". $this->titular->getId() . ".txt"; 
    $Handler = fopen($File, 'w');
    if(count($this->titular->getNome()) > 35)
    {
      $nome = substr($this->titular->getNome(),0,35);
    }
    else
    {
      $nome = $this->titular->getNome();
    }

    if($this->titular->getDataRenova())
    {
      $inclusao = $this->titular->getDateTimeObject('data_renova')->format('d/m/Y');
    }
    else
    {
      $inclusao = $this->titular->getDateTimeObject('created_at')->format('d/m/Y'); 
    }

    fwrite($Handler, "\r\n");
    fwrite($Handler, "Sindicato dos Vigilantes do RJ  -  Convenio(A-6570)");
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Beneficiario: " . $this->titular->getNome() );
    fwrite($Handler, "\r\n");
    
    fwrite($Handler, "Titular: " . $nome );
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Nascimento: " . $this->titular->getDateTimeObject('data_nasc')->format('d/m/Y') . "     Tipo: Titular");
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Inclusao: " . $inclusao . "      Validade: ". $this->titular->getDateTimeObject('data_expira')->format('d/m/Y'));
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Codigo: " . $this->titular->getMatricula() . "        Sexo: " . $this->titular->getSexo() );
    fwrite($Handler, "\r\n");
    fwrite($Handler, "SEM COBERTURA PARA INTERNACAO E CIRURGIA"); 
    fwrite($Handler, "\r\n");

    fclose($Handler);

    $descricao =  'Uma etiqueta foi impressa para o Titular ' . $this->titular->getNome();
    $tipo = sfConfig::get('app_atend_tipo_imp_cart');
    $titular_id = $this->titular->getId();

    $this->saveAtendimento($descricao, $tipo, $titular_id);

    header('Content-type: application/txt');
    header('Content-disposition: attachment; filename: cart.shf');
    readfile($File);

    throw new sfStopException();

  }

  public function executePetqdepend(sfWebRequest $request)
  {
    $this->depend = Doctrine_Core::getTable('Dependente')->find($request->getParameter('id'));

    $File = "uploads/cart". $this->depend->getId() . ".txt"; 
    $Handler = fopen($File, 'w');

    fwrite($Handler, "\r\n");
    fwrite($Handler, "Sindicato dos Vigilantes do RJ  -  Convenio(A-6570)");
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Beneficiario: " . $this->depend->getNome());
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Titular: " . $this->depend->getTitular()->getNome());
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Nascimento: " . $this->depend->getDateTimeObject('nasc')->format('d/m/Y') . "     Tipo: Dependente");
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Inclusao: " . $this->depend->getDateTimeObject('created_at')->format('d/m/Y') . "      Validade: ". $this->depend->getDateTimeObject('data_expira')->format('d/m/Y'));
    fwrite($Handler, "\r\n");
    fwrite($Handler, "Codigo: " . $this->depend->getTitular()->getMatricula() . "        Sexo: " . $this->depend->getSexo() );
    fwrite($Handler, "\r\n");
    fwrite($Handler, "SEM COBERTURA PARA INTERNACAO E CIRURGIA"); 
    fwrite($Handler, "\r\n");

    fclose($Handler);

    $descricao =  'Uma etiqueta foi impressa para o Dependente ' . $this->depend->getNome() . " do Titular " . $this->depend->getTitular()->getNome();
    $tipo = sfConfig::get('app_atend_tipo_imp_adesao');
    $titular_id = $this->depend->getTitularId();

    $this->saveAtendimento($descricao, $tipo, $titular_id);

    header('Content-type: application/txt');
    header('Content-disposition: attachment; filename: cart.shf');
    readfile($File);

    throw new sfStopException();


  }

  public function executePreparaficha(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));
 
    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $this->titular->getId() => "Voltar"
        );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "@atendimento_titular_show?id=" . $this->titular->getId() => $this->titular->getNome(),
      "#" => "Ficha de Adesão"
    );

    $this->adesao_data = new sfWidgetFormDate(array(
      'format' => '%day%/%month%/%year%',
      'years' =>  Doctrine_Core::getTable('Dependente')->getYearsRange('5'),
      'empty_values' => array(
        'year' => 'Ano',
        'month' => 'Mês',
        'day' => 'Dia'
        )
    ));

  }

  public function executeFichatitular(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));
    $admissao = $request->getParameter('data_admiss');

    $this->titular->setDataAdmiss($admissao["year"] . "-" . $admissao["month"] . "-" . $admissao["day"] );
    $this->titular->save();

    $pdf = new FichaAdesaoPdf();
    $pdf->renderFicha($this->titular);
    
    $descricao =  'Uma ficha de adesão foi gerada para o Titular ' . $this->titular->getNome();
    $tipo = sfConfig::get('app_atend_tipo_imp_adesao');
    $titular_id = $this->titular->getId();

    $this->saveAtendimento($descricao, $tipo, $titular_id);
 

    // Stop symfony process
    throw new sfStopException();
  }

  public function executeEncaminha(sfWebRequest $request)
  {
    $this->form = new EncaminhamentoForm();

    $ret= $this->processFormEncaminhamento($request, $this->form);

    if($ret == 'erro')
    {
      $this->encaminhamento_still_valid = "O associado tem um encaminhamento que ainda não expirou";
    }

    $this->setTemplate('prepencaminha');
    $encaminha_request = $request->getParameter('encaminhamento');

    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $encaminha_request['titular_id'] => "Voltar"
        );
  }

  public function executeEncaminhaok(sfWebRequest $request)
  {
    $this->encaminhamento = Doctrine_Core::getTable("Encaminhamento")->find($request->getParameter('id'));
    if($this->encaminhamento->isTitular())
    {
     $this->assoc = Doctrine_Core::getTable('Titular')->find($this->encaminhamento->getAssocId()); 
    $titular_id = $this->assoc->getId();
    $titular_nome = $this->assoc->getNome();
    }
    elseif($this->encaminhamento->isDependente())
    {
     $this->assoc = Doctrine_Core::getTable('Dependente')->find($this->encaminhamento->getAssocId()); 
    $titular_id = $this->assoc->getTitularId();
    $titular_nome = $this->assoc->getTitular()->getNome();
    }
    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $titular_id => "Voltar para titular"
        );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "@atendimento_titular_show?id=" . $titular_id => $titular_nome,
      "#" => "Encaminhamento Dentário"
    );
  }

  public function executeEncaminhaprint(sfWebRequest $request)
  {
    $this->forward404Unless($encaminhamento = Doctrine_Core::getTable('Encaminhamento')->find($request->getParameter('id')), 'Encaminhamento não existe');
    $locais = sfConfig::get('app_encaminha_enderecos');
    $local_data = Doctrine_Core::getTable('Encaminhamento')->getLocalData($locais[intval($encaminhamento->getLocal())]);
    if($encaminhamento->isDependente())
    {
      $assoc = Doctrine_Core::getTable('Dependente')->find($encaminhamento->getAssocId());
      $tipo = 'dependente';
    }
    elseif($encaminhamento->isTitular())
    {
      $assoc = Doctrine_Core::getTable('Titular')->find($encaminhamento->getAssocId());
      $tipo = 'titular';
    }

    $pdf = new EncaminhaPdf();
    $pdf->render($assoc, $local_data, $tipo);
  }

  public function executePrepencaminha(sfWebRequest $request)
  {
    switch($request->getParameter('tipo'))
    {
      case 't':
        $this->tipo = 'Titular';
        break;
      case 'd':
        $this->tipo = 'Dependente';
        break;
      default:
        $this->forward404('Não existe esse tipo de associado');
    }

    $this->forward404Unless($this->assoc = Doctrine_Core::getTable($this->tipo)->find(array($request->getParameter('id'))), sprintf('O %s codigo %s não existe', $this->tipo, $request->getParameter('id')));

    $encaminhamento = new Encaminhamento();

    $encaminhamento->setGratuito(false);
    $encaminhamento->setAssocId($this->assoc->getId());
    $encaminhamento->setTipo(sfConfig::get('app_assoc_' . strtolower($this->tipo)));

    if($this->tipo == 'Titular')
    {
      $titular_id = $this->assoc->getId();
      $titular_nome = $this->assoc->getNome();
    }
    else
    {
      $titular_id = $this->assoc->getTitularId();
      $titular_nome = $this->assoc->getTitular()->getNome();
    }

    $this->form = new EncaminhamentoForm($encaminhamento);

    $this->encaminhamento_still_valid = false;
    $this->lstLinks = array(
        "@atendimento_titular_show?id=" . $titular_id => "Voltar"
        );

    $this->breadcrumbs = array(
        "@homepage" => "Início",
        "@atendimento_titular" => "Titulares",
        "@atendimento_titular_show?id=" . $titular_id => $titular_nome,
        "#" => "Encaminhamento Dentário"
        );
  }

  public function executeOperationoktitular(sfWebRequest $request)
  {
    $this->message = "Titular inserido com sucesso";
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->titular);

    $this->lstLinks = array(
        "@atendimento_titular_edit?id=" . $this->titular->getId() => "Editar",
        "@atendimento_titular_renew?id=" . $this->titular->getId() => "Renovar",
        "@atendimento_dependente_novo?titular=" . $this->titular->getId() => "Insere Dependente",
        "@atendimento_titular_delete?id=" . $this->titular->getId() => "Apagar",
        "@atendimento_titular" => "Voltar"
        );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "#" => $this->titular->getNome()
    );
    $this->setTemplate('showtitular');
  }

  public function executeCreatetitular(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TitularForm();

    $this->processFormTitular($request, $this->form, 'create');

    $this->setTemplate('novotitular');
    $this->lstLinks = array(
      "@atendimento_titular" => "Titulares",
    );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares"
    );
  }

  public function executeCreatedependente(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DependenteForm();

    $this->processFormDependente($request, $this->form, 'create');

    $this->setTemplate('novodependente');
    $this->lstLinks = array(
      "@atendimento_titular" => "Titulares",
    );

    $this->breadcrumbs = array(
      "@homepage" => "Início",
      "@atendimento_titular" => "Titulares",
      "#" => 'Novo Dependente',
    );
  }

  public function executeDeletedependente(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($dependente = Doctrine_Core::getTable('Dependente')->find(array($request->getParameter('id'))), sprintf('Esse dependente não existe (%s).', $request->getParameter('id')));
    $titularId = $dependente->getTitularId();
    $nome_dependente = $dependente->getNome();
    $nome_titular = $dependente->getTitular()->getNome();

    $dependente->delete();
    $descricao = "O dependente " . $nome_dependente . " do titular " . $nome_titular . " foi excluido.";
    $tipo = sfConfig::get("app_atend_tipo_excl_dependente");
    $this->saveAtendimento($descricao, $tipo, $titularId);

    $this->redirect('@atendimento_titular_show?id=' . $titularId);
  }

  public function executeDeletetitular(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('Esse titular não existe (%s).', $request->getParameter('id')));
    $nome = $titular->getNome();
    $titular_id = $titular->getId();
    $titular->delete();

    $descricao = "O titular " . $nome . " foi excluido.";
    $tipo = sfConfig::get('app_atend_tipo_excl_titular');

    $this->saveAtendimento($descricao, $tipo, $titular_id);

    $this->redirect('@homepage');
  }


  protected function processFormTitular(sfWebRequest $request, sfForm $form, $action)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $titular = $form->save();

      $titular_id = $titular->getId();
      if($action == 'create')
      {
        $descricao =  'O titular ' . $titular->getNome() . ' foi inserido no sistema';
        $tipo = sfConfig::get('app_atend_tipo_inc_titular');
      }
      else
      {
        $descricao =  'Os dados do titular ' . $titular->getNome() . ' foram alterados';
        $tipo = sfConfig::get('app_atend_tipo_alt_titular');
      }

      $this->saveAtendimento($descricao, $tipo, $titular_id);

      $this->redirect('@atendimento_titular_operationok?id='.$titular->getId());
    }
  }

  protected function processFormDependente(sfWebRequest $request, sfForm $form, $action)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dependente = $form->save();

      $titular_id = $dependente->getTitularId();
      if($action == 'create')
      {
        $descricao = 'O Dependente ' . $dependente->getNome() . ' do Titular '. $dependente->getTitular()->getNome() .' foi inserido no sistema.';
        $tipo = sfConfig::get('app_atend_tipo_inc_dependente');
      }
      else
      {
        $descricao =  'Os dados do dependente ' . $dependente->getNome() . ' foram alterados';
        $tipo = sfConfig::get('app_atend_tipo_alt_dependente');
      }


      $this->saveAtendimento($descricao, $tipo, $titular_id);


      $this->redirect('@atendimento_titular_operationok?id='.$dependente->getTitularId());
    }
  }

  protected function processFormEncaminhamento(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter('encaminhamento'));
    if($form->isValid())
    {
      $form->updateObject();
      $duplicados = Doctrine_Core::getTable('Encaminhamento')->findByIdAndTipo($form->getObject()->getAssocId(), $form->getObject()->getTipo());

      if($duplicados->count() > 0)
      {
        return 'erro';
      }

      $encaminhamento = $form->save();
      
      if($encaminhamento->getTipo() == sfConfig::get('app_assoc_titular'))
      {
        $assoc = Doctrine_Core::getTable('Titular')->find($encaminhamento->getAssocId());
        $descricao = "Um encaminhamento dentário foi emitido para o titular " . $assoc->getNome() . " matricula " . $assoc->getMatricula() . ".";
        $titular_id = $encaminhamento->getAssocId();
      }
      elseif($encaminhamento->getTipo() == sfConfig::get('app_assoc_dependente'))
      {
        $assoc = Doctrine_Core::getTable('Dependente')->find($encaminhamento->getAssocId());
        $descricao = "Um encaminhamento dentário foi impresso para o dependente " . $assoc->getNome() . " do titular " . $assoc->getTitular()->getNome() . ".";
        $titular_id = $assoc->getTitularId();
      }

      $tipo_atendimento = sfConfig::get('app_atend_tipo_imp_encaminha');

      $this->saveAtendimento($descricao, $tipo_atendimento, $titular_id, $encaminhamento->getId());
      $encaminhamento->gdata_insert_row();

      $this->redirect("@encaminhamento_ok?id=" . $encaminhamento->getId());
    }

  }

  protected function saveAtendimento($descricao,$tipo,$titular_id, $encaminhamento_id = false)
  {
    $atendimento = new Atendimento();
    $atendimento->setDescricao($descricao);
    $atendimento->setTipo($tipo);
    $atendimento->setTitularId($titular_id);
    $atendimento->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
    if($encaminhamento_id)
    {
      $atendimento->setEncaminhamentoId($encaminhamento_id);
    }

    $atendimento->save();
  }
}
