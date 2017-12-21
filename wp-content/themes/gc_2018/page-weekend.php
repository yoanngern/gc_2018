<?php /* Template Name: Weekend */ ?>

<?php get_header(); ?>

<section id="content">

	<?php if ( get_field( 'bg_image' ) ): ?>

        <article class="title">
            <div class="image"
                 style="background-image: url('<?php echo get_field( 'bg_image' )['sizes']['header']; ?>')"></div>
            <div class="title">

                <h1 class="page-title">
                    <span class="txt"><?php echo get_the_title(); ?></span>
                    <span class="underline"></span>
                </h1>


            </div>

        </article>

	<?php else: ?>

        <div class="spacer"></div>

	<?php endif; ?>


	<?php


	$first = date( "Y-m-d H:i:s", strtotime( 'last monday' ) );

	$last = date( "Y-m-d", strtotime( 'next sunday' ) ) . ' 23:59:59';


	$events = wp_get_recent_posts( array(
		'numberposts'      => 12,
		'offset'           => 0,
		'orderby'          => 'meta_value',
		'meta_key'         => 'start',
		'order'            => 'asc',
		'meta_query'       => array(
			'relation' => 'AND',
			array(
				'key'     => 'end',
				'compare' => '>=',
				'value'   => $first,
			),
			array(
				'key'     => 'start',
				'compare' => '<=',
				'value'   => $last,
			),
			array(
				'key'     => 'weekend_prog',
				'compare' => '=',
				'value'   => true,
			)
		),
		'post_type'        => 'gc_event',
		'suppress_filters' => true

	), OBJECT );

	$services = wp_get_recent_posts( array(
		'numberposts'      => 12,
		'offset'           => 0,
		'orderby'          => 'meta_value',
		'meta_key'         => 'start',
		'order'            => 'asc',
		'meta_query'       => array(
			'relation' => 'AND',
			array(
				'key'     => 'end',
				'compare' => '>=',
				'value'   => $first,
			),
			array(
				'key'     => 'start',
				'compare' => '<=',
				'value'   => $last,
			)
		),
		'post_type'        => 'gc_service',
		'suppress_filters' => true

	), OBJECT );


	?>


    <div class="platter" id="weekend">

        <section class="weekend">

			<?php

			$items = [];

			$days = array(
				'friday'   => array(
					'show' => false,
					'date' => strtotime( 'next friday' ),
				),
				'saturday' => array(
					'show' => false,
					'date' => strtotime( 'next saturday' ),
				),
				'sunday'   => array(
					'show' => false,
					'date' => strtotime( 'next sunday' ),
				),
			);


			if ( $events != null ):
				foreach ( $events as $event ):

					$start = get_field( 'start', $event );
					$end   = get_field( 'end', $event );

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['friday']['date'] ) ) {
						$days['friday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['saturday']['date'] ) ) {
						$days['saturday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['sunday']['date'] ) ) {
						$days['sunday']['show'] = true;
					}

					$location_obj = get_field( 'location', $event );

					if ( $location_obj != null ) {
						$location = get_the_title( $location_obj );
					} else {
						$location = "";
					}

					$item = array(
						'title'    => $event->post_title,
						'start'    => get_field( 'start', $event ),
						'end'      => get_field( 'end', $event ),
						'time'     => date( 'G:i', strtotime( get_field( 'start', $event ) ) ),
						'location' => $location,
						'object'   => $event,
					);

					$items[] = $item;

				endforeach;
			endif;

			if ( $services != null ):
				foreach ( $services as $service ):

					$start = get_field( 'start', $service );
					$end   = get_field( 'end', $service );

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['friday']['date'] ) ) {
						$days['friday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['saturday']['date'] ) ) {
						$days['saturday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['sunday']['date'] ) ) {
						$days['sunday']['show'] = true;
					}

					$location_obj = get_field( 'location', $service );

					if ( $location_obj != null ) {
						$location = get_the_title( $location_obj );
					} else {
						$location = "";
					}

					$item = array(
						'title'    => $service->post_title,
						'start'    => get_field( 'start', $service ),
						'end'      => get_field( 'end', $service ),
						'time'     => date( 'G:i', strtotime( get_field( 'start', $service ) ) ),
						'location' => $location,
						'object'   => $service,
					);

					$items[] = $item;

				endforeach;
			endif;

			?>

			<?php if ( sizeof( $items ) != 0 ): ?>

                <div class="container">

					<?php if ( $days['friday']['show'] ): ?>
                        <article>
                            <header>
                                <div>
                                    <h1><?php echo date_i18n( 'l', $days['friday']['date'] ) ?></h1>
                                    <time><?php echo date_i18n( 'j F', $days['friday']['date'] ) ?></time>
                                </div>
                            </header>
                            <div class="content">

								<?php
								foreach ( $items as $item ):

									if ( date( 'Y-m-d', strtotime( $item['start'] ) ) == date( 'Y-m-d', $days['friday']['date'] ) ):


										?>

                                        <div class="item">
                                            <time><?php echo $item['time'] ?></time>
                                            <h2><?php echo $item['title'] ?></h2>
                                            <p><?php echo $item['location'] ?></p>
                                        </div>


									<?php endif;

								endforeach;
								?>

                            </div>
                        </article>
					<?php endif; ?>

					<?php if ( $days['saturday']['show'] ): ?>
                        <article>
                            <header>
                                <div>
                                    <h1><?php echo date_i18n( 'l', $days['saturday']['date'] ) ?></h1>
                                    <time><?php echo date_i18n( 'j F', $days['saturday']['date'] ) ?></time>
                                </div>
                            </header>
                            <div class="content">

								<?php
								foreach ( $items as $item ):

									if ( date( 'Y-m-d', strtotime( $item['start'] ) ) == date( 'Y-m-d', $days['saturday']['date'] ) ):


										?>

                                        <div class="item">
                                            <time><?php echo $item['time'] ?></time>
                                            <h2><?php echo $item['title'] ?></h2>
                                            <p><?php echo $item['location'] ?></p>
                                        </div>


									<?php endif;

								endforeach;
								?>
                            </div>
                        </article>
					<?php endif; ?>

					<?php if ( $days['sunday']['show'] ): ?>
                        <article>
                            <header>
                                <div>
                                    <h1><?php echo date_i18n( 'l', $days['sunday']['date'] ) ?></h1>
                                    <time><?php echo date_i18n( 'j F', $days['sunday']['date'] ) ?></time>
                                </div>
                            </header>
                            <div class="content">

								<?php
								foreach ( $items as $item ):

									if ( date( 'Y-m-d', strtotime( $item['start'] ) ) == date( 'Y-m-d', $days['sunday']['date'] ) ):


										?>

                                        <div class="item">
                                            <time><?php echo $item['time'] ?></time>
                                            <h2><?php echo $item['title'] ?></h2>
                                            <p><?php echo $item['location'] ?></p>
                                        </div>

									<?php endif;

								endforeach;
								?>
                            </div>
                        </article>
					<?php endif; ?>


                </div>

			<?php else: ?>

                <div class="empty">
                    <h1>There is no event this weekend</h1>
                </div>


			<?php endif; ?>


        </section>


		<?php
		// TO SHOW THE PAGE CONTENTS
		while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
            <article class="content-page">


				<?php

				if ( get_the_content() != null ) {
					echo '<div class="content">';
					the_content();
					echo '</div>';
				}


				?> <!-- Page Content -->

            </article><!-- .entry-content-page -->


			<?php
		endwhile; //resetting the page loop
		wp_reset_query(); //resetting the page query
		?>


    </div>


</section>


<?php get_footer(); ?>

