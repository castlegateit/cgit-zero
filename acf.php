<?php

/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */ 

// Fields 
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	//include_once('add-ons/acf-repeater/repeater.php');
	//include_once('add-ons/acf-gallery/gallery.php');
	//include_once('add-ons/acf-flexible-content/flexible-content.php');
}

// Options Page 
//include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_seo',
		'title' => 'SEO',
		'fields' => array (
			array (
				'key' => 'field_51c1b1ae483b1',
				'label' => 'SEO Title',
				'name' => 'seo_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_51c1b1c4483b2',
				'label' => 'SEO Heading',
				'name' => 'seo_heading',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_51c1b1cd483b3',
				'label' => 'SEO Description',
				'name' => 'seo_description',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 10,
	));
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_options',
		'title' => 'Options',
		'fields' => array (
			array (
				'key' => 'field_5284c77210b08',
				'label' => 'Telephone',
				'name' => 'telephone',
				'type' => 'text',
				'required' => 0,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5284c98c10b09',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'email',
				'required' => 0,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5284c99b10b0a',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'textarea',
				'required' => 0,
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5284dcc26357c',
				'label' => 'Registered address',
				'name' => 'registered_address',
				'type' => 'textarea',
				'required' => 0,
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5284dd566a323',
				'label' => 'Registered number',
				'name' => 'registered_number',
				'type' => 'number',
				'required' => 0,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_5284dd6a6a324',
				'label' => 'Registered country',
				'name' => 'registered_country',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5284dd796a325',
				'label' => 'VAT number',
				'name' => 'vat_number',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
