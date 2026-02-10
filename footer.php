<?php
/**
 * The footer for the LUNARFILM theme
 *
 * Contains the closing of the #page div and all content after.
 *
 * @package LUNARFILM
 */
?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
			printf(
				/* translators: 1: year, 2: site title */
				esc_html__( '&copy; %1$s %2$s', 'lunarfilm' ),
				wp_date( 'Y' ),
				get_bloginfo( 'name' )
			);
			?>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
