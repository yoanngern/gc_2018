<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5acb2c154fcdb',
		'title' => 'Team page',
		'fields' => array(
			array(
				'key' => 'field_5acb2c32ded8a',
				'label' => 'Teams',
				'name' => 'teams',
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
				'button_label' => 'Add a team',
				'sub_fields' => array(
					array(
						'key' => 'field_5acb2c8352728',
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
						'key' => 'field_5acb2d6ddc403',
						'label' => 'Members',
						'name' => 'team_members',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							949 => 'Pascal Widmer',
							929 => 'Wesley Hall',
							907 => 'Amaèle Bader',
							903 => 'Patrick Piccinelli',
							900 => 'Ryan Landolt',
							898 => 'Jean-Claude Berberat',
							873 => 'Kent Trachsel',
							871 => 'Noleen Bader',
							804 => 'Sophie Bernard',
							798 => 'Daniel Pitarella',
							713 => 'Henry Madava',
							704 => 'Pete Carter',
							697 => 'Chris Poeschl',
							688 => 'Shara Pradhan',
							686 => 'Yannick',
							655 => 'Christine Gallay',
							648 => 'Ben Fitzgerald',
							647 => 'Daniel Boudrias',
							646 => 'Markus Wenz',
							645 => 'Matthias Kuhn',
							644 => 'Chris Gore',
							629 => 'Benjamin Peterschmitt',
							587 => 'Thierry Juvet',
							579 => 'Olivier Combernous',
							568 => 'Marilyn Rollier',
							566 => 'François Clottu',
							554 => 'Daniel Shayesteh',
							523 => 'Brian Britton',
							522 => 'Audrey Mack',
							521 => 'Stephen Addison',
							520 => 'Daniel',
							515 => 'Jean-Michel Tour',
							513 => 'Daniel Berger',
							512 => 'Fabien B.',
							511 => 'Marc Gallay',
							501 => 'Véronique Lambelet',
							500 => 'Eric Jaffrain',
							499 => 'Patrick Bigler',
							474 => 'Mattheus van der Steen',
							473 => 'Mathieu Bernard',
							472 => 'John Arnott',
							471 => 'Valéry Gonin',
							442 => 'Gwenaëlle Beutler',
							422 => 'Denise Goulet',
							421 => 'David Wagner',
							387 => 'Djam\'s',
							385 => 'Mark McCord',
							382 => 'Matt Marvane',
							377 => 'Camille Kursner',
							370 => 'Jean-Pierre Gerber',
							368 => 'Mélanie Gerber',
							363 => 'Michaël Gerber',
							355 => 'Beat Jost',
							353 => 'Claudia Schmied',
							352 => 'David Zürcher',
							348 => 'Cédric Trachsel',
							347 => 'Marc',
							345 => 'David Schmied',
							339 => 'François Guernier',
							315 => 'Steve & Rita Fedele',
							313 => 'Pierre Demaude',
							308 => 'Luc Dumont',
							306 => 'Christophe Reichenbach',
							284 => 'Jérémie Lehmann',
							283 => 'Jérémie Bader',
							282 => 'Chuck Parry',
							255 => 'Danny Silk',
							253 => 'Paul Marsh',
							252 => 'Joël Spinks',
							251 => 'Sébastien Demierre',
							241 => 'Mado Lehmann',
							230 => 'Joaquin Evans',
							229 => 'Stéphane H',
							222 => 'Philippe Cherpillod',
							215 => 'Kent Gott',
							212 => 'Samuel Tapsoba',
							206 => 'Caroline Lehmann',
							202 => 'Rodrigues Pereira',
							82 => 'Bruno Picard',
							81 => 'Paul Manwaring',
							80 => 'Patrice Martorano',
							79 => 'Brother Yun',
							73 => 'Donato Anzalone',
							72 => 'Matthieu Zopfmann',
							71 => 'Sandra Dubi',
							70 => 'Julien Dubi',
							69 => 'Stéphane Potin',
							68 => 'Alexandre Goetschmann',
							51 => 'Stacey Campbell',
							50 => 'Massimo Franco',
							49 => 'Tim Paton',
							48 => 'Daniel Chand',
							43 => 'Fiona Benavides',
							33 => 'Marc Rapelli',
							32 => 'Yoann Gern',
							31 => 'Bob Hazlett',
							30 => 'Jean-Michel Chevalley',
							27 => 'Paul Hemes',
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
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-team.php',
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