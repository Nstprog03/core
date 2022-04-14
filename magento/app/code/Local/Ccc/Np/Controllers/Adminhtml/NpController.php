<?php

class Ccc_Np_Adminhtml_NpController extends Mage_Adminhtml_Controller_Action
 {

protected function _initAction()
 {
 $this->loadLayout()
 ->_setActiveMenu('np/np')
 ->_addBreadcrumb(Mage::helper('adminhtml')->__('Data Manager'), Mage::helper('adminhtml')->__('Data Manager'));
 return $this;
 }

public function indexAction() {
 $this->_initAction();
 $this->_addContent($this->getLayout()->createBlock('np/adminhtml_np'));
 $this->renderLayout();
 }

public function editAction()
 {
 $npId = $this->getRequest()->getParam('id');

$npModel = Mage::getModel('np/np')->load($npId);

if ($npModel->getId() || $npId == 0) {

Mage::register('np_data', $npModel);

$this->loadLayout();
 $this->_setActiveMenu('np/np');

$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Student Information'), Mage::helper('adminhtml')->__('Studenet Information'));
 $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Data News'), Mage::helper('adminhtml')->__('Data News'));

$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

$this->_addContent($this->getLayout()->createBlock('np/adminhtml_np_edit'))
 ->_addLeft($this->getLayout()->createBlock('np/adminhtml_np_edit_tabs'));

$this->renderLayout();
 } else {
 Mage::getSingleton('adminhtml/session')->addError(Mage::helper('np')->__('Item does not exist'));
 $this->_redirect('*/*/');
 }
 }

public function newAction()
 {
 $this->_forward('edit');
 }

public function saveAction()
 {
 if ( $this->getRequest()->getPost() ) {
 try {
 $postData = $this->getRequest()->getPost();
 $npModel = Mage::getModel('np/np');

$npModel->setId($this->getRequest()->getParam('id'))
 ->setStdname($postData['stdname'])
 ->setEmail($postData['email'])
 ->setRollno($postData['rollno'])
 ->setStatus($postData['status'])
 ->save();

Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully saved'));
 Mage::getSingleton('adminhtml/session')->setProData(false);

$this->_redirect('*/*/');
 return;
 } catch (Exception $e) {
 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 Mage::getSingleton('adminhtml/session')->setProData($this->getRequest()->getPost());
 $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
 return;
 }
 }
 $this->_redirect('*/*/');
 }

public function deleteAction()
 {
 if( $this->getRequest()->getParam('id') > 0 ) {
 try {
 $npModel = Mage::getModel('np/np');

$npModel->setId($this->getRequest()->getParam('id'))
 ->delete();

Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully deleted'));
 $this->_redirect('*/*/');
 } catch (Exception $e) {
 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
 }
 }
 $this->_redirect('*/*/');
 }
 /**
 * Product grid for AJAX request.
 * Sort and filter result for example.
 */
 public function gridAction()
 {
 $this->loadLayout();
 $this->getResponse()->setBody(
 $this->getLayout()->createBlock('np/adminhtml_np_grid')->toHtml()
 );
 }
 }