<?php slot(
    'title',
    sprintf('Encaminhamento %d - Sindhealth', $encaminhamento->getId())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Encaminhamento número: <?php echo $encaminhamento->getId() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
  </div>
<div class="displayData">
  <div id="encaminhaData">
    Data Expedição: <?php echo $encaminhamento->getDateTimeObject('inicio_validade')->format("d/m/Y") ?> <br />
    Local: <?php echo $encaminhamento->getLocal() ?> 
    Gratuito: <?php echo $encaminhamento->isGratuito() ? 'Sim' : 'Não' ?>
  </div>
  <h3>Associado</h3>
  <div id="associadoContainer">
    Nome:<?php echo $assoc->getNome() ?><br />
    Tipo: <?php echo $encaminhamento->getTipo() ?> <br />
    <?php if($encaminhamento->isDependente()): ?>
      Titular: <?php echo $assoc->getTitular()->getNome() ?>
    <?php endif; ?>
    Matricula: <?php echo $encaminhamento->isDependente() ? $assoc->getTitular()->getMatricula() : $assoc->getMatricula() ?></br>
  </div>

</div>

<hr />

<a class="bottom link" href="<?php echo url_for('@encaminhamento_delete?id='.$encaminhamento->getId()) ?>">Excluir</a>

</div>

<?php include_partial('rightCol') ?>
