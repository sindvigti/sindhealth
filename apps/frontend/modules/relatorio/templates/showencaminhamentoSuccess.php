<?php slot(
    'title',
    sprintf('Encaminhamento %s - Sindhealth', $atendimento->getEncaminhamento())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>

<div id="center-column">
  <div class="top-bar">
    <h1>Encaminhamento</h1>
    <?php include_partial('search_historico') ?>
  </div>
  <div class="displayData">
    <p> Usuário: <?php echo $atendimento->getSfGuardUser()->getFirstName() ?></p>
    <p> Data/Hora: <?php echo $atendimento->getDateTimeObject('created_at')->format("d/m/Y H:i:s") ?></p>
    <p>
    <p>Descrição: <?php echo $atendimento->getDescricao() ?></p>
  </div>
</div>
<?php include_partial('rightCol') ?>
