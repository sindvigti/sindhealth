<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('titular/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('titular/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'titular/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['matricula']->renderLabel() ?></th>
        <td>
          <?php echo $form['matricula']->renderError() ?>
          <?php echo $form['matricula'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nome']->renderLabel() ?></th>
        <td>
          <?php echo $form['nome']->renderError() ?>
          <?php echo $form['nome'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ende_logra']->renderLabel() ?></th>
        <td>
          <?php echo $form['ende_logra']->renderError() ?>
          <?php echo $form['ende_logra'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ende_numero']->renderLabel() ?></th>
        <td>
          <?php echo $form['ende_numero']->renderError() ?>
          <?php echo $form['ende_numero'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ende_compl']->renderLabel() ?></th>
        <td>
          <?php echo $form['ende_compl']->renderError() ?>
          <?php echo $form['ende_compl'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ende_bairro']->renderLabel() ?></th>
        <td>
          <?php echo $form['ende_bairro']->renderError() ?>
          <?php echo $form['ende_bairro'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ende_cidade']->renderLabel() ?></th>
        <td>
          <?php echo $form['ende_cidade']->renderError() ?>
          <?php echo $form['ende_cidade'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['estado_civil']->renderLabel() ?></th>
        <td>
          <?php echo $form['estado_civil']->renderError() ?>
          <?php echo $form['estado_civil'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['data_nasc']->renderLabel() ?></th>
        <td>
          <?php echo $form['data_nasc']->renderError() ?>
          <?php echo $form['data_nasc'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['empresa']->renderLabel() ?></th>
        <td>
          <?php echo $form['empresa']->renderError() ?>
          <?php echo $form['empresa'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['cargo']->renderLabel() ?></th>
        <td>
          <?php echo $form['cargo']->renderError() ?>
          <?php echo $form['cargo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
