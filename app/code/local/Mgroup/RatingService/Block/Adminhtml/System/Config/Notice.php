<?php

class Mgroup_RatingService_Block_Adminhtml_System_Config_Notice extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{
    protected $_template = 'ratingservice/system/config/notice.phtml';

    public function render(Varien_Data_Form_Element_Abstract $fieldset)
    {
        return $this->toHtml();
    }

    public function getSiteUrl(){
      return Mage::helper("ratingservice")->getSiteUrl()."/";
    }
}
