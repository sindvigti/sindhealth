<?php include_partial('leftCol', array('links'=> $lstLinks)) ?>
<div id="center-column">
  <div class="top-bar">
    <h1>Titulares</h1>
    <div class="breadcrumbs">
      <a href="#">Homepage</a>
      /
      <a href="#">Contents</a>
    </div>
    <br>
    <?php include_partial('search') ?>
  </div>
  <div class="displayData">

    <form action="<?php echo url_for("@atendimento_titular_update_expira?titular=" . $titular->getId()) ?>" method="post">
    <input type="hidden" name="titular" value="<?php echo $titular->getId() ?>" />
      <label for="periodo">Escolha o período a renovar: </label>
      <select name="periodo">
        <?php foreach($periodos as $valor=>$periodo) : ?>
          <option value="<?php echo $valor ?>"><?php echo $periodo?></option>
        <?php endforeach; ?>
      </select>
      <br />
      <input type="checkbox" name="renewall" id="renewall" value="renewall" checked="checked"/> Renovar todos os dependentes
      <br />
      <table>
        <tr>
          <th>Renova?</th>
          <th>Nome</th>
          <th>Nascimento</th>
          <th>Parentesco</th>
        </tr>
        <?php foreach($titular->getDependentes() as $i=>$depend): ?>
        <tr>
          <td><input type="checkbox" name="renova[]" value="<?php echo $depend->getId()?>"/> </td>
          <td><?php echo $depend->getNome()?></td>
          <td><?php echo $depend->getNasc()?></td>
          <td><?php echo $depend->getParentesco()?></td>
        </tr>
        <?php endforeach;?>
      </table>
      <input type="submit" value="Renovar" />
    </form>
  </div>
</div>

<?php include_partial('rightCol') ?>
