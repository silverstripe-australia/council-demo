<?php
class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		//$fields->addFieldToTab('Root.Behaviour', new CheckboxField('ShowChildrenMenu', 'Show Children Menu'), 'ShowInSearch');
		return $fields;
	}
	
	
	public function LatestNews($limit = 5){
		$limit = (int)$limit;
		if($items = DataObject::get('NewsArticle', $filter='', 'Created Desc', $join='', $limit = "0,$limit")){
			return $items;
		}
	}
	
	public function LatestSurveys($limit = 5){
		$limit = (int)$limit;
		if($items = DataObject::get('SurveyPage', $filter='', 'Created Desc', $join='', $limit = "0,$limit")){
			return $items;
		}
	}

}
class Page_Controller extends ContentController {

	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		
		$theme = THEMES_DIR . '/' . SSViewer::current_theme();
		// combine css files - was not working on server so...
   //     	$CSSFiles = array(
   //     		$theme . '/css/reset.css',
   //     		$theme . '/css/grid.css',
   //     		$theme . '/css/iconic.css',
			// $theme . '/css/type.css',
   //     		$theme . '/css/style.css'
   //     	);  
   //     	Requirements::combine_files('csspacked.css', $CSSFiles); 

       	Requirements::css($theme . '/css/reset.css');
		Requirements::css($theme . '/css/grid.css');
		Requirements::css($theme . '/css/reset.css');
		Requirements::css($theme . '/css/iconic.css');
		Requirements::css($theme . '/css/type.css');
		Requirements::css($theme . '/css/style.css');

       
		
        
       //combine js files - also not working on server, so...
       // $JSFiles = array(
       // 	THIRDPARTY_DIR.'/jquery/jquery.js',
       //     $theme . '/js/script.js' 
       // );  	
       // Requirements::combine_files('jspacked.js', $JSFiles);

       Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js');
       Requirements::javascript($theme . '/js/script.js');

	}
	
	function PageTitle(){
		return $this->Title . ' | ' . $this->SiteConfig()->Title;
	}
}