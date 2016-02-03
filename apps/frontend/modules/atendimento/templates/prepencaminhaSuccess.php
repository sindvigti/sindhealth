<?php slot(
    'title',
    sprintf('Encaminhamento Dentário de %s - Sindhealth', $assoc->getNome())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Encaminhamento Dentário para <?php echo $assoc->getNome() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
    <?php include_partial('search') ?>
  </div>

<h3><?php echo $tipo == 'Titular' ? $tipo . ' ' . $assoc->getNome() : $tipo . ' ' . $assoc->getNome() . ' - Titular: ' . $assoc->getTitular()->getNome() ?></h3>
<?php if($encaminhamento_still_valid): ?>
<div class="error"><?php echo $encaminhamento_still_valid ?></div>
<?php endif;?>
<div class="table">

<?php include_partial('form_encaminhamento', array('form' => $form, 'tipo'=>$tipo, 'assoc' => $assoc)) ?>
</div>
<hr />

</div>

<?php include_partial('rightCol') ?>
