<?php

if ( is_single() ) :


	get_template_part( 'template-parts/city/single' );

else:
	get_template_part( 'template-parts/city/list' );

endif;

?>