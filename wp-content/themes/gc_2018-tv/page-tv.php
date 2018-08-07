<?php /* Template Name: TV */ ?>

<?php get_header( 'tv' ); ?>

<section id="content" class="tv">

	<?php if ( get_field( 'bg_image' ) ): ?>

        <article class="title">
            <div class="image"
                 style="background-image: url('<?php echo get_field( 'bg_image' )['sizes']['home']; ?>')"></div>
            <div class="title">

                <h1 class="page-title">
                    <span class="txt"><?php echo get_field( 'title' ); ?></span>
                    <span class="underline"></span>
                </h1>
            </div>


        </article>

	<?php else: ?>

        <div class="spacer"></div>

	<?php endif; ?>


    <div class="platter">

		<?php


		?>

		<?php if ( have_rows( 'sections' ) ): ?>

			<?php while ( have_rows( 'sections' ) ): the_row();

				$talks = array();

				$type = get_sub_field( 'type' );

				$city     = null;
				$speaker  = null;
				$category = null;


				$link = get_post_type_archive_link( 'gc_talk' );



				if ( get_sub_field( 'speaker' ) ) {

					$speaker = get_sub_field( 'speaker' );

					$link = add_query_arg( array(
						'speaker' => $speaker->ID,
					), $link );

				}

				if ( get_sub_field( 'city' ) ) {

					$city = get_sub_field( 'city' );

					$link = add_query_arg( array(
						'city' => $city->ID,
					), $link );

				}

				if ( get_sub_field( 'category' ) ) {

					$category = get_sub_field( 'category' );

					$link = add_query_arg( array(
						'category' => $category->slug,
					), $link );
				}


				$talks = get_talks( 12, $city, $speaker, $category );

				$section_title = get_sub_field( 'title' );

				set_query_var( 'talks', $talks );
				set_query_var( 'section_title', $section_title );
				set_query_var( 'section_more', $link );

				get_template_part( 'template-parts/talk/talk_list' );


				?>

			<?php endwhile; ?>


		<?php endif; ?>


    </div>


</section>


<?php get_footer(); ?>

