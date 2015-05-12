<?php
 
 class UniteBaseAdminClassBiz extends UniteBaseClassBiz{
 	
		const ACTION_ADMIN_MENU = "admin_menu";
		const ACTION_ADMIN_INIT = "admin_init";	
		const ACTION_ADD_SCRIPTS = "admin_enqueue_scripts";
		const ACTION_ADD_METABOXES = "add_meta_boxes";
		const ACTION_SAVE_POST = "save_post";
		
		protected static $master_view;
		protected static $view;
		
		private static $arrSettings = array();
		private static $arrMenuPages = array();
		private static $arrSubMenuPages = array();	
		private static $tempVars = array();
		private static $startupError = "";
		private static $arrMetaBoxes = "";		//option boxes that will be added to post
		
		
		/**
		 * 
		 * main constructor		 
		 */
		public function __construct($mainFile,$t,$defaultView){
						
			parent::__construct($mainFile,$t);
			
			$this->initView($defaultView);
			
			//add internal hook for adding a menu in arrMenus
			self::addAction(self::ACTION_ADMIN_MENU, "addAdminMenu");
			self::addAction(self::ACTION_ADD_METABOXES, "onAddMetaboxes");
			self::addAction(self::ACTION_SAVE_POST, "onSavePost");
			
			//if not inside plugin don't continue
			if($this->isInsidePlugin() == true){
				self::addAction(self::ACTION_ADD_SCRIPTS, "addCommonScripts");
				self::addAction(self::ACTION_ADD_SCRIPTS, "onAddScripts");
			}else{
				self::addAction(self::ACTION_ADD_SCRIPTS, "addOutsideScripts");
			}
			
			//a must event for any admin. call onActivate function.
			$this->addEvent_onActivate();
			//self::addActionAjax("show_image", "onShowImage");
		}		
		
		
		/**
		 * 
		 * add some meta box
		 * return metabox handle
		 */
		public static function addMetaBox($title,$content = null, $customDrawFunction = null,$location="post"){
			
			$box = array();
			$box["title"] = $title;
			$box["location"] = $location;
			$box["content"] = $content;
			$box["draw_function"] = $customDrawFunction;
			
			self::$arrMetaBoxes[] = $box;			
		}
		
		
		/**
		 * 
		 * on add metaboxes
		 */
		public static function onAddMetaboxes(){
			
			foreach(self::$arrMetaBoxes as $index=>$box){
				
				$title = $box["title"];
				$location = $box["location"];
				
				$boxID = "mymetabox_".self::$dir_plugin.'_'.$index;
				$function = array(self::$t, "onAddMetaBoxContent");
				
				if(is_array($location)){
					foreach($location as $loc)
						add_meta_box($boxID,$title,$function,$loc,'normal','default');
				}else
			    	add_meta_box($boxID,$title,$function,$location,'normal','default');
			}
		}
		
		
		/**
		 * 
		 * on save post meta. Update metaboxes data from post, add it to the post meta 
		 */
		public static function onSavePost(){
			
			//protection against autosave
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
				$postID = UniteFunctionsBiz::getPostVariable("ID");
	        	return $postID;
			}
			
			$postID = UniteFunctionsBiz::getPostVariable("ID");
			if(empty($postID))
				return(false);
				
				
			foreach(self::$arrMetaBoxes as $box){
				$content = UniteFunctionsBiz::getVal($box, "content");
				if(gettype($content) != "object")
					continue;
					
				$arrSettingNames = $content->getArrSettingNames();
				foreach($arrSettingNames as $name){
					$value = UniteFunctionsBiz::getPostVariable($name);
					update_post_meta( $postID, $name, $value );
				}	//end foreach settings

			} //end foreach meta
			
		}
		
		
		
		/**
		 * 
		 * on add metabox content
		 */
		public static function onAddMetaBoxContent($post,$boxData){
			
			$postID = $post->ID;
			
			$boxID = UniteFunctionsBiz::getVal($boxData, "id");
			$index = str_replace("mymetabox_".self::$dir_plugin.'_',"",$boxID);
			
			$arrMetabox = self::$arrMetaBoxes[$index];
			
			$content = UniteFunctionsBiz::getVal($arrMetabox, "content");
			
			$contentType = getType($content);
			switch ($contentType){
				case "string":
					echo $content;
				break;
				default:		//settings object					
					$output = new UniteSettingsProductSidebarBiz();
					$output->setDefaultInputClass(UniteSettingsProductSidebarBiz::INPUT_CLASS_LONG);					
					$content->updateValuesFromPostMeta($postID);										
					$output->init($content);

					//draw element
					$drawFunction = UniteFunctionsBiz::getVal($arrMetabox, "draw_function");
					if(!empty($drawFunction))
						call_user_func($drawFunction,$output);
					else
						$output->draw();
						
				break;
			}
			
		}
		
		
		/**
		 * 
		 * set startup error to be shown in master view
		 */
		public static function setStartupError($errorMessage){
			self::$startupError = $errorMessage;
		}
		
		
		/**
		 * 
		 * tells if the the current plugin opened is this plugin or not 
		 * in the admin side.
		 */
		private function isInsidePlugin(){
			$page = self::getGetVar("page");
			
			if($page == self::$dir_plugin || strpos($page, self::$dir_plugin."_") !== false)
				return(true);
				
			return(false);
		} 
				

		/**
		 * 
		 * set the view from GET variables
		 */
		private function initView($defaultView){
			
			//set view
			$viewInput = self::getGetVar("view");
						
			$page = self::getGetVar("page");
			
			//get the view out of the page
			if(strpos($page,"_") !== false){
				$parts = explode("_", $page);
				$view = $parts[1];
			}
			
			if(!empty($viewInput))
				$view = $viewInput;
			
			if(empty($view)){
				$view = $defaultView;
			}
			
			self::$view = $view;
		}
		
		/**
		 * 
		 * add scripts that have to load outside the plugin
		 */
		public static function addOutsideScripts(){
			
		}
		
		
		/**
		 * 
		 * add common used scripts
		 */
		public static function addCommonScripts(){

			//include jquery ui
			if(GlobalsShowBiz::$isNewVersion){	//load new jquery ui library
				
				$urlJqueryUI = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js";
				self::addScriptAbsoluteUrl($urlJqueryUI,"jquery-ui");
				self::addStyle("jquery-ui-1.10.3.custom.min","jui-smoothness","css/jui/new");
				
				if(function_exists("wp_enqueue_media"))
					wp_enqueue_media();
				
				wp_deregister_style("wp-jquery-ui-dialog");
				
			}else{	//load old jquery ui library
				
				$urlJqueryUI = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js";
				self::addScriptAbsoluteUrl($urlJqueryUI,"jquery-ui");
				self::addStyle("jquery-ui-1.8.18.custom","jui-smoothness","css/jui/old");
				
			}
						
			self::addScriptCommon("settings","unite_settings");
			self::addScriptCommon("admin","unite_admin");
			self::addScriptCommon("jquery.tipsy","tipsy");
						
			//--- add styles
			
			self::addStyleCommon("admin","unite_admin");
			self::addStyleCommon("settings","unite_settings");
			
			//add tipsy
			self::addStyleCommon("tipsy","tipsy");
			
			//include farbtastic
			self::addScriptCommon("my-farbtastic","my-farbtastic","js/farbtastic");
			self::addStyleCommon("farbtastic","farbtastic","js/farbtastic");
			
			//include codemirror
			self::addScriptCommon("codemirror","codemirror_js","js/codemirror");
			self::addScriptCommon("css","codemirror_js_css","js/codemirror");
			self::addScriptCommon("xml","codemirror_js_xml","js/codemirror");
			self::addScriptCommon("overlay","codmirror_overlay","js/codemirror");
			
			self::addStyleCommon("codemirror","codemirror_css","js/codemirror");
						
		}
		
		
		
		/**
		 * 
		 * admin pages parent, includes all the admin files by default
		 */
		public static function adminPages(){
			self::validateAdminPermissions();
		}
		
		
		/**
		 * 
		 * validate permission that the user is admin, and can manage options.
		 */
		protected static function isAdminPermissions(){
			
			if( is_admin() &&  current_user_can("manage_options") )
				return(true);
				
			return(false);
		}
		
		/**
		 * 
		 * validate admin permissions, if no pemissions - exit
		 */
		protected static function validateAdminPermissions(){
			if(!self::isAdminPermissions()){
				echo "access denied";
				return(false);
			}			
		}
		
		/**
		 * 
		 * set view that will be the master
		 */
		protected static function setMasterView($masterView){
			self::$master_view = $masterView;
		}
		
		/**
		 * 
		 * inlcude some view file
		 */
		protected static function requireView($view){
			try{
				//require master view file, and 
				if(!empty(self::$master_view) && !isset(self::$tempVars["is_masterView"]) ){
					$masterViewFilepath = self::$path_views.self::$master_view.".php";
					UniteFunctionsBiz::validateFilepath($masterViewFilepath,"Master View");
					
					self::$tempVars["is_masterView"] = true;
					require $masterViewFilepath;
				}
				else{		//simple require the view file.
					$viewFilepath = self::$path_views.$view.".php";
					
					UniteFunctionsBiz::validateFilepath($viewFilepath,"View");
					require $viewFilepath;
				}
				
			}catch (Exception $e){
				echo "<br><br>View ($view) Error: <b>".$e->getMessage()."</b>";
				
				if(self::$debugMode == true)
					dmp($e->getTraceAsString());
			}
		}
		
		/**
		 * require some template from "templates" folder
		 */
		protected static function getPathTemplate($templateName){
			
			$pathTemplate = self::$path_templates.$templateName.".php";
			UniteFunctionsBiz::validateFilepath($pathTemplate,"Template");
			
			return($pathTemplate);
		}
		
		/**
		 * 
		 * require settings file, the filename without .php
		 */
		protected static function requireSettings($settingsFile){
			
			try{
				require self::$path_plugin."settings/$settingsFile.php";
			}catch (Exception $e){
				echo "<br><br>Settings ($settingsFile) Error: <b>".$e->getMessage()."</b>";
				dmp($e->getTraceAsString());
			}
		}
		
		/**
		 * 
		 * get path to settings file
		 * @param $settingsFile
		 */
		protected static function getSettingsFilePath($settingsFile){
			
			$filepath = self::$path_plugin."settings/$settingsFile.php";
			return($filepath);
		}
		
		
		/**
		 * 
		 * add all js and css needed for media upload
		 */
		protected static function addMediaUploadIncludes(){
			
			self::addWPScript("thickbox");
			self::addWPStyle("thickbox");
			self::addWPScript("media-upload");
			
		}
		
		
		/**
		 * add admin menus from the list.
		 */
		public static function addAdminMenu(){
			
			$role = "manage_options";
			
			switch(GlobalsShowBiz::SHOW_SLIDER_TO){
				case "author":
					$role = "edit_published_posts";
				break;
				case "editor":
					$role = "edit_pages";
				break;		
				default:		
				case "admin":
					$role = "manage_options";
				break;
			}
			
			foreach(self::$arrMenuPages as $menu){
				$title = $menu["title"];
				$pageFunctionName = $menu["pageFunction"];
				add_menu_page( $title, $title, $role, self::$dir_plugin, array(self::$t, $pageFunctionName), 'dashicons-image-flip-horizontal' );				
			}
						
			foreach(self::$arrSubMenuPages as $key=>$submenu){
				
				$title = $submenu["title"];
				$pageFunctionName = $submenu["pageFunction"];
				
				$slug = self::$dir_plugin."_".$submenu["slug"];
				
				if($key == 0)
					$slug = self::$dir_plugin;

				add_submenu_page(self::$dir_plugin, $title, $title, $role, $slug, array(self::$t, $pageFunctionName) );
			}
			
		}
		
		
		/**
		 * 
		 * add menu page
		 */
		protected static function addMenuPage($title,$pageFunctionName){
						
			self::$arrMenuPages[] = array("title"=>$title,"pageFunction"=>$pageFunctionName);
			
		}

		/**
		 * 
		 * add sub menu page
		 */
		protected static function addSubMenuPage($slug,$title,$pageFunctionName){
			self::$arrSubMenuPages[] = array("slug"=>$slug,"title"=>$title,"pageFunction"=>$pageFunctionName);
		}
		
		
		/**
		 * 
		 * get url to some view.
		 */
		public static function getViewUrl($viewName,$urlParams=""){
			$params = "&view=".$viewName;
			
			if(!empty($urlParams))
				$params .= "&".$urlParams;
			
			$link = admin_url( "admin.php?page=".self::$dir_plugin.$params);
			return($link);
		}
		
		/**
		 * 
		 * get page url
		 */
		public static function getPageUrl($pageName,$urlParams = ""){
			$page = self::$dir_plugin;
			
			if(!empty($pageName))
				$page = $page."_".$pageName;
						
			if(!empty($urlParams))
				$page .= "&".$urlParams;
				
			$link = admin_url( "admin.php?page=".$page);
			
			return($link);
		}
		
		
		
		/**
		 * 
		 * register the "onActivate" event
		 */
		protected function addEvent_onActivate($eventFunc = "onActivate"){
			register_activation_hook( self::$mainFile, array(self::$t, $eventFunc) );
		}
		
		/**
		 * 
		 * store settings in the object
		 */
		protected static function storeSettings($key,$settings){
			self::$arrSettings[$key] = $settings;
		}
		
		/**
		 * 
		 * get settings object
		 */
		protected static function getSettings($key){
			
			if(!isset(self::$arrSettings[$key]))
				UniteFunctionsBiz::throwError("Settings $key not found");
			$settings = self::$arrSettings[$key];
			return($settings);
		}
		
		
		/**
		 * 
		 * add ajax back end callback, on some action to some function.
		 */
		protected static function addActionAjax($ajaxAction,$eventFunction){
			self::addAction('wp_ajax_'.self::$dir_plugin."_".$ajaxAction, $eventFunction);
			self::addAction('wp_ajax_nopriv_'.self::$dir_plugin."_".$ajaxAction, $eventFunction);
		}
		
		/**
		 * 
		 * echo json ajax response
		 */
		private static function ajaxResponse($success,$message,$arrData = null){
			
			$response = array();			
			$response["success"] = $success;				
			$response["message"] = $message;
			
			if(!empty($arrData)){
				
				if(gettype($arrData) == "string")
					$arrData = array("data"=>$arrData);				
				
				$response = array_merge($response,$arrData);
			}
				
			$json = json_encode($response);
			
			echo $json;
			exit();
		}

		/**
		 * 
		 * echo json ajax response, without message, only data
		 */
		protected static function ajaxResponseData($arrData){
			if(gettype($arrData) == "string")
				$arrData = array("data"=>$arrData);
			
			self::ajaxResponse(true,"",$arrData);
		}
		
		/**
		 * 
		 * echo json ajax response
		 */
		protected static function ajaxResponseError($message,$arrData = null){
			
			self::ajaxResponse(false,$message,$arrData,true);
		}
		
		/**
		 * echo ajax success response
		 */
		protected static function ajaxResponseSuccess($message,$arrData = null){
			
			self::ajaxResponse(true,$message,$arrData,true);
			
		}
		
		/**
		 * echo ajax success response
		 */
		protected static function ajaxResponseSuccessRedirect($message,$url){
			$arrData = array("is_redirect"=>true,"redirect_url"=>$url);
			
			self::ajaxResponse(true,$message,$arrData,true);
		}
		
				
		/**
		 * 
		 * Enter description here ...
		 */
		protected static function updatePlugin($viewBack = null,$isRedirect = true){
			
			$linkBack = self::getViewUrl($viewBack);
			
			$htmlLinkBack = UniteFunctionsBiz::getHtmlLink($linkBack, "Go Back");
			
			$zip = new UniteZipBiz();
						
			try{
				
				if(function_exists("unzip_file") == false){					
					if( UniteZipBiz::isZipExists() == false)
						UniteFunctionsBiz::throwError("The ZipArchive php extension not exists, can't extract the update file. Please turn it on in php ini.");
				}
				
				dmp("Update in progress...");
				
				$arrFiles = UniteFunctionsBiz::getVal($_FILES, "update_file");
				if(empty($arrFiles))
					UniteFunctionsBiz::throwError("Update file don't found.");
					
				$filename = UniteFunctionsBiz::getVal($arrFiles, "name");
				
				if(empty($filename))
					UniteFunctionsBiz::throwError("Update filename not found.");
				
				$fileType = UniteFunctionsBiz::getVal($arrFiles, "type");
				
				/*				
				$fileType = strtolower($fileType);
				
				if($fileType != "application/zip")
					UniteFunctionsBiz::throwError("The file uploaded is not zip.");
				*/
				
				$filepathTemp = UniteFunctionsBiz::getVal($arrFiles, "tmp_name");
				if(file_exists($filepathTemp) == false)
					UniteFunctionsBiz::throwError("Can't find the uploaded file.");	

				//crate temp folder
				UniteFunctionsBiz::checkCreateDir(self::$path_temp);

				//create the update folder
				$pathUpdate = self::$path_temp."update_extract/";				
				UniteFunctionsBiz::checkCreateDir($pathUpdate);
								
				//remove all files in the update folder
				if(is_dir($pathUpdate)){ 
					$arrNotDeleted = UniteFunctionsBiz::deleteDir($pathUpdate,false);
					if(!empty($arrNotDeleted)){
						$strNotDeleted = print_r($arrNotDeleted,true);
						UniteFunctionsBiz::throwError("Could not delete those files from the update folder: $strNotDeleted");
					}
				}
				
				//copy the zip file.
				$filepathZip = $pathUpdate.$filename;
				
				$success = move_uploaded_file($filepathTemp, $filepathZip);
				if($success == false)
					UniteFunctionsBiz::throwError("Can't move the uploaded file here: {$filepathZip}.");
				
				if(function_exists("unzip_file") == true){
					WP_Filesystem();
					$response = unzip_file($filepathZip, $pathUpdate);
				}
				else					
					$zip->extract($filepathZip, $pathUpdate);
				
				//get extracted folder
				$arrFolders = UniteFunctionsBiz::getFoldersList($pathUpdate);
				if(empty($arrFolders))
					UniteFunctionsBiz::throwError("The update folder is not extracted");
				
				if(count($arrFolders) > 1)
					UniteFunctionsBiz::throwError("Extracted folders are more then 1. Please check the update file.");
					
				//get product folder
				$productFolder = $arrFolders[0];
				if(empty($productFolder))
					UniteFunctionsBiz::throwError("Wrong product folder.");
					
				if($productFolder != self::$dir_plugin)
					UniteFunctionsBiz::throwError("The update folder don't match the product folder, please check the update file.");
				
				$pathUpdateProduct = $pathUpdate.$productFolder."/";				
				
				//check some file in folder to validate it's the real one:
				$checkFilepath = $pathUpdateProduct.$productFolder.".php";
				if(file_exists($checkFilepath) == false)
					UniteFunctionsBiz::throwError("Wrong update extracted folder. The file: {$checkFilepath} not found.");
				
				//copy the plugin without the captions file.
				//$pathOriginalPlugin = $pathUpdate."copy/";
				$pathOriginalPlugin = self::$path_plugin;
				
				$arrBlackList = array();
				//$arrBlackList[] = "showbiz-plugin/css/captions.css";
				
				UniteFunctionsBiz::copyDir($pathUpdateProduct, $pathOriginalPlugin,"",$arrBlackList);
				
				//delete the update
				UniteFunctionsBiz::deleteDir($pathUpdate);
				
				if($isRedirect == true){
					dmp("Updated Successfully, redirecting...");
					echo "<script>location.href='$linkBack'</script>";
				}
				
				return(true);
				
			}catch(Exception $e){
				$message = $e->getMessage();
				$message .= " <br> Please update the plugin manually via the ftp";
				echo "<div style='color:#B80A0A;font-size:18px;'><b>Update Error: </b> $message</div><br>";
				echo $htmlLinkBack;
				exit();
			}
			
		}
		
 	
 }
 
 ?>