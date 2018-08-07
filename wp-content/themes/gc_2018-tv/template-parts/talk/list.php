<?php get_header( 'tv' );

$speaker  = null;
$city     = null;
$category = null;

$nb_filter = 0;
$title     = __( 'All talks', 'gc_2018' );

if ( isset( $_GET['speaker'] ) ) {

	$speaker_id = $_GET['speaker'];

	$speaker = get_post( $speaker_id );

	if ( $speaker ) {
		$nb_filter ++;


	}

}


if ( isset( $_GET['city'] ) ) {

	$city_id = $_GET['city'];

	$city = get_post( $city_id );

	if ( $city ) {
		$nb_filter ++;

		$title = $city->post_title;
	}

}


if ( isset( $_GET['category'] ) ) {

	$category_slug = $_GET['category'];

	$category = get_term_by( 'slug', $category_slug, 'gc_talkcategory' );

	if ( $category ) {
		$nb_filter ++;

		$title = $category->name;
	}

}


?>

    <section id="content" class="tv">

        <div class="platter">


            <article class="content-page">

                <section class="header">


					<?php if ( $nb_filter <= 1 ): ?>
                        <h1><?php echo $title; ?></h1>
					<?php endif; ?>


					<?php if ( $nb_filter > 1 ): ?>

                        <h1><?php _e( 'Talks selection', 'gc_2018' ) ?></h1>

                        <ul>
							<?php

							if ( $city ) {


								echo "<li>" . __( 'City', 'gc_2018' ) . ": " . $city->post_title . "</li>";
							}

							if ( $speaker ) {
								echo "<li>" . __( 'Speaker', 'gc_2018' ) . ": " . $speaker->post_title . "</li>";
							}

							if ( $category ) {
								echo "<li>" . __( 'Category', 'gc_2018' ) . ": " . $category->name . "</li>";
							}

							?>

                        </ul>

					<?php endif; ?>


                </section>

                <section class="talks">

					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						if ( get_field( 'talk_picture' ) != null ) {
							$item['image']   = get_field( 'talk_picture' );
						} else {

							$item['image']   = get_field( 'picture', get_field( 'speaker' ) );
						}


						$item['title']   = get_field( 'title' );
						$item['speaker'] = get_field( 'speaker' );

						$item['link'] = esc_url( get_permalink( $post ) );

						$item['date'] = complex_date( get_field( 'date' ), get_field( 'date' ) );

						set_query_var( 'item', $item );

						get_template_part( 'template-parts/talk/item' );

					endwhile; ?>

                </section>

            </article>

            <nav class="nav">
                <div class="previous"><?php previous_posts_link( __( 'Previous', 'gc_2018' ) ); ?></div>
                <div class="next"><?php next_posts_link( __( 'Next', 'gc_2018' ) ); ?></div>
            </nav>
        </div>


    </section>

<?php get_footer(); ?>