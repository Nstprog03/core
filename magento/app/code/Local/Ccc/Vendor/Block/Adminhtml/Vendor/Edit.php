<?php 
// class Ccc_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
// {
// 	// public function __construct()
// 	// {
// 	// 	echo "111";
// 	// 	exit;
// 	// 	// $this->_blockGroup = 'vendor';
// 	// 	// $this->_controller = 'adminhtml_vendor_index';
//  //  //       $this->_headerText = Mage::helper('vendor')->__('Manage Vendor');
//  //  //       $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Vendor');
//  //  //       parent::__construct();
// 	// 	// parent::__construct();
// 	// 	// $this->setTemplate("vendor/vendor/index.phtml");
// 	// }

// 	// public function __construct()
//  //    {
//  //        $this->_objectId = 'id';
//  //        $this->_controller = 'adminhtml_vendor_index';

//  //        parent::__construct();
//  //    }

//  //    public function getHeaderText()
//  //    {
//  //        $vendor = Mage::registry('vendor_data');
//  //        if ($vendor->getVendorId()) 
//  //        {
//  //            return Mage::helper('vendor')->__("Edit Rule '%s'", $this->escapeHtml($vendor->getName()));
//  //        }
//  //        else 
//  //        {
//  //            return Mage::helper('vendor')->__('New vendor');
//  //        }
// 	// }

// 	public function __construct()
//     {
//         $this->_objectId = 'id';
//         $this->_controller = 'adminhtml_vendor_index';

        

//         parent::__construct();

//         $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save Vendor'));
//         $this->_updateButton('delete', 'label', Mage::helper('vendor')->__('Delete Vendor'));

//     }

//     public function getVendorId()
//     {
//         return Mage::registry('vendor_data')->getId();
//     }

//     public function getHeaderText()
//     {
//         if (Mage::registry('vendor_data')->getId()) {
//             return $this->escapeHtml(Mage::registry('vendor_data')->getName());
//         }
//         else {
//             return Mage::helper('vendor')->__('New Vendor');
//         }
//     }

//     /**
//      * Prepare form html. Add block for configurable product modification interface
//      *
//      * @return string
//      */
//     public function getFormHtml()
//     {
//         $html = parent::getFormHtml();
//         $html .= $this->getLayout()->createBlock('adminhtml/catalog_product_composite_configure')->toHtml();
//         return $html;
//     }

//     public function getValidationUrl()
//     {
//         return $this->getUrl('*/*/validate', array('_current'=>true));
//     }

//     protected function _prepareLayout()
//     {

//         return parent::_prepareLayout();
//     }

//     protected function _getSaveAndContinueUrl()
//     {
//         return $this->getUrl('*/*/save', array(
//             '_current'  => true,
//             'back'      => 'edit',
//             'tab'       => '{{tab_id}}'
//         ));
//     }
// }

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    
    public function __construct()
    {
        // parent::__construct();
        // $this->_objectId = 'id';
        // $this->_controller = 'adminhtml_vendor_index';


        // $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save Vendor'));
        // $this->_updateButton('delete', 'label', Mage::helper('vendor')->__('Delete Vendor'));
  //       $this->loadLayout();
  //       $this->getLayout()->getBlock('content')->append(
		// 	$this->getLayout()->createBlock("vendor/adminhtml_vendor_edit_form")
		// );
		// $this->renderLayout();

        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'vendor';
        $this->_controller = 'adminhtml_vendor_index';

        $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('vendor')->__('Delete Item'));

    }

    public function getHeaderText()
    {
        if (Mage::registry('vendor_data')->getId()) {
            return Mage::helper('vendor')->__('Edit Vendor');
        }
        else 
        {
            return Mage::helper('vendor')->__('New Vendor');
        }
    }
}
