<?php get_header(); ?>


<section id="content">

	<?php


	if ( is_tax( 'gc_eventcategory' ) ):

		$bg_image = get_field_or_parent( 'bg_image', get_queried_object(), 'gc_eventcategory' );


		if ( $bg_image == null ) {
			$default_cat = get_term_by( 'slug', 'other', 'gc_eventcategory' );

			$bg_image = get_field( 'bg_image', $default_cat );
		}

		$title = get_queried_object()->name;


	elseif ( $post->post_type == "gc_event" ):

		$default_cat = get_term_by( 'slug', 'other', 'gc_eventcategory' );

		$bg_image = get_field( 'bg_image', $default_cat );

		$title = "Événements";


	else:

		$bg_image = get_field_or_parent( 'bg_image', $_POST, 'gc_eventcategory' );

		$title = "Événements";

	endif;


	?>


    <article class="title"
             style="background-image: url('<?php echo $bg_image['sizes']['header']; ?>')">
        <div class="title">


            <h1 class="page-title"><span><?php echo $title; ?></span></h1>


        </div>

    </article>


    <div class="platter">

        <section id="events_header">

            <div class="content">

                <a class="all_categories" href="<?php echo get_post_type_archive_link( 'gc_event' ); ?>">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>

                <ul class="event_categories">
					<?php

					$exclude    = array();
					$categories = get_terms( array(
						'taxonomy'   => 'gc_eventcategory',
						'hide_empty' => 1,
					) );

					$cat_other = get_term_by( 'slug', 'other', 'gc_eventcategory' );

					foreach ( $categories as $category ) {


						$events = get_posts( array(
							'post_type'   => 'gc_event',
							'numberposts' => - 1,
							'tax_query'   => array(
								array(
									'taxonomy'         => 'gc_eventcategory',
									'field'            => 'id',
									'terms'            => $category->term_id, // Where term_id of Term 1 is "1".
									'include_children' => true
								)
							)
						) );

						foreach ( $events as $key => $event ) {

							$end_date = get_field( "end_date", $event );


							if ( $end_date < date( 'Y-m-d' ) ) {
								unset( $events[ $key ] );
							}
						}

						if ( ! count( $events ) ) {

							$exclude[] = $category->term_id;
						}

					}

					$exclude[] = $cat_other->term_id;


					/*
					wp_list_categories( array(
						'show_option_all' => pll__( 'Filter events' ),
						'value_field'     => 'slug',
						'hide_if_empty'   => false,
						'title_li'        => "",
						'hide_empty'      => 1,
						'hierarchical'    => 1,
						'exclude'         => $exclude,
						'taxonomy'        => 'gc_eventcategory',
						'selected'        => get_queried_object()->slug
					) );
					*/


					$cat_list = get_categories( array(
						'taxonomy' => 'gc_eventcategory',
						'orderby'  => 'name',
						'order'    => 'ASC',
						'exclude'  => $exclude,
					) );

					//var_dump( $cat_list );


					foreach ( $cat_list as $cat ) {

						$name     = $cat->name;
						$id       = $cat->term_id;
						$link     = get_term_link( $cat );
						$acronym  = get_field( 'acronym', $cat );
						$bg_image = get_field( 'bg_image', $cat )['sizes']['social'];

						if ( $acronym == null ) {
							$s = $name;

							if ( preg_match_all( '/\b(\w)/', strtoupper( $s ), $m ) ) {
								$v = implode( '', $m[1] ); // $v is now SOQTU
							}


							if ( strlen( $v ) <= 1 ) {
								$acronym = substr( $name, 0, 3 );
							} else {
								$acronym = substr( $v, 0, 3 );
							}

						}

						if ( strlen( $name ) >= 15 ) {
							$name = substr( $name, 0, 12 ) . "...";
						}

						echo "
					<li id='category-item-$id'>
					    <a href='$link'>
					        <div class='round' style='background-image: url(\" $bg_image \")'>
					            <span>$acronym</span>
                            </div>
					        <div class='name'>$name</div>
					        
					    </a>
					</li>";
					}

					?>


                </ul>
            </div>

        </section>

		<?php


		if ( have_posts() ) : ?>


            <section id="listOfEvents" class="small" data-nb="3">
                <article class="content-page">


					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/event/item' );

					endwhile; ?>

                </article>
            </section>


            <nav class="nav_bottom">
                <div class="nav-previous alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
                <div class="nav-next alignright"><?php next_posts_link( 'Next' ); ?></div>
            </nav>

			<?php

		else :

			get_template_part( 'template-parts/event/none' );

		endif;
		?>

    </div>


</section>


<?php get_footer(); ?>




