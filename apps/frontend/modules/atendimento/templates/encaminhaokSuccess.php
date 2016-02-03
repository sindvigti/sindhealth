<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<div id="center-column">
  <div class="top-bar">
    <h1>Titulares</h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
  <?php include_partial('search') ?>
  </div>
  <div class="message">
  <?php if($encaminhamento->isDependente()): ?>
  <p>Encaminhamento dentário emitido para <?php echo $assoc->getNome()?> dependente do titular <?php echo $assoc->getTitular()->getNome() ?> matricula: <?php echo $assoc->getTitular()->getMatricula() ?></p>
  <?php elseif($encaminhamento->isTitular()): ?>
  <p>Encaminhamento dentário emitido para <?php echo $assoc->getNome()?>  titular da matricula <?php echo $assoc->getMatricula() ?></p>
  <?php endif; ?>
  </div>
  <a href="<?php echo url_for('@encaminhamento_print?id='. $encaminhamento->getId())?>">Imprimir Encaminhamento</a>
</div>
<?php include_partial('rightCol') ?>
