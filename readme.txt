=== Plugin Name ===
Contributors: itmonks, rajat_wpress
Donate link: http://w3press.net/donate
Tags: Theme Option Panel
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin is used to create theme options panel into your wordpress theme or blog. 

== Description ==

This plugin is used to create option panel in any wordpress theme, you can use as plugin or directly into theme. You are free to use this plugin for your theme or your client theme.

Feature included :-

* input
* textarea
* checkbox
* select
* radio button
* upload images
* color picker
* switch (On/Off)
	
Ajax Save button ( Save Setting without refreshing page )


== Installation ==
Get option in front end :-
$theme_options = get_option("itmfw_option");


Currently this plugin work in two mods, Theme Mod and Plugin Mod.
By Default Plugin Mod is active.

Plugin Mod :-
    You can simply download plugin and install it in wordpress plugin section. It will activate theme option under appearance menu.
	
	1. Upload `itm-option-panel` folder to the `/wp-content/plugins/` directory.
    2. Activate the plugin through the 'Plugins' menu in WordPress.
	
Theme Mod :-
	If you want to use this plugin into theme directly, just garb you plugin copy and put it into your theme. After that add two lines of code into theme functions.php file.
	
	1. Upload `itm-option-panel` folder to the `/wp-content/theme/YOUR-THEME` directory.
    2. You need to add code into functions.php file.
	
	Code :
	define('ITMFW_CURR_MODE', 'THEME' );  //Define current mod.
	require_once( dirname( __FILE__ ) . '/itm-option-panel/theme-options.php' );  //Please check as per your need.
	
	That's all you need to do install plugin into theme directly.

Next Step :-
    You need to edit options.php file, you will find file into folder option-panel/options.php
    
	Here you find multi-dimension array, you need to make edit on it to activate your theme options.
	
	1) Section Array
	2) Setting Array
	
	Inside $options = array( ); array...
	
	1) Section Array :- 
		'sections'        => array( 
			array(
				'id'          => 'general',  
				'title'       => '<i class="fa fa-cogs"></i> General Settings'
			),
		),
		
		a) id = used into html code.
		b) title = display in left sidebar.
		
	2) Setting Array
		'settings'        => array( 
			array(
				'id'          => 'mycustomid',
				'label'       => 'My Custom Title',
				'desc'        => 'This is Description',
				'std'         => 'Custom Value',
				'type'        => 'select',
				'section'     => 'general',
				'class'       => 'My Class',
				'choices'     =>  array(
									'value1' => 'label',
									'value2' => 'label',
								),
			),
		),
		
		a) id = must be unique for all fields.
		b) label = this is title.
		c) desc = this is description of field.
		d) std  = this is default value used for fields. if not sure leave it blank.
		e) type = this must be field type eg : text ( for input text) , textarea ( for textarea ), select (for dropdown, must have choices array), color (for color picker), radio ( for radio button, must have choices array), checkbox ( for checkbox), switch (for on off switch).
		f) section = this must be value which are define in above sections array.
		g) class = define css class name.
		h) choices = must be define in this pattern 
				array(
					'value1' => 'label',
					'value2' => 'label',
					),
			(i) value1, value2  = this will store in database.
			(ii)  label =  this is use to visible for user to select options.
			
			radio and select are two type which uses these array.
			
== Frequently Asked Questions ==

= Add Cusotm Options in theme panel =

1) You need to edit options.php file array to make custom options for your theme, Please follow installation section.

You need more help : mail us at support@itmonks.com

== Screenshots ==

1. /assets/screenshot-1.png
2. /assets/screenshot-2.png
3. /assets/screenshot-3.png

== Changelog ==

= 1.0 =
* plugin 1.0 version.

== Upgrade Notice ==

Note: Fresh install