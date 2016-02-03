<div id="left-column">
  <h3>Opções</h3>
  <ul class="nav">
  <?php foreach($links as $route=>$content): ?>
    <?php if(strpos($route,'delete') !== false): ?>
      <li><?php echo link_to($content, $route, array('method' => 'delete', 'confirm' => 'Tem certeza que deseja apagar?')) ?> </li>
    <?php else : ?>
      <li><a href="<?php echo url_for($route) ?>"><?php echo $content ?></a></li>
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
</div>
