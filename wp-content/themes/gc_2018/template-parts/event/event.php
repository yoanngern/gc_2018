<section id="content">

	<?php

	$location_obj = get_field( 'location', $_POST );

	if($location_obj != null) {
		$location    = get_the_title( $location_obj ) . "<br/>" . get_field( 'address', $location_obj ) . "<br/>" . get_field( 'zip_code', $location_obj ) . " " . get_field( 'city', $location_obj ) . "<br/>" . get_field( 'country', $location_obj );
    } else {
	    $location = "";
    }

	$title       = get_the_title();
	$dates       = complex_date( get_field( 'start' ), get_field( 'end' ) );
	$description = get_field( 'description', $_POST );
	$subtitle    = "Au coeur d’une culture";
	$times       = "9h30-10h30";

	$video       = get_field( 'event_video', $_POST );

	$button_url = get_field( 'button_url', $_POST );
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

                    <iframe class="video" width="1920" height="1080"
                            src="https://www.youtube.com/embed/5vP29nxEZCg?rel=0&amp;showinfo=0" frameborder="0"
                            allowfullscreen></iframe>
                </div>

                <div class="more">



	                <?php if ( $pres_page != null ): ?>
                        <a class="dynamic" href="<?php echo $pres_page->guid; ?>">découvrir <?php echo $pres_page->post_title; ?></a>
	                <?php endif; ?>

                    <div class="social">
                        <a class="social" id="Facebook" href="">Facebook</a>
                        <a class="social" id="twitter" href="">Twitter</a>
                    </div>
                </div>
            </main>

            <aside>
                <div class="content">
                    <time class="date"><?php echo $dates; ?></time>
                    <time class="time"><?php echo $times; ?></time>

	                <?php if ( $location_obj != null ): ?>
                        <h3>Lieu</h3>
                        <p target="_blank" class="address"><?php echo $location; ?></p>

                        <a class="direction" href="">Itinéraire</a>
                    <?php endif; ?>



					<?php if ( $button_url != null ): ?>
                        <a target="_blank" class="button" href="<?php echo $button_url ?>"><?php echo $button_label ?></a>
					<?php endif; ?>

	                <?php if ( $location_obj != null ): ?>
                        <a target="_blank" class="small" href="">ajouter au calendrier</a>
	                <?php endif; ?>


                </div>
            </aside>


        </article>


        <section class="content-default" id="related_events">
            <h1>prochaines dates à venir</h1>

            <ul>
                <li>
                    <a href="">
                        <time class="date"><?php echo $dates; ?></time>
                        <time class="time"><?php echo $times; ?></time>
                    </a>
                </li>
                <li>
                    <a href="">
                        <time class="date"><?php echo $dates; ?></time>
                        <time class="time"><?php echo $times; ?></time>
                    </a>
                </li>
                <li>
                    <a href="">
                        <time class="date"><?php echo $dates; ?></time>
                        <time class="time"><?php echo $times; ?></time>
                    </a>
                </li>
                <li>
                    <a href="">
                        <time class="date"><?php echo $dates; ?></time>
                        <time class="time"><?php echo $times; ?></time>
                    </a>
                </li>
            </ul>
        </section>


    </div>


</section>

