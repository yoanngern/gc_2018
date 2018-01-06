<?php /* Template Name: TV */ ?>

<?php get_header(); ?>

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

				if ( in_array( 'last', $type ) ) {

				}

				if ( in_array( 'city', $type ) ) {

					$city = get_sub_field( 'city' );

				}

				if ( in_array( 'speaker', $type ) ) {

					$speaker = get_sub_field( 'speaker' );
				}

				if ( in_array( 'category', $type ) ) {

					$category = get_sub_field( 'category' );
				}


				$talks = get_talks( 12, $city, $speaker, $category );


				$section_title = get_sub_field( 'title' );


				set_query_var( 'talks', $talks );
				set_query_var( 'section_title', $section_title );

				get_template_part( 'template-parts/talk/talk_list' );


				?>

			<?php endwhile; ?>


		<?php endif; ?>


    </div>


</section>


<?php get_footer(); ?>

