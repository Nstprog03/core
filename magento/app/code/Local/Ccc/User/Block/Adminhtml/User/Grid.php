<?php
class Ccc_User_Block_Adminhtml_User_Grid Extends Mage_Adminhtml_Block_Widget_Grid {

	public function __construct() {
		parent::__construct();
	}

	protected function _getStoreId() {
		$storeId = (int) $this->getRequest()->getParam('store', 0);
		return $storeId;
	}

	protected function _prepareCollection() {
		$collection = Mage::getModel('user/user')->getCollection()
			->addAttributeToSelect('firstname')
			->addAttributeToSelect('lastname');
		$storeId = $this->_getStoreId();
		$collection->joinAttribute(
			'firstname',
			'user/firstname',
			'entity_id',
			null,
			'inner',
			$storeId
		);
		$collection->joinAttribute(
			'lastname',
			'user/lastname',
			'entity_id',
			null,
			'inner',
			$storeId
		);
		$collection->joinAttribute(
			'id',
			'user/entity_id',
			'entity_id',
			null,
			'inner',
			$storeId
		);
		$collection->joinAttribute(
			'email',
			'user/email',
			'entity_id',
			null,
			'inner',
			$storeId
		);
		$collection->joinAttribute(
			'mobile',
			'user/mobile',
			'entity_id',
			null,
			'inner',
			$storeId
		);

		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this->addColumn('id',
			[
				'header' => Mage::helper('user')->__('Id'),
				'width' => '50px',
				'index' => 'id',
			]
		);
		$this->addColumn('firstname',
			[
				'header' => Mage::helper('user')->__('First Name'),
				'width' => '50px',
				'index' => 'firstname',
			]
		);
		$this->addColumn('lastname',
			[
				'header' => Mage::helper('user')->__('Last Name'),
				'width' => '50px',
				'index' => 'lastname',
			]
		);
		$this->addColumn('email',
			[
				'header' => Mage::helper('user')->__('Email'),
				'width' => '50px',
				'index' => 'email',
			]
		);
		$this->addColumn('mobile',
			[
				'header' => Mage::helper('user')->__('Mobile'),
				'width' => '50px',
				'index' => 'mobile',
			]
		);

		return parent::_prepareColumns();

	}

	public function getGridUrl() {
		return $this->getUrl('*/*/index', array('_current' => true));
	}

	public function getRowUrl($row) {
		return $this->getUrl('*/*/edit', array(
			'store' => $this->getRequest()->getParam('store'),
			'id' => $row->getId())
		);
	}

}