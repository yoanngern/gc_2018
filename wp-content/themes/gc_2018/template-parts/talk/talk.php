<section id="content">

	<?php


	$title = get_field( 'title' );
	$date  = complex_date( get_field( 'date' ), get_field( 'date' ) );

	$video = get_field( 'video', $_POST );

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


    <div class="header">

    </div>


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




            </article>

        </main>

        <aside>


        </aside>


    </div>


</section>

