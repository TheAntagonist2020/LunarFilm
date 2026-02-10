<?php
/**
 * Template for displaying single prognostication
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
					$year = get_post_meta( get_the_ID(), '_lunarfilm_year', true );

					if ( $year ) {
						printf(
							'<span class="awards-year">%s</span>',
							esc_html( $year )
						);
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
				printf(
					'<span class="byline">%s %s</span>',
					esc_html__( 'Analysis by', 'lunarfilm' ),
					esc_html( get_the_author() )
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
