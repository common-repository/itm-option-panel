<?php
/*	
 * @package   ITM Option Panel
 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
 * @Licence   GPLv2
 */
 
$options = array( 
    'sections'        => array( 
		array(
			'id'          => 'general',
			'title'       => '<i class="fa fa-cogs"></i> General Settings'
		),
		array(
			'id'          => 'style',
			'title'       => '<i class="fa fa-eye"></i> Theme Style'
		),
	),
	'settings'        => array( 
		array(
			'id'          => 'theme_color',
			'label'       => 'Theme Background',
			'desc'        => 'This is test desc.',
			'std'         => '',
			'type'        => 'color',
			'section'     => 'general',
			'choices'     => ''
		),
		array(
			'id'          => 'theme_switch',
			'label'       => 'Theme Switch',
			'desc'        => 'This is test desc.',
			'std'         => '',
			'type'        => 'switch',
			'section'     => 'general',
			'class'       => '',
			'choices'     => ''
		),
		array(
			'id'          => 'theme_checkbox',
			'label'       => 'Theme Checkbox',
			'desc'        => 'This is test desc.',
			'std'         => '',
			'type'        => 'checkbox',
			'section'     => 'general',
			'class'       => '',
			'choices'     => ''
		),
		
		array(
			'id'          => 'theme_logo',
			'label'       => 'Upload Logo',
			'desc'        => 'logo change',
			'std'         => '',
			'type'        => 'upload',
			'section'     => 'general',
			'class'       => '',
			'choices'     => ''
		),
		
		array(
			'id'          => 'theme_radio',
			'label'       => 'Theme Radio',
			'desc'        => 'This is test desc.',
			'std'         => 'radio1',
			'type'        => 'radio',
			'section'     => 'general',
			'class'       => '',
			'choices'     => array(
				'radio1' => 'option 1',
				'radio2' => 'option 2',
			),
		),
		
		array(
			'id'          => 'theme_layout',
			'label'       => 'Theme Layout',
			'desc'        => 'This is test desc.',
			'std'         => '',
			'type'        => 'select',
			'section'     => 'general',
			'class'       => '',
			'choices'     => array( 
				'full_width'  => 'Full Width',
				'boxed'       => 'Boxed',
			),
		),
		
		array(
			'id'          => 'theme_style',
			'label'       => 'Theme Color',
			'desc'        => 'This is test desc.',
			'std'         => '',
			'type'        => 'color',
			'section'     => 'style',
			'class'       => '',
			'choices'     => ''
		),
	)
);