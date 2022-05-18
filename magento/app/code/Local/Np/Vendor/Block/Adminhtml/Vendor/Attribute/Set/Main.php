<?php
class Np_Vendor_Block_Adminhtml_Vendor_Attribute_Set_Main extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Set_Main {

	public function getMoveUrl() {
		return $this->getUrl('*/adminhtml_vendor_set/save', array('id' => $this->_getSetId()));
	}

	public function getGroupTreeJson() {
		$items = array();
		$setId = $this->_getSetId();

		/* @var $groups Mage_Eav_Model_Mysql4_Entity_Attribute_Group_Collection */
		$groups = Mage::getModel('eav/entity_attribute_group')
			->getResourceCollection()
			->setAttributeSetFilter($setId)
			->setSortOrder()
			->load();

		$configurable = Mage::getResourceModel('catalog/product_type_configurable_attribute')
			->getUsedAttributes($setId);

		/* @var $node Mage_Eav_Model_Entity_Attribute_Group */
		foreach ($groups as $node) {
			$item = array();
			$item['text'] = $node->getAttributeGroupName();
			$item['id'] = $node->getAttributeGroupId();
			$item['cls'] = 'folder';
			$item['allowDrop'] = true;
			$item['allowDrag'] = true;

			$nodeChildren = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter(Mage::getModel('eav/entity')->setType(Np_Vendor_Model_Resource_Vendor::ENTITY)->getTypeId())
				->setAttributeGroupFilter($node->getId())
				->load();

			if ($nodeChildren->getSize() > 0) {
				$item['children'] = array();
				foreach ($nodeChildren->getItems() as $child) {
					/* @var $child Mage_Eav_Model_Entity_Attribute */
					$attr = array(
						'text' => $child->getAttributeCode(),
						'id' => $child->getAttributeId(),
						'cls' => (!$child->getIsVendorDefined()) ? 'system-leaf' : 'leaf',
						'allowDrop' => false,
						'allowDrag' => true,
						'leaf' => true,
						'is_vendor_defined' => $child->getIsVendorDefined(),
						'is_configurable' => (int) in_array($child->getAttributeId(), $configurable),
						'entity_id' => $child->getEntityAttributeId(),
					);

					$item['children'][] = $attr;
				}
			}

			$items[] = $item;
		}

		return Mage::helper('core')->jsonEncode($items);
	}

	public function getAttributeTreeJson() {
		$items = array();
		$setId = $this->_getSetId();

		$collection = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter(Mage::getModel('eav/entity')->setType(Np_Vendor_Model_Resource_Vendor::ENTITY)->getTypeId())
			->setAttributeSetFilter($setId)
			->load();

		$attributesIds = array('0');
		/* @var $item Mage_Eav_Model_Entity_Attribute */
		foreach ($collection->getItems() as $item) {
			$attributesIds[] = $item->getAttributeId();
		}

		$attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter(Mage::getModel('eav/entity')->setType(Np_Vendor_Model_Resource_Vendor::ENTITY)->getTypeId())
			->setAttributesExcludeFilter($attributesIds)
		// ->addVisibleFilter();
			->load();

		foreach ($attributes as $child) {
			$attr = array(
				'text' => $child->getAttributeCode(),
				'id' => $child->getAttributeId(),
				'cls' => 'leaf',
				'allowDrop' => false,
				'allowDrag' => true,
				'leaf' => true,
				'is_vendor_defined' => $child->getIsVendorDefined(),
				'is_configurable' => false,
				'entity_id' => $child->getEntityId(),
			);

			$items[] = $attr;
		}

		if (count($items) == 0) {
			$items[] = array(
				'text' => Mage::helper('catalog')->__('Empty'),
				'id' => 'empty',
				'cls' => 'folder',
				'allowDrop' => false,
				'allowDrag' => false,
			);
		}

		return Mage::helper('core')->jsonEncode($items);
	}

}