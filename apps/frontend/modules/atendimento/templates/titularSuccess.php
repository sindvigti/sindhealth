<?php use_helper('Pagination'); ?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Titulares</h1>
      <?php include_partial('breadcrumbs', array('crumbs'=> $breadcrumbs)) ?>
    <br>
  <?php include_partial('search') ?>
  </div>
  <p>Para <strong>inserir um novo Titular</strong>, utilize o menu a esquerda</p>
  <p>Para <strong>editar um Titular existente que nÃ£o se encontra na lista abaixo</strong>, utilize a busca acima</p>

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
          <td><a href="<?php echo url_for('@atendimento_titular_show?id='.$atendimento->getTitularId()) ?>"><?php echo $atendimento->getTitular()->getNome() ?></a></td>
          <td><?php echo $atendimento->getDescricao() ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php echo pager_navigation($pager,'atendimento/titular/page/') ?>
  </div>

</div>
<?php include_partial('rightCol') ?>
