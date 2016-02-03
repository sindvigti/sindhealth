<?php slot(
    'title',
    sprintf('Edição de %s - mat. %s - Sindhealth', $titular->getNome(), $titular->getMatricula())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<div id="center-column">
  <div class="top-bar">
    <h1>Titulares</h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
  <?php include_partial('search') ?>
  </div>
  <div class="table">
<?php include_partial('form_titular', array('form' => $form)) ?>
  </div>
</div>
<?php include_partial('rightCol') ?>
