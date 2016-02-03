<?php

/**
 * titular actions.
 *
 * @package    sindhealth
 * @subpackage titular
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class titularActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->titulars = Doctrine_Core::getTable('Titular')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->titular);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TitularForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TitularForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('Object titular does not exist (%s).', $request->getParameter('id')));
    $this->form = new TitularForm($titular);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('Object titular does not exist (%s).', $request->getParameter('id')));
    $this->form = new TitularForm($titular);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($titular = Doctrine_Core::getTable('Titular')->find(array($request->getParameter('id'))), sprintf('Object titular does not exist (%s).', $request->getParameter('id')));
    $titular->delete();

    $this->redirect('titular/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $titular = $form->save();

      $this->redirect('titular/edit?id='.$titular->getId());
    }
  }
}
