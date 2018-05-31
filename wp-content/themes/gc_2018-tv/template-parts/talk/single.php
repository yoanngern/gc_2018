<?php get_header('tv'); ?>


<?php

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/talk/talk' );

	endwhile; ?>

	<?php

else :

	get_template_part( 'template-parts/talk/none' );

endif;
?>

<?php get_footer(); ?>