<section id="content">

	<?php

	$location_obj = get_field( 'location', $_POST );

	if ( $location_obj != null ) {
		$location = get_the_title( $location_obj ) . "<br/>" . get_field( 'address', $location_obj ) . "<br/>" . get_field( 'zip_code', $location_obj ) . " " . get_field( 'city', $location_obj ) . "<br/>" . get_field( 'country', $location_obj );
	} else {
		$location = "";
	}


	$title       = get_the_title();
	$dates       = complex_date( get_field( 'start' ), get_field( 'end' ) );
	$description = get_field( 'description', $_POST );
	$subtitle    = get_field( 'event_subtitle', $_POST );
	$times       = "9h30-10h30";


	$video = get_field( 'event_video', $_POST );

	// use preg_match to find iframe src
	preg_match( '/src="(.+?)"/', $video, $matches );
	$src = $matches[1];

	$params = array(
		'controls'       => 1,
		'hd'             => 1,
		'autohide'       => 1,
		'rel'            => 0,
		'showinfo'       => 0,
		'color'          => 'e52639',
		'title'          => 0,
		'byline'         => 0,
		'portrait'       => 0,
		'data-show-text' => 0
	);


	$new_src = add_query_arg( $params, $src );

	$video = str_replace( $src, $new_src, $video );

	$attributes = 'frameborder="0"';

	$video = str_replace( '></iframe>', ' ' . $attributes . 'class="video"></iframe>', $video );


	$button_url   = get_field( 'button_url', $_POST );
	$button_label = get_field( 'button_label', $_POST );

	$pres_page = get_field( 'presentation_page', $_POST );


	$bg_image = get_field_or_parent( 'bg_image', $_POST, 'gc_eventcategory' );

	if ( ! $bg_image ) {

		$default_cat = get_term_by( 'slug', 'other', 'gc_eventcategory' );

		$bg_image = get_field( 'bg_image', $default_cat );

	}

	?>


    <article class="title">
        <div class="image" style="background-image: url('<?php echo $bg_image['sizes']['header']; ?>')"></div>
        <div class="title">

            <h1 class="page-title">
                <span class="txt"><?php echo $title; ?></span>
                <span class="underline"></span>
            </h1>


        </div>

    </article>


    <div class="platter">

        <div class="nav">
            <a href="<?php echo get_post_type_archive_link( 'gc_event' ); ?>"
               class="back"><?php pll_e( 'Back' ) ?></a>

        </div>

        <article class="content-page">

            <main>
                <div class="content">
                    <h1><?php echo $subtitle; ?></h1>
					<?php echo $description; ?>
                </div>
                <div class="video">

					<?php echo $video; ?>
                </div>

                <div class="more">


					<?php if ( $pres_page != null ): ?>
                        <a class="dynamic"
                           href="<?php echo $pres_page->guid; ?>"><?php pll_e( 'découvrir' ) ?><?php echo " " . $pres_page->post_title; ?></a>
					<?php endif; ?>

                    <div class="social">
                        <a class="social" id="facebook" target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>">Facebook</a>
                        <a class="social" id="twitter" target="_blank"
                           href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ) ?>&text=<?php echo $title . ' // ' . $dates ?>&original_referer=<?php echo urlencode( get_permalink() ) ?>">Twitter</a>
                    </div>
                </div>
            </main>

            <aside>
                <div class="content">
                    <time class="date"><?php echo $dates; ?></time>
                    <time class="time"><?php echo $times; ?></time>

					<?php if ( $location_obj != null ): ?>
                        <h3><?php pll_e( 'Lieu' ) ?></h3>
                        <p class="address"><?php echo $location; ?></p>

                        <a target="_blank" class="direction" href=""><?php pll_e( 'Itinéraire' ) ?></a>
					<?php endif; ?>



					<?php if ( $button_url != null ): ?>
                        <a target="_blank" class="button"
                           href="<?php echo $button_url ?>"><?php echo $button_label ?></a>
					<?php endif; ?>

					<?php if ( $location_obj != null ): ?>
                        <a target="_blank" class="small" href=""><?php pll_e( 'ajouter au calendrier' ) ?></a>
					<?php endif; ?>


                </div>
            </aside>


        </article>


		<?php


		$categories = [];

		foreach ( get_the_terms( $_POST, 'gc_eventcategory' ) as $cat ) {
			$categories[] = $cat->slug;
		}

		$query = new WP_Query( array(
			'post_type'    => 'gc_event',
			'showposts'    => 5,
			'post__not_in' => array( get_the_ID() ),
			'tax_query'    => array(
				array(
					'taxonomy' => 'gc_eventcategory',
					'field'    => 'slug',
					'terms'    => $categories
				)
			)

		) );


		$events = $query->get_posts();


		?>


        <section class="content-default" id="related_events">
            <h1><?php pll_e( 'prochaines dates à venir' ) ?></h1>

            <ul>
				<?php foreach ( $events as $event ):

					$e_dates = complex_date( get_field( 'start', $event ), get_field( 'end', $event ) );
					$e_times = "9h30-10h30";
					$e_link = $event->guid;

					?>
                    <li>
                        <a href="<?php echo $e_link; ?>">
                            <time class="date"><?php echo $e_dates; ?></time>
                            <time class="time"><?php echo $e_times; ?></time>
                            <span class="top"></span>
                            <span class="right"></span>
                            <span class="bottom"></span>
                            <span class="left"></span>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
        </section>


    </div>


</section>

