<?php
/**
 * The template for displaying archive pages
 *
 * @package LUNARFILM
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

		<?php
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
