<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $titular->getId() ?></td>
    </tr>
    <tr>
      <th>Nome:</th>
      <td><?php echo $titular->getNome() ?></td>
    </tr>
    <tr>
      <th>Ende logra:</th>
      <td><?php echo $titular->getEndeLogra() ?></td>
    </tr>
    <tr>
      <th>Ende numero:</th>
      <td><?php echo $titular->getEndeNumero() ?></td>
    </tr>
    <tr>
      <th>Ende compl:</th>
      <td><?php echo $titular->getEndeCompl() ?></td>
    </tr>
    <tr>
      <th>Ende bairro:</th>
      <td><?php echo $titular->getEndeBairro() ?></td>
    </tr>
    <tr>
      <th>Ende cidade:</th>
      <td><?php echo $titular->getEndeCidade() ?></td>
    </tr>
    <tr>
      <th>Matricula:</th>
      <td><?php echo $titular->getMatricula() ?></td>
    </tr>
    <tr>
      <th>Data expira:</th>
      <td><?php echo $titular->getDataExpira() ?></td>
    </tr>
    <tr>
      <th>Estado civil:</th>
      <td><?php echo $titular->getEstadoCivil() ?></td>
    </tr>
    <tr>
      <th>Empresa:</th>
      <td><?php echo $titular->getEmpresa() ?></td>
    </tr>
    <tr>
      <th>Cargo:</th>
      <td><?php echo $titular->getCargo() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $titular->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $titular->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('titular/edit?id='.$titular->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('titular/index') ?>">List</a>
