<article class="content-page">
    <div class="content">

		<?php

		if ( is_tax( 'gc_doccategory' ) ) {
			$title = get_queried_object()->name;
		} else {
			$title = "Docs";
		}

		echo '<h1>' . $title . '</h1>';

		?>

        <div class="docs">
            <div class="table">
			<?php while ( have_posts() ) :
				the_post();

				set_query_var( 'doc', $post );

				get_template_part( 'template-parts/doc/item' );

			endwhile; ?>
            </div>

            <nav class="nav">
                <div class="previous"><?php previous_posts_link( __('Previous', 'gc_2018') ); ?></div>
                <div class="next"><?php next_posts_link( __('Next', 'gc_2018') ); ?></div>
            </nav>
        </div>

    </div>

</article>
