<?php slot(
    'title',
    sprintf('%s - Dependente. %s - Sindhealth', $depend->getTitular()->getNome(), $depend->getNome())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Impressão de Etiqueta para <?php echo $depend->getNome() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
    <?php include_partial('search') ?>
  </div>

<div class="displayData">

<textarea rows="6" cols="50" id="txt_etiqueta" readonly="readonly">
Sindicato dos Vigilantes do RJ  -  Convenio(A-6570)
Beneficiario: <?php echo $depend->getNome()?>

Titular: <?php echo $depend->getTitular()->getNome()?>

Nascimento: <?php echo $depend->getDateTimeObject('nasc')->format('d/m/Y')?>    Tipo: Dependente
Inclusão:  <?php echo $depend->getDateTimeObject('created_at')->format('d/m/Y')?>         Validade: <?php echo $depend->getDateTimeObject('data_expira')->format('d/m/Y')?> 
Codigo: <?php echo $depend->getTitular()->getMatricula()?>        Sexo: <?php echo $depend->getSexo() ?> 
SEM COBERTURA PARA INTERNACAO E CIRURGIA 
ISENTO DE RECIBOS E CONTRA-CHEQUE
</textarea>

</div>
<hr />
<a id="printButton" href="#">Imprimir</a>
<a href="<?php echo url_for('@atendimento_titular_show?id='.$depend->getTitularId()) ?>">Cancelar</a>

</div>

<?php include_partial('rightCol') ?>

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/DYMO.Label.Framework.js" type="text/javascript" charset="UTF-8"></script>
<script src="/js/main.js"></script>
