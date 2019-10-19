<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) 
{
	require get_template_directory() . '/inc/back-compat.php';
}
require get_template_directory() . '/inc/custom-post-type.php';

if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Twenty Sixteen 1.2
		 */
		add_theme_support
		(
			'custom-logo',
			array
			(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
				'social'  => __( 'Social Links Menu', 'twentysixteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array
				(
					'name'  => __( 'Dark Gray', 'twentysixteen' ),
					'slug'  => 'dark-gray',
					'color' => '#1a1a1a',
				),
				array
				(
					'name'  => __( 'Medium Gray', 'twentysixteen' ),
					'slug'  => 'medium-gray',
					'color' => '#686868',
				),
				array
				(
					'name'  => __( 'Light Gray', 'twentysixteen' ),
					'slug'  => 'light-gray',
					'color' => '#e5e5e5',
				),
				array
				(
					'name'  => __( 'White', 'twentysixteen' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array
				(
					'name'  => __( 'Blue Gray', 'twentysixteen' ),
					'slug'  => 'blue-gray',
					'color' => '#4d545c',
				),
				array
				(
					'name'  => __( 'Bright Blue', 'twentysixteen' ),
					'slug'  => 'bright-blue',
					'color' => '#007acc',
				),
				array(
					'name'  => __( 'Light Blue', 'twentysixteen' ),
					'slug'  => 'light-blue',
					'color' => '#9adffd',
				),
				array(
					'name'  => __( 'Dark Brown', 'twentysixteen' ),
					'slug'  => 'dark-brown',
					'color' => '#402b30',
				),
				array(
					'name'  => __( 'Medium Brown', 'twentysixteen' ),
					'slug'  => 'medium-brown',
					'color' => '#774e24',
				),
				array(
					'name'  => __( 'Dark Red', 'twentysixteen' ),
					'slug'  => 'dark-red',
					'color' => '#640c1f',
				),
				array
				(
					'name'  => __( 'Bright Red', 'twentysixteen' ),
					'slug'  => 'bright-red',
					'color' => '#ff675f',
				),
				array
				(
					'name'  => __( 'Yellow', 'twentysixteen' ),
					'slug'  => 'yellow',
					'color' => '#ffef8e',
				),
			)
		);

		        // Indicate widget sidebars can use selective refresh in the Customizer.
		       add_theme_support( 'customize-selective-refresh-widgets' );
	}
         endif; // twentysixteen_setup
         add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() 
{
	   $GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
} 
       add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Sixteen 1.6
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentysixteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentysixteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	 return $urls;
}
     add_filter( 'wp_resource_hints', 'twentysixteen_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar (
		array(
			'name'          => __( 'Quick Links', 'twentysixteen' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Buying', 'twentysixteen' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Selling', 'twentysixteen' ),
			'id'            => 'sidebar-6',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) 
		{
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) 
		{
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) 
		{
			$fonts_url = add_query_arg
			(
				array
				(
					'family' => urlencode(implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() 
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
   add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );
/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20181230' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) 
	{
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script('twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181230', true );

	wp_localize_script(
		'twentysixteen-script',
		'screenReaderText',
		array(
			'expand'   => __('expand child menu', 'twentysixteen'),
			'collapse' => __('collapse child menu', 'twentysixteen'),
		)
	);
}
       add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Sixteen 1.6
 */
function twentysixteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentysixteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20181230' );
	// Add custom fonts.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
}
    add_action( 'enqueue_block_editor_assets', 'twentysixteen_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) 
	{
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) 
	{
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) 
	{
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
    add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array
	(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) 
{
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) 
		{
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else 
	{
	   if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) 
		{
$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

//////////////////
function pagination_bar( $query_wp ) 
{
    $pagination = $query_wp->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($pagination > 1)
    {
        $current = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current,
            'total' => $pagination,
        ));
    }
}


/*-- Custom Post Init End --*/
if( function_exists('acf_add_options_page') ) {
	
  acf_add_options_page(array(
    'page_title' 	=> 'General settings for your theme',
    'menu_title'	=> 'Theme settings',
    'menu_slug' 	=> 'theme-general-settings',
    'capability'	=> 'edit_posts',
    'redirect'	    => false
  ));
}

/////////////////////////
/* add_role('broker', __(
       'Broker'),
       array(
           'read'            => true, // Allows a user to read
           'create_posts'      => true, // Allows user to create new posts
           'edit_posts'        => true, // Allows user to edit their own posts
           'edit_others_posts' => true, // Allows user to edit others posts too
           'publish_posts' => true, // Allows the user to publish posts
           'manage_categories' => true, // Allows user to manage post categories
           )
    );
  add_role('seller', __(
       'Seller'),
       array(
           'read'            => true, // Allows a user to read
           'create_posts'      => true, // Allows user to create new posts
           'edit_posts'        => true, // Allows user to edit their own posts
           'edit_others_posts' => true, // Allows user to edit others posts too
           'publish_posts' => true, // Allows the user to publish posts
           'manage_categories' => true, // Allows user to manage post categories
           )
    );
  add_role('buyer', __(
       'Buyer'),
       array(
           'read'              => true, // Allows a user to read
           'create_posts'      => true, // Allows user to create new posts
           'edit_posts'        => true, // Allows user to edit their own posts
           'edit_others_posts' => true, // Allows user to edit others posts too
           'publish_posts'     => true, // Allows the user to publish posts
           'manage_categories' => true, // Allows user to manage post categories
           )
    );
  add_role('active-buyer', __(
       'Active Buyer'),
       array(
           'read'              => true, // Allows a user to read
           'create_posts'      => true, // Allows user to create new posts
           'edit_posts'        => true, // Allows user to edit their own posts
           'edit_others_posts' => true, // Allows user to edit others posts too
           'publish_posts'     => true, // Allows the user to publish posts
           'manage_categories' => true, // Allows user to manage post categories
           )
    );*/

///////////////////////////////////////////////

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
<h3>Extra profile information</h3>
    <table class="form-table">
    <tr>
            <th><label for="tel">Telephone</label></th>
            <td>
            <input type="text" name="tel" id="tel" value="<?php echo esc_attr( get_the_author_meta( 'tel', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
<tr>
                <th><label for="country">Country</label></th>
                <td>
                <?php 
            //get dropdown saved value
            $selected = get_the_author_meta( 'country', $user->ID ); //there was an extra ) here that was not needed 
            ?>
                    <select name="country" id="country" >
                        
<option value="AF" <?php echo ($selected == "AF")?  'selected="selected"' : '' ?>>Afghanistan</option>
<option value="AX" <?php echo ($selected == "AX")?  'selected="selected"' : '' ?>>Åland Islands</option>
<option value="AL" <?php echo ($selected == "AL")?  'selected="selected"' : '' ?>>Albania</option>
<option value="DZ" <?php echo ($selected == "DZ")?  'selected="selected"' : '' ?>>Algeria</option>
<option value="AS" <?php echo ($selected == "AS")?  'selected="selected"' : '' ?>>American Samoa</option>
<option value="AD" <?php echo ($selected == "AD")?  'selected="selected"' : '' ?>>Andorra</option>
<option value="AO" <?php echo ($selected == "AO")?  'selected="selected"' : '' ?>>Angola</option>
<option value="AI" <?php echo ($selected == "AI")?  'selected="selected"' : '' ?>>Anguilla</option>
<option value="AQ" <?php echo ($selected == "AQ")?  'selected="selected"' : '' ?>>Antarctica</option>
<option value="AG" <?php echo ($selected == "AG")?  'selected="selected"' : '' ?>>Antigua and Barbuda</option>
<option value="AR" <?php echo ($selected == "AR")?  'selected="selected"' : '' ?>>Argentina</option>
<option value="AM" <?php echo ($selected == "AM")?  'selected="selected"' : '' ?>>Armenia</option>
<option value="AW" <?php echo ($selected == "AW")?  'selected="selected"' : '' ?>>Aruba</option>
<option value="AU" <?php echo ($selected == "AU")?  'selected="selected"' : '' ?>>Australia</option>
<option value="AT" <?php echo ($selected == "AT")?  'selected="selected"' : '' ?>>Austria</option>
<option value="AZ" <?php echo ($selected == "AZ")?  'selected="selected"' : '' ?>>Azerbaijan</option>
<option value="BS" <?php echo ($selected == "BS")?  'selected="selected"' : '' ?>>Bahamas</option>
<option value="BH" <?php echo ($selected == "BH")?  'selected="selected"' : '' ?>>Bahrain</option>
<option value="BD" <?php echo ($selected == "BD")?  'selected="selected"' : '' ?>>Bangladesh</option>
<option value="BB" <?php echo ($selected == "BB")?  'selected="selected"' : '' ?>>Barbados</option>
<option value="BY" <?php echo ($selected == "BY")?  'selected="selected"' : '' ?>>Belarus</option>
<option value="BE" <?php echo ($selected == "BE")?  'selected="selected"' : '' ?>>Belgium</option>
<option value="BZ" <?php echo ($selected == "BZ")?  'selected="selected"' : '' ?>>Belize</option>
<option value="BJ" <?php echo ($selected == "BJ")?  'selected="selected"' : '' ?>>Benin</option>
<option value="BM" <?php echo ($selected == "BM")?  'selected="selected"' : '' ?>>Bermuda</option>
<option value="BT" <?php echo ($selected == "BT")?  'selected="selected"' : '' ?>>Bhutan</option>
<option value="BO" <?php echo ($selected == "BO")?  'selected="selected"' : '' ?>>Bolivia, Plurinational State of</option>
<option value="BQ" <?php echo ($selected == "BQ")?  'selected="selected"' : '' ?>>Bonaire, Sint Eustatius and Saba</option>
<option value="BA" <?php echo ($selected == "BA")?  'selected="selected"' : '' ?>>Bosnia and Herzegovina</option>
<option value="BW" <?php echo ($selected == "BW")?  'selected="selected"' : '' ?>>Botswana</option>
<option value="BV" <?php echo ($selected == "BV")?  'selected="selected"' : '' ?>>Bouvet Island</option>
<option value="BR" <?php echo ($selected == "BR")?  'selected="selected"' : '' ?>>Brazil</option>
<option value="IO" <?php echo ($selected == "IO")?  'selected="selected"' : '' ?>>British Indian Ocean Territory</option>
<option value="BN" <?php echo ($selected == "BN")?  'selected="selected"' : '' ?>>Brunei Darussalam</option>
<option value="BG" <?php echo ($selected == "BG")?  'selected="selected"' : '' ?>>Bulgaria</option>
<option value="BF" <?php echo ($selected == "BF")?  'selected="selected"' : '' ?>>Burkina Faso</option>
<option value="BI" <?php echo ($selected == "BI")?  'selected="selected"' : '' ?>>Burundi</option>
<option value="KH" <?php echo ($selected == "KH")?  'selected="selected"' : '' ?>>Cambodia</option>
<option value="CM" <?php echo ($selected == "CM")?  'selected="selected"' : '' ?>>Cameroon</option>
<option value="CA" <?php echo ($selected == "CA")?  'selected="selected"' : '' ?>>Canada</option>
<option value="CV" <?php echo ($selected == "CV")?  'selected="selected"' : '' ?>>Cape Verde</option>
<option value="KY" <?php echo ($selected == "KY")?  'selected="selected"' : '' ?>>Cayman Islands</option>
<option value="CF" <?php echo ($selected == "CF")?  'selected="selected"' : '' ?>>Central African Republic</option>
<option value="TD" <?php echo ($selected == "TD")?  'selected="selected"' : '' ?>>Chad</option>
<option value="CL" <?php echo ($selected == "CL")?  'selected="selected"' : '' ?>>Chile</option>
<option value="CN" <?php echo ($selected == "CN")?  'selected="selected"' : '' ?>>China</option>
<option value="CX" <?php echo ($selected == "CX")?  'selected="selected"' : '' ?>>Christmas Island</option>
<option value="CC" <?php echo ($selected == "CC")?  'selected="selected"' : '' ?>>Cocos (Keeling) Islands</option>
	<option value="CO" <?php echo ($selected == "CO")?  'selected="selected"' : '' ?>>Colombia</option>
	<option value="KM" <?php echo ($selected == "KM")?  'selected="selected"' : '' ?>>Comoros</option>
	<option value="CG" <?php echo ($selected == "CG")?  'selected="selected"' : '' ?>>Congo</option>
	<option value="CD" <?php echo ($selected == "CD")?  'selected="selected"' : '' ?>>Congo, the Democratic Republic of the</option>
	<option value="CK" <?php echo ($selected == "CK")?  'selected="selected"' : '' ?>>Cook Islands</option>
	<option value="CR" <?php echo ($selected == "CR")?  'selected="selected"' : '' ?>>Costa Rica</option>
	<option value="CI" <?php echo ($selected == "CI")?  'selected="selected"' : '' ?>>Côte d'Ivoire</option>
	<option value="HR" <?php echo ($selected == "HR")?  'selected="selected"' : '' ?>>Croatia</option>
	<option value="CU" <?php echo ($selected == "CU")?  'selected="selected"' : '' ?>>Cuba</option>
	<option value="CW" <?php echo ($selected == "CW")?  'selected="selected"' : '' ?>>Curaçao</option>
	<option value="CY" <?php echo ($selected == "CY")?  'selected="selected"' : '' ?>>Cyprus</option>
	<option value="CZ" <?php echo ($selected == "CZ")?  'selected="selected"' : '' ?>>Czech Republic</option>
	<option value="DK" <?php echo ($selected == "DK")?  'selected="selected"' : '' ?>>Denmark</option>
	<option value="DJ" <?php echo ($selected == "DJ")?  'selected="selected"' : '' ?>>Djibouti</option>
	<option value="DM" <?php echo ($selected == "DM")?  'selected="selected"' : '' ?>>Dominica</option>
	<option value="DO" <?php echo ($selected == "DO")?  'selected="selected"' : '' ?> >Dominican Republic</option>
	<option value="EG" <?php echo ($selected == "EG")?  'selected="selected"' : '' ?>>Egypt</option>
	<option value="SV" <?php echo ($selected == "SV")?  'selected="selected"' : '' ?> >El Salvador</option>
	<option value="GQ" <?php echo ($selected == "GQ")?  'selected="selected"' : '' ?>>Equatorial Guinea</option>
	<option value="ER" <?php echo ($selected == "ER")?  'selected="selected"' : '' ?>>Eritrea</option>
	<option value="EE" <<?php echo ($selected == "EE")?  'selected="selected"' : '' ?> >Estonia</option>
	<option value="ET" <?php echo ($selected == "ET")?  'selected="selected"' : '' ?>>Ethiopia</option>
	<option value="FK" <?php echo ($selected == "FK")?  'selected="selected"' : '' ?> >Falkland Islands (Malvinas)</option>
	<option value="FO" <?php echo ($selected == "FO")?  'selected="selected"' : '' ?> >Faroe Islands</option>
	<option value="FJ" <?php echo ($selected == "FJ")?  'selected="selected"' : '' ?>>Fiji</option>
	<option value="FI" <?php echo ($selected == "FI")?  'selected="selected"' : '' ?>>Finland</option>
	<option value="FR" <?php echo ($selected == "FR")?  'selected="selected"' : '' ?>>France</option>
	<option value="GF" <?php echo ($selected == "GF")?  'selected="selected"' : '' ?>>French Guiana</option>
	<option value="PF" <?php echo ($selected == "PF")?  'selected="selected"' : '' ?>>French Polynesia</option>
	<option value="TF" <?php echo ($selected == "TF")?  'selected="selected"' : '' ?>>French Southern Territories</option>
	<option value="GA" <?php echo ($selected == "GA")?  'selected="selected"' : '' ?>>Gabon</option>
	<option value="GM" <?php echo ($selected == "GM")?  'selected="selected"' : '' ?>>Gambia</option>
	<option value="GE" <?php echo ($selected == "GE")?  'selected="selected"' : '' ?>>Georgia</option>
	<option value="DE" <?php echo ($selected == "DE")?  'selected="selected"' : '' ?>>Germany</option>
	<option value="GH" <?php echo ($selected == "GH")?  'selected="selected"' : '' ?>>Ghana</option>
	<option value="GI" <?php echo ($selected == "GI")?  'selected="selected"' : '' ?>>Gibraltar</option>
	<option value="GR" <?php echo ($selected == "GR")?  'selected="selected"' : '' ?>>Greece</option>
	<option value="GL" <?php echo ($selected == "GL")?  'selected="selected"' : '' ?>>Greenland</option>
	<option value="GD" <?php echo ($selected == "GD")?  'selected="selected"' : '' ?>>Grenada</option>
	<option value="GP" <?php echo ($selected == "GP")?  'selected="selected"' : '' ?>>Guadeloupe</option>
	<option value="GU" <?php echo ($selected == "GU")?  'selected="selected"' : '' ?>>Guam</option>
	<option value="GT" <?php echo ($selected == "GT")?  'selected="selected"' : '' ?>>Guatemala</option>
	<option value="GG" <?php echo ($selected == "GG")?  'selected="selected"' : '' ?>>Guernsey</option>
	<option value="GN" <?php echo ($selected == "GN")?  'selected="selected"' : '' ?>>Guinea</option>
   <option value="GW" <?php echo ($selected == "GW")?  'selected="selected"' : '' ?>>Guinea-Bissau</option>
	<option value="GY" <?php echo ($selected == "GY")?  'selected="selected"' : '' ?>>Guyana</option>
	<option value="HT" <?php echo ($selected == "HT")?  'selected="selected"' : '' ?>>Haiti</option>
	<option value="HM" <?php echo ($selected == "HM")?  'selected="selected"' : '' ?>>Heard Island and McDonald Islands</option>
		<option value="VA" <?php echo ($selected == "VA")?  'selected="selected"' : '' ?>>Holy See (Vatican City State)</option>
	<option value="HN" <?php echo ($selected == "HN")?  'selected="selected"' : '' ?>>Honduras</option>
	<option value="HK" <?php echo ($selected == "HK")?  'selected="selected"' : '' ?>>Hong Kong</option>
	<option value="HU" <?php echo ($selected == "HU")?  'selected="selected"' : '' ?>>Hungary</option>
	<option value="IS" <?php echo ($selected == "IS")?  'selected="selected"' : '' ?>>Iceland</option>
	<option value="IN" <?php echo ($selected == "IN")?  'selected="selected"' : '' ?>>India</option>
	<option value="ID" <?php echo ($selected == "ID")?  'selected="selected"' : '' ?>>Indonesia</option>
	<option value="IR" <?php echo ($selected == "IR")?  'selected="selected"' : '' ?>>Iran, Islamic Republic of</option>
	<option value="IQ" <?php echo ($selected == "IQ")?  'selected="selected"' : '' ?>>Iraq</option>
	<option value="IE" <?php echo ($selected == "IE")?  'selected="selected"' : '' ?>>Ireland</option>
	<option value="IM" <?php echo ($selected == "IM")?  'selected="selected"' : '' ?>>Isle of Man</option>
	<option value="IL" <?php echo ($selected == "IL")?  'selected="selected"' : '' ?>>Israel</option>
	<option value="IT" <?php echo ($selected == "IT")?  'selected="selected"' : '' ?>>Italy</option>
	<option value="JM" <?php echo ($selected == "JM")?  'selected="selected"' : '' ?>>Jamaica</option>
	<option value="JP" <?php echo ($selected == "JP")?  'selected="selected"' : '' ?>>Japan</option>
	<option value="JE" <?php echo ($selected == "JE")?  'selected="selected"' : '' ?>>Jersey</option>
	<option value="JO" <?php echo ($selected == "JO")?  'selected="selected"' : '' ?>>Jordan</option>
	<option value="KZ" <?php echo ($selected == "KZ")?  'selected="selected"' : '' ?>>Kazakhstan</option>
	<option value="KE" <?php echo ($selected == "KE")?  'selected="selected"' : '' ?>>Kenya</option>
	<option value="KI" <?php echo ($selected == "KI")?  'selected="selected"' : '' ?>>Kiribati</option>
	<option value="KP" <?php echo ($selected == "KP")?  'selected="selected"' : '' ?>>Korea, Democratic People's Republic of</option>
	<option value="KR" <?php echo ($selected == "KR")?  'selected="selected"' : '' ?>>Korea, Republic of</option>
	<option value="KW" <?php echo ($selected == "KW")?  'selected="selected"' : '' ?>>Kuwait</option>
	<option value="KG" <?php echo ($selected == "KG")?  'selected="selected"' : '' ?>>Kyrgyzstan</option>
	<option value="LA" <?php echo ($selected == "LA")?  'selected="selected"' : '' ?>>Lao People's Democratic Republic</option>
	<option value="LV" <?php echo ($selected == "LV")?  'selected="selected"' : '' ?>>Latvia</option>
	<option value="LB" <?php echo ($selected == "LB")?  'selected="selected"' : '' ?>>Lebanon</option>
	<option value="LS" <?php echo ($selected == "LS")?  'selected="selected"' : '' ?>>Lesotho</option>
	<option value="LR" <?php echo ($selected == "LR")?  'selected="selected"' : '' ?>>Liberia</option>
	<option value="LY" <?php echo ($selected == "LY")?  'selected="selected"' : '' ?>>Libya</option>
	<option value="LI" <?php echo ($selected == "LI")?  'selected="selected"' : '' ?>>Liechtenstein</option>
	<option value="LT" <?php echo ($selected == "LT")?  'selected="selected"' : '' ?>>Lithuania</option>
	<option value="LU" <?php echo ($selected == "LU")?  'selected="selected"' : '' ?>>Luxembourg</option>
	<option value="MO" <?php echo ($selected == "MO")?  'selected="selected"' : '' ?>>Macao</option>
	<option value="MK" <?php echo ($selected == "MK")?  'selected="selected"' : '' ?>>Macedonia, the former Yugoslav Republic of</option>
	<option value="MG" <?php echo ($selected == "MG")?  'selected="selected"' : '' ?>>Madagascar</option>
	<option value="MW" <?php echo ($selected == "MW")?  'selected="selected"' : '' ?>>Malawi</option>
	<option value="MY" <?php echo ($selected == "MY")?  'selected="selected"' : '' ?>>Malaysia</option>
	<option value="MV" <?php echo ($selected == "MV")?  'selected="selected"' : '' ?>>Maldives</option>
	<option value="ML" <?php echo ($selected == "ML")?  'selected="selected"' : '' ?>>Mali</option>
	<option value="MT"<?php echo ($selected == "MT")?  'selected="selected"' : '' ?>>Malta</option>
	<option value="MH" <?php echo ($selected == "MH")?  'selected="selected"' : '' ?>>Marshall Islands</option>
	<option value="MQ" <?php echo ($selected == "MQ")?  'selected="selected"' : '' ?>>Martinique</option>
	<option value="MR" <?php echo ($selected == "MR")?  'selected="selected"' : '' ?>>Mauritania</option>
	<option value="MU" <?php echo ($selected == "MU")?  'selected="selected"' : '' ?>>Mauritius</option>
	<option value="YT" <?php echo ($selected == "YT")?  'selected="selected"' : '' ?>>Mayotte</option>
	<option value="MX" <?php echo ($selected == "MX")?  'selected="selected"' : '' ?>>Mexico</option>
	<option value="FM" <?php echo ($selected == "FM")?  'selected="selected"' : '' ?>>Micronesia, Federated States of</option>
	<option value="MD" <?php echo ($selected == "MD")?  'selected="selected"' : '' ?>>Moldova, Republic of</option>
	<option value="MC" <?php echo ($selected == "MC")?  'selected="selected"' : '' ?>>Monaco</option>
	<option value="MN" <?php echo ($selected == "MN")?  'selected="selected"' : '' ?>>Mongolia</option>
	<option value="ME" <?php echo ($selected == "ME")?  'selected="selected"' : '' ?>>Montenegro</option>
	<option value="MS" <?php echo ($selected == "MS")?  'selected="selected"' : '' ?>>Montserrat</option>
	<option value="MA" <?php echo ($selected == "MA")?  'selected="selected"' : '' ?>>Morocco</option>
	<option value="MZ" <?php echo ($selected == "MZ")?  'selected="selected"' : '' ?>>Mozambique</option>
	<option value="MM" <?php echo ($selected == "MM")?  'selected="selected"' : '' ?>>Myanmar</option>
	<option value="NA" <?php echo ($selected == "NA")?  'selected="selected"' : '' ?>>Namibia</option>
	<option value="NR" <?php echo ($selected == "NR")?  'selected="selected"' : '' ?>>Nauru</option>
	<option value="NP" <?php echo ($selected == "NP")?  'selected="selected"' : '' ?>>Nepal</option>
	<option value="NL" <?php echo ($selected == "NL")?  'selected="selected"' : '' ?>>Netherlands</option>
	<option value="NC" <?php echo ($selected == "NC")?  'selected="selected"' : '' ?>>New Caledonia</option>
	<option value="NZ" <?php echo ($selected == "NZ")?  'selected="selected"' : '' ?>>New Zealand</option>
	<option value="NI" <?php echo ($selected == "NI")?  'selected="selected"' : '' ?>>Nicaragua</option>
	<option value="NE" <?php echo ($selected == "NE")?  'selected="selected"' : '' ?>>Niger</option>
	<option value="NG" <?php echo ($selected == "NG")?  'selected="selected"' : '' ?>>Nigeria</option>
	<option value="NU" <?php echo ($selected == "NU")?  'selected="selected"' : '' ?>>Niue</option>
<option value="NF" <?php echo ($selected == "NF")?  'selected="selected"' : '' ?>>Norfolk Island</option>
<option value="MP" <?php echo ($selected == "MP")?  'selected="selected"' : '' ?>>Northern Mariana Islands</option>
<option value="NO" <?php echo ($selected == "NO")?  'selected="selected"' : '' ?>>Norway</option>
<option value="OM" <?php echo ($selected == "OM")?  'selected="selected"' : '' ?>>Oman</option>
<option value="PK" <?php echo ($selected == "PK")?  'selected="selected"' : '' ?>>Pakistan</option>
<option value="PW" <?php echo ($selected == "PW")?  'selected="selected"' : '' ?>>Palau</option>
<option value="PS" <?php echo ($selected == "PS")?  'selected="selected"' : '' ?>>Palestinian Territory, Occupied</option>
	<option value="PA" <?php echo ($selected == "PA")?  'selected="selected"' : '' ?>>Panama</option>
	<option value="PG" <?php echo ($selected == "PG")?  'selected="selected"' : '' ?>>Papua New Guinea</option>
	<option value="PY" <?php echo ($selected == "PY")?  'selected="selected"' : '' ?>>Paraguay</option>
	<option value="PE" <?php echo ($selected == "PE")?  'selected="selected"' : '' ?>>Peru</option>
	<option value="PH" <?php echo ($selected == "PH")?  'selected="selected"' : '' ?>>Philippines</option>
	<option value="PN" <?php echo ($selected == "PN")?  'selected="selected"' : '' ?>>Pitcairn</option>
	<option value="PL" <?php echo ($selected == "PL")?  'selected="selected"' : '' ?>>Poland</option>
	<option value="PT" <?php echo ($selected == "PT")?  'selected="selected"' : '' ?>>Portugal</option>
	<option value="PR" <?php echo ($selected == "PR")?  'selected="selected"' : '' ?>>Puerto Rico</option>
	<option value="QA" <?php echo ($selected == "QA")?  'selected="selected"' : '' ?>>Qatar</option>
	<option value="RE" <?php echo ($selected == "RE")?  'selected="selected"' : '' ?>>Réunion</option>
	<option value="RO" <?php echo ($selected == "RO")?  'selected="selected"' : '' ?>>Romania</option>
	<option value="RU" <?php echo ($selected == "RU")?  'selected="selected"' : '' ?>>Russian Federation</option>
	<option value="RW" <?php echo ($selected == "RW")?  'selected="selected"' : '' ?>>Rwanda</option>
	<option value="BL" <?php echo ($selected == "BL")?  'selected="selected"' : '' ?>>Saint Barthélemy</option>
	<option value="SH" <?php echo ($selected == "SH")?  'selected="selected"' : '' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="KN" <?php echo ($selected == "KN")?  'selected="selected"' : '' ?>>Saint Kitts and Nevis</option>
	<option value="LC"<?php echo ($selected == "LC")?  'selected="selected"' : '' ?>>Saint Lucia</option>
	<option value="MF" <?php echo ($selected == "MF")?  'selected="selected"' : '' ?>>Saint Martin (French part)</option>
	<option value="PM" <?php echo ($selected == "PM")?  'selected="selected"' : '' ?>>Saint Pierre and Miquelon</option>
	<option value="VC" <?php echo ($selected == "VC")?  'selected="selected"' : '' ?>>Saint Vincent and the Grenadines</option>
	<option value="WS" <?php echo ($selected == "WS")?  'selected="selected"' : '' ?>>Samoa</option>
	<option value="SM" <?php echo ($selected == "SM")?  'selected="selected"' : '' ?>>San Marino</option>
	<option value="ST" <?php echo ($selected == "ST")?  'selected="selected"' : '' ?>>Sao Tome and Principe</option>
	<option value="SA" <?php echo ($selected == "SA")?  'selected="selected"' : '' ?>>Saudi Arabia</option>
	<option value="SN" <?php echo ($selected == "SN")?  'selected="selected"' : '' ?>>Senegal</option>
	<option value="RS" <?php echo ($selected == "RS")?  'selected="selected"' : '' ?>>Serbia</option>
	<option value="SC" <?php echo ($selected == "SC")?  'selected="selected"' : '' ?>>Seychelles</option>
	<option value="SL" <?php echo ($selected == "SL")?  'selected="selected"' : '' ?>>Sierra Leone</option>
	<option value="SG" <?php echo ($selected == "SG")?  'selected="selected"' : '' ?>>Singapore</option>
	<option value="SX" <?php echo ($selected == "SX")?  'selected="selected"' : '' ?>>Sint Maarten (Dutch part)</option>
	<option value="SK" <?php echo ($selected == "SK")?  'selected="selected"' : '' ?>>Slovakia</option>
	<option value="SI" <?php echo ($selected == "SI")?  'selected="selected"' : '' ?>>Slovenia</option>
	<option value="SB" <?php echo ($selected == "SB")?  'selected="selected"' : '' ?>>Solomon Islands</option>
	<option value="SO" <?php echo ($selected == "SO")?  'selected="selected"' : '' ?>>Somalia</option>
	<option value="ZA" <?php echo ($selected == "ZA")?  'selected="selected"' : '' ?>>South Africa</option>
	<option value="GS" <?php echo ($selected == "GS")?  'selected="selected"' : '' ?>>South Georgia and the South Sandwich Islands</option>
	<option value="SS" <?php echo ($selected == "SS")?  'selected="selected"' : '' ?>>South Sudan</option>
	<option value="ES" <?php echo ($selected == "ES")?  'selected="selected"' : '' ?>>Spain</option>
	<option value="LK" <?php echo ($selected == "LK")?  'selected="selected"' : '' ?>>Sri Lanka</option>
	<option value="SD" <?php echo ($selected == "SD")?  'selected="selected"' : '' ?>>Sudan</option>
	<option value="SR" <?php echo ($selected == "SR")?  'selected="selected"' : '' ?>>Suriname</option>
	<option value="SJ" <?php echo ($selected == "SJ")?  'selected="selected"' : '' ?>>Svalbard and Jan Mayen</option>
	<option value="SZ" <?php echo ($selected == "SZ")?  'selected="selected"' : '' ?>>Swaziland</option>
	<option value="SE" <?php echo ($selected == "SE")?  'selected="selected"' : '' ?>>Sweden</option>
	<option value="CH"<?php echo ($selected == "CH")?  'selected="selected"' : '' ?>>Switzerland</option>
<option value="SY" <?php echo ($selected == "SY")?  'selected="selected"' : '' ?>>Syrian Arab Republic</option>
	<option value="TW" <?php echo ($selected == "TW")?  'selected="selected"' : '' ?>>Taiwan, Province of China</option>
	<option value="TJ" <?php echo ($selected == "TJ")?  'selected="selected"' : '' ?>>Tajikistan</option>
	<option value="TZ" <?php echo ($selected == "TZ")?  'selected="selected"' : '' ?>>Tanzania, United Republic of</option>
	<option value="TH" <?php echo ($selected == "TH")?  'selected="selected"' : '' ?>>Thailand</option>
	<option value="TL" <?php echo ($selected == "TL")?  'selected="selected"' : '' ?>>Timor-Leste</option>
	<option value="TG" <?php echo ($selected == "TG")?  'selected="selected"' : '' ?>>Togo</option>
	<option value="TK" <?php echo ($selected == "TK")?  'selected="selected"' : '' ?>>Tokelau</option>
	<option value="TO" <?php echo ($selected == "TO")?  'selected="selected"' : '' ?>>Tonga</option>
	<option value="TT" <?php echo ($selected == "TT")?  'selected="selected"' : '' ?>>Trinidad and Tobago</option>
	<option value="TN" <?php echo ($selected == "TN")?  'selected="selected"' : '' ?>>Tunisia</option>
	<option value="TR" <?php echo ($selected == "TR")?  'selected="selected"' : '' ?>>Turkey</option>
	<option value="TM" <?php echo ($selected == "TM")?  'selected="selected"' : '' ?>>Turkmenistan</option>
	<option value="TC" <?php echo ($selected == "TC")?  'selected="selected"' : '' ?>>Turks and Caicos Islands</option>
	<option value="TV" <?php echo ($selected == "TV")?  'selected="selected"' : '' ?>>Tuvalu</option>
	<option value="UG" <?php echo ($selected == "UG")?  'selected="selected"' : '' ?>>Uganda</option>
	<option value="UA" <?php echo ($selected == "UA")?  'selected="selected"' : '' ?>>Ukraine</option>
	<option value="AE" <?php echo ($selected == "AE")?  'selected="selected"' : '' ?>>United Arab Emirates</option>
	<option value="GB" <?php echo ($selected == "GB")?  'selected="selected"' : '' ?>>United Kingdom</option>
	<option value="US" <?php echo ($selected == "US")?  'selected="selected"' : '' ?>>United States</option>
	<option value="UM" <?php echo ($selected == "UM")?  'selected="selected"' : '' ?>>United States Minor Outlying Islands</option>
	<option value="UY" <?php echo ($selected == "UY")?  'selected="selected"' : '' ?>>Uruguay</option>
	<option value="UZ" <?php echo ($selected == "UZ")?  'selected="selected"' : '' ?>>Uzbekistan</option>
	<option value="VU" <?php echo ($selected == "VU")?  'selected="selected"' : '' ?>>Vanuatu</option>
	<option value="VE" <?php echo ($selected == "VE")?  'selected="selected"' : '' ?>>Venezuela, Bolivarian Republic of</option>
	<option value="VN" <?php echo ($selected == "VN")?  'selected="selected"' : '' ?>>Viet Nam</option>
	<option value="VG" <?php echo ($selected == "VG")?  'selected="selected"' : '' ?>>Virgin Islands, British</option>
	<option value="VI"<?php echo ($selected == "VI")?  'selected="selected"' : '' ?>>Virgin Islands, U.S.</option>
	<option value="WF" <?php echo ($selected == "WF")?  'selected="selected"' : '' ?>>Wallis and Futuna</option>
	<option value="EH" <?php echo ($selected == "EH")?  'selected="selected"' : '' ?>>Western Sahara</option>
	<option value="YE" <?php echo ($selected == "YE")?  'selected="selected"' : '' ?>>Yemen</option>
	<option value="ZM" <?php echo ($selected == "ZM")?  'selected="selected"' : '' ?>>Zambia</option>
	<option value="ZW" <?php echo ($selected == "ZW")?  'selected="selected"' : '' ?>>Zimbabwe</option>
                    </select>
                </td>
            </tr>

        <?php if($user->has_cap('broker') || $user->has_cap('seller') ){ ?>

      <tr>
            <th><label for="state">State</label></th>
            <td>
            <input type="text" name="state" id="state" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
 <tr>
            <th><label for="city">City</label></th>
            <td>
            <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
<tr>
            <th><label for="company">Company Name</label></th>
            <td>
            <input type="text" name="company" id="company" value="<?php echo esc_attr( get_the_author_meta( 'company', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
<tr>
            <th><label for="company_info">Company Info</label></th>
            <td>
            <textarea name="company_info" id="company_info" rows="3" cols="50"><?php echo esc_attr( get_the_author_meta( 'company_info', $user->ID ) ); ?></textarea>
            </td>
</tr>
<?php } ?>
<?php if(!$user->has_cap('broker') && !$user->has_cap('seller') ){ ?>
<tr>
            <th><label for="flat_num">House/Flat Number</label></th>
            <td>
            <input type="text" name="flat_num" id="flat_num" value="<?php echo esc_attr( get_the_author_meta( 'flat_num', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
<tr>
            <th><label for="street_number">Street Number</label></th>
            <td>
            <input type="text" name="street_number" id="street_number" value="<?php echo esc_attr( get_the_author_meta( 'street_number', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>

<tr>
            <th><label for="zip_code">Post Code</label></th>
            <td>
            <input type="text" name="zip_code" id="zip_code" value="<?php echo esc_attr( get_the_author_meta( 'zip_code', $user->ID ) ); ?>" class="regular-text" />
            </td>
</tr>
<!-- <tr>
            <th><label for="status">User Status</label></th>
            <td>
            <select name="status" id="status" >
                        
             <option value="Active Buyer" <?php echo ($selected == "Active Buyer")?  'selected="selected"' : '' ?>>Active Buyer</option>
            </select>
            </td>
</tr> -->
<?php } ?>
</table>
<h3><?php esc_html_e("Social profile information", "contempo"); ?></h3>
<table class="form-table border-bottom-remove">
                <tr>
                    <th><label for="twitterhandle"><?php esc_html_e('Twitter Username', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="twitterhandle" id="twitterhandle" value="<?php echo esc_attr( get_the_author_meta( 'twitterhandle', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="facebookurl"><?php esc_html_e('Facebook URL', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="facebookurl" id="facebookurl" value="<?php echo esc_attr( get_the_author_meta( 'facebookurl', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="instagramurl"><?php esc_html_e('Instagram URL', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="instagramurl" id="instagramurl" value="<?php echo esc_attr( get_the_author_meta( 'instagramurl', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="linkedinurl"><?php esc_html_e('LinkedIn URL', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="linkedinurl" id="linkedinurl" value="<?php echo esc_attr( get_the_author_meta( 'linkedinurl', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="gplus"><?php esc_html_e('Google+ URL', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
                <tr>
                    <th><label for="youtubeurl"><?php esc_html_e('YouTube URL', 'contempo'); ?></label></th>
                    <td>
                        <input type="text" name="youtubeurl" id="youtubeurl" value="<?php echo esc_attr( get_the_author_meta( 'youtubeurl', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
                </tr>
            </table>


<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) )
    return false;

update_usermeta( $user_id, 'tel', $_POST['tel'] );
update_usermeta( $user_id, 'country', $_POST['country'] );
update_usermeta( $user_id, 'state', $_POST['state'] );
update_usermeta( $user_id, 'city', $_POST['city'] );
update_usermeta( $user_id, 'company', $_POST['company'] );
update_usermeta( $user_id, 'company_info', $_POST['company_info'] );
update_usermeta( $user_id, 'flat_num', $_POST['flat_num'] );
update_usermeta( $user_id, 'street_number', $_POST['street_number'] );
update_usermeta( $user_id, 'zip_code', $_POST['zip_code'] );
//update_user_meta( $user_id, 'status', $_POST['status'] );

update_user_meta( $user_id, 'twitterhandle', $_POST['twitterhandle'] );
update_user_meta( $user_id, 'facebookurl', $_POST['facebookurl'] );
update_user_meta( $user_id, 'instagramurl', $_POST['instagramurl'] );
update_user_meta( $user_id, 'linkedinurl', $_POST['linkedinurl'] );
update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
update_user_meta( $user_id, 'youtubeurl', $_POST['youtubeurl'] );

}

function theme_add_user_zip_code_column( $columns ) {

 $columns['status'] = __( 'User Status', 'theme' );
 return $columns;

} // end theme_add_user_zip_code_column
add_filter( 'manage_users_columns', 'theme_add_user_zip_code_column' );

function theme_show_user_zip_code_data( $value, $column_name, $user_id ) {

 if( 'status' == $column_name ) {
	 return get_user_meta( $user_id, 'status', true );
 } // end if

} // end theme_show_user_zip_code_data
add_action( 'manage_users_custom_column', 'theme_show_user_zip_code_data', 10, 3 );

///////////////////////////
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/////////////////////////
if(!function_exists('ct_currency')) {
	function ct_currency( $echo=true ) {
		global $ct_options;
		$currency = "$";

		if($ct_options['ct_currency']) {
			$currency = esc_html($ct_options['ct_currency']);
		}

		if ( $echo ) {
			echo $currency;
		} else {
			return $currency;
		}
		
	}
}

if(!function_exists('ct_listing_post_count')) {
	function ct_listing_post_count( $userid, $post_type ) {
		if( empty( $userid ) )
		   return false;
		 
		$args = array(
		    'post_type'		=> $post_type,
		    'author'		=> $userid,
		    'post_status'	=> array('draft', 'pending', 'publish')
		);
		    
		$the_query = new WP_Query( $args );
		$user_post_count = $the_query->found_posts;
		 
		return $user_post_count;
	}
}

/////////////////////////////////////////////////////////
if(!function_exists('ct_delete_post_link')) {
	function ct_delete_post_link($link = 'Delete This', $before = '', $after = '') {
	    global $post;
	    $message = 'Are you sure you want to delete ' . get_the_title($post->ID) .' ?';
	    $delLink = wp_nonce_url( esc_url( home_url() ) . '/wp-admin/post.php?action=delete&amp;post=' . $post->ID, 'delete-post_' . $post->ID);
	    $htmllink = '<a class="btn delete-listing" href="' . $delLink . '" data-tooltip="' . __('Delete','contempo') . '" onclick = "if ( confirm(\'' . $message . '\' ) ) { execute(); return true; } return false;" />' . $link . '</a>';
	    echo $before . $htmllink . $after;
	}
}

////////////////////////////
add_action( 'wp_ajax_my_delete_post', 'my_delete_post' );
function my_delete_post(){

	$permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
	if( $permission == false ) {
		echo 'error';
	}
	else {
		wp_delete_post( $_REQUEST['id'] );
		wp_redirect ( home_url("/view-active-buyer-listing/") );
		echo 'success';
	}

	die();
}
//////////////////////////////
add_action( 'wp_ajax_franchise_delete_post', 'franchise_delete_post' );
function franchise_delete_post(){

	$permission = check_ajax_referer( 'franchise_delete_post_nonce', 'nonce', false );
	if( $permission == false ) {
		echo 'error';
	}
	else {
		wp_delete_post( $_REQUEST['id'] );
		wp_redirect ( home_url("/view-franchise-listing/") );
		echo 'success';
	}

	die();
}

//////////////////////////////
add_action( 'wp_ajax_franchise_delete_post1', 'franchise_delete_post1' );
function franchise_delete_post1(){

	$permission = check_ajax_referer( 'franchise_delete_post_nonce1', 'nonce', false );
	if( $permission == false ) {
		echo 'error';
	}
	else {
		wp_delete_post( $_REQUEST['id'] );
		 echo ("<script LANGUAGE='JavaScript'>
          window.alert('bussiness deleted successfully.');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties';
          </script>");
	}

	die();
}