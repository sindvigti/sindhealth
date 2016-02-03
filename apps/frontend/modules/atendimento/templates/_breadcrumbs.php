    <div class="breadcrumbs">
      <?php foreach($crumbs as $url=>$crumb) : ?>
        <?php $href = ($url == "#"?$url:url_for($url)) ?>
        /<a href="<?php echo $href?>"><?php echo $crumb ?></a>
      <?php endforeach; ?>
    </div>

