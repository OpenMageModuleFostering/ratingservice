<?php
class Mgroup_RatingService_Model_Mysql4_Siteconnect extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("ratingservice/siteconnect", "id");
    }
    public function truncate() {
      $this->_getWriteAdapter()->query('TRUNCATE TABLE '.$this->getMainTable());
    return $this;
    }   
}
