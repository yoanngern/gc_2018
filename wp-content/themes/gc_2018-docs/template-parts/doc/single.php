	<?php

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/doc/doc', 'single-gc_doc' );

		endwhile; ?>

	<?php

	else :

		get_template_part( 'template-parts/doc/none' );

	endif;
	?>

