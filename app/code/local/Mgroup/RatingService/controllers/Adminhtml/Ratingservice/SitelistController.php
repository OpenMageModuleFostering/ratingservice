<?php

class Mgroup_RatingService_Adminhtml_Ratingservice_SitelistController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {

      Mage::getResourceModel('ratingservice/siteconnect')->truncate();
      $site_data = Mage::helper("ratingservice")->getListSite();

      foreach ($site_data as $site) {
         $siteObject = Mage::getModel("ratingservice/siteconnect");
         $siteObject->setSite($site);
         $siteObject->setCreatedTime(time());
         $siteObject->save();
      }

      $sites = Mage::getModel("ratingservice/siteconnect")->getCollection();

      $sitesArray = array();
      foreach ($sites as $siteObject) {
        $sitesArray[] = $siteObject->getId()."%-%".$siteObject->getSite();
      }
      echo implode($sitesArray,"%;%");
    }
}
