<section id="content" class="tv">

	<?php


	$title = get_field( 'title' );
	$date  = complex_date( get_field( 'date' ), get_field( 'date' ) );

	$video = get_iframe_video( get_field( 'video', $_POST ) );

	$audio = get_iframe_audio( get_field( 'audio', $_POST ) );

	$city = get_field( 'city', $_POST );


	$speaker = get_field( 'speaker', $_POST );


	?>

    <div class="platter">

        <main>


            <article class="content-page">

				<?php if ( $video ): ?>
                    <div class="video">
						<?php echo $video; ?>
                    </div>
				<?php endif; ?>

				<?php if ( $audio ): ?>
                    <div class="audio <?php if ( $video ) {
						echo 'hide';
					} ?>">
						<?php echo $audio; ?>
                    </div>
				<?php endif; ?>

                <div class="talk_desc">
					<?php if ( $audio & $video ): ?>
                        <a href="#switch_player" class="dynamic audio"><span class="audio"><?php _e('Talk in audio', 'gc_2018') ?></span><span
                                    class="video"><?php _e('Talk in video', 'gc_2018') ?></span></a>
					<?php endif; ?>
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


				<?php

				if ( $speaker ):

					$name = get_field( 'firstname', $speaker ) . " " . get_field( 'lastname', $speaker );
					$image = get_field( 'picture', $speaker );
					$bio = get_field( 'bio', $speaker );
					$title = get_field( 'title', $speaker );
					$link = esc_url( get_permalink( $speaker ) );

					?>

                    <div class="talk_speaker">
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

				<?php endif; ?>


            </article>

        </main>

        <aside>

			<?php

			$exclude[] = get_the_ID();

			$talks = get_talks( 12, null, $speaker, null, $exclude );

			$section_title = "d'autres messages";

			set_query_var( 'talks', $talks );
			set_query_var( 'section_title', $section_title );

			get_template_part( 'template-parts/talk/talk_list' );

			?>

        </aside>


    </div>


</section>

