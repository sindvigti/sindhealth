<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
      <?php include_slot('title', 'SindHealth - Controle de Plano de Saúde'); ?>
    </title>
    <link rel="icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
	 <div id="main">
	  <div id="header">
		  <a href="<?php echo url_for('homepage') ?>" class="logo"><img src="/images/logo.png"  alt="" /></a> 
		  <ul id="top-navigation">
			  <li <?php echo $sf_params->get('module') == 'atendimento' ? "class=\"active\"" : ""; ?>><span><span><?php echo $sf_params->get('module') != 'atendimento' ? "<a href=\"" . url_for('atendimento_titular') . "\">" : "" ?>Atendimento<?php echo $sf_params->get('module') != 'atendimento' ? "</a>" : "" ?></span></span></li>
			  <li <?php echo $sf_params->get('module') == 'relatorio' ? "class=\"active\"": ""; ?>><span><span><?php echo $sf_params->get('module') != 'relatorio' ? "<a href=\"" . url_for('relatorio_index') . "\">" : "" ?>Relatórios<?php echo $sf_params->get('module') != 'relatorio' ? "</a>" : "" ?></span></span></li>
		  </ul>
          <?php if($sf_user->isAuthenticated()) : ?>
            <div id="logout_container">
              <?php echo link_to('Sair', 'sf_guard_signout'); ?>
            </div>
          <?php endif; ?>
	  </div>
	  <div id="middle">
      <?php echo $sf_content ?>
	  </div>
	  <div id="footer">Felipe Kaled - 2012</div>
   </div>
  </body>
</html>
