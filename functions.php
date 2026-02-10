<?php
/**
 * LUNARFILM theme functions and definitions
 *
 * This is a fully standalone theme with no parent theme dependency.
 *
 * @package LUNARFILM
 */

if ( ! defined( 'LUNARFILM_VERSION' ) ) {
	define( 'LUNARFILM_VERSION', '1.0.0' );
}

if ( ! function_exists( 'lunarfilm_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function lunarfilm_setup() {
		load_theme_textdomain( 'lunarfilm', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'lunarfilm' ),
				'footer'  => esc_html__( 'Footer Menu', 'lunarfilm' ),
			)
		);

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support(
			'custom-background',
			array(
				'default-color' => '0a1520',
				'default-image' => '',
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action( 'after_setup_theme', 'lunarfilm_setup' );

/**
 * Set the content width in pixels.
 *
 * @global int $content_width
 */
function lunarfilm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lunarfilm_content_width', 1200 );
}
add_action( 'after_setup_theme', 'lunarfilm_content_width', 0 );

/**
 * Register widget areas.
 */
function lunarfilm_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lunarfilm' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lunarfilm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'lunarfilm' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'lunarfilm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lunarfilm_widgets_init' );

/**
 * Enqueue theme styles and scripts.
 */
function lunarfilm_scripts() {
	wp_enqueue_style( 'lunarfilm-style', get_stylesheet_uri(), array(), LUNARFILM_VERSION );
}
add_action( 'wp_enqueue_scripts', 'lunarfilm_scripts' );

/**
 * Register custom post types for film content.
 */
function lunarfilm_register_post_types() {
	// Register Reviews post type
	register_post_type(
		'lunarfilm_review',
		array(
			'labels'       => array(
				'name'          => esc_html__( 'Reviews', 'lunarfilm' ),
				'singular_name' => esc_html__( 'Review', 'lunarfilm' ),
				'add_new'       => esc_html__( 'Add New', 'lunarfilm' ),
				'add_new_item'  => esc_html__( 'Add New Review', 'lunarfilm' ),
				'edit_item'     => esc_html__( 'Edit Review', 'lunarfilm' ),
				'new_item'      => esc_html__( 'New Review', 'lunarfilm' ),
				'view_item'     => esc_html__( 'View Review', 'lunarfilm' ),
				'all_items'     => esc_html__( 'All Reviews', 'lunarfilm' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-star-filled',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
			'rewrite'      => array( 'slug' => 'reviews' ),
		)
	);

	// Register Essays post type
	register_post_type(
		'lunarfilm_essay',
		array(
			'labels'       => array(
				'name'          => esc_html__( 'Essays', 'lunarfilm' ),
				'singular_name' => esc_html__( 'Essay', 'lunarfilm' ),
				'add_new'       => esc_html__( 'Add New', 'lunarfilm' ),
				'add_new_item'  => esc_html__( 'Add New Essay', 'lunarfilm' ),
				'edit_item'     => esc_html__( 'Edit Essay', 'lunarfilm' ),
				'new_item'      => esc_html__( 'New Essay', 'lunarfilm' ),
				'view_item'     => esc_html__( 'View Essay', 'lunarfilm' ),
				'all_items'     => esc_html__( 'All Essays', 'lunarfilm' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-book-alt',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
			'rewrite'      => array( 'slug' => 'essays' ),
		)
	);

	// Register Prognostications post type
	register_post_type(
		'lunarfilm_prognostication',
		array(
			'labels'       => array(
				'name'          => esc_html__( 'Prognostications', 'lunarfilm' ),
				'singular_name' => esc_html__( 'Prognostication', 'lunarfilm' ),
				'add_new'       => esc_html__( 'Add New', 'lunarfilm' ),
				'add_new_item'  => esc_html__( 'Add New Prognostication', 'lunarfilm' ),
				'edit_item'     => esc_html__( 'Edit Prognostication', 'lunarfilm' ),
				'new_item'      => esc_html__( 'New Prognostication', 'lunarfilm' ),
				'view_item'     => esc_html__( 'View Prognostication', 'lunarfilm' ),
				'all_items'     => esc_html__( 'All Prognostications', 'lunarfilm' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-awards',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
			'rewrite'      => array( 'slug' => 'prognostications' ),
		)
	);
}
add_action( 'init', 'lunarfilm_register_post_types' );

/**
 * Register film metadata fields.
 */
function lunarfilm_register_meta_boxes() {
	$post_types = array( 'lunarfilm_review', 'lunarfilm_essay', 'lunarfilm_prognostication', 'post' );

	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'lunarfilm_film_details',
			esc_html__( 'Film Details', 'lunarfilm' ),
			'lunarfilm_film_details_callback',
			$post_type,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'lunarfilm_register_meta_boxes' );

/**
 * Film details meta box callback.
 *
 * @param WP_Post $post The post object.
 */
function lunarfilm_film_details_callback( $post ) {
	wp_nonce_field( 'lunarfilm_film_details_nonce', 'lunarfilm_film_details_nonce' );

	$director = get_post_meta( $post->ID, '_lunarfilm_director', true );
	$year     = get_post_meta( $post->ID, '_lunarfilm_year', true );
	$genre    = get_post_meta( $post->ID, '_lunarfilm_genre', true );
	$studio   = get_post_meta( $post->ID, '_lunarfilm_studio', true );
	$runtime  = get_post_meta( $post->ID, '_lunarfilm_runtime', true );
	$rating   = get_post_meta( $post->ID, '_lunarfilm_rating', true );
	?>
	<p>
		<label for="lunarfilm_director"><?php esc_html_e( 'Director', 'lunarfilm' ); ?></label><br>
		<input type="text" id="lunarfilm_director" name="lunarfilm_director" value="<?php echo esc_attr( $director ); ?>" style="width: 100%;">
	</p>
	<p>
		<label for="lunarfilm_year"><?php esc_html_e( 'Year', 'lunarfilm' ); ?></label><br>
		<input type="text" id="lunarfilm_year" name="lunarfilm_year" value="<?php echo esc_attr( $year ); ?>" style="width: 100%;">
	</p>
	<p>
		<label for="lunarfilm_genre"><?php esc_html_e( 'Genre', 'lunarfilm' ); ?></label><br>
		<input type="text" id="lunarfilm_genre" name="lunarfilm_genre" value="<?php echo esc_attr( $genre ); ?>" style="width: 100%;">
	</p>
	<p>
		<label for="lunarfilm_studio"><?php esc_html_e( 'Studio', 'lunarfilm' ); ?></label><br>
		<input type="text" id="lunarfilm_studio" name="lunarfilm_studio" value="<?php echo esc_attr( $studio ); ?>" style="width: 100%;">
	</p>
	<p>
		<label for="lunarfilm_runtime"><?php esc_html_e( 'Runtime (minutes)', 'lunarfilm' ); ?></label><br>
		<input type="number" id="lunarfilm_runtime" name="lunarfilm_runtime" value="<?php echo esc_attr( $runtime ); ?>" style="width: 100%;">
	</p>
	<p>
		<label for="lunarfilm_rating"><?php esc_html_e( 'Star Rating (0.5 to 5.0)', 'lunarfilm' ); ?></label><br>
		<select id="lunarfilm_rating" name="lunarfilm_rating" style="width: 100%;">
			<option value=""><?php esc_html_e( 'Select Rating', 'lunarfilm' ); ?></option>
			<?php
			$rating_options = array(
				'0.5' => '½ (0.5)',
				'1'   => '★ (1)',
				'1.5' => '★½ (1.5)',
				'2'   => '★★ (2)',
				'2.5' => '★★½ (2.5)',
				'3'   => '★★★ (3)',
				'3.5' => '★★★½ (3.5)',
				'4'   => '★★★★ (4)',
				'4.5' => '★★★★½ (4.5)',
				'5'   => '★★★★★ (5)',
			);

			foreach ( $rating_options as $value => $label ) {
				printf(
					'<option value="%s"%s>%s</option>',
					esc_attr( $value ),
					selected( $rating, $value, false ),
					esc_html( $label )
				);
			}
			?>
		</select>
	</p>
	<?php
}

/**
 * Save film metadata.
 *
 * @param int $post_id The post ID.
 */
function lunarfilm_save_film_details( $post_id ) {
	if ( ! isset( $_POST['lunarfilm_film_details_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['lunarfilm_film_details_nonce'], 'lunarfilm_film_details_nonce' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array( 'director', 'year', 'genre', 'studio', 'runtime', 'rating' );

	foreach ( $fields as $field ) {
		if ( isset( $_POST[ 'lunarfilm_' . $field ] ) ) {
			update_post_meta(
				$post_id,
				'_lunarfilm_' . $field,
				sanitize_text_field( $_POST[ 'lunarfilm_' . $field ] )
			);
		}
	}
}
add_action( 'save_post', 'lunarfilm_save_film_details' );
