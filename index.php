<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package LUNARFILM
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header class="page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;

		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<div class="entry-meta">
						<span class="posted-on"><?php echo get_the_date(); ?></span>
						<span class="byline"><?php esc_html_e( 'by', 'lunarfilm' ); ?> <?php the_author(); ?></span>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
					</div>
				<?php endif; ?>

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

		<p><?php esc_html_e( 'No posts found.', 'lunarfilm' ); ?></p>

	<?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();
