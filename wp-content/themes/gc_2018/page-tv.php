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


				?>

				<?php if ( sizeof( $talks ) ): ?>


                    <section class="talk_list">

                        <div class="header">
                            <h1><?php echo $section_title; ?></h1>
                        </div>

                        <div class="list_container">
                            <div class="talks">
								<?php foreach ( $talks as $talk ):

									$image = get_field( 'talk_picture', $talk );
									$title = get_field( 'title', $talk );
									$speaker = get_field( 'speaker', $talk );

									$link = esc_url( get_permalink( $talk ) );

									$date = complex_date( get_field( 'date', $talk ), get_field( 'date', $talk ) );

									?>

                                    <div class="talk">
                                        <a class="talk_container" href="<?php echo $link; ?>">

                                            <div class="image">
                                                <div class="bg"
                                                     style="background-image: url('<?php echo $image['sizes']['summary'] ?>')"></div>
                                            </div>

                                            <div class="text">
                                                <h1><?php echo $title; ?></h1>
                                                <time><?php echo $date; ?></time>
                                            </div>
                                        </a>


                                    </div>

								<?php endforeach; ?>
                            </div>
                        </div>

                    </section>
				<?php endif; ?>

			<?php endwhile; ?>


		<?php endif; ?>


    </div>


</section>


<?php get_footer(); ?>

