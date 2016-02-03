<?php slot(
    'title',
    sprintf('Ficha de Adesão %s - Sindhealth',  $titular->getNome())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Ficha de Adesão para <?php echo  $titular->getNome() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
    <?php include_partial('search') ?>
  </div>


<div class="table">
  <form action="<?php echo url_for('@atendimento_titular_ficha?id=' . $titular->getId())?>" method="post">
    <label for="data_admiss">Data de Adesão
    <?php echo html_entity_decode($adesao_data->render('data_admiss')) ?>
    </label>
    <br />
    <input type="submit" name="enviar" value="Gera Ficha de Adesão" />

  </form>
</div>
<hr />

</div>

<?php include_partial('rightCol') ?>
