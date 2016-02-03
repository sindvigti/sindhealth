<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<?php use_helper('Pagination'); ?>
<div id="center-column">
  <div class="top-bar">
    <?php include_partial('search_historico') ?>
    <h1>Historico Recente</h1>
  </div>
  <p>Ultimas ações no sistema</p>

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
        <tr<?php echo( ($i % 2 < 1) ? "class=\"bg\"": "") ?>>
          <td><?php echo $atendimento->getDateTimeObject('created_at')->format('d/m/Y H:i:s') ?></td>
          <td><a href="<?php echo url_for('@atendimento_show_titular?id='.$atendimento->getTitularId()) ?>"><?php echo $atendimento->getTitular()->getNome() ?></a></td>
          <td><a href="<?php echo url_for('@relatorio_show_encaminhamento?id=' .$atendimento->getEncaminhamentoId()) ?>"><?php echo $atendimento->getDescricao() ?></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php echo pager_navigation($pager,'relatorio/historico/page/') ?>
  </div>

</div>
<?php include_partial('rightCol') ?>
