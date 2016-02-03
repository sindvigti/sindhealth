<?php slot(
    'title',
    sprintf('%s - mat. %s - Sindhealth', $titular->getNome(), $titular->getMatricula())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Impressão de Etiqueta para <?php echo $titular->getNome() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
    <?php include_partial('search') ?>
  </div>

<div class="displayData">

<textarea rows="6" cols="60" id="txt_etiqueta" readonly="readonly">
SINDICATO DOS VIGILANTES DO RJ  -  CONVENIO(A-6570)
Titular: <?php echo $titular->getNome()?>

Beneficiario: <?php echo $titular->getNome()?>

Nascimento: <?php echo $titular->getDateTimeObject('data_nasc')->format('d/m/Y')?>

Inclusão:  <?php echo $titular->getDateTimeObject('created_at')->format('d/m/Y')?>         Validade: <?php echo $titular->getDateTimeObject('data_expira')->format('d/m/Y')?> 
Codigo: <?php echo $titular->getMatricula()?>          Sexo: <?php echo $titular->getSexo() ?> 
SEM COBERTURA PARA INTERNACAO E CIRURGIA 
ISENTO DE RECIBOS E CONTRA-CHEQUE

</textarea>
<input type="checkbox" id="todos" /> Imprime dependentes tambem?
</div>
<hr />
<a id="printButton" href="#">Imprimir</a>
<a href="<?php echo url_for('@atendimento_titular_show?id='.$titular->getId()) ?>">Cancelar</a>

</div>

<?php include_partial('rightCol') ?>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/DYMO.Label.Framework.js" type="text/javascript" charset="UTF-8"></script>
<script src="/js/main.js"></script>
