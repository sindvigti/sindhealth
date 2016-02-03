    <div class="select-bar">
      <form action="<?php echo url_for('atendimento_titular_search')?>" method="get">
      <label>
        <input type="text" name="keyword">
      </label>
      <label><input type="radio" name="tipobusca" value="matricula" checked="checked"/> por Matrícula</label>
      <label><input type="radio" name="tipobusca" value="nome" /> por Nome</label>
      <label>
        <input type="submit" value="Busca" name="Submit">
      </label>
      </form>
    </div>
