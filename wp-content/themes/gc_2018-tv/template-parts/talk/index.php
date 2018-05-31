<?php

if ( is_single() ) :


	get_template_part( 'template-parts/talk/single' );

else:
	get_template_part( 'template-parts/talk/list' );

endif;

?>