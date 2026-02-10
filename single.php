<?php
/**
 * The template for displaying single posts
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
					<span class="posted-on"><?php echo get_the_date(); ?></span>
					<span class="byline"><?php esc_html_e( 'by', 'lunarfilm' ); ?> <?php the_author(); ?></span>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lunarfilm' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<footer class="entry-footer">
				<?php
				$categories_list = get_the_category_list( esc_html__( ', ', 'lunarfilm' ) );
				if ( $categories_list ) {
					printf( '<span class="cat-links">%s</span>', $categories_list );
				}

				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'lunarfilm' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links">%s</span>', $tags_list );
				}
				?>
			</footer>
		</article>

		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'lunarfilm' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'lunarfilm' ) . '</span> <span class="nav-title">%title</span>',
			)
		);

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</main>

<?php
get_sidebar();
get_footer();
