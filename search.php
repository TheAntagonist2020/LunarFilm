<?php
/**
 * The template for displaying search results
 *
 * @package LUNARFILM
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'lunarfilm' ),
					'<span>' . get_search_query() . '</span>'
				);
				?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php
		the_posts_pagination(
			array(
				'prev_text' => esc_html__( '&laquo; Previous', 'lunarfilm' ),
				'next_text' => esc_html__( 'Next &raquo;', 'lunarfilm' ),
			)
		);
		?>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no results were found for your search. Please try again with different keywords.', 'lunarfilm' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();
