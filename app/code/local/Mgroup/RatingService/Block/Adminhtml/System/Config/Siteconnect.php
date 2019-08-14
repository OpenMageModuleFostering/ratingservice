<?php
class Mgroup_RatingService_Block_Adminhtml_System_Config_Siteconnect extends Mage_Adminhtml_Block_System_Config_Form_Field{
    const CONFIG_PATH = 'rating_service/general/site_connect';
    const AVAILABLE_SITES_URL = 'http://www.kundtjanster.com/available_sites';

    protected $_values = null;
    protected function _construct()
    {
        if(count($this->getSiteConnect()) == 0){
            $json = file_get_contents(self::AVAILABLE_SITES_URL);
            $site_data = json_decode($json,true);

            foreach ($site_data as $site) {
               $siteObject = Mage::getModel("ratingservice/siteconnect");
               $siteObject->setSite($site);
               $siteObject->setCreatedTime(time());
               $siteObject->save();
            }
        }

        $this->setTemplate('ratingservice/system/config/siteconnect.phtml');
        return parent::_construct();
    }
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setNamePrefix($element->getName())
            ->setHtmlId($element->getHtmlId());
        return $this->_toHtml();
    }


    public function getSiteConnect(){

      $sites = Mage::getModel("ratingservice/siteconnect")->getCollection();
      return $sites;

    }

    public function getSelectedValue(){

      $data = $this->getConfigData();
      return $data[self::CONFIG_PATH];

    }

    public function getAjaxSiteListUrl(){
       return Mage::helper('adminhtml')->getUrl('adminhtml/ratingservice_sitelist/index');
   }

}
