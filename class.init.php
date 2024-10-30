<?php
/*	
 * @package   ITM Option Panel
 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
 * @Licence   GPL2
 */
 
/* 
 * Including Option files, Array $options.
 * Including fields class to get fields, eg: text, upload, textarea ..
 */
require ITMFW_OPTION_PANEL_DIR .'/options.php';
require ITMFW_OPTION_PANEL_DIR .'/fields.init.php';

class ITM_FW
{
	
    public $sections;
    public $settings;
	public $options;
	/*
	 * register fields class
	 */
	var $ITM_FIELD;
	var $theme;

    /*
     * Base class constructor. 
     */
    public function __construct()
    {
		/*
		 * Start process.
		 */
		
		/*  "field" class object.  */
		$this->ITM_FIELD = new ITM_FIELDS();
		
		/* Theme name */
		$this->theme = get_current_theme();
		
		/*  fetch options values if exits in db. */
		$this->options = get_option( 'itmfw_option' );
		
		/*  filter section values from options array, file:option.php, array : 'sections'        => array('...'). */
		$this->itmfw_filter_sections();
		
		/*  filter settings values from options array file:option.php, array : 'settings'        => array('...'). */
		$this->itmfw_filter_settings();
		
		/*  add menu for theme options page. */
		add_action( 'admin_menu', array( $this, 'itmfw_menu_page' ) );
		
		/*  register settings, sections. */
        add_action( 'admin_init', array( $this, 'page_init' ) );
		
		/*  including scripts and styles in option panel. */
		add_action( 'admin_print_scripts',  array( &$this,'itmfw_admin_scripts'));
		add_action( 'admin_print_styles',  array( &$this,'itmfw_admin_styles'));
		

		/* register default_options if it's fresh install. */
		if (!get_option( 'itmfw_option' ))
		add_action( 'after_setup_theme', array($this, 'register_default_options'));
        
    }

	
	/**
	 * function for filtering sections from $options array.
	 */
	public function itmfw_filter_sections()
	{
		global $options; 
		if(!empty($options)){
			$sections = $options['sections'];
			if($sections){
				foreach($sections as $section){
					$this->sections[$section['id']] = __( $section['title'] );
				}
			}
		}else{
			$this->sections['general']  = __( 'Demo Settings' );
		}
	}
	
	/**
	 * function for filtering settings from $options array.
	 */
	public function itmfw_filter_settings()
	{
		global $options;
		if(!empty($options)){
			$settings = $options['settings'];
			foreach($settings as $setting){
				$this->settings[$setting['id']] = $setting;
			}
		}else{
			$this->settings['demo_text'] = array(
				'id'      => 'id',
				'title'   => __( 'Demo title' ),
				'desc'    => __( 'Demo description.' ),
				'std'     => '',
				'type'    => 'text',
				'section' => 'general',
				'choices' => '',
				'class'   => ''
			);
		}
	}
	/**
	 * ITMFW Options Menu Page.
	 */
	public function itmfw_menu_page()
	{
		// This page will be under "Appearance"
        add_theme_page(
            __(' Theme Options'),  //$page title
			__(' Theme Options'),  //$menu title
            'manage_options', 	   //$capability 
            'itmfw_options',       //$menu_slug
			array($this, 'itmfw_options_panel') //$function
        );
	}
	
	
	/**
     * Options page callback, function for html.
     */
    public function itmfw_options_panel()
    {	
		echo '<div class="warp" id="itmfw-warpper">';
		echo '<h2>'.$this->theme.' Theme Option Panel</h2>';
		echo '<div class="itmfw-block">';
			/* Header Section  */
			echo '<div class="itmfw-header">';
				echo '<span class="itmfw-logo"><h1><i class="fa fa-cog"></i> ITM OPTION PANEL</h1></span>';
				echo '<div class="itmfw-save-button">';
					echo '<div class="itmfw_response"></div>';
					echo '<div class="ajaxloader"></div>';
					echo	'<input class="button itm_save_btn" type="submit" value="Save Changes" name="submit" />';
				echo '</div>';
			echo '</div>';
			/* Body Section */
			echo '<div class="itmfw-content">';
				echo 	'<div id="tabs">';
				echo 		'<form class="itmfw_options_form">';
							settings_fields( 'itmfw_option' );   
							echo '<ul>';
								foreach ( $this->sections as $section_slug => $section )
								echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
							echo '</ul>';
							echo '<div class="itmfw_setting_warp">';
								$this->itwfw_settings_sections($_GET['page']);
							echo '</div>';
				echo 		'</form>';
				echo 	'</div>';
			echo '</div>';
			/* Footer Section */
			echo '<div class="itmfw-footer">';
				get_itmfw_version();
				echo '<div class="itmfw-save-button">';
					echo '<div class="itmfw_response"></div>';
					echo '<div class="ajaxloader"></div>';
					echo '<input class="button itm_save_btn" type="submit" value="Save Changes" name="submit" />';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
    }
	
	/**
	 * GET Setting Fields & Section.
	 */
	public function itwfw_settings_sections($page) {
		global $wp_settings_sections, $wp_settings_fields;

		foreach( (array) $wp_settings_sections[$page] as $section ) {
			echo "<div id='".$section['id']."'>";
			echo "<h3>{$section['title']}</h3>\n";
			call_user_func($section['callback'], $section);
			if ( !isset($wp_settings_fields) ||
				 !isset($wp_settings_fields[$page]) ||
				 !isset($wp_settings_fields[$page][$section['id']]) )
					continue;
			echo '<div class="itmfw_settings_form_wrapper">';
			$this->custom_do_settings_fields($page, $section['id']);
			echo '</div>';
			echo "</div>";
		}
	}

