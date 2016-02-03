<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@atendimento_'.($form->getObject()->isNew() ? 'create_dependente' : 'update_dependente').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('@atendimento_titular_show?id=' . $form->getObject()->getTitularId()) ?>">Volta pra Titular</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'atendimento/titular/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['nome']->renderLabel() ?></th>
        <td>
          <?php echo $form['nome']->renderError() ?>
          <?php echo $form['nome'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['parentesco']->renderLabel() ?></th>
        <td>
          <?php echo $form['parentesco']->renderError() ?>
          <?php echo $form['parentesco'] ?>
        </td>
      </tr>
      <tr>
      <tr>
        <th><?php echo $form['sexo']->renderLabel() ?></th>
        <td>
          <?php echo $form['sexo']->renderError() ?>
          <?php echo $form['sexo'] ?>
        </td>
      </tr>
        <th><?php echo $form['nasc']->renderLabel() ?></th>
        <td>
          <?php echo $form['nasc']->renderError() ?>
          <?php echo $form['nasc'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
