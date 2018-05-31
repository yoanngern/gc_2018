<?php

if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5b06afd6dd6cf',
		'title'                 => 'Doc category',
		'fields'                => array(
			array(
				'key'               => 'field_5b06afde99575',
				'label'             => 'Cover Photo',
				'name'              => 'bg_image',
				'type'              => 'image',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '51',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'array',
				'preview_size'      => 'header',
				'library'           => 'all',
				'min_width'         => '',
				'min_height'        => '',
				'min_size'          => '',
				'max_width'         => '',
				'max_height'        => '',
				'max_size'          => '',
				'mime_types'        => '',
			),
			array(
				'key'               => 'field_5b0e521471b27',
				'label'             => 'Doc Picture',
				'name'              => 'doc_picture',
				'type'              => 'image',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '49',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'array',
				'preview_size'      => 'hd',
				'library'           => 'all',
				'min_width'         => '',
				'min_height'        => '',
				'min_size'          => '',
				'max_width'         => '',
				'max_height'        => '',
				'max_size'          => '',
				'mime_types'        => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'gc_doccategory',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'seamless',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => 1,
		'description'           => '',
	) );

endif;