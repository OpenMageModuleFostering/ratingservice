<?php
class Mgroup_RatingService_Model_Observer
{

    public function ratingProcess()
    {

        $company_id = Mage::getStoreConfig('rating_service/general/company_id', Mage::app()->getStore());
        $site_data = Mage::helper("ratingservice")->getListSite();
        $companyUrl = $site_data[Mage::getStoreConfig('rating_service/general/site_connect', Mage::app()->getStore())];
        Mage::register('company_url', $companyUrl);

        $companyExists = false;
        if($company_id != ""){
            $companyExists = Mage::helper("ratingservice")->checkCompanyExists($company_id);
        }

        Mage::getConfig()->saveConfig('rating_service/general/site_url',$companyUrl);

        if($companyExists == true && Mage::getStoreConfig('rating_service/general/company_active', Mage::app()->getStore()) == 0){
            Mage::getConfig()->saveConfig('rating_service/general/company_active', 1);

            $senderName = Mage::getStoreConfig('trans_email/ident_general/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');
            $company_id = Mage::getStoreConfig('rating_service/general/company_id', Mage::app()->getStore());

            $mail = Mage::getModel('core/email')
             ->setToName($senderName)
             ->setToEmail($senderEmail)
             ->setBody("_Company <b>".$company_id ."</b> has been activated!")
             ->setSubject('Rating Service: '.$company_id ." has been activated!")
             ->setFromEmail($senderEmail)
             ->setFromName($senderName)
             ->setType('html');
             try{
               $mail->send();
             }
             catch(Exception $error){
               Mage::getSingleton('core/session')->addError($error->getMessage());
             }

        }elseif($companyExists != true){
            Mage::getConfig()->saveConfig('rating_service/general/company_active', 0);
        }
        Mage::unregister('company_url');

    }
}
