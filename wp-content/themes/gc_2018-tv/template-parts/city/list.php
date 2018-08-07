<?php get_header('tv'); ?>


<section id="content">

	<?php


	$bg_image = get_field( 'bg_image', $_POST );

	$title = __('Cities', 'gc_2018');

	?>

    <article class="title">

        <div class="image"
             style="background-image: url('<?php echo $bg_image['sizes']['header']; ?>')"></div>
        <div class="title">

            <h1 class="page-title">
                <span class="txt"><?php echo $title; ?></span>
                <span class="underline"></span>
            </h1>

        </div>
    </article>


    <div class="platter">


		<?php


		if ( have_posts() ) : ?>


            <section id="listOfTalks" class="small" data-nb="3">
                <article class="content-page">


					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						set_query_var( 'talk', $_POST );

						get_template_part( 'template-parts/talk/item' );

					endwhile; ?>

                </article>
            </section>


            <nav class="nav">
                <div class="previous"><?php previous_posts_link( __('Previous', 'gc_2018') ); ?></div>
                <div class="next"><?php next_posts_link( __('Next', 'gc_2018') ); ?></div>
            </nav>

			<?php

		else :

			get_template_part( 'template-parts/talk/none' );

		endif;
		?>

    </div>


</section>


<?php get_footer(); ?>




