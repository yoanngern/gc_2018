



<section id="content" class="events">

    <div class="platter">


        <header>


            <div id="categories" data-tax="event-category" data-url="<?php echo pll_home_url(); ?>"
                 data-path="events">
		        <?php

		        $exclude = array();
		        $categories = get_terms( array(
			        'taxonomy'   => 'gc_eventcategory',
			        'hide_empty' => 1,
		        ) );

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

		        wp_dropdown_categories( array(
			        'show_option_all' => pll__( 'Filter events' ),
			        'value_field'     => 'slug',
			        'hide_if_empty'   => false,
			        'hide_empty'      => 1,
			        'hierarchical'    => 1,
			        'exclude'         => $exclude,
			        'taxonomy'        => 'gc_eventcategory',
			        'selected'        => get_queried_object()->slug
		        ) ); ?>
            </div>

            <h1><?php pll_e( 'Upcoming Events' ); ?></h1>

        </header>


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



