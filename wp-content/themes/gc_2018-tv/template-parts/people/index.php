<?php

if ( is_single() ) :


	get_template_part( 'template-parts/people/single' );

else:
	get_template_part( 'template-parts/people/list' );

endif;

?>