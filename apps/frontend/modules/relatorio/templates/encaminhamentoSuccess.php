<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<?php use_helper('Pagination'); ?>
<div id="center-column">
  <div class="top-bar">
    <?php include_partial('search_historico', array('datesQueryFormated'=> $datesQueryFormated)) ?>
    <h1>Encaminhamentos do Período de 
        <?php echo date('d/m/Y', strtotime($datesQueryFormated['start'])) ?> a
        <?php echo date('d/m/Y',strtotime($datesQueryFormated['end'])) ?>
    </h1>
    <div id="visualize-chart-container" class="visualize" role="img"></div>
  </div>

    <h2>Encaminhamentos do Período</h2>
  <div class="table">
    <img class="left" width="8" height="7" alt="" src="img/bg-th-left.gif">
    <img class="right" width="7" height="7" alt="" src="img/bg-th-right.gif">
    <table class="listing" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="first">Data</th>
          <th>Titular</th>
          <th class="last">Descrição</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pager->getResults() as $i=>$atendimento): ?>
        <tr<?php echo( ($i % 2 < 1) ? " class=\"bg\"": "") ?>>
          <td><?php echo $atendimento->getDateTimeObject('created_at')->format('d/m/Y H:i:s') ?></td>
          <td><a href="<?php echo url_for('@atendimento_show_titular?id='.$atendimento->getTitularId()) ?>"><?php echo $atendimento->getTitular()->getNome() ?></a></td>
          <td><a href="<?php echo url_for('@relatorio_show_encaminhamento?id=' .$atendimento->getEncaminhamentoId()) ?>"><?php echo $atendimento->getDescricao() ?></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php echo pager_navigation($pager,'@relatorio_encaminhamento_interval?start=' . strtotime($datesQueryFormated['start']) . '&end=' . strtotime($datesQueryFormated['end'])) ?>
  </div>
  <div style="clear:both"></div>
  <div id="graphData">
    <div id="visualize-data-container">
    <table id="visualize-data">
     <caption>Encaminhamentos por dia</caption>
     <thead>
       <tr>
         <td></td> 
         <?php foreach($dias as $dia) : ?>
           <th scope="col"><?php echo $dia ?></th>
         <?php endforeach;?>
       </tr>
     </thead>
     <tbody>
       <tr>
         <th scope="row">Total de Encaminhamentos do Dia</th> 
       <? foreach($totais as $total) : ?>
         <td><?php echo $total ?></td>
       <?php endforeach;?>
       </tr>

      </tbody>
    </table>
    </div>
  </div>
  <div id="actions" >
     <a href="<?php echo url_for('@relatorio_encaminhamento_print?start=' . strtotime($datesQueryFormated['start']) . '&end=' . strtotime($datesQueryFormated['end']))?>">Imprimir relatorio</a>
  </div>
</div>
<?php include_partial('rightCol') ?>

