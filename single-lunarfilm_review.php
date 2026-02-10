<?php
/**
 * Template for displaying single film review
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
					$rating   = get_post_meta( get_the_ID(), '_lunarfilm_rating', true );

					if ( $director ) {
						printf(
							'<span class="film-director">%s: <strong>%s</strong></span>',
							esc_html__( 'Directed by', 'lunarfilm' ),
							esc_html( $director )
						);
					}

					if ( $year ) {
						echo ' <span class="film-year">(' . esc_html( $year ) . ')</span>';
					}
					?>
				</div>

				<?php if ( $rating ) : ?>
					<div class="film-rating">
						<?php
						$full_stars = floor( $rating );
						$half_star  = ( fmod( $rating, 1 ) >= 0.5 );
						
						for ( $i = 0; $i < $full_stars; $i++ ) {
							echo '<span class="star-full">★</span>';
						}
						
						if ( $half_star ) {
							echo '<span class="star-half">★</span>';
						}

						$empty_stars = 5 - $full_stars - ( $half_star ? 1 : 0 );
						for ( $i = 0; $i < $empty_stars; $i++ ) {
							echo '<span class="star-empty">☆</span>';
						}
						?>
					</div>
				<?php endif; ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<div class="film-details">
				<h3><?php esc_html_e( 'Lunara Debrief', 'lunarfilm' ); ?></h3>
				<?php
				$genre   = get_post_meta( get_the_ID(), '_lunarfilm_genre', true );
				$studio  = get_post_meta( get_the_ID(), '_lunarfilm_studio', true );
				$runtime = get_post_meta( get_the_ID(), '_lunarfilm_runtime', true );

				if ( $genre || $studio || $runtime ) :
					?>
					<ul>
						<?php if ( $genre ) : ?>
							<li><strong><?php esc_html_e( 'Genre:', 'lunarfilm' ); ?></strong> <?php echo esc_html( $genre ); ?></li>
						<?php endif; ?>
						<?php if ( $studio ) : ?>
							<li><strong><?php esc_html_e( 'Studio:', 'lunarfilm' ); ?></strong> <?php echo esc_html( $studio ); ?></li>
						<?php endif; ?>
						<?php if ( $runtime ) : ?>
							<li><strong><?php esc_html_e( 'Runtime:', 'lunarfilm' ); ?></strong> <?php echo esc_html( $runtime ); ?> <?php esc_html_e( 'minutes', 'lunarfilm' ); ?></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div>

			<footer class="entry-footer">
				<?php
				$posted_on = sprintf(
					'<time datetime="%1$s">%2$s</time>',
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				printf(
					'<span class="posted-on">%s %s</span>',
					esc_html__( 'Published:', 'lunarfilm' ),
					$posted_on
				);
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
