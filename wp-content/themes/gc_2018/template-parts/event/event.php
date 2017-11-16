<section id="content">

	<?php

	$title = get_the_title();
	$dates = complex_date( get_field( 'start' ), get_field( 'end' ) );
	$description = get_field('description', $_POST);

	$bg_image = get_field_or_parent( 'bg_image', $_POST, 'gc_eventcategory' );

	if ( ! $bg_image ) {

		$default_cat = get_term_by( 'slug', 'other', 'gc_eventcategory' );

		$bg_image = get_field( 'bg_image', $default_cat );

	}

	?>


    <article class="title"
             style="background-image: url('<?php echo $bg_image['sizes']['header']; ?>')">
        <div class="title">


            <h1 class="page-title"><span><?php echo $title; ?></span></h1>


        </div>

    </article>


    <div class="platter">


        <div class="nav">
            <a href="<?php echo get_post_type_archive_link( 'gc_event' ); ?>"
               class="back"><?php pll_e( 'Back' ) ?></a>

        </div>

        <article class="content-page">
            <time><?php echo $dates; ?></time>

	        <?php echo $description; ?>

        </article>


    </div>


</section>

