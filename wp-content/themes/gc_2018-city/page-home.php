<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

<section id="content">

	<?php if ( get_field( 'bg_image' ) ): ?>

        <article class="title">
            <div class="image"
                 style="background-image: url('<?php echo get_field( 'bg_image' )['sizes']['home']; ?>')"></div>
            <div class="title">

                <h1 class="page-title">
                    <span class="txt"><?php echo get_field( 'title' ); ?></span>
                    <span class="underline"></span>
                </h1>

	            <?php print_buttons('weekend_buttons', $_POST) ?>

            </div>

            <div class="footer">
                <a href="#events"></a>
            </div>


        </article>

	<?php else: ?>

        <div class="spacer"></div>

	<?php endif; ?>


    <div class="platter">


		<?php

		$today = date( 'Y-m-d H:i:s' );

		$events = wp_get_recent_posts( array(
			'numberposts'      => 3,
			'offset'           => 0,
			'orderby'          => 'meta_value',
			'meta_key'         => 'start',
			'order'            => 'asc',
			'meta_query'       => array(
				'relation' => 'AND',
				array(
					'key'     => 'end',
					'compare' => '>=',
					'value'   => $today,
				),
				array(
					'key'     => 'events_show',
					'compare' => '=',
					'value'   => true,
				)
			),
			'post_type'        => 'gc_event',
			'suppress_filters' => true

		), OBJECT );

		if ( $events != null && get_field( 'events_show' ) ) : ?>

            <article id="events" class="home-default">
                <section id="listOfEvents" class="small" data-nb="3">
                    <h1 class="title"><span><?php _e( 'Events', 'gc_2018' ) ?></span></h1>
                    <article class="content-page events_table">

						<?php foreach ( $events as $event ) :


							set_query_var( 'event', $event );
							get_template_part( 'template-parts/event/item' );

						endforeach; ?>

                    </article>


                </section>


                    <a class="dynamic" href="<?php echo get_post_type_archive_link( 'gc_event' ); ?>"><?php _e( 'More events', 'gc_2018' ) ?></a>

	                <?php print_buttons('event_buttons', $_POST) ?>

            </article>

		<?php endif; ?>

		<?php if ( have_rows( 'gcfamily' ) && get_field( 'gcfamily_show' ) ): ?>
            <article id="gcfamily" class="home-default">
                <h1 class="title"><span><?php echo get_field( 'gcfamily_title' ) ?></span></h1>
                <h4><?php echo get_field( 'gcfamily_subtitle' ) ?></h4>

                <ul class="dynamic">
					<?php while ( have_rows( 'gcfamily' ) ): the_row();

						$link     = get_sub_field( 'link' );
						$title    = get_sub_field( 'title' );
						$subtitle = get_sub_field( 'subtitle' );

						?>
                        <li>
                            <a href="<?php echo $link; ?>">
                                <h1 class="date"><?php echo $title; ?></h1>
                                <h2 class="time"><?php echo $subtitle; ?></h2>
                                <span class="top"></span>
                                <span class="right"></span>
                                <span class="bottom"></span>
                                <span class="left"></span>
                            </a>
                        </li>


					<?php endwhile; ?>
                </ul>
            </article>
		<?php endif; ?>


		<?php if ( have_rows( 'next_step' ) && get_field( 'next_step_show' ) ): ?>
            <article id="next_step" class="home-default">
                <h1 class="title"><span><?php echo get_field( 'next_step_title' ) ?></span></h1>
                <h4><?php echo get_field( 'next_step_subtitle' ) ?></h4>

                <ul class="wall_image">
					<?php while ( have_rows( 'next_step' ) ): the_row();

						$link  = get_sub_field( 'link' );
						$title = get_sub_field( 'title' );
						$image = get_sub_field( 'image' )['sizes']['summary'];

						?>


                        <li>
                            <a href="<?php echo $link; ?>">
                                <div class="hover"></div>
                                <h1 class="date"><?php echo $title; ?></h1>
                                <div class="image" style="background-image: url('<?php echo $image; ?>')"></div>
                            </a>
                        </li>


					<?php endwhile; ?>
                </ul>
            </article>
		<?php endif; ?>

		<?php if ( get_field( 'tv_show' ) ): ?>
            <article class="home-default" id="tv">
                <h1 class="title"><span><?php echo get_field( 'tv_title' ) ?></span></h1>

				<?php

				$city = get_field( 'home_talks' );
				$more = get_field( 'tv_link' );

				$items = get_last_talks( $city );


				?>

                <section class="talks">

					<?php foreach ( $items as $item ):


						?>

                        <div class="talk_item">
                            <a class="talk_container" href="<?php echo $item['link']; ?>">

                                <div class="image">
                                    <div class="bg"
                                         style="background-image: url('<?php echo $item['image']['sizes']['summary'] ?>')"></div>
                                </div>

                                <div class="text">
                                    <h1><?php echo $item['title']; ?></h1>
                                    <time><?php echo $item['date']; ?></time>
                                </div>
                            </a>
                        </div>


					<?php endforeach; ?>

                </section>

				<?php print_buttons('tv_buttons', $_POST) ?>

            </article>
		<?php endif; ?>



		<?php if ( have_rows( 'life_church' ) && get_field( 'life_church_show' ) ): ?>
            <article id="church_life" class="home-default">
                <div class="left">
                    <h1><?php echo get_field( 'life_church_title' ) ?></h1>
                </div>

                <div class="right">

					<?php while ( have_rows( 'life_church' ) ):
						the_row();

						$link  = get_sub_field( 'link' );
						$title = get_sub_field( 'title' );

						?>

                        <p>
                            <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                        </p>

					<?php endwhile; ?>
                </div>

            </article>
		<?php endif; ?>


		<?php if ( get_field( 'news_show' ) ): ?>
            <article class="home-default" id="news">
                <h1><?php echo get_field( 'news_title' ) ?></h1>

				<?php

				$form_id = get_field( 'form_id' );

				?>

                <div class="form">
					<?php echo do_shortcode( '[mc4wp_form id="' . $form_id . '"]' ); ?>
                </div>
            </article>
		<?php endif; ?>


    </div>


</section>


<?php get_footer(); ?>

