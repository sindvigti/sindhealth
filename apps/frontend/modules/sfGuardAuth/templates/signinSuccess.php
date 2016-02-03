<?php use_helper('I18N') ?>

<div id="signInContainer">
<h1><?php echo __('Acesso ao Sindhealth', null, 'sf_guard') ?></h1>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
</div>
