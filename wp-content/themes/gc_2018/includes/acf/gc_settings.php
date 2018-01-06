<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5a3a447122488',
		'title' => 'Gospel Center - Settings',
		'fields' => array(
			array(
				'key' => 'field_5a426b0c8ff14',
				'label' => 'General',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5a3a4495236fc',
				'label' => 'Logo',
				'name' => 'logo',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'logo',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => 'png',
			),
			array(
				'key' => 'field_5a427745b973a',
				'label' => 'Logo white',
				'name' => 'logo_white',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'logo',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => 'png',
			),
			array(
				'key' => 'field_5a3a4660162dd',
				'label' => 'Long name',
				'name' => 'long_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Gospel Center Lausanne',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a3a4681162de',
				'label' => 'Short name',
				'name' => 'short_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'GCLausanne',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a3a461e27cb0',
				'label' => 'City name',
				'name' => 'city_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Lausanne',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a426e9bb8ab0',
				'label' => 'Social',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5a426ea3b8ab1',
				'label' => 'Social',
				'name' => 'social',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_5a426ebfb9e58',
						'label' => 'Social network',
						'name' => 'social_network',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '51',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'facebook' => 'Facebook',
							'instagram' => 'Instagrm',
							'twitter' => 'Twitter',
							'youtube' => 'YouTube',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'array',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5a426ef6b9e59',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '49',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
				),
			),
			array(
				'key' => 'field_5a426b188ff15',
				'label' => 'Footer',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5a426b295b22b',
				'label' => 'Footer',
				'name' => 'footer',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_5a426b3a5b22c',
						'label' => 'Icon',
						'name' => 'icon',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '51',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'email' => 'E-mail',
							'location' => 'Location',
							'time' => 'Time',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5a426d153ff34',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '49',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_5a426b945b22d',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '51',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5a426b9d5b22e',
						'label' => 'Subtitle',
						'name' => 'subtitle',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '49',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_5a5129224f94a',
				'label' => 'Script',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_5a51293175feb',
				'label' => 'script',
				'name' => 'script',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'gc',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;