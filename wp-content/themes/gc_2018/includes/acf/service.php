<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5a01c2acb5d86',
		'title' => 'Service',
		'fields' => array(
			array(
				'key' => 'field_5a033c2e613b3',
				'label' => 'Type',
				'name' => 'service_type',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '61',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'gc_servicecategory',
				'field_type' => 'select',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'object',
				'multiple' => 0,
			),
			array(
				'key' => 'field_5a0575546c948',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					0 => 'group_5a04aa94d7fc4',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
			array(
				'key' => 'field_5a03018fe14a8',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '61',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'gc_location',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5a0312a682814',
				'label' => 'Speaker',
				'name' => 'service_speaker',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '61',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					22 => 'Yann Guerry',
					21 => 'Nicolas Lehmann',
					20 => 'Claire-Lise Cherpillod',
					19 => 'Werner Lehmann',
					13 => 'Jean-Luc Trachsel',
				),
				'default_value' => array(
				),
				'allow_null' => 1,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 1,
				'return_format' => 'array',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gc_service',
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