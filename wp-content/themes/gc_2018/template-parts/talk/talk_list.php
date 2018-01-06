<?php if ( sizeof( $talks ) ): ?>


    <section class="talk_list">

        <div class="header">
            <div>
                <h1><?php echo $section_title; ?></h1>

				<?php if ( sizeof( $talks ) > 12 ): ?>
                    <a href="<?php echo $section_more; ?>" class="more">More talks</a>
				<?php endif; ?>
            </div>
        </div>

        <div class="list_container">
            <div class="talks">
				<?php foreach ( $talks as $talk ):

					$item['image']   = get_field( 'talk_picture', $talk );
					$item['title']   = get_field( 'title', $talk );
					$item['speaker'] = get_field( 'speaker', $talk );

					$item['link'] = esc_url( get_permalink( $talk ) );

					$item['date'] = complex_date( get_field( 'date', $talk ), get_field( 'date', $talk ) );

					set_query_var( 'item', $item );

					get_template_part( 'template-parts/talk/item' );

					?>

				<?php endforeach; ?>
            </div>
        </div>

    </section>
<?php endif; ?>