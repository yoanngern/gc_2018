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


	$first = date( "Y-m-d H:i:s", strtotime( 'monday this week' ) );

	$last = date( "Y-m-d", strtotime( 'sunday this week' ) ) . ' 23:59:59';


	$dates = get_dates( $first, $last, false, false, true );

	?>


    <div class="platter" id="weekend">

        <section class="weekend">

			<?php

			$items = [];

			$days = array(
				'friday'   => array(
					'show' => false,
					'date' => strtotime( 'friday this week' ),
				),
				'saturday' => array(
					'show' => false,
					'date' => strtotime( 'saturday this week' ),
				),
				'sunday'   => array(
					'show' => false,
					'date' => strtotime( 'sunday this week' ),
				),
			);


			if ( $dates != null ):

				foreach ( $dates as $date ):

					$start = get_field( 'start', $date );
					$end   = get_field( 'end', $date );

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['friday']['date'] ) ) {
						$days['friday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['saturday']['date'] ) ) {
						$days['saturday']['show'] = true;
					}

					if ( date( 'Y-m-d', strtotime( $start ) ) == date( 'Y-m-d', $days['sunday']['date'] ) ) {
						$days['sunday']['show'] = true;
					}

					$location_obj = get_field( 'location', $date );

					if ( $location_obj != null ) {
						$location = get_the_title( $location_obj );
					} else {
						$location = "";
					}

					$item = array(
						'title'    => $date->post_title,
						'start'    => get_field( 'start', $date ),
						'end'      => get_field( 'end', $date ),
						'time'     => date( 'G:i', strtotime( get_field( 'start', $date ) ) ),
						'location' => $location,
						'object'   => $date,
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
											<?php if ( $item['location'] != "" ): ?>
                                                <p class="location"><?php echo $item['location'] ?></p>
											<?php endif; ?>
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
											<?php if ( $item['location'] != "" ): ?>
                                                <p class="location"><?php echo $item['location'] ?></p>
											<?php endif; ?>
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
											<?php if ( $item['location'] != "" ): ?>
                                                <p class="location"><?php echo $item['location'] ?></p>
											<?php endif; ?>
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

