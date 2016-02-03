<?php slot(
    'title',
    sprintf('%s - mat. %s - Sindhealth', $titular->getNome(), $titular->getMatricula())
    )
?>
<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1><?php echo $titular->getNome() ?></h1>
    <?php include_partial('breadcrumbs', array('crumbs'=>$breadcrumbs)) ?>
    <br>
    <?php include_partial('search') ?>
  </div>
<div class="displayData">
  <h3>Matricula: <?php echo $titular->getMatricula() ?></h3>

  <p>Validade: <?php echo $titular->getDateTimeObject('data_expira')->format('d/m/Y') ?></p>
  <p>Sexo: 
  <?php 
switch($titular->getSexo())
{
  case 'M':
    echo 'Masculino';
    break;
  case 'F':
    echo 'Feminino';
    break;
  default:
    echo 'Sem sexo';
    break;
}
?>
  </p>
  <p>Estado civil: <?php echo $titular->getEstadoCivil() ?></p>

  <?php if(count($titular->getDependentes()) > 0) : ?>
  <div id="dependentes">
    <h4>Dependentes</h4>
      <table>
      <tr>
        <th>Nome</th>
        <th>Parentesco</th>
        <th>Idade</th>
      </tr>

    <?php foreach ($titular->getDependentes() as $dependente): ?>
        <tr <?php if($dependente->getIdade() > 18 && $dependente->getParentesco() == `filho`) echo 'class="dep_menor"'?>>
          <td><?php echo $dependente->getNome() ?></td>
          <td><?php echo $dependente->getParentesco() ?></td>
          <td><?php echo $dependente->getIdade() ?></td>
          <td><?php echo link_to('Editar', '@atendimento_edit_dependente?id='. $dependente->getId(), array('class' => 'link')) ?></td>
          <td><?php echo link_to('Excluir', '@atendimento_delete_dependente?id='. $dependente->getId(), array('method' => 'delete', 'confirm' => 'Tem certeza?', 'class' => 'link' )) ?></td>
          <td><?php echo link_to('Etiqueta', '@atendimento_etiqueta_dependente_confirma?id='. $dependente->getId(), array('class' => 'link')) ?></td>
          <td><?php echo link_to('Encaminha', '@encaminhamento_prep?id=' . $dependente->getId(). "&tipo=d", array('class' => 'link')) ?></td>

        </tr>
    <?php endforeach; ?>
    </table>
  </div>
  <?php endif; ?>
  <?php if(isset($encaminhamentos) && $encaminhamentos->count() > 0) : ?>
  <div id="encaminhamentos">
    <h4>Encaminhamentos</h4>
    <ul>
    <?php foreach($encaminhamentos as $encaminhamento) : ?>
      <li>Emitido para: <a href="<?php echo url_for("@encaminhamento_show?id=" . $encaminhamento->getId()) ?>"><?php echo $encaminhamento->getAssociado()->getNome() ?></a> em <?php echo $encaminhamento->getDateTimeObject('inicio_validade')->format('d/m/Y') ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

</div>

<hr />

<a class="bottom link" href="<?php echo url_for('@atendimento_titular_edit?id='.$titular->getId()) ?>">Editar</a>
<a class="bottom link" href="<?php echo url_for('@atendimento_dependente_novo?titular=' . $titular->getId()) ?>">Novo Dependente</a>
<a class="bottom link" href="<?php echo url_for('@atendimento_titular_imprime_etiqueta?id=' . $titular->getId()) ?>">Emitir Etiqueta</a>
<a class="bottom link" href="<?php echo url_for('@atendimento_titular_prep_ficha?id=' . $titular->getId()) ?>">Ficha de Adesão</a>
<a class="bottom link" href="<?php echo url_for('@atendimento_titular_prep_ficha?id=' . $titular->getId()) ?>">Renovar Adesão</a>
<!--
<a class="bottom link" href="<?php echo url_for('@encaminhamento_prep?id=' . $titular->getId(). "&tipo=t" ) ?>">Encaminhamento Dentário</a>
!>
</div>

<?php include_partial('rightCol') ?>
