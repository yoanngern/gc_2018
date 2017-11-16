<?php


if ( get_post_type( $_POST ) == "gc_event" ):

	get_template_part( 'template-parts/event/index' );

else:

	get_template_part( 'template-parts/blog/index' );

endif;

?>



