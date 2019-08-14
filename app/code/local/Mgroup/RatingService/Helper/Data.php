<?php
class Mgroup_RatingService_Helper_Data extends Mage_Core_Helper_Abstract
{

		public function getListSite(){
			$json = file_get_contents('http://www.kundtjanster.com/available_sites');
			$site_data = json_decode($json,true);
			return $site_data;
		}

		public function getSiteUrl(){

			$siteUrl = Mage::getStoreConfig('rating_service/general/site_url', Mage::app()->getStore());
			if(substr($siteUrl, -1)=="/"){
				$siteUrl = substr($siteUrl, 0, -1);
			}
			return $siteUrl;
		}

		public function checkCompanyExists($company_id){
			$company_data = $this->getCompanyData($company_id);
			if($company_data["company_exist"] == 1){
				return true;
			}else{
				return false;
			}
		}

		public function getCompanyData($company_id){
			if($company_id != ""){

				$siteUrl = Mage::helper("ratingservice")->getSiteUrl();

				if(Mage::registry('company_url')!=""){
					$siteUrl = Mage::registry('company_url');

				}

				$validateCompanyURL = $siteUrl."/company_exists/".$company_id;

				$json = file_get_contents($validateCompanyURL);
				$company_data = json_decode($json,true);
				if($company_data == ""){
					Mage::getSingleton('core/session')->addError("Can't access to the API, please try again.");
				}
				return $company_data;
			}else{
				return "";
			}
		}
}
