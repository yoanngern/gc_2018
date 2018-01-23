<section id="content" class="tv">

	<?php

	$talks = get_talks( '36', $post, null, null, null );

	?>

    <div class="platter">


        <article class="content-page">

            <section class="header">
                <h1><?php echo get_the_title(); ?></h1>

            </section>

            <section class="talks">

				<?php foreach ( $talks as $talk ):

					if ( get_field( 'talk_picture', $talk ) != null ) {
						$item['image']   = get_field( 'talk_picture', $talk );
					} else {

						$item['image']   = get_field( 'picture', get_field( 'speaker', $talk ) );
					}

					$item['title']   = get_field( 'title', $talk );
					$item['speaker'] = get_field( 'speaker', $talk );

					$item['link'] = esc_url( get_permalink( $talk ) );

					$item['date'] = complex_date( get_field( 'date', $talk ), get_field( 'date', $talk ) );

					set_query_var( 'item', $item );

					get_template_part( 'template-parts/talk/item' );

					?>

				<?php endforeach; ?>

            </section>

        </article>

    </div>


</section>

