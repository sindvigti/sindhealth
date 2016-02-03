<?php

/**
 * relatorio actions.
 *
 * @package    sindhealth
 * @subpackage relatorio
 * @author     Felipe Kaled
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class relatorioActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeHistorico(sfWebRequest $request)
  {

    $this->pager = new sfDoctrinePager('Atendimento',10);

    if($this->getRequestParameter('matricula'))
    {
      $this->pager->setQuery(Doctrine_Core::getTable('Atendimento')->getSearchMatriculaQuery($this->getRequestParameter('matricula')));
    }

    $this->pager->getQuery()->from('atendimento a')->orderBy('created_at DESC');
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->init();

    $this->lstLinks = array(
        "relatorio_historico" => "Historico",
        "relatorio_encaminhamento" => "Encaminhamentos"
        );
  }

  public function executeEncaminhamento(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('Atendimento',10);

    if($request->hasParameter('modo'))
    {
      if($request->getParameter('modo') == 'mensal')
      {
        $start = strtotime( date('Y') . '-' . date('m')  . '-01');
        $end = $this->getMonthLastDay();
        $this->datesQueryFormated = $this->getDatesQueryFormated($start,$end);
        $queries = Doctrine_Core::getTable('Atendimento')->getEncaminhamentosBydate($this->datesQueryFormated);
      }
      elseif($request->getParameter('modo') == 'semanal')
      {
        $this->datesQueryFormated = $this->getDatesQueryFormated();
        $queries = Doctrine_Core::getTable('Atendimento')->getEncaminhamentosBydate($this->datesQueryFormated);
      }
    }
    else
    {
      if($request->hasParameter('start') || $request->hasParameter('end'))
      {
        $start = $request->hasParameter('start')? $request->getParameter('start'): NULL;
        $end = $request->hasParameter('end')? $request->getParameter('end'): NULL;
        $this->datesQueryFormated = $this->getDatesQueryFormated($start, $end);
        $queries = Doctrine_Core::getTable('Atendimento')->getEncaminhamentosBydate($this->datesQueryFormated);
      }
      else
      {
        $this->datesQueryFormated = $this->getDatesQueryFormated();
        $queries = Doctrine_Core::getTable('Atendimento')->getEncaminhamentosBydate($this->datesQueryFormated);
      }
    }

    $this->pager->setQuery($queries['encaminhamento']);
    $graphData = $queries['chartData']->execute();

    $this->pager->getQuery()->orderBy('created_at DESC');
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->init();

    $this->prepareGraphData($graphData);

    $this->pagerURL = $this->preparePagerURL('encaminhamento');

    

    $this->lstLinks = array(
        "@relatorio_encaminhamento?modo=semanal" => "Semanal",
        "@relatorio_encaminhamento?modo=mensal" => "Mensal",
        "@relatorio_historico" => "Voltar"
        );
  }

  public function executeShowencaminhamento(sfWebRequest $request)
  {
    $this->atendimento = Doctrine_Core::getTable('Atendimento')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->atendimento->getEncaminhamento());

    $this->lstLinks = array(
        "@relatorio_historico" => "Voltar"
        );

    $this->breadcrumbs = array(
        "@relatorio_historico" => "Início",
        "#" => sprintf('%s',$this->atendimento->getEncaminhamento())
        );


  }

  public function executePrintencaminhamento(sfWebRequest $request)
  {
    $start = $request->getParameter('start');
    $end = $request->getParameter('end');
    $this->datesQueryFormated = $this->getDatesQueryFormated($start, $end);

    $queries = Doctrine_Core::getTable('Atendimento')->getEncaminhamentosByDate($this->datesQueryFormated);

    $this->encaminhamentos = $queries['encaminhamento']->execute();
    $graphData = $queries['chartData']->execute();
    $this->prepareGraphData($graphData);

  }
  // return timestamp
  protected function getMonthLastDay()
  {
    return strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
  }

  protected function getDatesQueryFormated($start = NULL, $end =  NULL)
  {
    $result = array();

    //Se houver apenas um parametro, o outro recebe uma semana pra frente ou para trás
    if(isset($start) && isset($end))
    {
      $result['end'] =  date("Y-m-d H:i:s", $end);
      $result['start'] = date("Y-m-d H:i:s", $start);
    }
    else
    {
      if(isset($start) || isset($end))
      {
        if(isset($end) && !isset($start))
        {
          $lastWeekTS = strtotime('-7 day', $end );
          $result['start'] = date("Y-m-d H:i:s", strtotime(date('m/d/Y ',$lastWeekTS). " 00:00:00"));
          $result['end'] =  date("Y-m-d H:i:s", $end);
        }

        if(isset($start) && !isset($end))
        {
          $result['end'] = date("Y-m-d H:i:s",strtotime('-1 second', strtotime('+8 day', $start)));
          $result['start'] = date("Y-m-d H:i:s", $start);
        }
      }
      else
      {
      // Se nenhum estiver setado, uma semana pra trás
        $result['start'] = date("Y-m-d H:i:s", strtotime(date('m/d/Y',strtotime('-7 day')) . " 00:00:00"));
        $result['end']   = date("Y-m-d H:i:s", time());
      }
    }

    return $result;
  }

  protected function preparePagerURL($tipo='historico')
  {
    $result = false;
    if($tipo == 'historico' || $tipo == 'encaminhamento')
    {
      $result = array();
      $result['rule'] = '@relatorio_' . $tipo; 
      $result['start'] = strtotime($this->datesQueryFormated['start']);
      $result['end'] = strtotime($this->datesQueryFormated['end']) ; 
    }

    return $result;
  }

  protected function prepareGraphData($graphData)
  {
    $this->dias = array();
    $this->totais = array();
    $this->total_periodo = 0;
    foreach($graphData as $data)
    {
      $this->dias[] = date("d/m", strtotime($data['my_date']));
      $this->totais[] = $data['cnt'];
      $this->total_periodo += $data['cnt'];
    }
  }
  
}
