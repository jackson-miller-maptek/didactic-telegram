<?php

/**
 * Maptek Labs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Maptek_Labs
 */

if (!defined('MAPTEK_LABS_VERSION')) {
	// Replace the version number of the theme on each release.
	define('MAPTEK_LABS_VERSION', '1.5.1');
}

if (!function_exists('maptek_labs_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maptek_labs_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Maptek Labs, use a find and replace
		 * to change 'maptek-labs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('maptek-labs', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'maptek-labs'),
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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'maptek_labs_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'maptek_labs_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maptek_labs_content_width()
{
	$GLOBALS['content_width'] = apply_filters('maptek_labs_content_width', 640);
}
add_action('after_setup_theme', 'maptek_labs_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maptek_labs_widgets_init()
{
	/*
									 register_sidebar(
										 array(
											 'name'          => esc_html__('Sidebar', 'maptek-labs'),
											 'id'            => 'sidebar-1',
											 'description'   => esc_html__('Add widgets here.', 'maptek-labs'),
											 'before_widget' => '<section id="%1$s" class="widget %2$s">',
											 'after_widget'  => '</section>',
											 'before_title'  => '<h2 class="widget-title">',
											 'after_title'   => '</h2>',
										 )
									 );
									 */

	register_sidebar(
		array(
			'name' => esc_html__('Footer content', 'maptek-labs'),
			'id' => 'footer-widgets',
			'description' => esc_html__('Add footer content here.', 'maptek-labs'),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'maptek_labs_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function maptek_labs_scripts()
{
	wp_enqueue_style('maptek-v12-style', get_template_directory_uri() . '/maptek_v12.css', array(), MAPTEK_LABS_VERSION);
	wp_enqueue_style('maptek-labs-style', get_stylesheet_uri(), array(), MAPTEK_LABS_VERSION);
	wp_style_add_data('maptek-labs-style', 'rtl', 'replace');

	wp_enqueue_script('maptek-labs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), MAPTEK_LABS_VERSION, true);
	wp_enqueue_script('maptek-labs-geoplugin', 'https://ssl.geoplugin.net/javascript.gp?k=80af4f8d3ea6d542', array(), MAPTEK_LABS_VERSION, true);
	wp_enqueue_script('maptek-labs-cookieOptIn', get_template_directory_uri() . '/js/cookieOptIn.min.js', array(), MAPTEK_LABS_VERSION, true);
	wp_enqueue_script('maptek-labs-bsjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), MAPTEK_LABS_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'maptek_labs_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Prevent Post Object ACF field from allowing drafts
 */
add_filter('acf/fields/post_object/query', 'maptek_labs_acf_post_object_only_publish', 10, 3);
function maptek_labs_acf_post_object_only_publish($args, $field, $post_id)
{
	// $args['post_status'] = 'publish';
	return $args;
}


/**
 * Disable comments
 * from: https://gist.github.com/mattclements/eab5ef656b2f946c4bfb
 */

add_action('admin_init', function () {
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}

	// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});


/**
 * Hide menus in customise 
 */

function maptek_labs_remove_customizer_controls_all($wp_customize)
{

	// To remove other sections, panels, controls look in html source code in chrome dev tools or firefox or whatever and it will tell you the id and whether it's a section or panel or control. 

	$wp_customize->remove_control("custom_logo");
	$wp_customize->remove_control("blogdescription");
	$wp_customize->remove_control("display_header_text");
	// $wp_customize->remove_panel("nav_menus");
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("header_image");
	$wp_customize->remove_section("background_image");
	$wp_customize->remove_panel("widgets");
}
add_action('customize_register', 'maptek_labs_remove_customizer_controls_all', 999);


/**
 * Redirect archives to home page 
 */

function redirect_archive()
{
	if (is_archive()) {
		wp_redirect(home_url(), 301);
		exit();
	}
}
add_action('template_redirect', 'redirect_archive');


/**
 * Redirect attachment pages to parent page
 * Disabled: yoast handles this
 */

function redirect_attachment_pages()
{
	if (is_attachment()) {
		wp_redirect(home_url(), 301);
		exit();
	}
}
// add_action('template_redirect', 'redirect_attachment_pages');

/**
 * Redirect search page to home page 
 */

function redirect_search()
{
	if (is_search()) {
		wp_redirect(home_url(), 301);
		exit();
	}
}
add_action('template_redirect', 'redirect_search');


// __ Move Yoast metaboxes to bottom __
add_filter('wpseo_metabox_prio', function () {
	return 'low';
});

// Breadcrumbs

function simple_breadcrumbs()
{
	if (is_front_page()) {
		return;
	}

	echo '<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">';
	echo '<li class="breadcrumb-item"><a style="color:#dddddd; text-decoration: none" href="' . get_home_url() . '">Maptek Labs</a></li>';

	if (is_single()) {
		echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
	}

	echo '</ol></nav>';
}


/**
 * Contact form
 */
function contact_form($labs_name, $sfdc_campaign_id, $product_interest)
{
	// Don't run if we don't have a campaign ID - the modal button won't appear anyway
	if (empty($sfdc_campaign_id)) {
		return;
	}

	ob_start(); ?>

	<!-- Modal -->
	<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form class="form-horizontal" role="form" id="formID" method="post"
					action="https://go.maptek.com/l/19542/2022-01-31/3vfcdl9">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<h4 class="modal-title" id="contactModalLabel">Contact Maptek about
							<?php echo $labs_name; ?>
						</h4>
					</div>
					<div class="modal-body">

						<?php //include $_SERVER["DOCUMENT_ROOT"] . "/inc/recaptcha_hidden_inputs.php"; 
							?>
						<input name="region" type="hidden" value="en">
						<input type="hidden" name="Campaign_ID" id="Campaign_ID" value="<?php echo $sfdc_campaign_id; ?>">
						<input name="oid" type="hidden" value="00D70000000IfrP">
						<input name="retURL" type="hidden" value="https://labs.maptek.com/thank-you/">
						<input name="lead_source" type="hidden" value="Web">
						<input name="00N70000001yXHT" type="hidden" value="<?php echo $product_interest; ?>">
						<input name="labs_page" type="hidden" value="labs.maptek.com - <?php echo $labs_name; ?>">


						<div class="mb-3 row control-group form-group">
							<label for="first_name" class="col-md-3 col-form-label text-md-end">First Name*</label>
							<div class="col-md-7 controls">
								<input type="text" class="form-control" name="first_name" id="first_name"
									placeholder="First Name" required />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="last_name" class="col-md-3 col-form-label text-md-end">Last Name*</label>
							<div class="col-md-7 controls">
								<input type="text" class="form-control" name="last_name" id="last_name"
									placeholder="Last Name" required />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="email" class="col-md-3 col-form-label text-md-end">Email*</label>
							<div class="col-md-7 controls">
								<input type="email" class="form-control" name="email" id="email" placeholder="Email"
									required />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="phone" class="col-md-3 col-form-label text-md-end">Phone</label>
							<div class="col-md-7 controls">
								<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="title" class="col-md-3 col-form-label text-md-end">Job Title</label>
							<div class="col-md-7 controls">
								<input type="text" class="form-control" name="title" id="title" placeholder="Job Title" />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="company" class="col-md-3 col-form-label text-md-end">Company</label>
							<div class="col-md-7 controls">
								<input type="text" class="form-control" name="company" id="company" placeholder="Company" />
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="office" class="col-md-3 col-form-label text-md-end">Office/Region*</label>
							<div class="col-md-7 selectContainer">
								<select class="form-select" id="00N70000001yXHj" name="00N70000001yXHj"
									title="Office / Region" required>
									<option value="" selected="selected" disabled>--select--</option>
									<option value="Africa">Africa</option>
									<option value="Asia/Oceania">Asia/Oceania</option>
									<option value="Australia">Australia</option>
									<option value="Brasil">Brasil</option>
									<option value="Canada">Canada</option>
									<option value="Chile">Chile</option>
									<option value="Europe">Europe</option>
									<option value="Mexico &amp; the Caribbean">Mexico &amp; the Caribbean</option>
									<option value="Peru">Peru</option>
									<option value="USA">USA</option>
								</select>
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="comments" class="col-md-3 col-form-label text-md-end">Comments</label>
							<div class="col-md-7 controls">
								<textarea class="form-control" name="description" cols="50" rows="5"
									placeholder="Comments" /></textarea>
							</div>
						</div>
						<div class="mb-3 row control-group form-group">
							<label for="comments" class="col-md-3 col-form-label text-md-end"></label>
							<div class="col-md-7 controls">
								<p class="help-block"> (*required fields)</p>
							</div>
						</div>
						<?php // include $_SERVER["DOCUMENT_ROOT"] . "/inc/recaptcha_notice.php"; 
							?>


					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	// Chuck HTML in variable
	$form_modal_html = ob_get_contents();

	// End output buffering
	ob_end_clean();

	// echo  HTML
	echo $form_modal_html;
}
