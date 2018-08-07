<article class="content-page">
    <div class="content">

		<?php
		the_title( "<h1>", "</h1>" );

		the_content();

		//the_date('j.m.Y','<time>','</time>');
		?>

    </div>
</article>


<?php

if ( have_rows( 'resources' ) ): ?>

    <div id="right-sidebar" class="right-sidebar">
        <div id="resources">
            <h4><?php _e('Resources', 'gc_2018') ?></h4>
            <ul class="resources">
				<?php while ( have_rows( 'resources' ) ): the_row();

					$link = get_sub_field( 'link' );
					$file = get_sub_field( 'file' );

					if ( $file != null ) {

						$title = $file['title'];
						$url   = $file['url'];
						$type  = $file['subtype'];

					} else if ( $link != null ) {

						$title = $link['title'];
						$url   = $link['url'];
						$type  = 'link';

					} else {
					    return;
                    }


					?>

                    <li class="<?php echo $type; ?>">
                        <a target="_blank" href="<?php echo $url; ?>"><?php echo $title ?></a>
                    </li>


				<?php endwhile; ?>
            </ul>
        </div>
    </div>

<?php endif; ?>