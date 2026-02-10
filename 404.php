<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package LUNARFILM
 */

get_header(); ?>

<main id="primary" class="site-main">
	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'lunarfilm' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Try searching for what you are looking for.', 'lunarfilm' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>
</main>

<?php
get_sidebar();
get_footer();
