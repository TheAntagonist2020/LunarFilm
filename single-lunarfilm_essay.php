<?php
/**
 * Template for displaying single film essay
 *
 * @package LUNARFILM
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				
				<div class="entry-meta">
					<?php
					$director = get_post_meta( get_the_ID(), '_lunarfilm_director', true );
					$year     = get_post_meta( get_the_ID(), '_lunarfilm_year', true );

					if ( $director || $year ) {
						echo '<span class="film-info">';
						if ( $director ) {
							echo esc_html( $director );
						}
						if ( $year ) {
							echo ' (' . esc_html( $year ) . ')';
						}
						echo '</span>';
					}

					$posted_on = sprintf(
						'<time datetime="%1$s">%2$s</time>',
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() )
					);
					printf(
						' <span class="posted-on">· %s</span>',
						$posted_on
					);
					?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<footer class="entry-footer">
				<?php
				$genre   = get_post_meta( get_the_ID(), '_lunarfilm_genre', true );
				$studio  = get_post_meta( get_the_ID(), '_lunarfilm_studio', true );
				$runtime = get_post_meta( get_the_ID(), '_lunarfilm_runtime', true );

				if ( $genre || $studio || $runtime ) {
					echo '<div class="film-metadata">';
					$metadata_parts = array();
					
					if ( $genre ) {
						$metadata_parts[] = esc_html( $genre );
					}
					if ( $studio ) {
						$metadata_parts[] = esc_html( $studio );
					}
					if ( $runtime ) {
						$metadata_parts[] = esc_html( $runtime ) . ' ' . esc_html__( 'min', 'lunarfilm' );
					}
					
					echo implode( ' · ', $metadata_parts );
					echo '</div>';
				}
				?>
			</footer>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</main>

<?php
get_sidebar();
get_footer();
