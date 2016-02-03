<?php slot(
    'title',
    sprintf('Edição de %s - Dependente de %s - Sindhealth', $dependente->getNome(), $dependente->getTitular()->getNome())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<div id="center-column">
  <div class="top-bar">
    <h1>Edição de Dependente</h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
  <?php include_partial('search') ?>
  </div>
  <div class="table">
<?php include_partial('form_dependente', array('form' => $form)) ?>
  </div>
</div>
<?php include_partial('rightCol') ?>
