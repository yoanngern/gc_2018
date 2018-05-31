<?php get_header(); ?>

<section id="content">

	<?php if ( get_field( 'bg_image' ) ): ?>

        <article class="title">
            <div class="image"
                 style="background-image: url('<?php echo get_field( 'bg_image' )['sizes']['header']; ?>')"></div>

        </article>

	<?php else: ?>

        <div class="spacer"></div>

	<?php endif; ?>

    <div class="platter">

	    <?php if ( is_active_sidebar( 'left_sidebar' ) ) : ?>
            <div id="left-sidebar" class="left-sidebar widget-area">
			    <?php dynamic_sidebar( 'left_sidebar' ); ?>
            </div>
	    <?php endif; ?>


		<?php
		// TO SHOW THE PAGE CONTENTS
		while ( have_posts() ) : the_post(); ?>
            <article class="content-page">


				<?php
				echo '<div class="content">';
				the_title("<h1>","</h1>");
				the_content();
				echo '</div>';
				?> <!-- Page Content -->

            </article>


			<?php
		endwhile; //resetting the page loop
		wp_reset_query(); //resetting the page query
		?>


    </div>


</section>


<?php get_footer(); ?>

