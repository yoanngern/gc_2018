<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5a4e27604527c',
		'title' => 'TV page',
		'fields' => array(
			array(
				'key' => 'field_5a4e277fcc17d',
				'label' => 'Page title',
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
				'key' => 'field_5a4e2931b78bb',
				'label' => 'Background',
				'name' => 'bg_image',
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
				'preview_size' => 'home',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5a4e579013f24',
				'label' => 'Sections',
				'name' => 'sections',
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
						'key' => 'field_5a4e5ce709a10',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
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
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5a4e57a113f25',
						'label' => 'Type',
						'name' => 'type',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'last' => 'Last',
							'city' => 'City',
							'speaker' => 'Speaker',
							'category' => 'Category',
						),
						'allow_custom' => 0,
						'save_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'value',
					),
					array(
						'key' => 'field_5a4e58064e057',
						'label' => 'Speaker',
						'name' => 'speaker',
						'type' => 'post_object',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5a4e57a113f25',
									'operator' => '==',
									'value' => 'speaker',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'gc_people',
						),
						'taxonomy' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'return_format' => 'object',
						'ui' => 1,
					),
					array(
						'key' => 'field_5a4e58394d61e',
						'label' => 'City',
						'name' => 'city',
						'type' => 'post_object',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5a4e57a113f25',
									'operator' => '==',
									'value' => 'city',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'gc_city',
						),
						'taxonomy' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'return_format' => 'object',
						'ui' => 1,
					),
					array(
						'key' => 'field_5a4e5863e5ed5',
						'label' => 'Category',
						'name' => 'category',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5a4e57a113f25',
									'operator' => '==',
									'value' => 'category',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'gc_talkcategory',
						'field_type' => 'select',
						'allow_null' => 0,
						'add_term' => 1,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'object',
						'multiple' => 0,
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-tv.php',
				),
			),
		),
		'menu_order' => -1,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
		),
		'active' => 1,
		'description' => '',
	));

endif;