<?php

$doc       = get_query_var( 'doc' );

if ( $doc != null ) :


	$id = $doc->id;
	$title = get_the_title( $doc );
	$link  = esc_url( get_permalink( $doc ) );
	$text = get_the_excerpt();

	$image = get_field_or_parent( 'doc_picture', $id, 'gc_doccategory' );

	?>


    <div class="doc">
        <a href="<?php echo $link; ?>">
            <div class="image" style="background-image: url('<?php echo $image['sizes']['hd'] ?>')"></div>
            <h2><?php echo $title; ?></h2>
        </a>
    </div>

<?php endif; ?>