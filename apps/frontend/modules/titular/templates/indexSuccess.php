<div id="left-column">
  <h3>Menu</h3>
  <ul class="nav">
    <a class="link" href="#">Link here</a>
    <a class="link" href="#">Link here</a>
  </ul>
</div>
<div id="center-column">
  <div class="top-bar">
    <h1>Início</h1>
    <div class="breadcrumbs">
      <a href="#">Homepage</a>
      /
      <a href="#">Contents</a>
    </div>
    <br>
    <div class="select-bar">
      <label>
        <input type="text" name="textfield">
      </label>
      <label>
        <input type="submit" value="Busca" name="Submit">
      </label>
    </div>
  </div>
  <div class="table">
    <img class="left" width="8" height="7" alt="" src="img/bg-th-left.gif">
    <img class="right" width="7" height="7" alt="" src="img/bg-th-right.gif">
    <table class="listing" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="first">Id</th>
          <th>Nome</th>
          <th>Ende logra</th>
          <th>Ende numero</th>
          <th>Ende compl</th>
          <th>Ende bairro</th>
          <th>Ende cidade</th>
          <th>Matricula</th>
          <th>Data expira</th>
          <th>Estado civil</th>
          <th>Empresa</th>
          <th>Cargo</th>
          <th>Created at</th>
          <th class="last">Updated at</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($titulars as $i=>$titular): ?>
        <tr<?php echo( ($i % 2 < 1) ? "class=\"bg\"": "") ?>>
          <td><a href="<?php echo url_for('titular/show?id='.$titular->getId()) ?>"><?php echo $titular->getId() ?></a></td>
          <td><?php echo $titular->getNome() ?></td>
          <td><?php echo $titular->getEndeLogra() ?></td>
          <td><?php echo $titular->getEndeNumero() ?></td>
          <td><?php echo $titular->getEndeCompl() ?></td>
          <td><?php echo $titular->getEndeBairro() ?></td>
          <td><?php echo $titular->getEndeCidade() ?></td>
          <td><?php echo $titular->getMatricula() ?></td>
          <td><?php echo $titular->getDataExpira() ?></td>
          <td><?php echo $titular->getEstadoCivil() ?></td>
          <td><?php echo $titular->getEmpresa() ?></td>
          <td><?php echo $titular->getCargo() ?></td>
          <td><?php echo $titular->getCreatedAt() ?></td>
          <td><?php echo $titular->getUpdatedAt() ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

    <a href="<?php echo url_for('titular/new') ?>">New</a>
</div>
<div id="right-column"></div>
