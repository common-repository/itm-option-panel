<?php
	/**
	 * Plugin Name: ITM Option Panel
	 * Plugin URI: http://itmonks.com/
	 * Description: A brief description of the Plugin.
	 * Version: 1.0
	 * Author: ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
	 * Author URI: http://w3press.net/
	 * License: GPL2
	 */
	 
	/*	
	 * @package   ITM Option Panel
	 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
	 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
	 * @Licence   GPLv2
	 */
	
	/** Here You need to Define Panel Mode eg: THEME or PLUGIN **/
	
	/* Default : Plugin Mod Active. */
	define('ITMFW_CURR_MODE', 'PLUGIN' );
	
	/** End  **/
	
	define('ITMFW_VERSION', '1.0');
	define('ITMFW_COPYRIGHT', '2014, ITMonks Pvt. Ltd.');
	define('ITMFW_MODE', true);
	
	/***  Defining URL and DIR ***/
	if(ITMFW_MODE == true && ITMFW_CURR_MODE == 'THEME'){
		/* For : Theme Mod */
		define('ITMFW_DIR', get_template_directory());
		define('ITMFW_URL', get_template_directory_uri());
		
		define('ITMFW_OPTION_PANEL_DIR', get_template_directory() .'/option-panel/');
		define('ITMFW_OPTION_PANEL_URL', get_template_directory_uri() .'/option-panel/');
		
	}elseif(ITMFW_MODE == true && ITMFW_CURR_MODE == 'PLUGIN'){
		/* For : Plugin Mod */
		define('ITMFW_DIR',  plugin_dir_path( __FILE__ ));
		define('ITMFW_URL',  plugin_dir_url( __FILE__ ));
		
		define('ITMFW_OPTION_PANEL_DIR', plugin_dir_path( __FILE__ ));
		define('ITMFW_OPTION_PANEL_URL', plugin_dir_url( __FILE__ ));
		
	}else{
		/* For : Die  if mod is not specified */
		wp_die('Opps! something went wrong please contact support team or mail us at support@itmonks.com');
	}
	
	/* Including Base Class */
	require ITMFW_OPTION_PANEL_DIR .'/class.init.php';
	if(is_admin())
	$ITM_FW = new ITM_FW();
	/* End */
	
	
	/* Get Plugin Version and Copyright */
	function get_itmfw_version()
	{
		echo '<div class="itmfw-version"><h4>Version : '.ITMFW_VERSION.', </h4><h4>&copy; '.ITMFW_COPYRIGHT.'</h4></div>';
	}

	/*	
	 * @package   ITM Option Panel
	 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
	 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
	 * @Licence   GPLv2
	 */