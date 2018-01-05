<section id="content" class="tv">

	<?php


	$title = get_field( 'title' );
	$date  = complex_date( get_field( 'date' ), get_field( 'date' ) );

	$video = get_field( 'video', $_POST );

	$city = get_field( 'city', $_POST );


	$speakers = get_field( 'speaker', $_POST );


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


	?>

    <div class="platter">

        <main>


            <article class="content-page">

                <div class="video">

					<?php echo $video; ?>
                </div>

                <div class="talk_desc">
                    <h1><?php echo $title; ?></h1>

                    <time><?php echo $date; ?></time>

                    <div class="more">

                        <div class="social">
                            <a class="social" id="facebook" target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>">Facebook</a>
                            <a class="social" id="twitter" target="_blank"
                               href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ) ?>&text=<?php echo $title . ' // ' . $dates ?>&original_referer=<?php echo urlencode( get_permalink() ) ?>">Twitter</a>
                        </div>
                    </div>
                </div>

                <div class="speakers">

					<?php foreach ( $speakers as $speaker ):

						$name = get_field( 'firstname', $speaker ) . " " . get_field( 'lastname', $speaker );
						$image = get_field( 'picture', $speaker );
						$bio = get_field( 'bio', $speaker );
						$title = get_field( 'title', $speaker );
						$link = esc_url( get_permalink( $speaker ) );

						?>

                        <div class="speaker">
                            <a class="photo" href="<?php echo $link ?>">
                                <div class="image">
                                    <div class="bg"
                                         style="background-image: url('<?php echo $image['sizes']['speaker'] ?>')"></div>
                                </div>
                            </a>
                            <div class="pres">
                                <h1><a href="<?php echo $link ?>"><?php echo $name ?></a></h1>
                                <h2><?php echo $title ?></h2>
                                <p><?php echo $bio; ?></p>
                            </div>

                        </div>

					<?php endforeach; ?>
                </div>


            </article>

        </main>

        <aside>

			<?php

			$exclude[] = get_the_ID();

			$talks = get_talks( 12, null, $speakers[0], null, $exclude );

			$section_title = "d'autres vidéos";

			set_query_var( 'talks', $talks );
			set_query_var( 'section_title', $section_title );

			get_template_part( 'template-parts/talk/talk_list' );

			?>

        </aside>


    </div>


</section>

