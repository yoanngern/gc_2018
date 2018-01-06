<?php get_header( 'tv' ); ?>

    <section id="content" class="tv">

		<?php


		?>

        <div class="platter">


            <article class="content-page">

                <section class="header">
                    <h1>Speakers</h1>

                </section>

                <section class="speakers">

					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						set_query_var( 'speaker', $_POST );

						get_template_part( 'template-parts/people/item' );

					endwhile; ?>

                </section>

            </article>

            <nav class="nav">
                <div class="previous"><?php previous_posts_link( pll__('Previous') ); ?></div>
                <div class="next"><?php next_posts_link( pll__('Next') ); ?></div>
            </nav>
        </div>


    </section>

<?php get_footer(); ?>