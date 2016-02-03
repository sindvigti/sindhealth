<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
       Periodo de 
        <?php echo date('d/m/Y', strtotime($datesQueryFormated['start'])) ?> a
        <?php echo date('d/m/Y',strtotime($datesQueryFormated['end'])) ?> - 
SindHealth - Relatorio de Encaminhamentos </title>
    <link rel="icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/reset.css" />
<link rel="stylesheet" type="text/css" media="print,screen" href="/css/relatorio.css" />
<link rel="stylesheet" type="text/css" media="print" href="/css/relatorio-print.css" />
<body>
<div id="back">
<a href="<?php echo url_for('@relatorio_encaminhamento_interval?start=' . strtotime($datesQueryFormated['start']) . '&end=' .  strtotime($datesQueryFormated['end'])) ?>">Voltar para relatório</a> 
</div>
<div id="main">
    <h1>Encaminhamentos do Período de 
        <?php echo date('d/m/Y', strtotime($datesQueryFormated['start'])) ?> a
        <?php echo date('d/m/Y',strtotime($datesQueryFormated['end'])) ?>
    </h1>
    <h2>Listagem de Todos os Encaminhamentos do Período</h2>
  <div class="table">
    <table class="listing" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="first">Data</th>
          <th>Titular</th>
          <th>Descrição</th>
          <th class="last">Usuário</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($encaminhamentos as $i=>$encaminhamento): ?>
        <tr<?php echo( ($i % 2 < 1) ? " class=\"bg\"": "") ?>>
          <td><?php echo $encaminhamento->getDateTimeObject('created_at')->format('d/m/Y H:i:s') ?></td>
          <td><?php echo $encaminhamento->getTitular()->getNome() ?></td>
          <td><?php echo $encaminhamento->getDescricao() ?></td>
          <td><?php echo $encaminhamento->getSfGuardUser()->getUsername() ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h2>Total de Encaminhamentos no Periodo: <?php echo $total_periodo ?> </h2>
  </div>
  
</div>
</body>
</html>


