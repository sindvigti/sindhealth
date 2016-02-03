<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<?php slot('title', 'Novo dependente') ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Novo Dependente</h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
  <?php include_partial('search') ?>
  </div>
  <div class="table">
<?php include_partial('form_dependente', array('form' => $form)) ?>
  </div>
</div>
<?php include_partial('rightCol') ?>
