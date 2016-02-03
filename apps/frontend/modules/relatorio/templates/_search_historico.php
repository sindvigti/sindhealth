    <div class="select-bar">
      <form action="<?php echo url_for('relatorio_encaminhamento')?>" method="get">
      <fieldset>
        <legend>Busca por Intervalo de Data</legend>
        <input type="submit" value="Busca" name="Submit">
      </fieldset>
      </form>
      <div class="data-nav">
        <ul>
          <li><a href="<?php echo url_for('@relatorio_encaminhamento_interval?start=' . strtotime('-1 month',strtotime($datesQueryFormated['start']))) ?>">-1 Mês</a></li> 
          <li><a href="<?php echo url_for('@relatorio_encaminhamento_interval?start=' . strtotime('-7 day',strtotime($datesQueryFormated['start']))) ?>">-1 Semana</a></li> 
        </ul>
        <ul>
          <li><a href="<?php echo url_for('@relatorio_encaminhamento_interval?start=' . strtotime('+7 day',strtotime($datesQueryFormated['start']))) ?>">+1 Semana</a></li> 
          <li><a href="<?php echo url_for('@relatorio_encaminhamento_interval?start=' . strtotime('+1 month',strtotime($datesQueryFormated['start']))) ?>">+1 Mês</a></li> 
        </ul>
      </div>
    </div>
