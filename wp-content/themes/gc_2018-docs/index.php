<?php

$post_type = "";

if ( get_queried_object() instanceof WP_Post_Type ) {

	$post_type = get_queried_object()->name;

} else {

	$post_type = get_post_type( $_POST );

}

if ( $post_type == "gc_doc" ) {

	get_template_part( 'template-parts/doc/index' );

} else {

	get_template_part( 'template-parts/blog/index' );

}

?>



