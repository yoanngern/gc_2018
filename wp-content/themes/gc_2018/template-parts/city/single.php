<?php get_header(); ?>

<?php

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/city/city', 'single-gc_city' );

	endwhile; ?>

	<?php

else :

	get_template_part( 'template-parts/event/none' );

endif;
?>

<?php get_footer(); ?>