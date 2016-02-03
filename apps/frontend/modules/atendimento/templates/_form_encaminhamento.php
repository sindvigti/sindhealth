<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('@encaminhamento_'. strtolower($tipo) . '?id=' . $assoc->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('@atendimento_titular_show?id=' . ($tipo == "Titular" ? $assoc->getId() : $assoc->getTitularId())) ?>">Voltar</a>
          <input type="submit" value="Emitir" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['local']->renderLabel() ?></th>
        <td>
          <?php echo $form['local']->renderError() ?>
          <?php echo $form['local'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['gratuito']->renderLabel() ?></th>
        <td>
          <?php echo $form['gratuito']->renderError() ?>
          <?php echo $form['gratuito'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
