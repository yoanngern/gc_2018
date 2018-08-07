<?php get_header(); ?>

    <section id="content">

		<?php


		if ( is_tax( 'gc_doccategory' ) ) {

			$bg_image = get_field_or_parent( 'bg_image', get_queried_object(), 'gc_doccategory' );

		} else if ( get_queried_object()->name == "gc_doc" ) {

			$bg_image = null;

		} else {

			$bg_image = get_field_or_parent( 'bg_image', get_queried_object(), 'gc_doccategory' );
		}

		?>

		<?php if ( $bg_image ): ?>

            <article class="title">
                <div class="image"
                     style="background-image: url('<?php echo $bg_image['sizes']['header']; ?>')"></div>

            </article>

		<?php else: ?>

            <div class="spacer"></div>

		<?php endif; ?>

        <div class="platter">

            <div id="left-sidebar" class="left-sidebar">
                <h4><a href="<?php echo get_post_type_archive_link( 'gc_doc' ); ?>"><?php _e('Categories', 'gc_2018') ?></a></h4>
                <ul class="doc_categories category_filter">
					<?php

					$curr_cats = array();

					if ( is_tax( 'gc_doccategory' ) ) {

						$queried_object = get_queried_object();

						$categories = null;

						if ( $queried_object instanceof WP_Term ) {
							$curr_cats[] = $queried_object->term_id;
						}

					} else if ( get_queried_object()->name == "gc_doc" ) {

					} else {
						$categories = get_the_terms( $post->ID, 'gc_doccategory' );

						if ( $categories != null ) {
							foreach ( $categories as $cat ) {
								$curr_cats[] = $cat->term_id;
							}
						}
					}

					$terms = get_terms( array(
						'taxonomy' => 'gc_doccategory',
						//'hide_empty' => false,
					) );

					$curr_parents = null;

					foreach ( $curr_cats as $curr_cat ) {

						$ancestors = get_ancestors( $curr_cat, 'gc_doccategory' );

						foreach ( $ancestors as $ancestor ) {
							$curr_parents[] = $ancestor;
						}

					}

					if($curr_parents != null) {

						foreach ( $curr_parents as $curr_parent ) {
							$curr_cats[] = $curr_parent;
						}
					}


					wp_list_categories( array(
						'orderby'          => 'name',
						'taxonomy'         => 'gc_doccategory',
						'current_category' => $curr_cats,
						'title_li'         => '',
						'hierarchical'     => true,
					) );

					?>


                </ul>
            </div>


			<?php

			if ( is_single() ) :


				get_template_part( 'template-parts/doc/single' );

			else:
				get_template_part( 'template-parts/doc/list' );

			endif;

			?>


        </div>


    </section>

<?php get_footer(); ?>