	/**
	 * Setting Field
	 */
	function custom_do_settings_fields($page, $section) {
		global $wp_settings_fields;
		
		foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
			echo '<div class="itmfw_label">';
			if ( !empty($field['args']['label_for']) )
				echo '<p><label for="' . $field['args']['label_for'] . '">' . $field['title'] . '</label><br />';
			else
				echo '';
				call_user_func($field['callback'], $field['args']);
				echo '</div>';
		}
	}
	
	/**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'itmfw_option', // Option group
            'itmfw_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		foreach ( $this->sections as $id => $title ) {
			add_settings_section(
				$id, // ID
				$title, // Title
				array( $this, 'itmfw_sections_callback' ), // Callback
				'itmfw_options' // Page
			);
		}
		foreach ( $this->settings as $id => $setting ){
			add_settings_field(
				$id, // ID
				$setting['title'], // Title 
				array( $this, 'id_settings_callback' ), // Callback
				'itmfw_options', // Page
				$setting['section'], // Section 
				$setting
			);  
		}
    }
	
	/**
	 * id_settings_callback
	 */
	
	public function id_settings_callback($setting_args)
	{
		extract($setting_args);
		$options = $this->options;
		
		//print_r($setting_args);die;
			
		switch ( $type ) {
			case 'text':
				$this->ITM_FIELD->itmfw_text($setting_args);
			break;
			case 'textarea':
				$this->ITM_FIELD->itmfw_textarea($setting_args);
			break;
			case 'select':
				$this->ITM_FIELD->itmfw_select($setting_args);
			break;
			case 'upload':
				$this->ITM_FIELD->itmfw_upload($setting_args);
			break;
			case 'switch':
				$this->ITM_FIELD->itmfw_switch($setting_args);
			break;
			case 'radio':
				$this->ITM_FIELD->itmfw_radio($setting_args);
			break;
			case 'checkbox':
				$this->ITM_FIELD->itmfw_checkbox($setting_args);
			break;
			case 'color':
				$this->ITM_FIELD->itmfw_colorpicker($setting_args);
			break;
		}
	}
	/**
	 *	itmfw_sections_callback
	 */
	public function itmfw_sections_callback()
	{
		
	}
	
	/**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        return $input;
    }
	
	/** 
     * Register default options.
     */
	 
	public function register_default_options()
	{
		$default_options = array();
		foreach($this->settings as $id => $setting){
			$default_options[$id] = $setting['std'];
		}
		$this->itmfw_save_settings($default_options);
	
	}
	
	private function itmfw_save_settings($args)
	{
		if(!empty($args)){
			update_option("itmfw_option",$args);
		}
	}
    
	public function itmfw_admin_scripts() 
	{	
		wp_print_scripts( 'jquery-ui-tabs' );
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		wp_register_script( 'bootstrap_js', ITMFW_OPTION_PANEL_URL. 'assets/js/bootstrap.min.js');
		
		wp_register_script( 'itmfw_options_script', ITMFW_OPTION_PANEL_URL . 'assets/js/itmfw-options-scripts.js', array('jquery','media-upload','thickbox'));
		
		wp_enqueue_script( 'itmfw-colorpicker', ITMFW_OPTION_PANEL_URL . 'assets/js/colorpicker.js');
		wp_enqueue_script( 'itmfw-colorpicker-eye', ITMFW_OPTION_PANEL_URL . 'assets/js/eye.js');
		wp_enqueue_script( 'itmfw-colorpicker-utils', ITMFW_OPTION_PANEL_URL . 'assets/js/utils.js');
		wp_enqueue_script( 'itmfw-colorpicker-layout', ITMFW_OPTION_PANEL_URL . 'assets/js/layout.js');
		
		wp_enqueue_script('bootstrap_js');
		wp_enqueue_script('bootstrap_switch');
		wp_enqueue_script('itmfw_options_script');
		
	}
	
	public function itmfw_admin_styles() 
	{	
		wp_enqueue_style( 'wp-color-picker' );
		
		wp_register_style( 'itmfw_options_style',  ITMFW_OPTION_PANEL_URL.'assets/css/itmfw-options-style.css' );
		wp_enqueue_style( 'itmfw_options_style' );	
		
		wp_register_style( 'itmfw_font_awesome',  ITMFW_OPTION_PANEL_URL.'assets/css/font-awesome.css' );
		wp_enqueue_style( 'itmfw_font_awesome' );	
		
		wp_register_style( 'itmfw_bootstrap',  ITMFW_OPTION_PANEL_URL.'assets/css/bootstrap.css' );
		wp_enqueue_style( 'itmfw_bootstrap' );
		
		wp_register_style( 'itmfw_colorpicker',  ITMFW_OPTION_PANEL_URL.'assets/css/colorpicker.css' );
		wp_enqueue_style( 'itmfw_colorpicker' );
		
		wp_register_style( 'itmfw_colorpicker_layout',  ITMFW_OPTION_PANEL_URL.'assets/css/layout.css' );
		wp_enqueue_style( 'itmfw_colorpicker_layout' );
		
		wp_enqueue_style('thickbox');

	}
/*	
 * @package   ITM Option Panel
 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
 * @Licence   GPLv2
 */
}

