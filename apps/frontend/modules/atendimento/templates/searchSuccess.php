
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Titulares</h1>
      <?php include_partial('breadcrumbs', array('crumbs'=> $breadcrumbs)) ?>
    <br>
  <?php include_partial('search') ?>
  </div>

  <?php if(count($titulares) < 1): ?>
    <p>Não há titulares com esses critérios.<?php echo count($titulares)?></p>
  <?php else: ?>
  <div class="table">
    <img class="left" width="8" height="7" alt="" src="img/bg-th-left.gif">
    <img class="right" width="7" height="7" alt="" src="img/bg-th-right.gif">
    <table class="listing" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="first">Matricula</th>
          <th>Nome</th>
          <th class="last">Validade</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($titulares as $i=>$titular): ?>
        <tr<?php echo( ($i % 2 < 1) ? "class=\"bg\"": "") ?>>
          <td><?php echo $titular->getMatricula() ?></td>
          <td><a href="<?php echo url_for('@atendimento_titular_show?id='.$titular->getId()) ?>"><?php echo $titular->getNome() ?></a></td>
          <td><?php echo $titular->getDateTimeObject('data_expira')->format('d/m/Y') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif;?>

</div>
<?php include_partial('rightCol') ?>
