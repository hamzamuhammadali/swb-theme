<?php
/**
 * Author: Robert DeVore | @deviorobert
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */

require_once 'modules/is-debug.php';
require_once 'vendor/autoload.php';

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$currentUserCan = [];

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {

	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 700, '', true ); // Large Thumbnail.
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
	add_image_size( 'small', 120, '', true ); // Small Thumbnail.
	add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use.
	/*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

	// Add Support for Custom Header - Uncomment below if you're going to use.
	/*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

	// Enables post and comment RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable HTML5 support.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Localisation Support.
	load_theme_textdomain( 'html5blank', get_template_directory() . '/languages' );
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

/**
 * Gets the request parameter.
 *
 * @param string $key The query parameter
 * @param string|null $default The default value to return if not found
 *
 * @return     string|null  The request parameter.
 */

function get_request_parameter( string $key, ?string $default = '' ) {
	// If not request set
	if ( ! isset( $_REQUEST[ $key ] ) || empty( $_REQUEST[ $key ] ) ) {
		return $default;
	}

	$unsplashed = wp_unslash( $_REQUEST[ $key ] );
	if ( is_array( $unsplashed ) ) {
		$output = [];
		foreach ( $unsplashed as $unsplashedElement ) {
			$output[] = strip_tags( (string) $unsplashedElement );
		}
	} else {
		$output = strip_tags( (string) $unsplashed );
	}

	return $output;
}

// HTML5 Blank navigation
function html5blank_nav() {
	wp_nav_menu( array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="nav">%3$s</ul>',
		'depth'           => 0,
		'walker'          => '',
	) );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
		if ( HTML5_DEBUG ) {
			// jQuery
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', get_template_directory_uri() . '/js/lib/jquery.js', array(), '1.11.1' );

			// Conditionizr
			wp_register_script( 'conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0' );

			// Modernizr
			wp_register_script( 'modernizr', get_template_directory_uri() . '/js/lib/modernizr.js', array(), '2.8.3' );

			// Custom scripts
			wp_register_script( 'html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array(
				'conditionizr',
				'modernizr',
				'jquery',
			), '1.0.0' );

			// Enqueue Scripts
			wp_enqueue_script( 'html5blankscripts' );

			// If production
		} else {
			// Scripts minify
			wp_register_script( 'html5blankscripts-min', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0' );
			// Enqueue Scripts
			wp_enqueue_script( 'html5blankscripts-min' );
		}
	}
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
	if ( is_page( 'pagenamehere' ) ) {
		// Conditional script(s)
		wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' );
		wp_enqueue_script( 'scriptname' );
	}
}

// Load HTML5 Blank styles
function html5blank_styles() {
	if ( HTML5_DEBUG ) {
		// Custom CSS
		wp_register_style( 'html5blank', get_template_directory_uri() . '/css/sass/style.css', array(), '1.0' );

		// Register CSS
		wp_enqueue_style( 'html5blank' );
		// Custom CSS

	} else {
		// Custom CSS
		wp_register_style( 'html5blankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0' );
		// Register CSS
		wp_enqueue_style( 'html5blankcssmin' );


	}
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
	register_nav_menus( array( // Using array to specify more menus if needed
		'header-menu' => esc_html( 'Header Menu', 'html5blank' ),
		// Main Navigation
		'extra-menu'  => esc_html( 'Extra Menu', 'html5blank' )
		// Extra Navigation if needed (duplicate as many as you need!)
	) );
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;

	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes, true );
		if ( $key > - 1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

	return $html;
}


// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) ) {
	// Define Sidebar Widget Area 1
	register_sidebar( array(
		'name'          => esc_html( 'Widget Area 1', 'html5blank' ),
		'description'   => esc_html( 'Description for this widget-area...', 'html5blank' ),
		'id'            => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	// Define Sidebar Widget Area 2
	register_sidebar( array(
		'name'          => esc_html( 'Widget Area 2', 'html5blank' ),
		'description'   => esc_html( 'Description for this widget-area...', 'html5blank' ),
		'id'            => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style',
		) );
	}
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total'   => $wp_query->max_num_pages,
	) );
}

// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
function html5wp_index( $length ) {
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p>' . $output . '</p>';
	echo esc_html( $output );
}

// Custom View Article link to Post
function html5_blank_view_article( $more ) {
	global $post;

	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . esc_html_e( 'View Article', 'html5blank' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );

	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar( $avatar_defaults ) {
	$myavatar                     = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[ $myavatar ] = 'Custom Gravatar';

	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() and comments_open() and ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

// Custom Comments Callback
function html5blankcomments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo esc_html( $tag ) ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, $args['avatar_size'] );
		} ?>
		<?php printf( esc_html( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' ) ?></em>
		<br/>
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a
			href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
			printf( esc_html( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( esc_html_e( '(Edit)' ), '  ', '' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
		<?php comment_reply_link( array_merge( $args, array(
			'add_below' => $add_below,
			'depth'     => $depth,
			'max_depth' => $args['max_depth'],
		) ) ) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
//add_action( 'wp_enqueue_scripts', 'html5blank_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_print_scripts', 'html5blank_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'html5blank_styles' ); // Add Theme Stylesheet
add_action( 'init', 'register_html5_menu' ); // Add HTML5 Blank Menu
//add_action( 'init', 'create_post_type_html5' ); // Add our HTML5 Blank Custom Post Type
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'html5wp_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters
add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
// add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
//add_filter( 'excerpt_more', 'html5_blank_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'html5_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode( 'html5_shortcode_demo', 'html5_shortcode_demo' ); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode( 'html5_shortcode_demo_2', 'html5_shortcode_demo_2' ); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5() {
	register_taxonomy_for_object_type( 'category', 'html5-blank' ); // Register Taxonomies for Category
	register_taxonomy_for_object_type( 'post_tag', 'html5-blank' );
	register_post_type( 'html5-blank', // Register Custom Post Type
		array(
			'labels'       => array(
				'name'               => esc_html( 'HTML5 Blank Custom Post', 'html5blank' ), // Rename these to suit
				'singular_name'      => esc_html( 'HTML5 Blank Custom Post', 'html5blank' ),
				'add_new'            => esc_html( 'Add New', 'html5blank' ),
				'add_new_item'       => esc_html( 'Add New HTML5 Blank Custom Post', 'html5blank' ),
				'edit'               => esc_html( 'Edit', 'html5blank' ),
				'edit_item'          => esc_html( 'Edit HTML5 Blank Custom Post', 'html5blank' ),
				'new_item'           => esc_html( 'New HTML5 Blank Custom Post', 'html5blank' ),
				'view'               => esc_html( 'View HTML5 Blank Custom Post', 'html5blank' ),
				'view_item'          => esc_html( 'View HTML5 Blank Custom Post', 'html5blank' ),
				'search_items'       => esc_html( 'Search HTML5 Blank Custom Post', 'html5blank' ),
				'not_found'          => esc_html( 'No HTML5 Blank Custom Posts found', 'html5blank' ),
				'not_found_in_trash' => esc_html( 'No HTML5 Blank Custom Posts found in Trash', 'html5blank' ),
			),
			'public'       => true,
			'hierarchical' => true,
			// Allows your posts to behave like Hierarchy Pages
			'has_archive'  => true,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			// Go to Dashboard Custom HTML5 Blank post for supports
			'can_export'   => true,
			// Allows export in Tools > Export
			'taxonomies'   => array( 'post_tag', 'category' )
			// Add Category and Post Tags support
		) );
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo( $atts, $content = null ) {
	return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function html5_shortcode_demo_2( $atts, $content = null ) {
	return '<h2>' . $content . '</h2>';
}

add_shortcode( 'googleinfo', 'googlereviewsshort' );

function googlereviewsshort( $attributes ) {
	global $reviewLink;

	$attribute = shortcode_atts( array( 'placeid' => 'ChIJ587jZP7ZnUcRHA-EplDh5xw', 'type' => '' ), $attributes );

	$reviewLink = 'https://www.google.com/maps/search/?api=1&query=Google&query_place_id=' . $attribute['placeid'];

	$url3 = "https://maps.googleapis.com/maps/api/place/details/json?placeid=" . $attribute['placeid'] . "&fields=opening_hours,address_components,reviews,name,rating,formatted_phone_number&key=AIzaSyB2cjJAXR34mqCEOsLtJYlRq0H8yArfjR0&language=de";
	$ch3  = curl_init();
	curl_setopt( $ch3, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch3, CURLOPT_URL, $url3 );
	$result3 = curl_exec( $ch3 );
	curl_close( $ch3 );

	$output  = '';
	$result3 = json_decode( $result3 );

	if ( $attribute['type'] === 'reviews' ) {
		$reviews = $result3->result->reviews;

		shuffle( $reviews );
		foreach ( $reviews as $review ) {
			if ( $review->rating >= 4 ) {
				$output .= '<li class="splide__slide rating__tile">
              <div class="rating__stars"><span class="star-icon">★★★★★' . '</span><span class="rating__timing">' . $review->relative_time_description . '</span></div>' . ' ' . '<div class="rating__author">' . $review->author_name . '</div>' . '<div class="rating__comment">' . substr( $review->text, 0, 223 ) . ( strlen( $review->text ) > 223 ? ' …' : '' ) . '</div>
            </li>';
			}
		}

		$staticReviews = array(
			array(
				'timing'  => 'vor 2 Wochen',
				'author'  => 'Dieter F. BAUER',
				'comment' => 'Wir sind sowohl mit der Leistung der Facharbeiter als auch mit der telefonischen Betreuung sehr zufrieden. Seit der Installation Anfang Februar 2021 sind wir zu 86,8% autark. Das begeistert uns. Gut, dass uns ein Batteriespeicher empfohlen wurde, durch den wir einen Stromausfall  eine Zeit lang  überbrücken könnten.',
			),
			array(
				'timing'  => 'vor 3 Monaten',
				'author'  => 'Andreas Backhaus',
				'comment' => 'Im Frühjahr diesen  Jahres haben wir uns entschieden ein Solaranlage auf unser Haus(50 Jahre alt) zu montieren. Wir haben uns bei verschiedenen Herstellern erkundigt, wie zufällig die Fa SWB-Solar sich per Telefon gemeldet hat , weil eine Berater in der Nähe sei. Da wir gerne eine Anlage mit Speicher haben wollten und ich selber HV-Batterien entwickle, war ich bei allen Beratungen sehr skeptisch. Doch der  Hr. Monti von SWB-Solar konnte alle meine Zweifel aus dem Weg räumen und hat uns sehr gut beraten. Das Angebot war auf uns zugeschnitten und gut. Besser als die anderen Angebote, welche wir teilweise nicht einmal bekommen haben. Zu unserer Überraschung sollte die Anlage bereits 2 Monate später montiert werden.
Die Montage der Anlage wurde durch 2 Subunternehmer ausgeführt. Am Morgen als die Solaranlage aufs Dach montiert werden sollte kamen die Monteure und haben sich mit uns besprochen wie genau die Anlage montiert werden soll. Am Abend war alles sauber montiert und die Monteure sind heim gefahren. Dann gab es leider eine Engpass für die Lieferung des Speichers von Senec auf Grund der großen Nachfrage, aber auch diese Problem löste Hr. Monti. Nach dem wir 80% bezahlt hatten, wurde ein Termin zur Elektromontage vereinbart. Pünktlich wurde dann das Installationsmaterial angeliefert und auch die Monteure haben den Elektroanschluss in 2 Tagen durchgeführt. Dann wurden durch die Fa. SWB Solar die benötigten Unterlagen erstellt und zum Netzbetreiber weitergeleitet. Dieses verzögert sich leider auch leicht, da die Fa. SWB sich genau zu diesem Zeitpunkt im Betriebsurlaub befand. Aber auch hier konnte man sich wieder an den Hr. Monti wenden und es wurde sich gekümmert.',
			),
		);


		foreach ( $staticReviews as $review ) {
			$output .= '<li class="splide__slide rating__tile">
              <div class="rating__stars"><span class="star-icon">★★★★★' . '</span><span class="rating__timing">' . $review['timing'] . '</span></div>' . ' ' . '<div class="rating__author">' . $review['author'] . '</div>' . '<div class="rating__comment">' . substr( $review['comment'], 0, 223 ) . ( strlen( $review['comment'] ) > 223 ? ' …' : '' ) . '</div>
            </li>';
		}

		/*$output.= '<li class="splide__slide rating__tile">
              <div class="rating__stars"><span class="star-icon">★★★★★' . '</span><span class="rating__timing"></span></div> <div class="rating__author"></div><div class="rating__comment">' . substr($review->text, 0, 223) . (strlen($review->text) > 223 ? ' …' : '') . '</div>
            </li>';*/
	} else {
		if ( $attribute['type'] === 'address' ) {
			$result  = $result3->result;
			$address = $result->address_components;
			$output  = $result->name . '<br>';
			$output  .= $address[1]->long_name . ' ' . $address[0]->long_name . '<br>';
			$output  .= $address[8]->long_name . ' ' . $address[3]->long_name;
		} else {
			if ( $attribute['type'] === 'hours' ) {
				$hours    = $result3->result->opening_hours;
				$opening  = str_split( $hours->periods[0]->open->time, 2 );
				$opening2 = str_split( $hours->periods[1]->open->time, 2 );
				$close    = str_split( $hours->periods[0]->close->time, 2 );
				$close2   = str_split( $hours->periods[1]->close->time, 2 );
				$output   = '<div class="footer__opening">
                <div class="row no-gutters">
                  <div class="col-auto mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35.012" height="35.012" viewBox="0 0 35.012 35.012">
                      <g id="clock_1_" data-name="clock (1)" transform="translate(0)">
                        <path id="Pfad_181" data-name="Pfad 181" d="M29.884,5.127a17.506,17.506,0,0,0-25.1,24.4.514.514,0,1,0,.747-.706A16.468,16.468,0,1,1,6.986,30.19a.514.514,0,0,0-.657.791A17.506,17.506,0,0,0,29.884,5.127Z" transform="translate(0 0)" fill="#fff"/>
                        <path id="Pfad_182" data-name="Pfad 182" d="M65.881,45.816a.514.514,0,0,0-.025-.726,14.683,14.683,0,1,0,1.452,1.567.514.514,0,1,0-.8.642,13.517,13.517,0,0,1,2.99,8.532,13.665,13.665,0,1,1-4.341-9.99.514.514,0,0,0,.726-.025Z" transform="translate(-38.325 -38.325)" fill="#fff"/>
                        <path id="Pfad_183" data-name="Pfad 183" d="M249.513,69.963V68.371a.514.514,0,1,0-1.028,0v1.592a.514.514,0,0,0,1.028,0Z" transform="translate(-231.493 -63.217)" fill="#fff"/>
                        <path id="Pfad_184" data-name="Pfad 184" d="M248.485,406.35v1.592a.514.514,0,1,0,1.028,0V406.35a.514.514,0,0,0-1.028,0Z" transform="translate(-231.493 -378.084)" fill="#fff"/>
                        <path id="Pfad_185" data-name="Pfad 185" d="M407.942,249.513a.514.514,0,1,0,0-1.028H406.35a.514.514,0,0,0,0,1.028Z" transform="translate(-378.084 -231.493)" fill="#fff"/>
                        <path id="Pfad_186" data-name="Pfad 186" d="M68.372,248.485a.514.514,0,1,0,0,1.028h1.592a.514.514,0,1,0,0-1.028Z" transform="translate(-63.218 -231.493)" fill="#fff"/>
                        <path id="Pfad_187" data-name="Pfad 187" d="M138.3,152.538a.514.514,0,1,0,.661-.787l-5.585-4.691a2.252,2.252,0,0,0,.242-.882l3.261-3.306a1.542,1.542,0,0,0-2.2-2.165l-3.034,3.076a2.266,2.266,0,0,0-.753.026l-6.127-5.46a1.542,1.542,0,1,0-2.051,2.3l2.965,2.642a.514.514,0,1,0,.684-.767l-2.965-2.642a.514.514,0,1,1,.684-.767l5.809,5.177a2.281,2.281,0,0,0-.62.824l-1.374-1.224a.514.514,0,1,0-.684.767l1.886,1.68a2.268,2.268,0,0,0,3.611,1.507Zm-2.884-11.11a.514.514,0,0,1,.732.722l-2.786,2.825a2.287,2.287,0,0,0-.675-.779Zm-4.063,5.846a1.242,1.242,0,1,1,1.242-1.242A1.244,1.244,0,0,1,131.357,147.274Z" transform="translate(-113.851 -128.526)" fill="#fff"/>
                      </g>
                    </svg>
                  </div>
                  <div class="col-auto">
                    Öffnungszeiten<br>Montag - Freitag<br>' . $opening[0] . ':' . $opening[1] . ' - ' . $close[0] . ':' . $close[1] . ' Uhr, <br>' . $opening2[0] . ':' . $opening2[1] . ' - ' . $close2[0] . ':' . $close2[1] . ' Uhr</div></div></div>';
			} else {
				if ( $attribute['type'] === 'contact' ) {
					$output = '<div class="footer__contact">
                <div class="row no-gutters">
                <div class="col-auto mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="34.021" height="34.758" viewBox="0 0 34.021 34.758">
                  <g id="phone-call" transform="translate(-5.427 0)">
                  <g id="Gruppe_174" data-name="Gruppe 174" transform="translate(5.427 0)">
                    <path id="Pfad_158" data-name="Pfad 158" d="M28.451,23.262a2.534,2.534,0,0,0-3.468-.905L21.6,24.336a1.357,1.357,0,0,1-1.858-.488L13.9,14.044a1.357,1.357,0,0,1,.484-1.857l3.378-1.98h0a2.534,2.534,0,0,0,.9-3.468L15.454,1.254a2.534,2.534,0,0,0-3.468-.9L9.675,1.7A8.675,8.675,0,0,0,5.538,7.578a.508.508,0,1,0,1,.189A7.66,7.66,0,0,1,9.954,2.723l4.748,8.1-.83.486a2.373,2.373,0,0,0-.846,3.251l5.844,9.805a2.376,2.376,0,0,0,3.248.847l.83-.486,4.748,8.1a7.667,7.667,0,0,1-10.239-2.871l-10-16.9a7.592,7.592,0,0,1-1.014-3.1.508.508,0,1,0-1.011.1,8.6,8.6,0,0,0,1.15,3.515l10,16.9a8.678,8.678,0,0,0,11.868,3.1l2.311-1.354a2.534,2.534,0,0,0,.905-3.468ZM12.4,4.89,10.829,2.205l1.671-.98a1.518,1.518,0,0,1,2.077.542l3.215,5.485A1.518,1.518,0,0,1,17.25,9.33l-1.671.98ZM30.947,30.412a1.508,1.508,0,0,1-.7.926l-1.671.98-4.75-8.1,1.671-.98a1.518,1.518,0,0,1,2.077.542l3.215,5.485a1.508,1.508,0,0,1,.159,1.151Z" transform="translate(-5.427 0)" fill="#fff"/>
                    <path id="Pfad_159" data-name="Pfad 159" d="M267.137,30.453a8.567,8.567,0,0,0-6.076-2.5h-.068a8.627,8.627,0,0,0-4.074,16.195v1.849a.823.823,0,0,0,.482.754.835.835,0,0,0,.351.078.824.824,0,0,0,.536-.2l1.747-1.485a8.685,8.685,0,0,0,5.027-.922.508.508,0,1,0-.472-.9,7.628,7.628,0,0,1-3.529.866,7.708,7.708,0,0,1-.976-.062.835.835,0,0,0-.646.19l-1.5,1.278V44.034a.828.828,0,0,0-.44-.733A7.611,7.611,0,0,1,261,28.967h.06a7.61,7.61,0,0,1,5.324,13.047.508.508,0,1,0,.711.726,8.626,8.626,0,0,0,.04-12.286Z" transform="translate(-235.665 -26.053)" fill="#fff"/>
                    <path id="Pfad_160" data-name="Pfad 160" d="M323.34,104.125h-7.727a.508.508,0,1,0,0,1.016h7.727a.508.508,0,1,0,0-1.016Z" transform="translate(-294.081 -97.056)" fill="#fff"/>
                    <path id="Pfad_161" data-name="Pfad 161" d="M371.906,147.47h-4.19a.508.508,0,1,0,0,1.016h4.19a.508.508,0,0,0,0-1.016Z" transform="translate(-342.647 -137.459)" fill="#fff"/>
                    <path id="Pfad_162" data-name="Pfad 162" d="M315.612,148.487h1.171a.508.508,0,0,0,0-1.016h-1.171a.508.508,0,1,0,0,1.016Z" transform="translate(-294.081 -137.46)" fill="#fff"/>
                    <path id="Pfad_163" data-name="Pfad 163" d="M315.612,191.832h7.727a.508.508,0,1,0,0-1.016h-7.727a.508.508,0,1,0,0,1.016Z" transform="translate(-294.081 -177.862)" fill="#fff"/>
                  </g>
                  </g>
                  </svg>
                </div>
                <div class="col-auto">
                  +49 (0)89 215 376 39<br>
                  <a href="mailto:info@swb-solar.de">info@swb-solar.de</a>
                </div>
                </div>
              </div>';
				}
			}
		}
	}

	return $output;

}


// php function to convert csv to json format
function csvToJson( $fname ) {
	// open csv file
	if ( ! ( $fp = fopen( $fname, 'r' ) ) ) {
		die( "Can't open file..." );
	}

	//read csv headers
	$key = fgetcsv( $fp, "1024", ";" );

	// parse csv rows into array
	$json = array();
	while ( $row = fgetcsv( $fp, "1024", ";" ) ) {
		$json[] = array_combine( $key, $row );
	}

	// release file handle
	fclose( $fp );

	// encode array to json
	return json_encode( $json );
}

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}

add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 *
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 *
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}

/*SWB STUFF=========================================================================================================================*/


// GLOBAL Variables
$status = (object) [
	'pending'  => 'Ausstehend',
	'sold'     => 'Verkauft',
	'not-sold' => 'Nicht verkauft',
	'funding'  => 'In Finanzierung',
];

$miscInformation    = [
	'einheit'       => 'Einheit',
	'name'          => 'Name',
	'description2'  => 'Beschreibung',
	'description3'  => 'Beschreibung',
	'description4'  => 'Beschreibung',
	'description5'  => 'Beschreibung',
	'description6'  => 'Beschreibung',
	'description7'  => 'Beschreibung',
	'description8'  => 'Beschreibung',
	'description9'  => 'Beschreibung',
	'description10' => 'Beschreibung',
	'description11' => 'Beschreibung',
	'description12' => 'Beschreibung',
];
$storageInformation = [
	'active'       => 'Für Angebotserstellung berücksichtigen',
	'typ'          => 'Energiespeicher Typ',
	'name'         => 'Name',
	'beschreibung' => 'Beschreibung',
	'price'        => 'Einkaufspreis letzte Preisliste',
	'kwhkapazität' => 'kWh-Kapazität',
	'groesse'      => 'Größe kWh',
	'modell'       => 'Modell',
	'masse'        => 'Maße',
	'gewicht'      => 'Gewicht',
	'installation' => 'Installation',
	'diagnose'     => 'Diagnose',
	'wartung'      => 'Wartung',
	'sicherheit'   => 'Sicherheit',
	'sicherheit2'  => 'Sicherheit 2',
	'garantie'     => 'Garantie',
	'garantie2'    => 'Garantie 2',
	'garantie3'    => 'Garantie 3',
	'garantie4'    => 'Garantie 4',
	'garantie5'    => 'Garantie 5',
	'garantie6'    => 'Garantie 6',
	'anhang'       => 'PDF Anhang Dateiname',
	'cloud'        => 'Cloud',
	'agreements'   => 'Erlaubte Zusatzvereinbarungen',
];

$moduleInformation = [
	'active'            => 'Für Angebotserstellung berücksichtigen',
	'pvmoduleid'        => 'PV-Module-ID',
	'hersteller'        => 'Hersteller',
	'nummer'            => 'Nr',
	'typ'               => 'Typ',
	'preis'             => 'Einkaufspreis letzte Preisliste',
	'produktTyp'        => 'ProduktTyp',
	'leistungstoleranz' => 'Leistungstoleranz',
	'modulabmessungH'   => 'Modulabmessung H',
	'modulabmessungB'   => 'Modulabmessung B',
	'modulabmessungT'   => 'Modulabmessung T',
	'kg'                => 'Kg',
	'wirkungsgrad'      => 'Wirkungsgrad',
	'modultechnik'      => 'Modultechnik',
	'leistungsgarantie' => 'Leistungsgarantie des Herstellers -Jahre',
	'produktgarantie'   => 'Produktgarantie	Max.',
	'schneelast'        => 'Schneelast (Pa)',
	'anhang'            => 'PDF Anhang Dateiname',
];

$agreementInformation = [
	'beschreibung' => 'Beschreibung',
	'qty'          => 'Benötigt Stück-Feld',
	'price'        => 'Verkaufspreis'
];

$inverterInformation = [
	'name'          => 'Name',
	'beschreibung'  => 'Beschreibung I',
	'beschreibung2' => 'Beschreibung II',
	'beschreibung3' => 'Beschreibung III',
	'beschreibung4' => 'Beschreibung IV',
	'beschreibung5' => 'Beschreibung V',
	'beschreibung6' => 'Beschreibung VI',
	'anhang'        => 'PDF Anhang Dateiname',
];


function create_posttype() {
	register_post_type( 'customer', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Angebote' ),
				'singular_name' => __( 'Angebot' ),
				'add_new_item'  => __( 'Kunde und Angebot erstellen' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'customer' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-text-page',
			'capability_type' => 'order',
			'map_meta_cap'    => true,
			'menu_position'   => 1,
		) );

	register_post_type( 'lead', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Leads' ),
				'singular_name' => __( 'Lead' ),
				'add_new_item'  => __( 'Lead erstellen' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'lead' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-businessperson',
			'capability_type' => 'lead',
			'map_meta_cap'    => true,
			'menu_position'   => 10,
		) );

	register_post_type( 'storage', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Speicher' ),
				'singular_name' => __( 'Speicher' ),
				'add_new_item'  => __( 'Neuer Speicher' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'storage' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-businessman',
			'show_in_menu'    => 'settings',
			'capability_type' => 'storage',
			'map_meta_cap'    => true,
		) );

	register_post_type( 'module', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Module' ),
				'singular_name' => __( 'Module' ),
				'add_new_item'  => __( 'Neues Modul' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'module' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-businessman',
			'show_in_menu'    => 'settings',
			'capability_type' => 'module',
			'map_meta_cap'    => true,
		) );

	register_post_type( 'inverter', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Wechselrichter' ),
				'singular_name' => __( 'Wechselrichter' ),
				'add_new_item'  => __( 'Neuer Wechselrichter' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'inverter' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-randomize',
			'show_in_menu'    => 'settings',
			'capability_type' => 'inverter',
			'map_meta_cap'    => true,
		) );

	register_post_type( 'agreement', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Zusatzverinbarungen' ),
				'singular_name' => __( 'Zusatzvereinbarung' ),
				'add_new_item'  => __( 'Neue Zusatzvereinbarung' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'agreement' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-businessman',
			'show_in_menu'    => 'settings',
			'capability_type' => 'agreement',
			'map_meta_cap'    => true,
		) );

	register_post_type( 'misc', // CPT Options
		array(
			'labels'          => array(
				'name'          => __( 'Positionen' ),
				'singular_name' => __( 'Position' ),
				'add_new_item'  => __( 'Neuer Position' ),
			),
			'public'          => true,
			'has_archive'     => false,
			'rewrite'         => array( 'slug' => 'misc' ),
			'show_in_rest'    => true,
			'supports'        => array( '' ),
			'menu_icon'       => 'dashicons-text-page',
			'show_in_menu'    => 'settings',
			'capability_type' => 'misc',
			'map_meta_cap'    => true,
		) );
}

function init_order_status_page() {
	if ( get_page_by_title( 'Auftragsstatus' ) !== null ) {
		return;
	}

	$statusPage = [
		'post_title'    => 'Auftragsstatus',
		'post_content'  => 'Auftragsstatus',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'page_template' => 'page-status.php',
	];
	wp_insert_post( $statusPage );
}

//add_action( 'init', 'init_order_status_page' );
add_action( 'init', 'create_posttype' );
add_action( 'add_meta_boxes', 'removeMetaBoxes', 100 );
add_action( 'add_meta_boxes', 'registerMetaBoxes' );
add_filter( 'display_post_states', '__return_false' );

function removeMetaBoxes() {
	remove_meta_box( 'wpseo_meta', 'customer', 'normal' );
	remove_meta_box( 'wpseo_meta', 'storage', 'normal' );
	remove_meta_box( 'wpseo_meta', 'misc', 'normal' );
	remove_meta_box( 'wpseo_meta', 'module', 'normal' );
	remove_meta_box( 'wpseo_meta', 'agreement', 'normal' );
	remove_meta_box( 'wpseo_meta', 'inverter', 'normal' );
	remove_meta_box( 'wpseo-score', 'customer', 'normal' );
	remove_meta_box( 'wpseo-score', 'storage', 'normal' );
	remove_meta_box( 'wpseo-score', 'misc', 'normal' );
	remove_meta_box( 'wpseo-score', 'module', 'normal' );
	remove_meta_box( 'wpseo-score', 'agreement', 'normal' );
	remove_meta_box( 'wpseo-score', 'inverter', 'normal' );
	remove_meta_box( 'submitdiv', 'customer', 'side' );
	remove_meta_box( 'submitdiv', 'storage', 'side' );
	remove_meta_box( 'submitdiv', 'misc', 'side' );
	remove_meta_box( 'submitdiv', 'module', 'side' );
	remove_meta_box( 'submitdiv', 'agreement', 'side' );
	remove_meta_box( 'submitdiv', 'inverter', 'side' );
}

function registerMetaBoxes() {
	$screen = get_current_screen();
	//	add_meta_box( 'orderstatus', __( 'Order Status', 'textdomain' ), 'orderStatus', 'customer', 'normal', 'high' );
	add_meta_box( 'order', __( 'Auftrag', 'textdomain' ), 'order', 'customer' );
	add_meta_box( 'lead', __( 'Lead', 'textdomain' ), 'lead', 'lead' );
	//	add_meta_box( 'contactinformation', __( 'Kontaktinformationen', 'textdomain' ), 'contactinformation', 'customer' );
	//	add_meta_box( 'pvInformation', __( 'Eckdaten PV', 'textdomain' ), 'pvInformation', 'customer' );
	//	add_meta_box( 'orderAttachmentsForm', 'Uploads', 'orderAttachmentsForm', 'customer' );


	//add_meta_box( 'offerInformation', __( 'Angebot', 'textdomain' ), 'offerInformation', 'customer' );
	add_meta_box( 'storageInformation', __( 'Speicher Informationen', 'textdomain' ), 'storageInformation', 'storage' );
	add_meta_box( 'miscInformation', __( 'Sonstiges', 'textdomain' ), 'miscInformation', 'misc' );
	add_meta_box( 'moduleInformation', __( 'Modul Informationen', 'textdomain' ), 'moduleInformation', 'module' );
	add_meta_box( 'agreementInformation', __( 'Zusatzvereinbarung Informationen', 'textdomain' ), 'agreementInformation', 'agreement' );
	add_meta_box( 'inverterInformation', __( 'Wechselrichter Informationen', 'textdomain' ), 'inverterInformation', 'inverter' );
}

function view( $template, $variables = [], $print = true ) {
	$output   = null;
	$template = template( $template );
	if ( file_exists( $template ) ) {
		// Extract the variables to a local namespace
		extract( $variables, EXTR_OVERWRITE );

		// Start output buffering
		ob_start();

		// Include the template file
		include $template;

		// End buffering and return its contents
		$output = ob_get_clean();
	}
	if ( $print ) {
		print $output;
	}

	return $output;

}

function template( $template ): string {
	return get_template_directory() . '/templates/' . $template . '.phtml';
}


function storageInformation( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'storage_fields' );

	global $storageInformation;

	$output = '<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">';
	foreach ( $storageInformation as $key => $value ) {
		if ( $key === 'active' ) {
			$output .= '<div class="form-group checkbox"><input name="' . $key . '" class="form-control" type="checkbox" id="' . $key . '" ' . ( get_post_meta( $post->ID, $key, true ) === 'on' ? 'checked' : '' ) . '><label for="' . $key . '">' . $value . ' </label></div>';
		} else {
			$output .= '<div class="form-group text"><label>' . $value . ' </label><input name="' . $key . '" class="form-control" type="text" value="' . get_post_meta( $post->ID, $key, true ) . '"></div>';
		}
	}
	$output .= '<button class="button-primary"><span>Speichern</span></button>';
	echo $output;
}

function miscInformation( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'misc_fields' );

	global $miscInformation;

	$output = '<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">';
	foreach ( $miscInformation as $key => $value ) {
		$output .= '<div class="form-group text"><label>' . $value . ' </label><input name="' . $key . '" class="form-control" type="text" value="' . get_post_meta( $post->ID, $key, true ) . '"></div>';
	}
	$output .= '<button class="button-primary"><span>Speichern</span></button>';
	echo $output;
}

function moduleInformation( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'module_fields' );

	global $moduleInformation;

	$output = '<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">';
	foreach ( $moduleInformation as $key => $value ) {
		if ( $key === 'active' ) {
			$output .= '<div class="form-group checkbox"><input name="' . $key . '" class="form-control" type="checkbox" id="' . $key . '" ' . ( get_post_meta( $post->ID, $key, true ) === 'on' ? 'checked' : '' ) . '><label for="' . $key . '">' . $value . ' </label></div>';
		} else {
			$output .= '<div class="form-group text"><label>' . $value . ' </label><input name="' . $key . '" class="form-control" type="text" value="' . get_post_meta( $post->ID, $key, true ) . '"></div>';
		}
	}
	$output .= '<button class="button-primary"><span>Speichern</span></button>';
	echo $output;
}

function agreementInformation( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'agreement_fields' );

	global $agreementInformation;

	$output = '<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">';
	foreach ( $agreementInformation as $key => $value ) {
		$output .= '<div class="form-group text"><label>' . $value . ' </label><input name="' . $key . '" class="form-control" type="text" value="' . get_post_meta( $post->ID, $key, true ) . '"></div>';
	}
	$output .= '<button class="button-primary"><span>Speichern</span></button>';
	echo $output;
}

function inverterInformation( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'inverter_fields' );

	global $inverterInformation;

	$output = '<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">';
	foreach ( $inverterInformation as $key => $value ) {
		$output .= '<div class="form-group text"><label>' . $value . ' </label><input name="' . $key . '" class="form-control" type="text" value="' . get_post_meta( $post->ID, $key, true ) . '"></div>';
	}
	$output .= '<button class="button-primary"><span>Speichern</span></button>';
	echo $output;
}

function users( string $userType ): array {
	return get_users( [
		'role'    => $userType,
		'orderby' => 'user_nicename',
		'order'   => 'ASC',
	] );
}

function dcTechnicians(): array {
	return users( 'dc_technician' );
}

function acTechnicians(): array {
	return users( 'ac_technician' );
}

function initOrderRole( $roleName, $roleDisplayName, array $capabilities ) {
	$role = add_role( $roleName, $roleDisplayName );
	if ( $role === null ) {
		$role = get_role( $roleName );
	}

	foreach ( $capabilities as $capability ) {
		$role->add_cap( $capability, true );
	}
}

// create a new user role
function initOrderRoles() {
	initOrderRole( 'administrator', 'Admin', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
		'dashboard_leads',
		'spread_sheet_orders',
	] );

	initOrderRole( 'director', 'Geschäftsführer', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
		'spread_sheet_orders',
		'delete_orders',
		'delete_others_orders',
		'delete_private_orders',
		'dashboard_leads'
	] );

	initOrderRole( 'dc_technician', 'DC Monteur', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );

	initOrderRole( 'ac_technician', 'AC Monteur', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );

	initOrderRole( 'dc_project_manager', 'DC Projektierung', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
		'spread_sheet_orders',
	] );

	initOrderRole( 'ac_project_manager', 'AC Project Manager', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
		'spread_sheet_orders',
	] );

	initOrderRole( 'project_manager', 'Projektierung', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
		'spread_sheet_orders',
	] );

	initOrderRole( 'controlling', 'Buchhaltung', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );

	initOrderRole( 'seller', 'Verkäufer', [
		'edit_orders',
		'edit_private_orders',
		'read_private_orders',
		'read_private_storages',
		'read_private_agreements',
		'read_private_miscs',
		'read_private_inverters',
		'read_private_modules',
		'read_private_pages',
		'dashboard_orders',
		'dashboard_leads',
	] );

	initOrderRole( 'registration', 'An- und Fertigmeldung', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );

	initOrderRole( 'pv_scout', 'TECHNISCHE MACHBARKEIT', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );

	initOrderRole( 'qa_manager', 'QS Manager', [
		'edit_orders',
		'edit_others_orders',
		'edit_private_orders',
		'edit_published_orders',
		'read_private_orders',
		'dashboard_orders',
	] );
}

// add the example_role
add_action( 'init', 'initOrderRoles' );
add_action( 'init', static function () {
	if ( get_request_parameter( 'reset_order' ) !== 'on' ) {
		return;
	}
	$orderId = get_request_parameter( 'post' );
	$order   = get_post( $orderId );

	if ( $order === null ) {
		return;
	}

	update_post_meta( $order->ID, 'step', 1 );
	update_post_meta( $order->ID, 'status', 'pending' );
	delete_post_meta( $order->ID, 'ac_appointment' );
	delete_post_meta( $order->ID, 'ac_technician' );
	delete_post_meta( $order->ID, 'dc_appointment' );
	delete_post_meta( $order->ID, 'dc_delivery' );
	delete_post_meta( $order->ID, 'dc_technician' );
	delete_post_meta( $order->ID, 'first-billing' );
	delete_post_meta( $order->ID, 'second-billing' );
	delete_post_meta( $order->ID, 'registration' );
	delete_post_meta( $order->ID, 'notes' );
	delete_post_meta( $order->ID, 'customer_notes' );
	delete_post_meta( $order->ID, 'seller_filesuploaded' );
	delete_post_meta( $order->ID, 'filesuploaded' );
	delete_post_meta( $order->ID, 'ac_filesuploaded' );
	delete_post_meta( $order->ID, 'order_start_date' );
	delete_post_meta( $order->ID, 'project_start_date' );
	delete_post_meta( $order->ID, 'storage_delivery' );
	delete_post_meta( $order->ID, 'defects' );
	delete_post_meta( $order->ID, 'qacall' );

	foreach ( get_post_meta( $order->ID ) as $key => $value ) {
		if ( str_starts_with( $key, 'orderAttachments-' ) ) {
			delete_post_meta( $order->ID, $key );
		}
	}

	$projectUploadsDir = wp_upload_dir()['path'] . '/orders-attachments/' . $order->ID;
	if ( is_dir( $projectUploadsDir ) && $order->ID != '' ) {
		deleteDirectory( $projectUploadsDir );
	}

	wp_redirect( htmlspecialchars_decode( get_edit_post_link( $order->ID ) ) );
	die();
} );

add_action( 'init', static function () {

	if ( get_request_parameter( 'deleteOrder' ) !== 'on' ) {
		return;
	}

	$orderId = get_request_parameter( 'post' );
	$order   = get_post( $orderId );

	if ( $order === null ) {
		return;
	}

	$projectUploadsDir = wp_upload_dir()['path'] . '/orders-attachments/' . $orderId;
	if ( is_dir( $projectUploadsDir ) && $order->ID != '' ) {
		deleteDirectory( $projectUploadsDir );
	}

	wp_delete_post( $orderId );

	wp_redirect( 'https://www.swb.solar/wp-admin/edit.php?post_type=customer&page=dashboard' );
	die();
} );

add_action( 'init', static function () {

	$orderId = get_request_parameter( 'post' );
	$order   = get_post( $orderId );

	if ( get_request_parameter( 'projectPdf' ) !== 'on' ) {
		return;
	}

	generateSummaryPDF( $order->ID );

} );


function deleteDirectory( $dir ) {
	if ( ! file_exists( $dir ) ) {
		return true;
	}

	if ( ! is_dir( $dir ) ) {
		return unlink( $dir );
	}

	foreach ( scandir( $dir ) as $item ) {
		if ( $item == '.' || $item == '..' ) {
			continue;
		}

		if ( ! deleteDirectory( $dir . DIRECTORY_SEPARATOR . $item ) ) {
			return false;
		}

	}

	return rmdir( $dir );
}

add_action( 'init', static function () {
	if ( get_request_parameter( 'softreset' ) !== 'on' ) {
		return;
	}
	$orderId = get_request_parameter( 'post' );
	$order   = get_post( $orderId );

	if ( $order === null ) {
		return;
	}

	update_post_meta( $order->ID, 'step', 1 );
	delete_post_meta( $order->ID, 'ac_appointment' );
	delete_post_meta( $order->ID, 'ac_technician' );
	delete_post_meta( $order->ID, 'dc_appointment' );
	delete_post_meta( $order->ID, 'dc_delivery' );
	delete_post_meta( $order->ID, 'dc_technician' );
	delete_post_meta( $order->ID, 'first-billing' );
	delete_post_meta( $order->ID, 'second-billing' );
	delete_post_meta( $order->ID, 'registration' );
	//delete_post_meta( $order->ID, 'notes' );
	//delete_post_meta( $order->ID, 'customer_notes' );
	//delete_post_meta( $order->ID, 'seller_filesuploaded' );
	//delete_post_meta( $order->ID, 'filesuploaded' );
	//delete_post_meta( $order->ID, 'ac_filesuploaded' );
	//delete_post_meta( $order->ID, 'order_start_date' );
	//delete_post_meta( $order->ID, 'project_start_date' );

	wp_redirect( htmlspecialchars_decode( get_edit_post_link( $order->ID ) ) );
	die();
} );

add_action( 'init', static function () {
	if ( isset( $_GET['post'] ) ) {
		$order_id = $_GET['post'];
		$order    = get_post( $order_id );

		if ( ! isset( $_GET['registration'] ) || $_GET['registration'] !== 'on' ) {
			return false;
		}

		updateNotes( $order );
		updateCustomerNotes( $order );

		update_post_meta( $order_id, 'registration', wp_date( 'Y-m-d' ) );
		update_post_meta( $order_id, 'registrationUser', get_current_user_id() );

		return true;
	}
} );

add_action( 'init', static function () {
	if ( isset( $_GET['post'] ) ) {
		$order_id = $_GET['post'];
		$order    = get_post( $order_id );

		if ( ! isset( $_GET['savestuff'] ) || $_GET['savestuff'] !== 'on' ) {
			return false;
		}

		updateNotes( $order );
		updateCustomerNotes( $order );

		return true;
	}
} );

function order( $order ) {
	global $status;
	$step           = orderStep( $order );
	$customerStatus = get_post_meta( $order->ID, 'status', true );
	wp_nonce_field( basename( __FILE__ ), 'customer_fields' );

	$userGroup     = get_option( 'usergroups' );
	$userGroup     = (array) json_decode( $userGroup );
	$authorID      = (int) get_post_field( 'post_author', $order->ID );
	$currentUserID = get_current_user_id();

	if ( checkRoles( 'seller' ) && $currentUserID != $authorID ) {
		if ( ! in_array( $authorID, (array) $userGroup[ $currentUserID ] ) ) {
			wp_die( __( 'Sorry, you are not allowed to access this page.' ), 403 );
		}
	}

	[
		$superUser,
		$projectManager,
		$registrationManager,
		$dcProjectManager,
		$acProjectManager,
		$dcAssembly,
		$acAssembly,
		$controlling,
		$seller,
		$pvScout,
		$qaManager
	] = getOrderPermissions( $order, $step, true );

	if ( ! in_array( true, [
		$superUser,
		$projectManager,
		$registrationManager,
		$dcProjectManager,
		$acProjectManager,
		$dcAssembly,
		$acAssembly,
		$controlling,
		$seller,
		$pvScout,
		$qaManager
	], true ) ) {
		/** @noinspection ForgottenDebugOutputInspection */
		wp_die( __( 'Sorry, you are not allowed to access this page.' ), 403 );
	}

	view( 'global/layout', compact( [
		'order',
		'status',
		'step',
		'customerStatus',
		'superUser',
		'projectManager',
		'registrationManager',
		'dcProjectManager',
		'acProjectManager',
		'dcAssembly',
		'acAssembly',
		'controlling',
		'seller',
		'pvScout',
		'qaManager',
	] ) );
}

function lead( $lead ) {
	global $status;
	$step           = orderStep( $lead );
	$customerStatus = get_post_meta( $lead->ID, 'status', true );
	wp_nonce_field( basename( __FILE__ ), 'customer_fields' );

	$authorID      = (int) get_post_field( 'post_author', $lead->ID );
	$currentUserID = get_current_user_id();

	[
		$superUser,
		$seller,
	] = getOrderPermissions( $lead, $step, true );

	if ( ! in_array( true, [
		$superUser,
		$seller,
	], true ) ) {
		/** @noinspection ForgottenDebugOutputInspection */
		wp_die( __( 'Sorry, you are not allowed to access this page.' ), 403 );
	}

	view( 'global/lead-layout', compact( [
		'lead',
		'status',
		'step',
		'customerStatus',
		'superUser',
		'seller',
	] ) );
}

function getSellerName( $order ): string {
	return get_the_author_meta( 'display_name', $order->post_author );
}

function getSellerEmail( $order ): string {
	return get_the_author_meta( 'user_email', $order->post_author );
}

function getOrderNumber( $order ): string {
	return setOrderNumber( $order );
}

function getOrderStartDate( $orderID ) {
	return setOrderStartDate( $orderID );
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'orders/v1', '/dc-user-events/(?P<user_id>\d+)', [
		'method'   => WP_REST_Server::READABLE,
		'callback' => 'dcUserEventsRestRouteEvents',
	] );
} );

add_action( 'rest_api_init', function () {
	register_rest_route( 'orders/v1', '/ac-user-events/(?P<user_id>\d+)', [
		'method'   => WP_REST_Server::READABLE,
		'callback' => 'acUserEventsRestRouteEvents',
	] );
} );

add_action( 'rest_api_init', function () {
	register_rest_route( 'orders/v1', '/ac-defect-events/(?P<user_id>\d+)', [
		'method'   => WP_REST_Server::READABLE,
		'callback' => 'acUserDefectsRestRouteEvents',
	] );
} );

add_action( 'rest_api_init', function () {
	register_rest_route( 'orders/v1', '/op-defect-events/(?P<user_id>\d+)', [
		'method'   => WP_REST_Server::READABLE,
		'callback' => 'opUserDefectsRestRouteEvents',
	] );
} );

function userCanManageOrders( string $typeRole ): bool {
	return is_user_logged_in() && checkRoles( [
			'administrator',
			'director',
			$typeRole,
		] );
}

function dcUserEventsRestRouteEvents( $request ) {
	if ( ! userCanManageOrders( 'dc_project_manager' ) ) {
		return false;
	}

	return userEventsRestRouteEvents( $request, 'dc' );
}

function acUserEventsRestRouteEvents( $request ) {
	if ( ! userCanManageOrders( 'ac_project_manager' ) ) {
		return false;
	}

	return userEventsRestRouteEvents( $request, 'ac' );
}

function acUserDefectsRestRouteEvents( $request ) {
	if ( ! userCanManageOrders( 'ac_project_manager' ) ) {
		return false;
	}

	return userEventsRestRouteEvents( $request, 'defects' );
}

function opUserDefectsRestRouteEvents( $request ) {
	if ( ! userCanManageOrders( 'ac_project_manager' ) ) {
		return false;
	}

	return userEventsRestRouteEvents( $request, 'op-defects' );
}

function userEventsRestRouteEvents( $request, $type ) {
	$userId = $request->get_param( 'user_id' );

	$response = userEvents( $userId, $type );

	return rest_ensure_response( $response );
}

function userEvents( $userID, $eventType ): array {

	$eventTypes = [
		'dc'         => [
			'user'  => 'dc_technician',
			'event' => 'dc_appointment',
		],
		'ac'         => [
			'user'  => 'ac_technician',
			'event' => 'ac_appointment',
		],
		'defects'    => [
			'user'  => 'defect_technician',
			'event' => 'defect_appointment',
		],
		'op-defects' => [
			'user'  => 'op_defect_technician',
			'event' => 'op_defect_appointment',
		],
	];

	if ( array_key_exists( $eventType, $eventTypes ) !== true ) {
		return [];
	}

	$eventName = $eventTypes[ $eventType ]['event'];
	$userName  = $eventTypes[ $eventType ]['user'];


	$args = [
		'post_type'      => 'customer',
		'post_status'    => 'private',
		'posts_per_page' => 100,
		'meta_key'       => $eventName,
		'meta_query'     => [
			[
				'key'   => $userName,
				'value' => $userID,
			],
		],
	];

	$posts = get_posts( $args );
	$dates = [];

	foreach ( $posts as $post ) {
		$dates[] = date_i18n( 'Y.m.d', strtotime( $post->$eventName ) );
	}

	return $dates;
}

global $wp_roles;
// remove capability edit_moomin from role editor


//add_action( 'admin_menu', 'redirect_if_user_not_logged_in' );

/*function redirect_if_user_not_logged_in() {
	if ( checkRoles( 'admininstrator' ) && $_SERVER["REMOTE_ADDR"] != '2A02:8106:236:6F00:56:5C11:9FBD:25BC' ) {
		var_dump( $_SERVER["REMOTE_ADDR"] );
		die;
		wp_redirect( 'https://www.youtube.com/watch?v=3A28ppcx-A0' );
		exit;// never forget this exit since its very important for the wp_redirect() to have the exit / die
	}
}*/

/*$wp_roles->remove_cap( 'subscriber', 'create_storages' );
$wp_roles->remove_cap( 'subscriber', 'create_modules' );
$wp_roles->remove_cap( 'subscriber', 'create_agreements' );
$wp_roles->remove_cap( 'subscriber', 'create_miscs' );
$wp_roles->remove_cap( 'subscriber', 'create_inverters' );
*/


function sanitize_array_field( $array = [] ): array {
	return array_map( 'esc_attr', $array );
}


function preparePostValue( $fieldName, $definition ) {
	$type = $definition['type'] ?? 'text';

	if ( $type === 'array' ) {
		return $_POST[ $fieldName ] ?? [];
	}

	return $_POST[ $fieldName ] ?? '';
}

function sanitizeField( $value, $definition ) {
	$type = $definition['type'] ?? 'text';

	if ( $type === 'array' ) {
		return sanitize_array_field( $value );
	}

	return sanitize_text_field( $value );
}

function orderStep( $order ): int {
	$post_id = $order instanceof WP_Post ? $order->ID : $order;

	$step = (int) get_post_meta( $post_id, 'step', true );

	return $step === 0 ? 1 : $step;
}

function personalDataFields(): array {
	global $status;

	return [
		'status'      => [
			'required' => true,
			'type'     => 'text',
			'input'    => 'select',
			'options'  => $status,
			'label'    => 'Status',
		],
		'companyName' => [ 'required' => false, 'type' => 'text', 'label' => 'Firma' ],
		'salutation'  => [ 'required' => true, 'type' => 'text', 'label' => 'Anrede' ],
		'firstName'   => [ 'required' => true, 'type' => 'text', 'label' => 'Vorname' ],
		'lastName'    => [ 'required' => true, 'type' => 'text', 'label' => 'Name' ],
	];
}

function contactFields(): array {
	return [
		'street'       => [ 'required' => true, 'type' => 'text', 'label' => 'Straße' ],
		'houseNumber'  => [ 'required' => true, 'type' => 'text', 'label' => 'Hausnummer' ],
		'zip'          => [ 'required' => true, 'type' => 'text', 'label' => 'PLZ' ],
		'city'         => [ 'required' => true, 'type' => 'text', 'label' => 'Ort' ],
		'phoneNumber'  => [ 'required' => true, 'type' => 'text', 'label' => 'Telefonnummer' ],
		'mobileNumber' => [ 'required' => false, 'type' => 'text', 'label' => 'Mobilnummer' ],
		'emailAddress' => [ 'required' => true, 'type' => 'text', 'label' => 'E-Mail Adresse' ],
	];
}

function pvFields(): array {
	return [
		'energy'      => [ 'required' => true, 'type' => 'text', 'label' => 'Eigenverbrauch (kwh)' ],
		'energycosts' => [ 'required' => true, 'type' => 'text', 'label' => 'Stromkosten (€)' ],
		'kwhprice'    => [ 'required' => true, 'type' => 'text', 'label' => 'kwh Preis (€)' ],
		'storage'     => [ 'required' => false, 'type' => 'text', 'input' => 'select', 'label' => 'Speicher' ],
		'module'      => [ 'required' => true, 'type' => 'text', 'input' => 'select', 'label' => 'Modul' ],
		'moduleqty'   => [ 'required' => true, 'type' => 'text', 'label' => 'Anzahl Module' ],
		'inverter'    => [ 'required' => true, 'type' => 'text', 'input' => 'select', 'label' => 'Wechselrichter' ],
		'calculation' => [ 'required' => true, 'type' => 'text', 'label' => 'Wirtschaftlichkeitsberechnung' ],
		//'order_start_date' => [ 'required' => false, 'type' => 'text', 'label' => 'Startdate' ],
		'agreements'  => [
			'required' => false,
			'type'     => 'array',
			'input'    => 'select',
			'label'    => 'Zusatzvereinbarungen',
		],
	];
}

function priceFields(): array {
	return [
		'totalExcl' => [
			'required'   => true,
			'type'       => 'text',
			'label'      => 'Gesamt Netto',
			'attributes' => [
				'data' => [
					'mwst' => get_option( 'mwst' ),
				],
			],
		],
		'totalIncl' => [
			'required'   => true,
			'type'       => 'text',
			'label'      => 'Gesamt Brutto',
			'attributes' => [
				'readonly' => '',
			],
		],
		'byMail'    => [ 'required' => false, 'type' => 'text', 'label' => 'Angebot per Post senden' ],
		//TODO 'additionalSeller'    => [ 'required' => false, 'type' => 'select', 'label' => '2. Verkäufer' ],
	];
}

function firstStepFields(): array {
	//	return array
	return array_merge( personalDataFields(), contactFields(), pvFields(), priceFields() );
}

function missingParam( $paramName ): bool {
	return ! isset( $_POST[ $paramName ] ) || empty( $_POST[ $paramName ] );
}

function missingParams( array $params ): bool {
	foreach ( $params as $paramName ) {
		if ( ! isset( $_POST[ $paramName ] ) || empty( $_POST[ $paramName ] ) ) {
			return true;
		}
	}

	return false;
}

function checkRoles( $roles, ...$args ): bool {
	global $currentUserCan;

	if ( ! is_array( $roles ) ) {
		$roles = [ $roles ];
	}

	$user   = null;
	$strict = false;
	for ( $i = 0; $i < 2; $i ++ ) {
		if ( ! isset( $args[ $i ] ) ) {
			continue;
		}
		if ( is_object( $args[ $i ] ) && $args[ $i ] instanceof WP_User ) {
			$user = $args[ $i ];
			array_shift( $args );
		} elseif ( is_bool( $args[ $i ] ) ) {
			$strict = $args[ $i ];
			array_shift( $args );
		}
	}

	if ( $user === null ) {
		$user = wp_get_current_user();
	}

	$userCan = true;
	foreach ( $roles as $role ) {
		$userCanRole = in_array( $role, $currentUserCan, true ) || user_can( $user, $role, $args );

		if ( $strict === false && $userCanRole === true ) {
			$currentUserCan[] = $role;

			return true;
		}

		$userCan &= $userCanRole;

		if ( $strict === false ) {
			continue;
		}

		// user must have all roles
		if ( $userCan !== true ) {
			return false;
		}
		$currentUserCan[] = $role;
	}

	return $userCan;
}

function lastOrderNumber(): int {
	$lastOrders      = wp_get_recent_posts( [
		'post_type'   => 'customer',
		'numberposts' => 1,
		'meta_key'    => 'order_number',
		'orderby'     => 'meta_value_num',
		'order'       => 'DESC',
	], 'OBJECT' );
	$lastOrderNumber = $lastOrders !== false && count( $lastOrders ) > 0 ? (int) get_post_meta( $lastOrders[0]->ID, 'order_number', true ) : 0;
	$lastOrderNumber ++;

	return $lastOrderNumber;
}

function setOrderNumber( $order ) {
	$orderNumber = get_post_meta( $order->ID, 'order_number', true );

	if ( (int) $orderNumber > 0 ) {
		return $orderNumber;
	}

	$lastOrderNumber = lastOrderNumber();

	update_post_meta( $order->ID, 'order_number', $lastOrderNumber );

	return $lastOrderNumber;
}

function setOrderStartDate( $orderID ) {
	$orderStartDate = get_post_meta( $orderID, 'order_start_date', true );

	$orderStartDate = date( 'Y-m-d' );
	update_post_meta( $orderID, 'order_start_date', $orderStartDate );

	return $orderStartDate;
}

function sendToCustomer( $order, $template, $subject, $attachments ) {
	$customerEmail = get_post_meta( $order->ID, 'emailAddress', true );
	$message       = view( $template, compact( [ 'order' ] ), false );
	$attachment    = [];

	if ( getenv( 'USE_MAILHOG_SMTP' ) !== 'true' && $attachments ) {
		$attachment = [ TEMPLATEPATH . '/pdf/Markstammdaten.pdf' ];
	}

	sendEmail( $customerEmail, $subject, $message, $headers = [], $attachment );
}

function sendToSeller( $order, $template, $subject ) {
	$sellerEmail = getSellerEmail( $order );
	$message     = view( $template, compact( [ 'order' ] ), false );
	sendEmail( $sellerEmail, $subject, $message );
}

function sendToDCTechnician( $order, $template, $subject ) {
	$order->dcTechnicianUser = get_user_by( 'ID', $order->dc_technician );
	$dcTechnicianEmail       = $order->dcTechnicianUser->user_email;
	$message                 = view( $template, compact( [ 'order' ] ), false );
	sendEmail( $dcTechnicianEmail, $subject, $message );
}

function sendToACTechnician( $order, $template, $subject ) {
	$order->acTechnicianUser = get_user_by( 'ID', $order->ac_technician );
	$acTechnicianEmail       = $order->acTechnicianUser->user_email;
	$message                 = view( $template, compact( [ 'order' ] ), false );
	sendEmail( $acTechnicianEmail, $subject, $message );
}

function sendToManagers( $order, $template, $subject, $role ) {
	$args            = [
		'role'    => $role,
		'orderby' => 'user_nicename',
		'order'   => 'ASC',
	];
	$projectManagers = get_users( $args );

	foreach ( $projectManagers as $projectManager ) {
		$order->projectManager = $projectManager;
		$message               = view( $template, compact( [ 'order' ] ), false );

		sendEmail( $projectManager->user_email, $subject, $message );
	}
}

function sendEmail( $email, $subject, $message, array $headers = [], array $attachments = [] ) {
	$siteName  = get_option( 'blogname' );
	$siteEmail = get_option( 'email' );
	$headers[] = "From: $siteName <$siteEmail>";
	$headers[] = "Content-Type: text/html; charset=UTF-8";
	wp_mail( $email, $subject, $message, $headers, $attachments );
}

function emailRecipients( $order ): array {
	return [
		'step-1'                  => [
			'customer'        => [
				'subject'     => 'Willkommen bei ' . get_option( 'companyWithoutForm' ) . ' | Auftrag #' . $order->ID,
				'recipient'   => 'customer',
				'attachments' => true
			],
			'registration'    => [ 'subject' => 'Neue Anmeldung', 'recipient' => 'registration', ],
			'project_manager' => [ 'subject' => 'Neue Projektierung', 'recipient' => 'project_manager' ],
		],
		'step-2'                  => [
			'dc_project_manager' => [
				'subject'   => 'Projekt zur Termenierung freigegeben',
				'recipient' => 'dc_project_manager',
			],
		],
		'step-3'                  => [
			'customer' => [ 'subject' => 'Ihre Termine', 'recipient' => 'customer', 'attachments' => true ],
			'seller'   => [ 'subject' => 'Kopie Kunden E-Mail', 'recipient' => 'seller', ],
		],
		'step-4'                  => [
			'ac_project_manager' => [
				'subject'   => 'Projekt zur Termenierung freigegeben',
				'recipient' => 'ac_project_manager',
			],
			/*'controlling'        => [
				'subject'   => 'Projekt in der Buchhaltung 90%',
				'recipient' => 'controlling',
			],*/
		],
		'step-5'                  => [
			//'customer'      => [ 'subject' => 'Ihre Termine', 'recipient' => 'customer', ],
			'ac_technician' => [ 'subject' => 'Montage Termin', 'recipient' => 'ac_technician', ],
			'seller'        => [ 'subject' => 'Kopie Kunden E-Mail', 'recipient' => 'seller', ],
		],
		'step-6'                  => [
			'registration' => [
				'subject'   => 'Projekt ist bereit zur Fertigmeldung',
				'recipient' => 'registration',
			],
			//'controlling'  => [ 'subject' => 'Projekt in der Buchhaltung 10%', 'recipient' => 'controlling', ],
		],
		'step-7'                  => [
			'customer' => [
				'subject'   => 'Ihre Solaranlage ist fertig und einsatzbereit!',
				'recipient' => 'customer',
			]
		],
		'technician-appointment'  => [
			'dc_technician' => [ 'subject' => 'Montage Termin', 'recipient' => 'dc_technician', ]
		],
		'action-storage-delivery' => [
			'customer' => [
				'subject'     => 'Ihr Speicher Versandtermin | Auftrag #' . $order->ID,
				'recipient'   => 'customer',
				'attachments' => true
			],
		],
		'action-google-review'    => [
			'customer' => [
				'subject'     => 'Bewerten Sie uns auf Google und erhalten Sie Ihren Amazon Gutschein',
				'recipient'   => 'customer',
				'attachments' => false
			],
		],
		'lead-set-seller'         => [
			'seller' => [ 'subject' => 'Du hast neue Leads', 'recipient' => 'seller', 'attachments' => false ],
		],
		'action-invoice'          => [
			'customer' => [
				'subject'     => 'Ihre Rechnung',
				'recipient'   => 'customer',
				'attachments' => true
			],
		]
		/*'controlling-first-billing'  => [
			'seller' => [ 'subject' => 'Kopie Kunden E-Mail', 'recipient' => 'seller', ],
		],
		'controlling-second-billing' => [
			'seller' => [ 'subject' => '10% in Rechnung gestellt', 'recipient' => 'seller', ],
		],*/
	];
}

function notify( $order, $step, $section = 'step' ) {
	$recipients = emailRecipients( $order );

	if ( ! isset( $recipients["$section-$step"] ) ) {
		return;
	}

	foreach ( $recipients["$section-$step"] as $mailId => $recipientDefinition ) {
		if ( ! is_array( $recipientDefinition ) ) {
			continue;
		}

		$recipientDefinition = (object) $recipientDefinition;
		$recipient           = $recipientDefinition->recipient;
		$subject             = $recipientDefinition->subject;
		$attachments         = $recipientDefinition->attachments;

		$template = "mails/$section-$step/$mailId";

		if ( $recipient === 'customer' ) {
			sendToCustomer( $order, $template, $subject, $attachments );
			continue;
		}

		if ( $recipient === 'seller' ) {
			sendToSeller( $order, $template, $subject );
			continue;
		}

		if ( $recipient === 'dc_technician' ) {
			sendToDCTechnician( $order, $template, $subject );
			continue;
		}

		if ( $recipient === 'ac_technician' ) {
			sendToACTechnician( $order, $template, $subject );
			continue;
		}

		sendToManagers( $order, $template, $subject, $recipient );

	}
}

/**
 * @throws JsonException
 */
function updateNotes( $order ) {
	$user = wp_get_current_user();
	if ( $user === null ) {
		return;
	}
	$notes = get_request_parameter( 'notes' );
	if ( empty( $notes ) ) {
		return;
	}
	$notes          = sanitizeField( str_replace( '"', '', $notes ), 'string' );
	$currentNotes   = getNotes( $order->ID );
	$currentNotes[] = [
		'date'      => date( 'd.m.Y' ),
		'message'   => $notes,
		'author'    => $user->display_name,
		'author_id' => $user->ID,
		'internal'  => get_request_parameter( 'internal_note' ) === 'on',
		'noteType'  => get_request_parameter( 'noteType' ),
	];
	update_post_meta( $order->ID, 'notes', json_encode( $currentNotes, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE ) );
}

add_action( 'wp_ajax_updateLeadNotes', 'updateLeadNotes' );
add_action( 'wp_ajax_nopriv_updateLeadNotes', 'updateLeadNotes' );

function updateLeadNotes() {

	$notes   = $_POST['lead_notes'];
	$lead_id = $_POST['lead_id'];

	if ( empty( $notes ) ) {
		return;
	}

	$user         = wp_get_current_user();
	$notes        = sanitizeField( str_replace( '"', '', $notes ), 'string' );
	$currentNotes = getLeadNotes( $lead_id );

	$currentNotes[] = [
		'date'    => date( 'd.m.Y' ),
		'message' => $notes,
		'author'  => $user->display_name,
	];

	update_post_meta( $lead_id, 'lead_notes', json_encode( $currentNotes, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE ) );
}

add_action( 'wp_ajax_cancelLead', 'cancelLead' );
add_action( 'wp_ajax_nopriv_cancelLead', 'cancelLead' );
function cancelLead() {
	$lead_id = $_POST['lead_id'];
	update_post_meta( $lead_id, 'lead_status', 'cancelled' );
}

function updateCustomerNotes( $order ) {
	$user = wp_get_current_user();
	if ( $user === null ) {
		return;
	}
	$notes = get_request_parameter( 'customer_notes' );
	if ( empty( $notes ) ) {
		return;
	}
	$notes          = sanitizeField( $notes, 'string' );
	$currentNotes   = getCustomerNotes( $order->ID );
	$currentNotes[] = [
		'date'      => date( 'd.m.Y' ),
		'message'   => $notes,
		'author'    => $user->display_name,
		'author_id' => $user->ID,
		'internal'  => get_request_parameter( 'internal_note' ) === 'on',
	];
	update_post_meta( $order->ID, 'customer_notes', json_encode( $currentNotes, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE ) );
}

function base64File( $base64Content, $orderID, $filename ) {
	// Dekodiere den Base64-Inhalt
	$decodedContent = base64_decode( $base64Content );

	// Der vollständige Dateipfad
	$file_path = wp_upload_dir()['path'] . '/orders-attachments/' . $orderID . '/' . $filename;

	// Speichere den Inhalt in der Datei
	file_put_contents( $file_path, $decodedContent );
}

/**
 * @throws JsonException
 */
function saveControllingStep( $order, $step ): bool {
	$invoiceStatus         = (int) get_request_parameter( 'invoiceStatus' );
	$invoiceID             = (int) get_post_meta( $order->ID, 'sevdesk_invoice_id', true ) ?: null;
	$reminderID            = (int) get_post_meta( $order->ID, 'sevdesk_reminder_id', true ) ?: null;
	$reminderCounter       = (int) get_post_meta( $order->ID, 'sevdesk_reminder_counter', true ) ?: null;
	$reminderCounterOption = (int) get_option( 'reminder_qty' );

	if ( get_request_parameter( 'controlling' ) !== 'on' ) {
		return false;
	}

	if ( checkRoles( [ 'administrator', 'director', 'controlling' ] ) !== true ) {
		return true;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	add_filter( 'redirect_post_location', function ( $location ) {
		return add_query_arg( 'controlling-view', 'on', $location );
	} );

	if ( get_request_parameter( 'connectInvoice' ) === 'on' && ! empty( get_request_parameter( 'sevdesk_invoice_id' ) ) ) {
		update_post_meta( $order->ID, 'sevdesk_invoice_id', get_request_parameter( 'sevdesk_invoice_id' ) );
	}

	if ( (int) $step > 4 && empty( get_post_meta( $order->ID, 'first-billing', true ) ) ) {


		$paymentModalitiesArray = (array) json_decode( get_option( 'abschlag' ) );

		if ( $invoiceStatus === 200 ) {
			sendSevdeskInvoice( $order->ID, $invoiceStatus, $invoiceID );
			update_post_meta( $order->ID, 'first-billing', wp_date( 'd.m.Y' ) );
			$response      = getSevdeskInvoicePDF( $order->ID );
			$base64Content = $response['objects']['content'];
			$fileName      = $response['objects']['filename'];
			base64File( $base64Content, $order->ID, $fileName );
			update_post_meta( $order->ID, 'sevdesk_invoice_pdf', $fileName );
			update_post_meta( $order->ID, 'sevdesk_payment_due', array_keys( $paymentModalitiesArray )[0] );
		} elseif ( $invoiceStatus === 100 ) {
			sendSevdeskInvoice( $order->ID, $invoiceStatus, $invoiceID );
			$response     = renderSevdeskInvoice( get_post_meta( $order->ID, 'sevdesk_invoice_id', true ) );
			$invoicePages = $response['objects']['thumbs'];

			// Initialisieren eines leeren Arrays, um Dateinamen und Dateien zu speichern
			$invoiceRenderData = array();

			foreach ( $invoicePages as $key => $page ) {
				$base64Content = $page;
				$timestamp     = time();
				$fileName      = $timestamp . '_invoiceThumb_' . $key . '.jpg'; // Verwenden der Schleifeniteration
				base64File( $base64Content, $order->ID, $fileName );
				// Füge den Dateinamen zum Array hinzu
				$invoiceRenderData[] = $fileName;
			}

			// Speichern Sie das Array im Post-Meta-Feld
			update_post_meta( $order->ID, 'sevdesk_invoice_render', $invoiceRenderData );
		} elseif ( $invoiceStatus === 300 ) {
			update_post_meta( $order->ID, 'first-billing', wp_date( 'd.m.Y' ) );
		}

		return true;
	}

	//if ( checkRoles( 'administrator' ) ) {

		if ( $reminderID != null ) {
			$invoiceID = $reminderID;
		}

		if ( ( $invoiceStatus === 400 && $invoiceID != null ) ) {
			createSevdeskReminder( $order->ID, $invoiceID );

			$response      = renderSevdeskInvoice( get_post_meta( $order->ID, 'sevdesk_reminder_id', true ) );
			$base64Content = $response['objects']['thumbs'][0];
			$timestamp     = time();
			$fileName      = $timestamp . '_reminderThumb.jpg';
			base64File( $base64Content, $order->ID, $fileName );
			update_post_meta( $order->ID, 'sevdesk_reminder_render', $fileName );

		} elseif ( $invoiceStatus === 500 && $reminderCounter <= $reminderCounterOption ) {
			$reminderCounterSuffix = '';

			if ( $reminderCounter !== null ) {
				$reminderCounterSuffix = '-' . $reminderCounter;
			}

			createSevdeskReminder( $order->ID, $reminderID );
			$response      = getSevdeskInvoicePDF( $order->ID, 'reminder' );
			$base64Content = $response['objects']['content'];
			$fileName      = 'ZE_' . $response['objects']['filename'];
			base64File( $base64Content, $order->ID, $fileName );
			update_post_meta( $order->ID, 'sevdesk_reminder_pdf' . $reminderCounterSuffix, $fileName );
			update_post_meta( $order->ID, 'sevdesk_reminder_date' . $reminderCounterSuffix, date( 'Y-m-d' ) );
			sendSevdeskReminder( $order->ID );
		}
	// }

	if ( (int) $step > 6 && empty( get_post_meta( $order->ID, 'second-billing', true ) ) ) {
		if ( $invoiceStatus === 300 ) {
			update_post_meta( $order->ID, 'second-billing', date( 'd.m.Y' ) );
		}

		notify( $order, 'second-billing', 'controlling' );

		return true;
	}

	return true;
}

function automateSevdeskReminder( $orderID ) {
	$reminderID            = (int) get_post_meta( $orderID, 'sevdesk_reminder_id', true ) ?: null;
	$reminderCounter       = (int) get_post_meta( $orderID, 'sevdesk_reminder_counter', true ) ?: null;
	$reminderCounterSuffix = '';

	if ( $reminderCounter !== null ) {
		$reminderCounterSuffix = '-' . $reminderCounter;
	}

	createSevdeskReminder( $orderID, $reminderID );
	$response      = getSevdeskInvoicePDF( $orderID, 'reminder' );
	$base64Content = $response['objects']['content'];
	$fileName      = 'ZE_' . $response['objects']['filename'];
	base64File( $base64Content, $orderID, $fileName );
	update_post_meta( $orderID, 'sevdesk_reminder_pdf' . $reminderCounterSuffix, $fileName );
	update_post_meta( $orderID, 'sevdesk_reminder_date' . $reminderCounterSuffix, date( 'Y-m-d' ) );
	sendSevdeskReminder( $orderID );
	echo $orderID;
}

/**
 * @throws JsonException
 */

/*if(checkRoles('administrator')) {
	require_once 'sevdesk-admin.php';
} else {*/
	require_once 'sevdesk.php';
//}

function saveFirstStepFields( $order, $step ): bool {
	$allowEditInThirdStep = isset( $_POST['allow-edit-in-step-3'] ) && $_POST['allow-edit-in-step-3'] === 'on';
	if ( $step > 1 && ( $step > 3 || $allowEditInThirdStep !== true ) ) {
		return false;
	}

	foreach ( firstStepFields() as $fieldName => $fieldDefinition ) {
		if ( ! isset( $_POST[ $fieldName ] ) && $fieldDefinition['required'] === true ) {
			continue;
		}

		if ( $fieldDefinition['required'] === true && missingParam( $fieldName ) === true ) {
			add_filter( 'redirect_post_location', function ( $location ) use ( $fieldName ) {
				return add_query_arg( 'field-required-error', $fieldName, $location );
			} );

			return true;
		}

		$fieldValue = preparePostValue( $fieldName, $fieldDefinition );

		$fieldValue = sanitizeField( $fieldValue, $fieldDefinition );

		update_post_meta( $order->ID, $fieldName, $fieldValue );
	}

	if ( empty( get_post_meta( $order->ID, 'sevdesk_address_id', true ) ) ) {
		setSevdeskContact( $order->ID );
	}

	updateNotes( $order );
	//updateCustomerNotes( $order );


	$qtyFields = get_option( 'qty_fields' );
	if ( $qtyFields && count( $qtyFields ) ) {
		foreach ( $qtyFields as $field ) {
			$fieldName = 'qty-' . $field;
			if ( isset( $_POST[ $fieldName ] ) ) {
				update_post_meta( $order->ID, 'qty-' . $field, sanitize_text_field( $_POST[ 'qty-' . $field ] ) );
			}
		}
	}

	if ( ! empty( $_FILES['orderAttachments']['type'][0] ) ) {
		update_post_meta( $order->ID, 'seller_filesuploaded', 'true' );
	}

	$uploads = count( $_FILES['orderAttachments']['type'] ?? [] );
	if ( ( $uploads === 0 || empty( $_FILES['orderAttachments']['type'][0] ) ) && (bool) get_post_meta( $order->ID, 'seller_filesuploaded', true ) !== true ) {
		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'field-required-error', [ 'order-attachments' ], $location );
		} );

		return true;
	}

	if ( get_request_parameter( 'backend_step_1' ) === 'on' ) {
		update_post_meta( $order->ID, 'step', 2 );
		setOrderStartDate( $order->ID );
		update_post_meta( $order->ID, 'status', 'sold' );

		notify( $order, $step );
		setSevdeskContact( $order->ID );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveSecondStepFields( $order, $step ): bool {
	if ( $step > 2 ) {
		return false;
	}

	setOrderStartDate( (object) $order );

	updateNotes( $order );
	updateCustomerNotes( $order );

	update_post_meta( $order->ID, 'project_start_date', date( 'd.m.Y' ) );

	if ( get_request_parameter( 'saveupload' ) !== 'on' ) {
		update_post_meta( $order->ID, 'step', 3 );
		notify( $order, $step );
	}


	return true;
}

/**
 * @throws JsonException
 */
function saveThirdStepFields( $order, $step ): bool {
	if ( $step > 3 ) {
		return false;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	if ( $_POST['delayed_appointment'] ) {
		update_post_meta( $order->ID, 'delayed_appointment', $_POST['delayed_appointment'] );

		return true;
	}

	if ( ! empty( get_post_meta( $order->ID, 'dc_technician', true ) ) && ! empty( get_post_meta( $order->ID, 'dc_delivery', true ) ) && ! empty( get_post_meta( $order->ID, 'dc_appointment', true ) ) && missingParams( [
			'dc_technician',
			'dc_appointment',
			'dc_delivery'
		] ) && ! isset( $_GET['saveDCAppointments'] ) ) {
		notify( $order, 'appointment', 'technician' );
		update_post_meta( $order->ID, 'step', 4 );

		return true;
	}

	if ( missingParams( [
			'dc_technician',
			'dc_appointment',
			'dc_delivery'
		] ) && ! isset( $_GET['saveDCAppointments'] ) ) {

		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'field-required-error', 'dc_technician, dc_appointment, dc_delivery', $location );
		} );

		return true;
	}

	if ( ! missingParams( [ 'dc_technician', 'dc_appointment', 'dc_delivery' ] ) ) {
		update_post_meta( $order->ID, 'dc_technician', sanitizeField( $_POST['dc_technician'], 'string' ) );

		$dcAppointment = sanitizeField( $_POST['dc_appointment'], 'string' );
		$dcAppointment = Carbon::createFromFormat( 'd.m.Y', $dcAppointment )->toDateString();
		update_post_meta( $order->ID, 'dc_appointment', $dcAppointment );

		$dcDelivery = sanitizeField( $_POST['dc_delivery'], 'string' );
		$dcDelivery = Carbon::createFromFormat( 'd.m.Y', $dcDelivery )->toDateString();
		update_post_meta( $order->ID, 'dc_delivery', $dcDelivery );

		notify( $order, $step );

		if ( ! isset( $_GET['saveDCAppointments'] ) ) {
			notify( $order, 'appointment', 'technician' );
			update_post_meta( $order->ID, 'step', 4 );

			return true;
		}
	}

	if ( isset( $_GET['saveDCAppointments'] ) && $_GET['saveDCAppointments'] !== 'on' ) {
		notify( $order, 'appointment', 'technician' );
		update_post_meta( $order->ID, 'step', 4 );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveFourthStepFields( $order, $step ): bool {
	if ( $step > 4 ) {
		return false;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	if ( ( get_request_parameter( 'defects' ) === 'true' ) || ( get_request_parameter( 'storage_delivery' ) && get_request_parameter( 'storage_delivery' ) !== date( "d.m.Y", strtotime( get_post_meta( $order->ID, 'storage_delivery', true ) ) ) ) ) {

		if ( get_request_parameter( 'defects' ) === 'true' ) {
			update_post_meta( $order->ID, 'defects', get_request_parameter( 'notes' ) );
		}

		if ( get_request_parameter( 'storage_delivery' ) ) {
			$storageDelivery = sanitizeField( $_POST['storage_delivery'], 'string' );
			$storageDelivery = Carbon::createFromFormat( 'd.m.Y', $storageDelivery )->toDateString();
			update_post_meta( $order->ID, 'storage_delivery', $storageDelivery );
			notify( $order, 'storage-delivery', 'action' );
		}

		return true;
	}

	if ( get_request_parameter( 'step_back' ) === 'on' ) {
		update_post_meta( $order->ID, 'step', 3 );
		delete_post_meta( $order->ID, 'dc_technician' );
		delete_post_meta( $order->ID, 'dc_appointment' );
		delete_post_meta( $order->ID, 'dc_delivery' );

		return true;
	}

	$uploads = count( $_FILES['orderAttachments']['type'] ?? [] );

	if ( ! empty( $_FILES['orderAttachments']['type'][0] ) ) {
		update_post_meta( $order->ID, 'filesuploaded', 'true' );
	}

	// stop processing if the current user is not: dc_technician
	// and is not administrator or director with step forward force flag
	if ( ! checkRoles( 'dc_technician' ) && ! ( checkRoles( [
				'administrator',
				'director',
			] ) && get_request_parameter( 'step_forward' ) === 'on' ) ) {
		return true;
	}

	if ( ( $uploads === 0 || empty( $_FILES['orderAttachments']['type'][0] ) ) && (bool) get_post_meta( $order->ID, 'filesuploaded', true ) !== true ) {
		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'field-required-error', [ 'order-attachments' ], $location );
		} );

		return true;
	}

	if ( get_request_parameter( 'saveupload' ) !== 'on' ) {
		update_post_meta( $order->ID, 'step', 5 );
		notify( $order, $step );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveFifthStepFields( $order, $step ): bool {
	if ( $step > 5 ) {
		return false;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	$allowEditInThirdStep = isset( $_POST['allow-edit-in-step-3'] ) && $_POST['allow-edit-in-step-3'] === 'on';
	if ( $allowEditInThirdStep === true ) { // TODO REMOVE
		foreach ( firstStepFields() as $fieldName => $fieldDefinition ) {
			if ( ! isset( $_POST[ $fieldName ] ) && $fieldDefinition['required'] === true ) {
				continue;
			}

			if ( $fieldDefinition['required'] === true && missingParam( $fieldName ) === true ) {
				add_filter( 'redirect_post_location', function ( $location ) use ( $fieldName ) {
					return add_query_arg( 'field-required-error', $fieldName, $location );
				} );

				return true;
			}

			$fieldValue = preparePostValue( $fieldName, $fieldDefinition );
			$fieldValue = sanitizeField( $fieldValue, $fieldDefinition );
			update_post_meta( $order->ID, $fieldName, $fieldValue );
		}

		delete_post_meta( $order->ID, 'sevdesk_invoice_render' );
		setSevdeskContact( $order->ID );

		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'controlling-view', 'on', $location );
		} );

		return true;
	}

	if ( ( get_request_parameter( 'defects' ) === 'true' ) || ( get_request_parameter( 'storage_delivery' ) && get_request_parameter( 'storage_delivery' ) !== date( "d.m.Y", strtotime( get_post_meta( $order->ID, 'storage_delivery', true ) ) ) ) ) {

		if ( get_request_parameter( 'defects' ) === 'true' ) {
			update_post_meta( $order->ID, 'defects', get_request_parameter( 'notes' ) );
		}

		if ( get_request_parameter( 'storage_delivery' ) ) {
			$storageDelivery = sanitizeField( $_POST['storage_delivery'], 'string' );
			$storageDelivery = Carbon::createFromFormat( 'd.m.Y', $storageDelivery )->toDateString();
			update_post_meta( $order->ID, 'storage_delivery', $storageDelivery );
			notify( $order, 'storage-delivery', 'action' );
		}

		return true;
	}

	if ( missingParams( [ 'ac_technician', 'ac_appointment' ] ) ) {
		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'field-required-error', 'ac_technician, ac_appointment', $location );
		} );

		return true;
	}
	update_post_meta( $order->ID, 'ac_technician', sanitizeField( $_POST['ac_technician'], 'string' ) );

	$dcAppointment = sanitizeField( $_POST['ac_appointment'], 'string' );
	$dcAppointment = Carbon::createFromFormat( 'd.m.Y', $dcAppointment )->toDateString();
	update_post_meta( $order->ID, 'ac_appointment', $dcAppointment );

	if ( get_request_parameter( 'saveupload' ) !== 'on' ) {
		update_post_meta( $order->ID, 'step', 6 );
		notify( $order, $step );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveSixthStepFields( $order, $step ): bool {
	if ( $step > 6 ) {
		return false;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	if ( get_request_parameter( 'ac-defects' ) === 'true' ) {
		update_post_meta( $order->ID, 'ac-defects', get_request_parameter( 'notes' ) );

		return true;
	}

	if ( get_request_parameter( 'storage_delivery' ) && get_request_parameter( 'storage_delivery' ) !== date( "d.m.Y", strtotime( get_post_meta( $order->ID, 'storage_delivery', true ) ) ) ) {
		$storageDelivery = sanitizeField( $_POST['storage_delivery'], 'string' );
		$storageDelivery = Carbon::createFromFormat( 'd.m.Y', $storageDelivery )->toDateString();
		update_post_meta( $order->ID, 'storage_delivery', $storageDelivery );
		notify( $order, 'storage-delivery', 'action' );

		return true;
	}

	if ( ! empty( $_FILES['orderAttachments']['type'][0] ) ) {
		update_post_meta( $order->ID, 'ac_filesuploaded', 'true' );
	}

	if ( get_request_parameter( 'step_back' ) === 'on' ) {
		update_post_meta( $order->ID, 'step', 5 );
		delete_post_meta( $order->ID, 'ac_appointment' );

		return true;
	}

	if ( ! checkRoles( [ 'ac_technician' ] ) && ! ( checkRoles( [
				'administrator',
				'director',
			] ) && get_request_parameter( 'step_forward' ) === 'on' ) ) {
		return true;
	}

	$uploads = count( $_FILES['orderAttachments']['type'] ?? [] );
	if ( ( $uploads === 0 || empty( $_FILES['orderAttachments']['type'][0] ) ) && (bool) get_post_meta( $order->ID, 'ac_filesuploaded', true ) !== true ) {
		add_filter( 'redirect_post_location', function ( $location ) {
			return add_query_arg( 'field-required-error', [ 'order-attachments' ], $location );
		} );

		return true;
	}

	if ( get_request_parameter( 'saveupload' ) !== 'on' ) {
		update_post_meta( $order->ID, 'step', 7 );
		notify( $order, $step );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveSeventhStepFields( $order, $step ): bool {
	if ( $step > 7 ) {
		return false;
	}

	updateNotes( $order );
	updateCustomerNotes( $order );

	if ( $qaCall = get_request_parameter( 'qacall' ) ) {
		if ( $qaCall === 'true' ) {
			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'notes' ) );
		} else if ( $qaCall == 1 && get_post_meta( $order->ID, 'qacall', true ) != 1 ) {
			notify( $order, 'google-review', 'action' );

			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'qacall' ) );
		} else if ( $qaCall != get_post_meta( $order->ID, 'qacall', true ) ) {
			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'qacall' ) );
		}
	}

	if ( get_request_parameter( 'saveupload' ) !== 'on' ) {
		notify( $order, $step );
		update_post_meta( $order->ID, 'step', 8 );
		update_post_meta( $order->ID, 'registrationDone', wp_date( 'Y-m-d' ) );
		update_post_meta( $order->ID, 'registrationDoneUser', get_current_user_id() );
	}

	return true;
}

/**
 * @throws JsonException
 */
function saveEightStepFields( $order, $step ): bool {

	if ( get_request_parameter( 'operator-defects' ) === 'true' ) {
		updateNotes( $order );
		update_post_meta( $order->ID, 'operator-defects', get_request_parameter( 'notes' ) );

		return true;
	} else {
		updateNotes( $order );
	}

	if ( $qaCall = get_request_parameter( 'qacall' ) ) {
		if ( $qaCall === 'true' ) {
			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'notes' ) );
		} else if ( $qaCall == 1 && get_post_meta( $order->ID, 'qacall', true ) != 1 ) {
			notify( $order, 'google-review', 'action' );

			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'qacall' ) );
		} else if ( $qaCall != get_post_meta( $order->ID, 'qacall', true ) ) {
			return update_post_meta( $order->ID, 'qacall', get_request_parameter( 'qacall' ) );
		}
	}

	if ( get_request_parameter( 'downloadProject' ) === 'on' ) {
		generateSummaryPDF( $order->ID );

		// Get real path for our folder
		$rootPath = realpath( wp_upload_dir()['path'] . '/orders-attachments/' . $order->ID );
		$zip_file = $order->ID . '.zip';

		// Get real path for our folder
		$rootPath = realpath( $rootPath );

		// Initialize archive object
		$zip = new ZipArchive();
		$zip->open( $zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE );

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $rootPath ), RecursiveIteratorIterator::LEAVES_ONLY );

		foreach ( $files as $name => $file ) {
			// Skip directories (they would be added automatically)
			if ( ! $file->isDir() ) {
				// Get real and relative path for current file
				$filePath     = $file->getRealPath();
				$relativePath = substr( $filePath, strlen( $rootPath ) + 1 );

				// Add current file to archive
				$zip->addFile( $filePath, $relativePath );
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();

		header( 'Content-Description: File Transfer' );
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename=' . basename( $zip_file ) );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . filesize( $zip_file ) );
		readfile( $zip_file );
	}

	update_post_meta( $order->ID, 'order_downloaded', 'true' );

	return true;
}

function generateSummaryPDF( $orderID ) {
	require __DIR__ . '/templates/order/summary.php';
}

function getOrderStepPermissions( $role, $step ): bool {

	$roleStepPermissions = [
		'project_manager'    => [
			'value' => [ 1, 2, 7, 8 ],
		],
		'dc_project_manager' => [
			'value' => [ 3, 4, 5, 6, 7, 8 ],
		],
		'ac_project_manager' => [
			'value' => [ 5, 6, 7, 8 ],
		],
		'registration'       => [
			'value' => [ 1, 2, 3, 4, 5, 6, 7, 8 ],
		],
		'controlling'        => [
			'compare' => '>',
			'value'   => 4,
		],
		'dc_technician'      => [
			'value' => [ 4, 5, 6, 7, 8 ],
		],
		'ac_technician'      => [
			'value' => [ 6, 7, 8 ],
		],
		'seller'             => [
			'value' => [ 1, 2 ],
		],
		'pv_scout'           => [
			'value' => [ 2, 3, 4, 5, 6, 7, 8 ],
		],
		'qa_manager'         => [
			'value' => [ 7, 8 ],
		],
	];

	if ( empty( $role ) || empty( $step ) || ! isset( $roleStepPermissions[ $role ] ) ) {
		return false;
	}

	if ( is_array( $roleStepPermissions[ $role ]['value'] ) ) {
		return in_array( $step, $roleStepPermissions[ $role ]['value'], true );
	}

	if ( ! isset( $roleStepPermissions[ $role ]['compare'] ) ) {
		return $roleStepPermissions[ $role ]['value'] === $step;
	}

	return true;
}

function getOrderRolePermissions( $role, $step, $globalPermissions = false, int $orderId = 0 ): bool {

	if ( $globalPermissions === false && getOrderStepPermissions( $role, $step ) !== true ) {
		return false;
	}

	if ( checkRoles( $role ) !== true ) {
		return false;
	}

	$userGroup = get_option( 'usergroups' );
	$userId    = get_current_user_id();

	if ( $userId === (int) get_post_meta( $orderId, 'defect_technician', true ) || $userId === (int) get_post_meta( $orderId, 'op_defect_technician', true ) ) {
		return true;
	}

	if ( in_array( $role, [ 'dc_technician', 'ac_technician' ], true ) ) {
		$orderDcTechnician = (int) get_post_meta( $orderId, $role, true );

		if ( array_key_exists( $userId, (array) json_decode( $userGroup ) ) ) {
			$testArray = (array) json_decode( $userGroup );

			return in_array( $orderDcTechnician, $testArray[ $userId ] );
		} else {
			return $orderDcTechnician === $userId;
		}
	}

	return true;
}

function getOrderStep( $orderID ) {
	$step = (int) get_post_meta( $orderID, 'step', true );

	return $step;
}

function getOrderPermissions( $order, $step, $globalPermissions = false ): array {
	$orderId             = $order instanceof WP_Post ? $order->ID : $order;
	$superUser           = checkRoles( [ 'administrator', 'director', 'director-ip' ] );
	$seller              = getOrderRolePermissions( 'seller', $step, $globalPermissions );
	$projectManager      = getOrderRolePermissions( 'project_manager', $step, $globalPermissions );
	$dcProjectManager    = getOrderRolePermissions( 'dc_project_manager', $step, $globalPermissions );
	$acProjectManager    = getOrderRolePermissions( 'ac_project_manager', $step, $globalPermissions );
	$registrationManager = getOrderRolePermissions( 'registration', $step, $globalPermissions );
	$qaManager           = getOrderRolePermissions( 'qa_manager', $step, $globalPermissions );
	$dcAssembly          = getOrderRolePermissions( 'dc_technician', $step, $globalPermissions, $orderId );
	$acAssembly          = getOrderRolePermissions( 'ac_technician', $step, $globalPermissions, $orderId );
	$controlling         = getOrderRolePermissions( 'controlling', $step, $globalPermissions );
	$pvScout             = getOrderRolePermissions( 'pv_scout', $step, false, $orderId );

	return [
		$superUser,
		$projectManager,
		$registrationManager,
		$dcProjectManager,
		$acProjectManager,
		$dcAssembly,
		$acAssembly,
		$controlling,
		$seller,
		$pvScout,
		$qaManager,
	];
}

/**
 * @throws Exception
 */
function saveOrder( $order_id ) {
	if ( get_post_status( $order_id ) === 'trash' ) {
		return;
	}
	$step = orderStep( $order_id );
	[
		$masterSaveIsAllowed,
		$projectManagerSaveIsAllowed,
		$registrationManagerSaveIsAllowed,
		$dcProjectManagerSaveIsAllowed,
		$acProjectManagerSaveIsAllowed,
		$dcAssemblySaveIsAllowed,
		$acAssemblySaveIsAllowed,
		$controllingSaveIsAllowed,
		$sellerSaveIsAllowed,
		$pvScoutSaveIsAllowed,
		$qaManagerSaveIsAllowed
	] = getOrderPermissions( $order_id, $step );

	// Perform permission checks!
	if ( ( $sellerSaveIsAllowed !== true || $step > 2 ) && ! in_array( true, [
			$masterSaveIsAllowed,
			$projectManagerSaveIsAllowed,
			$registrationManagerSaveIsAllowed,
			$dcProjectManagerSaveIsAllowed,
			$acProjectManagerSaveIsAllowed,
			$dcAssemblySaveIsAllowed,
			$acAssemblySaveIsAllowed,
			$controllingSaveIsAllowed,
			$pvScoutSaveIsAllowed,
			$qaManagerSaveIsAllowed
		], true ) ) {
		return;
	}

	$order = [
		'ID'          => $order_id,
		'post_status' => 'private',
	];

	if ( isset( $_GET['defectsFixed'] ) ) {
		if ( $_GET['defectType'] === 'dc' ) {
			delete_post_meta( $order_id, 'defects' );
		} else if ( $_GET['defectType'] === 'ac' ) {
			delete_post_meta( $order_id, 'ac-defects' );
			delete_post_meta( $order_id, 'defects_technician' );
		} else if ( $_GET['defectType'] === 'operator' ) {
			delete_post_meta( $order_id, 'operator-defects' );
			delete_post_meta( $order_id, 'op_defect_technician' );
		}

		update_post_meta( $order_id, 'date_defect_deleted', wp_date( 'Y-m-d' ) );

		return;
	}

	if ( get_request_parameter( 'defect_appointment' ) && get_request_parameter( 'defect_technician' ) ) {

		update_post_meta( $order_id, 'defect_technician', sanitizeField( $_POST['defect_technician'], 'string' ) );

		$defectAppointment = sanitizeField( $_POST['defect_appointment'], 'string' );
		$defectAppointment = Carbon::createFromFormat( 'd.m.Y, H:i', $defectAppointment )->toDateTimeString();
		update_post_meta( $order_id, 'defect_appointment', $defectAppointment );
	}

	if ( get_request_parameter( 'op_defect_appointment' ) && get_request_parameter( 'op_defect_technician' ) ) {

		update_post_meta( $order_id, 'op_defect_technician', sanitizeField( $_POST['op_defect_technician'], 'string' ) );

		$defectAppointment = sanitizeField( $_POST['op_defect_appointment'], 'string' );
		$defectAppointment = Carbon::createFromFormat( 'd.m.Y, H:i', $defectAppointment )->toDateTimeString();
		update_post_meta( $order_id, 'op_defect_appointment', $defectAppointment );
	}

	if ( isset( $_GET['qaCallFixed'] ) ) {
		delete_post_meta( $order_id, 'qacall' );

		return;
	}

	if ( isset( $_GET['savePVScoutFlag'] ) ) {
		update_post_meta( $order_id, 'pvscout_flag', 'done' );

		return;
	}

	if ( $step <= 3 ) {
		if ( isset( $_POST['firstName'] ) && isset( $_POST['lastName'] ) ) {
			$order['post_title'] = sanitize_text_field( $_POST['firstName'] ) . ' ' . sanitize_text_field( $_POST['lastName'] );
		} else {
			$order['post_title'] = get_post_meta( $order_id, 'firstName', true ) . ' ' . get_post_meta( $order_id, 'lastName', true );
		}
	}

	if ( saveOrderAttachments( $order_id ) !== true ) {
		return;
	}

	if ( $step <= 1 && ! isset( $_POST['firstName'], $_POST['lastName'] ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	//If calling wp_update_post, unhook this function, so it doesn't loop infinitely
	remove_action( 'save_post', 'saveOrder' );

	// call wp_update_post update, which calls save_post again. E.g:
	$order_id = wp_update_post( $order );

	// re-hook this function
	add_action( 'save_post', 'saveOrder' );

	if ( $order_id === false ) {
		throw new RuntimeException( 'Order update failed!' );
	}

	$order = get_post( $order_id );

	if ( saveControllingStep( $order, $step ) ) {
		return;
	}

	if ( saveFirstStepFields( $order, $step ) ) {
		return;
	}

	if ( saveSecondStepFields( $order, $step ) ) {
		return;
	}

	if ( saveThirdStepFields( $order, $step ) ) {
		return;
	}

	if ( saveFourthStepFields( $order, $step ) ) {
		return;
	}

	if ( saveFifthStepFields( $order, $step ) ) {
		return;
	}

	if ( saveSixthStepFields( $order, $step ) ) {
		return;
	}

	if ( saveSeventhStepFields( $order, $step ) ) {
		return;
	}

	saveEightStepFields( $order, $step );
}

function saveStorage( $post_id ) {
	global $storageInformation;

	foreach ( $storageInformation as $key => $value ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		} else if ( $key === 'active' ) {
			update_post_meta( $post_id, $key, 'off' );
		}
	}

	if ( isset( $_POST['name'] ) ) {
		$my_post = array(
			'ID'          => $post_id,
			'post_title'  => sanitize_text_field( $_POST['name'] ),
			'post_status' => 'private',
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Perform permission checks! For example:
		if ( ! checkRoles( 'edit_post', $post_id ) ) {
			return;
		}

		//If calling wp_update_post, unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'saveStorage' );

		// call wp_update_post update, which calls save_post again. E.g:
		wp_update_post( $my_post );

		// re-hook this function
		add_action( 'save_post', 'saveStorage' );

	}
}

function saveMisc( $post_id ) {

	global $miscInformation;

	foreach ( $miscInformation as $key => $value ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}

	if ( isset( $_POST['name'] ) ) {
		$my_post = array(
			'ID'          => $post_id,
			'post_title'  => sanitize_text_field( $_POST['name'] ),
			'post_status' => 'private',
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Perform permission checks! For example:
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		//If calling wp_update_post, unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'saveMisc' );

		// call wp_update_post update, which calls save_post again. E.g:
		wp_update_post( $my_post );

		// re-hook this function
		add_action( 'save_post', 'saveMisc' );

	}
}

function saveModule( $post_id ) {

	global $moduleInformation;

	foreach ( $moduleInformation as $key => $value ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}

	if ( isset( $_POST['pvmoduleid'] ) ) {
		$my_post = array(
			'ID'          => $post_id,
			'post_title'  => sanitize_text_field( $_POST['pvmoduleid'] ),
			'post_status' => 'private',
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Perform permission checks! For example:
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		//If calling wp_update_post, unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'saveModule' );

		// call wp_update_post update, which calls save_post again. E.g:
		wp_update_post( $my_post );

		// re-hook this function
		add_action( 'save_post', 'saveModule' );

	}
}

function saveAgreement( $post_id ) {

	global $agreementInformation;

	foreach ( $agreementInformation as $key => $value ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}

	if ( isset( $_POST['beschreibung'] ) ) {
		$my_post = array(
			'ID'          => $post_id,
			'post_title'  => sanitize_text_field( $_POST['beschreibung'] ),
			'post_status' => 'private',
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Perform permission checks! For example:
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		//If calling wp_update_post, unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'saveAgreement' );

		// call wp_update_post update, which calls save_post again. E.g:
		wp_update_post( $my_post );

		// re-hook this function
		add_action( 'save_post', 'saveAgreement' );

	}
}

function saveInverter( $post_id ) {

	global $inverterInformation;

	foreach ( $inverterInformation as $key => $value ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}

	if ( isset( $_POST['name'] ) ) {
		$my_post = array(
			'ID'          => $post_id,
			'post_title'  => sanitize_text_field( $_POST['name'] ),
			'post_status' => 'private',
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Perform permission checks! For example:
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		//If calling wp_update_post, unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'saveInverter' );

		// call wp_update_post update, which calls save_post again. E.g:
		wp_update_post( $my_post );

		// re-hook this function
		add_action( 'save_post', 'saveInverter' );

	}
}

add_action( 'save_post', 'saveMisc' );
add_action( 'save_post', 'saveStorage' );
add_action( 'save_post', 'saveModule' );
add_action( 'save_post', 'saveAgreement' );
add_action( 'save_post', 'saveInverter' );
add_action( 'save_post', 'saveOrder' );


function customColumns( $columns ) {
	global $post;
	/* remove the Yoast SEO columns */
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
	unset( $columns['wpseo-score-readability'] );
	unset( $columns['wpseo-links'] );
	unset( $columns['wpseo-linked'] );
	//unset($columns['date']);

	unset( $columns['tags'] );
	$columns['author'] = __( 'Berater', 'textdomain' );
	$columns['status'] = 'Status';
	$columns['title']  = 'Kundenname';

	return $columns;

}

function removeYoastColumns( $columns ) {
	global $post;
	unset( $columns['wpseo-links'] );
	unset( $columns['wpseo-linked'] );

	unset( $columns['tags'] );
	$columns['title'] = 'Name';

	return $columns;
}

$user  = wp_get_current_user();
$roles = ( array ) $user->roles;
if ( in_array( 'seller', $roles ) ) {
	add_filter( 'views_edit-customer', '__return_null' );
}

//add_filter( 'views_edit-storage', '__return_null' );
//add_filter( 'views_edit-misc', '__return_null' );
//add_filter( 'views_edit-module', '__return_null' );
//add_filter( 'views_edit-inverter', '__return_null' );


add_filter( 'manage_movie_posts_columns', function ( $columns ) {
	return array_merge( $columns, [ 'status' => __( 'Status', 'textdomain' ) ] );
} );

add_action( 'manage_movie_posts_custom_column', function ( $column_key, $post_id ) {
	if ( $column_key == 'Status' ) {
		$duration = get_post_meta( $post_id, 'status', true );
		echo ( ! empty( $duration ) ) ? sprintf( __( '%s status', 'textdomain' ), $duration ) : __( 'Unknown', 'textdomain' );
	}
}, 10, 2 );

add_filter( 'manage_edit-customer_sortable_columns', function ( $columns ) {
	$columns['status'] = 'status';

	return $columns;
} );

add_action( 'pre_get_posts', function ( $query ) {
	if ( ! is_admin() ) {
		return;
	}

	$orderby = $query->get( 'orderby' );
	if ( $orderby == 'status' ) {
		$query->set( 'meta_key', 'status' );
	}
} );

function kb_admin_style() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/style-admin.css' );
}

add_action( 'admin_enqueue_scripts', 'kb_admin_style' );

add_filter( 'manage_edit-customer_columns', 'customColumns' );
add_filter( 'manage_edit-storage_columns', 'removeYoastColumns' );
add_filter( 'manage_edit-inverter_columns', 'removeYoastColumns' );
add_filter( 'manage_edit-misc_columns', 'removeYoastColumns' );
add_filter( 'manage_edit-module_columns', 'removeYoastColumns' );
add_filter( 'manage_edit-agreement_columns', 'removeYoastColumns' );

function set_column_value( $column_name, $post_ID ) {
	global $status;
	if ( 'status' === $column_name ) {
		$post_featured_image = get_post_meta( $post_ID, 'status', true );
		if ( $post_featured_image ) {
			echo '<div class="status status--' . strToLower( $post_featured_image ) . '">' . $status->$post_featured_image . '</div>';
		} else {
			echo '<div class="status status--pending">Ausstehend</div>';
		}
	}
}

function get_featured_image( $post_ID ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'featured_preview' );

		return $post_thumbnail_img[0];
	}
}

add_action( 'manage_posts_custom_column', 'set_column_value', 10, 2 );

// Removes from post and pages
add_action( 'init', 'remove_comment_support', 100 );

function remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );

}

// Removes from admin bar
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}

add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

function remove_wp_nodes() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node( 'new-post' );
	$wp_admin_bar->remove_node( 'new-link' );
	$wp_admin_bar->remove_node( 'new-media' );
}

if ( ! checkRoles( 'pv_scout' ) ) {
	add_action( 'admin_menu', 'add_google_to_admin' );
}

function add_google_to_admin() {
	$siteUrl = get_option( 'siteurl' );
	add_menu_page( 'add_google_to_admin', 'Neues Angebot', 'read_private_orders', $siteUrl . '/Angebotsformular', '', 'dashicons-plus-alt', 0 );
}

function my_admin_menu() {
	add_menu_page( __( 'Angebot Einstellungen', 'my-textdomain' ), __( 'Angebot Einstellungen', 'my-textdomain' ), 'read', 'settings', 'offerMain', 'dashicons-admin-settings', 1 );
	add_submenu_page( 'settings', 'Sonstiges', 'Sonstiges', 'read', 'settings_basis', 'offerBasis' );
}

function sevdesk_menu() {
	add_menu_page( __( 'Sevdesk', 'my-textdomain' ), __( 'Sevdesk', 'my-textdomain' ), 'read', 'sevdesk', 'sevdeskBasis', 'dashicons-admin-comments', 1 );
	add_submenu_page( 'sevdesk', 'Rechnungen mit Zahlungsverzug', 'Rechnungen mit Zahlungsverzug', 'dashboard_orders', 'sevdesk_invoices', 'addSevdeskOrdersOverviewDashboard' );
	add_submenu_page( 'sevdesk', 'Rechnungen mit Mahnstufen', 'Rechnungen mit Mahnstufen', 'dashboard_orders', 'sevdesk_invoices_reminder', 'addSevdeskOrdersReminderDashboard' );
	add_submenu_page( 'sevdesk', 'Rechnungen für Inkasso', 'Rechnungen für Inkasso', 'dashboard_orders', 'sevdesk_invoices_inkasso', 'addSevdeskOrdersInkassoDashboard' );
}

if ( checkRoles( 'administrator' ) || checkRoles( 'director' ) || checkRoles( 'director-ip' ) ) {
	add_action( 'admin_menu', 'my_admin_menu' );
}

if ( checkRoles( [ 'administrator', 'director', 'controlling' ] ) ) {
	add_action( 'admin_menu', 'sevdesk_menu' );
}

function getModulePower( $orderID ) {
	$moduleID    = get_post_meta( $orderID, 'module', true );
	$moduleQty   = (int) get_post_meta( $orderID, 'moduleqty', true );
	$modulePower = (int) get_post_meta( $moduleID, 'typ', true );

	return $moduleQty * $modulePower / 1000;
}

function getDuePercentage( $orderID ) {

	$paymentModalitiesArray = (array) json_decode( get_option( 'abschlag' ) );
	$duePaymentFirst        = (int) get_post_meta( $orderID, 'sevdesk_payment_due', true );
	$today                  = wp_date( 'Y-m-d' );
	$storageDate            = get_post_meta( $orderID, 'storage_delivery', true );
	$duePaymentSecond       = ! empty( $storageDate ) && $storageDate <= $today ? array_keys( $paymentModalitiesArray )[1] : 0;
	$duePaymentThird        = get_post_meta( $orderID, 'registrationDone', true ) ? array_keys( $paymentModalitiesArray )[2] : 0;

	// wenn AC Montage abgeschlossen ist, dann 3. Step Fälligkeit und es dürfen keine Mängel vorhanden sein

	return $duePaymentFirst + $duePaymentSecond + $duePaymentThird;
}

function getOverDue( $orderID ) {
	$hasDefects         = ! empty( get_post_meta( $orderID, 'defects', true ) );
	$hasACDefects       = ! empty( get_post_meta( $orderID, 'ac-defects', true ) );
	$hasOperatorDefects = ! empty( get_post_meta( $orderID, 'operator-defects', true ) );

	if ( $hasDefects || $hasACDefects || $hasOperatorDefects ) {
		delete_post_meta( $orderID, 'sevdesk_date_to_monitor' );

		return false;
	}

	$sevdeskInvoiceID     = get_post_meta( $orderID, 'sevdesk_invoice_date', true );
	$storageDate          = get_post_meta( $orderID, 'storage_delivery', true );
	$registrationDone     = get_post_meta( $orderID, 'registrationDone', true );
	$sevdeskReminderDate  = get_post_meta( $orderID, 'sevdesk_reminder_date', true );
	$sevdeskReminderDate1 = get_post_meta( $orderID, 'sevdesk_reminder_date-1', true );
	$sevdeskReminderDate2 = get_post_meta( $orderID, 'sevdesk_reminder_date-2', true );
	$sevdeskReminderDate3 = get_post_meta( $orderID, 'sevdesk_reminder_date-3', true );
	$dateDefectDeleted    = get_post_meta( $orderID, 'date_defect_deleted', true );

	// Hinzufügen von 4 Tagen zu $storageDate
	$storageDate = date( 'Y-m-d', strtotime( $storageDate . ' +' . get_option( 'buffer_days' ) . ' days' ) );

	$date_array = array(
		'Rechnungserstellung'    => $sevdeskInvoiceID,
		'Speicher Versandtermin' => $storageDate,
		'Fertigstellung'         => $registrationDone,
		'Zahlungserinnerung'     => $sevdeskReminderDate,
		'Mahnung 1'              => $sevdeskReminderDate1,
		'Mahnung 2'              => $sevdeskReminderDate2,
		'letzter Mahnung'        => $sevdeskReminderDate3,
		'Mängelbeseitigung'      => $dateDefectDeleted,
	);

	$filtered_dates = array_filter( $date_array, function ( $date ) {
		return strtotime( $date ) <= strtotime( 'today' );
	} );

	$dateToMonitor = max( $filtered_dates );
	$keyOfDate     = array_search( $dateToMonitor, $date_array );

	update_post_meta( $orderID, 'sevdesk_date_to_monitor', array( 'date' => $dateToMonitor, 'key' => $keyOfDate ) );

	$dueDays      = get_option( 'due_days' );
	$current_date = date( 'Y-m-d' );
	$due_days_ago = date( 'Y-m-d', strtotime( '-' . $dueDays . ' days', strtotime( $current_date ) ) );

	return strtotime( $dateToMonitor ) <= strtotime( $due_days_ago );
}

function offerBasis() {
	$fields = array(
		'abschlag'           => 'Abschläge',
		'zahlung3'           => "Zahlungsmodalität III",
		'zahlung4'           => "Zahlungsmodalität IV",
		'telefon'            => "Telefon",
		'fax'                => "Fax",
		'email'              => "E-Mail Adresse",
		'marketing'          => "Marketing",
		'mwst'               => "MwSt-Satz",
		'cloudgroesse'       => "Cloudgrößen",
		'kw10'               => 'Einspeisevergütung bis 10kw',
		'kw10kw40'           => 'Einspeisevergütung über 10kw bis 40kw',
		'ockw10'             => 'Einspeisevergütung bis 10kw (ohne Cloud)',
		'ockw10kw40'         => 'Einspeisevergütung über 10kw bis 40kw (ohne Cloud)',
		'defaultinverter'    => 'Standard Wechselrichter ID',
		'agb'                => 'Marktstammdaten + AGB PDF',
		'usergroups'         => 'User Gruppen',
		'icalhash'           => 'Kalendar Random URL Pfad',
		'company'            => 'Unternehmen',
		'companyWithoutForm' => 'Name ohne Geschäftsform',
		'street'             => 'Straße und Hausnummer',
		'zip'                => 'PLZ',
		'openingHours'       => 'Öffnungszeiten',
		'city'               => 'Ort',
		'website'            => "Webseite",
		'postemail'          => "Post E-Mail Adresse",
		'color'              => 'Farbe (z.B. #000000)',
		'logo'               => 'Logo PNG',
		'logoprint'          => 'Logo SVG',
		'vatid'              => 'Steuernummer',
		'handelsregister'    => 'Handelsregister',
		'director'           => 'Geschäftsführer',
		'bank'               => 'Commerzbank',
		'globalPlattform'    => 'Globale Plattform',
		'smtp_password'      => 'SMTP Passwort',
	)
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline" style="text-indent: 0">
			<?php esc_html_e( 'Sonstiges', 'my-plugin-textdomain' ); ?>
		</h1>
		<form method="post" action="options.php">
			<?php wp_nonce_field( 'update-options' ) ?>
			<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">
			<?php foreach ( $fields as $key => $val ) : ?>
				<?php if ( $key === 'cloudgroesse' || $key === 'usergroups' || $key === 'abschlag' ) : ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<textarea class="form-control" id="<?php echo $key; ?>"
						          name="<?php echo $key; ?>"><?php echo get_option( $key ); ?></textarea>
					</div>
				<?php elseif ( $key === 'smtp_password' ) : ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<input class="form-control" type="password" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
						       value="<?php echo get_option( $key ); ?>">
					</div>
				<?php elseif ( $key === 'company' ) : ?>
					<h1 style="text-indent: 0">
						Einstellungen Angebotstool
					</h1>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<input class="form-control" type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
						       value="<?php echo get_option( $key ); ?>">
					</div>
				<?php elseif ( $key === 'color' ): ?>
					<div class="form-group">
						<label for="exampleColorInput" class="form-label">Farbauswahl</label>
						<input type="color" name="<?php echo $key; ?>" class="form-control form-control-color"
						       id="exampleColorInput" value="<?php echo get_option( 'color' ); ?>"
						       title="Choose your color">
					</div>
				<?php elseif ( $key === 'globalPlattform' && checkRoles( 'administrator' ) ): ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<input class="form-control" type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
						       value="<?php echo get_option( $key ); ?>">
					</div>
				<?php elseif ( $key === 'logo' || $key === 'logoprint' ): ?>
					<div class="media-selector form-group form-group--canvas">
						<?php wp_enqueue_media(); ?>
						<div class='image-preview-wrapper'>
							<div><label><?php echo $val; ?></label></div>
							<img class='image-preview' src='<?php echo wp_get_attachment_url( get_option( $key ) ); ?>'
							     height='100'>
						</div>
						<input type="button" class="upload_image_button button"
						       value="<?php _e( 'Bild hochladen' ); ?>"/>
						<input type='hidden' name='<?php echo $key; ?>' class='image_attachment_id'
						       value='<?php echo get_option( $key ); ?>'>
					</div>
				<?php else: ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<input class="form-control" type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
						       value="<?php echo get_option( $key ); ?>">
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<input type="hidden" name="action" value="update"/>
			<input type="hidden" name="page_options"
			       value="
<?php foreach ( $fields as $key => $value ) {
				       echo $key . ',';
			       }
			       ?>
"/>
			<input type="submit" name="Submit" class="button-primary" value="Einstellungen speichern"/>
		</form>
	</div>
	<script type='text/javascript'>

      jQuery(document).ready(function ($) {

        var file_frame;
        var wp_media_post_id = wp.media.model.settings.post.id;
        var thisMedia = ''
        jQuery('.media-selector').on('click', '.upload_image_button', function (event) {
          thisMedia = $(this);
          event.preventDefault();

          if (file_frame) {
            file_frame.open();
            return;
          } else {
          }

          file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select a image to upload',
            button: {
              text: 'Use this image',
            },
            multiple: false
          });

          file_frame.on('select', function () {
            attachment = file_frame.state().get('selection').first().toJSON();

            thisMedia.parent().find('.image-preview').attr('src', attachment.url).css('width', 'auto');
            thisMedia.parent().find('.image_attachment_id').val(attachment.id);

            wp.media.model.settings.post.id = wp_media_post_id;
          });

          file_frame.open();
        });

        jQuery('a.add_media').on('click', function () {
          wp.media.model.settings.post.id = wp_media_post_id;
        });
      });

	</script>
	<?php
}

function sevdeskBasis() {
	$fields = array(
		'invoice_header'  => 'Rechnung Header Text',
		'invoice_footer'  => 'Rechnung Footer Text',
		'dc_price'        => 'Dachmontage Preis pro kwp',
		'ac_flat'         => 'Elektromontage AC Pauschale',
		'pv_includes'     => 'Inklusivleistungen PV Anlage',
		'due_days'        => 'Fälligkeit in Tagen',
		'buffer_days'     => 'Speicher Puffer Tage',
		'reminder_qty'    => 'Anzahl Mahnungen ohne Zahlungserinnerung',
		'reminder_header' => 'Zahlungserinnerungen / Mahnungen Header Text',
		'reminder_footer' => 'Zahlungserinnerungen / Mahnungen Footer Text',
	);
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline" style="text-indent: 0">
			<?php esc_html_e( 'Sevdesk Einstellungen', 'my-plugin-textdomain' ); ?>
		</h1>
		<form method="post" action="options.php">
			<?php wp_nonce_field( 'update-options' ) ?>
			<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/angebote/style.css">
			<?php foreach ( $fields as $key => $val ) : ?>
				<?php if ( $key === 'invoice_header' || $key === 'invoice_footer' || $key === 'reminder_footer' || $key === 'reminder_header' ) : ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<textarea class="form-control" id="<?php echo $key; ?>"
						          name="<?php echo $key; ?>"><?php echo get_option( $key ); ?></textarea>
					</div>
				<?php else: ?>
					<div class="form-group text">
						<label for="<?php echo $key; ?>"><?php echo $val; ?></label>
						<input class="form-control" type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
						       value="<?php echo get_option( $key ); ?>">
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<input type="hidden" name="action" value="update"/>
			<input type="hidden" name="page_options"
			       value="
					<?php foreach ( $fields as $key => $value ) {
				       echo $key . ',';
			       }
			       ?>"/>
			<input type="submit" name="Submit" class="button-primary" value="Einstellungen speichern"/>
		</form>
	</div>
	<?php
}


add_filter( 'auth_cookie_expiration', 'keep_me_logged_in_for_1_year' );

function keep_me_logged_in_for_1_year( $expirein ) {
	return 31556926; // 1 year in seconds
}

add_filter( 'wpseo_update_notice_content', '__return_null' );

// Removes from admin menu
add_action( 'admin_init', 'wpse_136058_remove_menu_pages' );
add_action( 'admin_menu', 'remove_cpt_submenu_page', 999 );

function remove_cpt_submenu_page() {

}

function wpse_136058_remove_menu_pages() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'tools.php' );
	remove_menu_page( 'wpseo_workouts' );
	remove_menu_page( 'index.php' );
	remove_menu_page( 'activity-log-settings' );
	remove_menu_page( 'complianz' );
	if ( checkRoles( 'pv_scout' ) ) {
		remove_menu_page( 'post-new.php' );
	}

	remove_submenu_page( 'edit.php?post_type=lead', 'post-new.php?post_type=lead' );
	remove_submenu_page( 'edit.php?post_type=customer', 'post-new.php?post_type=customer' );

	if ( ! checkRoles( 'administrator' ) ) {
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'wp-mail-smtp' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_settings' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_userlogin' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_useracc' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_user_registration' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_database' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_filesystem' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_blacklist' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_firewall' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_brute_force' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_spam' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_filescan' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_maintenance' );
		remove_submenu_page( 'aiowpsec', 'aiowpsec_misc' );

	}
	//remove_menu_page('profile.php');

	$user  = wp_get_current_user();
	$roles = ( array ) $user->roles;
	if ( in_array( 'seller', $roles ) ) {
		remove_menu_page( 'settings' );
	}
}

function update_contact_methods( $contactmethods ) {

	unset( $contactmethods['aim'] );
	unset( $contactmethods['jabber'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['pinterest'] );
	unset( $contactmethods['facebook'] );
	unset( $contactmethods['instagram'] );
	unset( $contactmethods['linkedin'] );
	unset( $contactmethods['myspace'] );
	unset( $contactmethods['soundcloud'] );
	unset( $contactmethods['tumblr'] );
	unset( $contactmethods['twitter'] );
	unset( $contactmethods['youtube'] );
	unset( $contactmethods['wikipedia'] );
	unset( $contactmethods['website'] );


	return $contactmethods;

}

add_filter( 'user_contactmethods', 'update_contact_methods' );


function custom_user_profile_fields( $user ) {
	?>
	<h3>Extra profile information</h3>
	<table class="form-table" role="presentation">
		<tr>
			<th class="">
				<label for="handynummer">Handynummer</label></th>
			<td>
				<input type="text" class="regular-text ltr" name="handynummer"
				       value="<?php echo esc_attr( get_the_author_meta( 'handynummer', $user->ID ) ); ?>"
				       id="handynummer"/>
			</td>
		</tr>
		<tr class="form-required">
			<th class="">
				<label for="mailtext">E-Mail Text</label></th>
			<td>
                <textarea class="regular-text ltr" name="mailtext" required id="mailtext"
                          rows="10"><?php echo esc_attr( get_the_author_meta( 'mailtext', $user->ID ) ); ?></textarea>
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );

function save_custom_user_profile_fields( $user_id ) {

	# save my custom field
	update_user_meta( $user_id, 'handynummer', $_POST['handynummer'] );
	update_user_meta( $user_id, 'mailtext', $_POST['mailtext'] );
}

add_action( 'user_register', 'save_custom_user_profile_fields' );
add_action( 'profile_update', 'save_custom_user_profile_fields' );


//add_action( 'admin_init', 'my_limit_admin_color_options', 1 );

/* Limit admin color options */
function my_limit_admin_color_options() {
	global $_wp_admin_css_colors;

	/* Get fresh color data */
	$fresh_color_data = $_wp_admin_css_colors['fresh'];

	/* Remove everything else */
	$_wp_admin_css_colors = array( 'fresh' => $fresh_color_data );
	/*
	 *
	 * TODO Rausnehmen
	 * prüfen welche seiten eingebunden sind
		echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
	*/

	//remove_menu_page( 'activity_log_page' );
}

add_filter( 'auto_core_update_send_email', 'wpb_stop_auto_update_emails', 10, 4 );

function wpb_stop_update_emails( $send, $type, $core_update, $result ) {
	if ( ! empty( $type ) && $type == 'success' ) {
		return false;
	}

	return true;
}


// Fix post counts
function fix_post_counts( $views ) {
	global $current_user, $wp_query;
	unset( $views['mine'] );
	$types = array(
		array( 'status' => null ),
		array( 'status' => 'publish' ),
		array( 'status' => 'draft' ),
		array( 'status' => 'pending' ),
		array( 'status' => 'trash' ),
	);
	foreach ( $types as $type ) {
		$query  = array(
			'author'      => $current_user->ID,
			'post_type'   => 'post',
			'post_status' => $type['status'],
		);
		$result = new WP_Query( $query );
		if ( $type['status'] == null ):
			$class        = ( $wp_query->query_vars['post_status'] == null ) ? ' class="current"' : '';
			$views['all'] = sprintf( __( '<a href="%s"' . $class . '>All <span class="count">(%d)</span></a>', 'all' ), admin_url( 'edit.php?post_type=post' ), $result->found_posts );
		elseif ( $type['status'] == 'publish' ):
			$class            = ( $wp_query->query_vars['post_status'] == 'publish' ) ? ' class="current"' : '';
			$views['publish'] = sprintf( __( '<a href="%s"' . $class . '>Published <span class="count">(%d)</span></a>', 'publish' ), admin_url( 'edit.php?post_status=publish&post_type=post' ), $result->found_posts );
		elseif ( $type['status'] == 'draft' ):
			$class          = ( $wp_query->query_vars['post_status'] == 'draft' ) ? ' class="current"' : '';
			$views['draft'] = sprintf( __( '<a href="%s"' . $class . '>Draft' . ( ( sizeof( $result->posts ) > 1 ) ? "s" : "" ) . ' <span class="count">(%d)</span></a>', 'draft' ), admin_url( 'edit.php?post_status=draft&post_type=post' ), $result->found_posts );
		elseif ( $type['status'] == 'pending' ):
			$class            = ( $wp_query->query_vars['post_status'] == 'pending' ) ? ' class="current"' : '';
			$views['pending'] = sprintf( __( '<a href="%s"' . $class . '>Pending <span class="count">(%d)</span></a>', 'pending' ), admin_url( 'edit.php?post_status=pending&post_type=post' ), $result->found_posts );
		elseif ( $type['status'] == 'trash' ):
			$class          = ( $wp_query->query_vars['post_status'] == 'trash' ) ? ' class="current"' : '';
			$views['trash'] = sprintf( __( '<a href="%s"' . $class . '>Trash <span class="count">(%d)</span></a>', 'trash' ), admin_url( 'edit.php?post_status=trash&post_type=post' ), $result->found_posts );
		endif;
	}

	return $views;
}

// Fix media counts
function fix_media_counts( $views ) {
	global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
	$views = array();
	$count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
	foreach ( $count as $row ) {
		$_num_posts[ $row['post_mime_type'] ] = $row['num_posts'];
	}
	$_total_posts = array_sum( $_num_posts );
	$detached     = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
	if ( ! isset( $total_orphans ) ) {
		$total_orphans = $wpdb->get_var( "
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment' 
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        " );
	}
	$matches = wp_match_mime_types( array_keys( $post_mime_types ), array_keys( $_num_posts ) );
	foreach ( $matches as $type => $reals ) {
		foreach ( $reals as $real ) {
			$num_posts[ $type ] = ( isset( $num_posts[ $type ] ) ) ? $num_posts[ $type ] + $_num_posts[ $real ] : $_num_posts[ $real ];
		}
	}
	$postMimeType = get_request_parameter( 'post_mime_type' );
	$status       = get_request_parameter( 'status', null );
	$class        = ( empty( $postMimeType ) && ! $detached && $status !== null ) ? ' class="current"' : '';
	$views['all'] = "<a href='upload.php'$class>" . sprintf( __( 'All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts ) ) . '</a>';
	foreach ( $post_mime_types as $mime_type => $label ) {
		$class = '';
		if ( ! wp_match_mime_types( $mime_type, $avail_post_mime_types ) ) {
			continue;
		}
		if ( ! empty( $postMimeType ) && wp_match_mime_types( $mime_type, $postMimeType ) ) {
			$class = ' class="current"';
		}
		if ( ! empty( $num_posts[ $mime_type ] ) ) {
			$views[ $mime_type ] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[ $mime_type ] ), $num_posts[ $mime_type ] ) . '</a>';
		}
	}
	$views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';

	return $views;
}

add_filter( 'rest_authentication_errors', function ( $result ) {
	// If a previous authentication check was applied,
	// pass that result along without modification.
	if ( true === $result || is_wp_error( $result ) ) {
		return $result;
	}

	// No authentication has been performed yet.
	// Return an error if user is not logged in.
	if ( ! is_user_logged_in() ) {
		return new WP_Error( 'rest_not_logged_in', __( 'You are not currently logged in.' ), array( 'status' => 401 ) );
	}

	// Our custom authentication check should have no effect
	// on logged-in requests
	return $result;
} );

function getDeprecatedNotes( $notes ): array {
	if ( empty( $notes ) ) {
		return [];
	}
	$notesArray = [];
	$firstNote  = explode( '<', $notes );
	if ( isset( $firstNote[0] ) && ! empty( $firstNote[0] ) ) {
		$notesArray[] = [
			'message' => trim( $firstNote[0] ),
			'author'  => 'Anonymous',
		];
	}

	$dom = new DOMDocument();
	$dom->loadHTML( $notes );
	$domx           = new DOMXPath( $dom );
	$notesDomeArray = $domx->query( "//div[contains(@class, 'note')]" );
	foreach ( $notesDomeArray as $note ) {
		$noteArray    = explode( ':', $note->nodeValue );
		$notesArray[] = [
			'author'  => trim( $noteArray[0] ?? 'Anonymous' ),
			'message' => trim( $noteArray[1] ?? '' ),
		];
	}

	return $notesArray;
}

function getNotes( $orderId ): array {
	$notesRaw = get_post_meta( $orderId, 'notes', true );
	try {
		$notes = json_decode( $notesRaw, true, 512, JSON_THROW_ON_ERROR );
	} catch ( Exception $exception ) {
		$notes = JSON_ERROR_NONE;
	}
	if ( $notes === JSON_ERROR_NONE ) {
		$notes = getDeprecatedNotes( $notesRaw );
	}

	if ( ! is_array( $notes ) ) {
		return [];
	}

	return $notes;
}

function getLeadNotes( $lead_id ): array {

	$notesRaw = get_post_meta( $lead_id, 'lead_notes', true );

	try {
		$notes = json_decode( $notesRaw, true, 512, JSON_THROW_ON_ERROR );
	} catch ( Exception ) {
		$notes = JSON_ERROR_NONE;
	}

	if ( ! is_array( $notes ) ) {
		return [];
	}

	return $notes;
}

function getCustomerNotes( $orderId ): array {
	$notesRaw = get_post_meta( $orderId, 'customer_notes', true );
	try {
		$notes = json_decode( $notesRaw, true, 512, JSON_THROW_ON_ERROR );
	} catch ( Exception $exception ) {
		$notes = JSON_ERROR_NONE;
	}
	if ( $notes === JSON_ERROR_NONE ) {
		$notes = getDeprecatedNotes( $notesRaw );
	}

	if ( ! is_array( $notes ) ) {
		return [];
	}

	return $notes;
}

function getCurrentOrderView(): string {
	if ( isset( $_GET['controlling-view'] ) ) {
		return 'controlling';
	}
	if ( isset( $_GET['dc-assembly-view'] ) ) {
		return 'dc-assembly';
	}
	if ( isset( $_GET['ac-assembly-view'] ) ) {
		return 'ac-assembly';
	}
	if ( isset( $_GET['seller-view'] ) ) {
		return 'seller';
	}
	if ( isset( $_GET['pvscout-view'] ) ) {
		return 'pvscout';
	}

	return 'normal';
}

function orderAttachments( $order ): array {
	$orderAttachments = [];
	foreach ( get_post_meta( $order->ID ) as $key => $value ) {
		if ( strpos( $key, 'orderAttachments-' ) === 0 ) {
			$orderAttachments[ $key ] = unserialize( $value[0] ?? '', [ 'array' ] );
		}
	}

	return $orderAttachments;
}

function customAttachmentsUploadPath( $arr, $orderId ) {
	$order          = get_post( $orderId );
	$attachmentsDir = DIRECTORY_SEPARATOR . 'orders-attachments' . DIRECTORY_SEPARATOR . $order->ID;

	if ( strpos( $arr['path'], $attachmentsDir ) === false ) {
		$arr['path'] .= $attachmentsDir;
	}
	if ( strpos( $arr['url'], $attachmentsDir ) === false ) {
		$arr['url'] .= $attachmentsDir;
	}
	if ( strpos( $arr['subdir'], $attachmentsDir ) === false ) {
		$arr['subdir'] .= $attachmentsDir;
	}

	return $arr;
}

function saveOrderAttachments( $order_id ): bool {
	$uploads = count( $_FILES['orderAttachments']['type'] ?? [] );
	if ( $uploads === 0 || empty( $_FILES['orderAttachments']['type'][0] ) ) {
		return true;
	}

	add_filter( 'upload_dir', static function ( $arr ) use ( $order_id ) {
		return customAttachmentsUploadPath( $arr, $order_id );
	} );
	$uploadsDir = wp_upload_dir();
	wp_mkdir_p( $uploadsDir['path'] );

	for ( $i = 0; $i < $uploads; $i ++ ) {
		if ( empty( $_FILES['orderAttachments']['tmp_name'][ $i ] ) ) {
			continue;
		}

		if ( ! isAttachmentTypeAllowed( $_FILES['orderAttachments']['type'][ $i ] ) ) {
			add_filter( 'redirect_post_location', function ( $location ) {
				return add_query_arg( 'attachment-error', 'type not allowed', $location );
			} );

			return false;
		}

		$orderAttachmentFilename     = $_FILES['orderAttachments']['name'][ $i ];
		$orderAttachmentTempFilename = $_FILES['orderAttachments']['tmp_name'][ $i ];
		$orderAttachmentUpload       = wp_upload_bits( $orderAttachmentFilename, null, file_get_contents( $orderAttachmentTempFilename ) );

		$uuid = wp_generate_uuid4();
		update_post_meta( $order_id, 'orderAttachments-' . $uuid, $orderAttachmentUpload );
		unset( $_FILES['orderAttachments']['name'][ $i ], $_FILES['orderAttachments']['tmp_name'][ $i ] );
	}
	remove_filter( 'upload_dir', 'customAttachmentsUploadPath' );

	return true;
}

function allowedAttachmentTyps(): array {
	return [
		'image/png',
		'image/jpeg',
		'video/quicktime',
		'video/mp4',
		'application/pdf',
	];
}

function isAttachmentTypeAllowed( $attachmentType ): bool {
	$allowedTypes = allowedAttachmentTyps();

	return in_array( $attachmentType, $allowedTypes, true );
}

function update_edit_form() {
	echo ' enctype="multipart/form-data"';
}

add_action( 'post_edit_form_tag', 'update_edit_form' );


function addOrUpdateUrlParam( array $newParams = [] ): string {
	$getParams = $_GET;
	foreach ( $newParams as $name => $value ) {
		unset( $getParams[ $name ] );
		$getParams[ $name ] = $value;
	}

	return basename( $_SERVER['PHP_SELF'] ) . '?' . http_build_query( $getParams );
}


add_action( 'add_meta_boxes_customer', 'deleteAttachment' );
function deleteAttachment() {
	global $post;

	if ( empty( get_request_parameter( 'delete-attachment' ) ) || checkRoles( [
			'administrator',
			'director'
		] ) !== true ) {
		return;
	}

	if ( $post->ID !== (int) get_request_parameter( 'post' ) ) {
		return;
	}

	$attachmentMetaKey  = trim( get_request_parameter( 'delete-attachment' ) );
	$attachmentMetaData = get_post_meta( $post->ID, $attachmentMetaKey, true );
	if ( empty( $attachmentMetaData['file'] ) ) {
		return;
	}
	wp_delete_file( $attachmentMetaData['file'] );
	delete_post_meta( $post->ID, $attachmentMetaKey );
}

// force one column for customer
function single_screen_layout_columns( $columns ) {
	$columns['post'] = 1;

	return $columns;
}

add_filter( 'screen_layout_columns', 'single_screen_layout_columns' );

function single_screen_layout_customer(): int {
	return 1;
}

add_filter( 'get_user_option_screen_layout_customer', 'single_screen_layout_customer' );


/// add dashboards
add_action( 'admin_menu', 'addOrdersDashboardToMenu' );
function addOrdersDashboardToMenu() {
	if ( ! checkRoles( [
		'administrator',
		'director',
		'project_manager',
		'registration',
		'dc_project_manager',
		'ac_project_manager',
		'dc_technician',
		'ac_technician',
		'controlling',
		'pv_scout',
		'qa_manager',
	] ) ) {
		return;
	}
	add_submenu_page( 'edit.php?post_type=customer', 'Dashboard', 'Dashboard', 'dashboard_orders', 'dashboard', 'ordersDashboard', 0 );
}

function ordersDashboard() {
	/// ROLES
	// administrator
	// director
	// pm
	// pm-dc
	// dc-tech
	// pm-ac
	// ac-tech
	// controlling
	//
	/// STATES
	// Projektierung step = 2 // administrator, director, pm
	// FÖRDERMITTELANTRAG = 3 // administrator, director, pm
	// IN DC Montage = 4 // administrator, director, pm-dc-montage, dc-tech
	// IN ELEKTRO TERMINIERUNG = 5 // administrator, director, pm-ac-montage
	// IN AC Montage = 6 // administrator, director, pm-ac-montage, ac-tech
	// In Fertigmeldung = 7 // administrator, director, pm
	// Buchhaltung 90% >= step 5 // administrator, director, controlling
	// Buchhaltung 10% >= step 6 & 90% billed // administrator, director, controlling
	view( 'dashboards/layout' );
}


/// add dashboards
add_action( 'admin_menu', 'addLeadsDashboardToMenu' );
function addLeadsDashboardToMenu() {
	if ( checkRoles( [ 'administrator', 'director', 'seller' ] ) ) {
		add_submenu_page( 'edit.php?post_type=lead', 'Leads Dashboard', 'Dashboard', 'dashboard_leads', 'lead-dashboard', 'setLeadsDashboard', 0 );
	}

}

function setLeadsDashboard() {
	view( 'dashboards/lead-layout' );
}


/// dc appointment Dashboard
// add_action( 'admin_menu', 'defectsDashboard' );
// function defectsDashboard() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 		'dc_project_manager',
// 		'ac_project_manager',
// 	] ) ) {
// 		return;
// 	}

// 	add_submenu_page( 'edit.php?post_type=customer', 'DC / AC Termine', 'DC Mängel', 'dashboard_orders', 'defects-dashboard', 'addDefectsDashboard', 2 );
// }

// function addDefectsDashboard() {
// 	$filter = 'defects';
// 	view( 'defects-dashboard/layout', compact( 'filter' ) );
// }

// add_action( 'admin_menu', 'finishedDefectsDashboard' );
// function finishedDefectsDashboard() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 		'dc_project_manager',
// 		'ac_project_manager',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'Netzbetreiber Mängel', 'Netzbetreiber Mängel', 'dashboard_orders', 'finished-defects-dashboard', 'addFinishedDefectsDashboard', 3 );
// }

// function addFinishedDefectsDashboard() {
// 	$filter = 'operator-defects';
// 	view( 'defects-dashboard/layout', compact( 'filter' ) );
// }


// add_action( 'admin_menu', 'acDefectsDashboard' );
// function acDefectsDashboard() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 		'dc_project_manager',
// 		'ac_project_manager',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'AC Nacharbeiten', 'AC Nacharbeiten', 'dashboard_orders', 'ac-defects-dashboard', 'addAcDefectsDashboard', 3 );
// }

// function addAcDefectsDashboard() {
// 	$filter = 'ac-defects';
// 	view( 'defects-dashboard/layout', compact( 'filter' ) );
// }


/// dc appointment Dashboard
// add_action( 'admin_menu', 'ordersOverviewPage' );
// function ordersOverviewPage() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'Auftragsliste', 'Auftragsliste', 'dashboard_orders', 'orders-dashboard', 'addOrdersOverviewDashboard', 2 );
// }

// function addOrdersOverviewDashboard() {
// 	view( 'orders-dashboard/layout' );
// }


// Admin Orders Overview
// if ( checkRoles( 'administrator' ) ) {
// 	add_action( 'admin_menu', 'AdminOrdersOverviewPage' );
// }
// function AdminOrdersOverviewPage() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'Admin Auftragsliste', 'Admin Auftragsliste', 'dashboard_orders', 'admin-orders-dashboard', 'addAdminOrdersOverviewDashboard', 2 );
// }

function addAdminOrdersOverviewDashboard() {
	view( 'admin-orders-dashboard/layout' );
}


function addSevdeskOrdersOverviewDashboard() {
	//checkSevdeskPayments();
	view( 'sevdesk-orders-dashboard/layout' );
}

function addSevdeskOrdersReminderDashboard() {
	//checkSevdeskPayments();
	view( 'sevdesk-orders-dashboard/layout-reminder' );
}

function addSevdeskOrdersInkassoDashboard() {
	//checkSevdeskPayments();
	view( 'sevdesk-orders-dashboard/layout-inkasso' );
}


/// dc appointment Dashboard
// add_action( 'admin_menu', 'addDCAppointmentDashboard' );
// function addDCAppointmentDashboard() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 		'dc_project_manager',
// 		'ac_project_manager',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'DC / AC Termine', 'DC / AC Termine', 'dashboard_orders', 'dc-dashboard', 'dcAppointmentDashboard', 2 );
// }

// function dcAppointmentDashboard() {
// 	view( 'dc-dashboard/layout' );
// }

/// dc appointment Dashboard
// add_action( 'admin_menu', 'registrationMenu' );
// function registrationMenu() {
// 	if ( ! checkRoles( [
// 		'administrator',
// 		'director',
// 		'registration',
// 	] ) ) {
// 		return;
// 	}
// 	add_submenu_page( 'edit.php?post_type=customer', 'An- & Fertigmeldungen', 'An- & Fertigmeldungen', 'dashboard_orders', 'registration-dashboard', 'addRegistrationDoneDashboard', 3 );
// }

// function addRegistrationDoneDashboard() {
// 	view( 'registration-dashboard/layout' );
// }


/// DC Saved Appointments Dashboard
// if ( checkRoles( [ 'registration', 'administrator', 'director', 'dc_project_manager' ] ) ) {
// 	add_action( 'admin_menu', 'addSavedAppointmentsDashboard' );
// }

// function addSavedAppointmentsDashboard() {
// 	add_submenu_page( 'edit.php?post_type=customer', 'Gelegte Montagen', 'Gelegte Montagen', 'dashboard_orders', 'dc-saved-appointments', 'SavedAppointmentsDashboard', 3 );
// }

// function SavedAppointmentsDashboard() {
// 	view( 'dc-saved-appointments/layout' );
// }


/// Storage Delivery Dates
// if ( checkRoles( [ 'registration', 'administrator', 'director' ] ) ) {
// 	add_action( 'admin_menu', 'addStorageDatesDashboard' );
// }

// function addStorageDatesDashboard() {
// 	add_submenu_page( 'edit.php?post_type=customer', 'Speicher Versandtermine', 'Speicher Versandtermine', 'dashboard_orders', 'storage_dates', 'showStorageDatesDashboard', 3 );
// }

// function showStorageDatesDashboard() {
// 	view( 'storage-dates/layout' );
// }


/// QS
// if ( checkRoles( [ 'administrator', 'director', 'qa_manager' ] ) ) {
// 	add_action( 'admin_menu', 'addQSDashboard' );
// }

// function addQSDashboard() {
// 	add_submenu_page( 'edit.php?post_type=customer', 'Qualitätssicherung', 'Qualitätssicherung', 'dashboard_orders', 'qs', 'showQSDashboard', 7 );
// }

// function showQSDashboard() {
// 	view( 'quality-assurance/layout' );
// }


function ordersDashoboard( array $roles, string $title, array $args, array $options = [], $template = 'dashboards/section' ): bool {
	if ( ! checkRoles( $roles ) ) {
		return false;
	}
	$args['post_type']              = 'customer';
	$args['post_status']            = 'private';
	$args['update_post_term_cache'] = false;
	$args['no_found_rows']          = true;


	$args['meta_query']['order_start_date'] = [
		'key'  => 'order_start_date',
		'type' => 'CHAR'
	];
	$args['orderby']['order_start_date']    = 'ASC';

	if ( isset( $options['step'] ) && $options['step'] > 2 ) {
		$args['meta_query']['project_start_date'] = [
			'key'  => 'project_start_date',
			'type' => 'DATE',
			//		'compare' => 'EXISTS',
		];
		$args['orderby']['project_start_date']    = 'ASC';
	}

	if ( ! isset( $args['posts_per_page'] ) ) {
		$args['posts_per_page'] = - 1;
	}

	$orders = get_posts( $args );
	if ( count( $orders ) === 0 ) {
		return false;
	}
	view( $template, compact( [ 'orders', 'title', 'options' ] ) );

	return true;
}

function leadsDashboard( array $roles, string $title, array $args, array $options = [], $template = 'dashboards/lead-section' ): bool {
	if ( ! checkRoles( $roles ) ) {
		return false;
	}
	$args['post_type']   = 'lead';
	$args['post_status'] = 'private';

	//creation date order
	//$args['orderby']['order_start_date']    = 'ASC';

	if ( ! isset( $args['posts_per_page'] ) ) {
		$args['posts_per_page'] = - 1;
	}

	$leads = get_posts( $args );
	if ( count( $leads ) === 0 ) {
		return false;
	}
	view( $template, compact( [ 'leads', 'title', 'options' ] ) );

	return true;
}


function registrationDashboard(): bool {
	$args  = [
		'meta_query'     => [
			[
				'key'     => 'registration',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'step',
				'value'   => 2,
				'compare' => '>',
			],
		],
		'posts_per_page' => - 1,
	];
	$title = 'ANMELDUNG';

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'registration',
	], $title, $args, [ 'step' => 1 ] );
}


function pvScoutDashboard(): bool {
	$title = 'TECHNISCHE MACHBARKEIT';

	$args = [
		'meta_query'     => [
			[
				'key'     => 'pvscout_flag',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'step',
				'value'   => 2,
				'compare' => '>=',
			],
			[
				'key'     => 'step',
				'value'   => 4,
				'compare' => '<',
			],
		],
		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [
		'administrator',
		'project_manager',
// 		'director',
	], $title, $args, [ 'forcePVScoutView' => true, 'step' => 1 ] );
}

function projectPlanningDashboard(): bool {
	$args  = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 2,
			],
		],
		'posts_per_page' => - 1,
	];
	$title = 'PROJEKTIERUNG';

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'project_manager'
	], $title, $args, [ 'step' => 2 ] );
}

function dcSchedulingDashboard( $title = 'FÖRDERMITTELANTRAG', $template = 'dashboards/section', $registration = false ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 3,
			]
		],
		'orderby'        => [
			'dc_appointment' => 'DESC',
		],
		'posts_per_page' => - 1,
	];

	if ( checkRoles( [ 'registration' ] ) || $registration ) {
		$args                                 = [
			'meta_query'     => [

				[
					'key'     => 'step',
					'value'   => 4,
					'compare' => '>='
				],
				[
					'key'     => 'step',
					'value'   => 8,
					'compare' => '<',
				],
				[
					'key'     => 'registrationDone',
					'compare' => 'NOT EXISTS'
				]
			],
			'orderby'        => [
				'dc_appointment' => 'DESC',
			],
			'posts_per_page' => - 1,
		];
		$args['meta_query']['dc_appointment'] = [
			'key'     => 'dc_appointment',
			'compare' => 'EXIST',
		];
	}

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'dc_project_manager'
	], $title, $args, [ 'step' => 3 ], $template );
}
function wpMontageTerminierung( $title = 'WP MONTAG TERMINIERUNG ', $template = 'dashboards/section', $registration = false ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 3,
			]
		],
		'orderby'        => [
			'dc_appointment' => 'DESC',
		],
		'posts_per_page' => - 1,
	];

	if ( checkRoles( [ 'registration' ] ) || $registration ) {
		$args                                 = [
			'meta_query'     => [

				[
					'key'     => 'step',
					'value'   => 4,
					'compare' => '>='
				],
				[
					'key'     => 'step',
					'value'   => 8,
					'compare' => '<',
				],
				[
					'key'     => 'registrationDone',
					'compare' => 'NOT EXISTS'
				]
			],
			'orderby'        => [
				'dc_appointment' => 'DESC',
			],
			'posts_per_page' => - 1,
		];
		$args['meta_query']['dc_appointment'] = [
			'key'     => 'dc_appointment',
			'compare' => 'EXIST',
		];
	}

	return ordersDashoboard( [
		'administrator',
		'disposition',
	], $title, $args, [ 'step' => 3 ], $template );
}
function ÖL( $title = 'TANKSCHUTZ', $template = 'dashboards/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 4,
			],
			'dc_delivery'    => [
				'key'     => 'dc_delivery',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
			'dc_appointment' => [
				'key'     => 'dc_appointment',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
		],
		'orderby'        => [
			'dc_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'dc_project_manager' ] ) !== true ) {
		$args['meta_query'][] = [
			'key'     => 'dc_technician',
			'value'   => $userID,
			'compare' => 'IN',
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'disposition',
		'dc_technician',
	], $title, $args, [ 'step' => 4 ], $template );
}
function GAS( $title = 'GAS Abmeldung', $template = 'dashboards/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 4,
			],
			'dc_delivery'    => [
				'key'     => 'dc_delivery',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
			'dc_appointment' => [
				'key'     => 'dc_appointment',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
		],
		'orderby'        => [
			'dc_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'dc_project_manager' ] ) !== true ) {
		$args['meta_query'][] = [
			'key'     => 'dc_technician',
			'value'   => $userID,
			'compare' => 'IN',
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'disposition',
		'dc_technician',
	], $title, $args, [ 'step' => 4 ], $template );
}
// 3. WP Montage Terminierung


function dcAssemblyDashboard( $title = 'IN WP MONTAGE', $template = 'dashboards/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 4,
			],
			'dc_delivery'    => [
				'key'     => 'dc_delivery',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
			'dc_appointment' => [
				'key'     => 'dc_appointment',
				'type'    => 'DATE',
				'compare' => 'EXISTS',
			],
		],
		'orderby'        => [
			'dc_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'dc_project_manager' ] ) !== true ) {
		$args['meta_query'][] = [
			'key'     => 'dc_technician',
			'value'   => $userID,
			'compare' => 'IN',
		];
	}

	return ordersDashoboard( [
		'administrator',
// 		'director',
// 		'dc_project_manager',
// 		'dc_technician',
		'wp_monteur' 		
	], $title, $args, [ 'step' => 4 ], $template );
}

function dcAssemblyDoneDashboard(): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 4,
				'compare' => '>'
			]
		],
		'orderby'        => [
			'dc_delivery'    => 'ASC',
			'dc_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	$title = 'DC Montage abgeschlossen';

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'dc_project_manager' ] ) !== true ) {
		$args['meta_query'][] = [
			'key'     => 'dc_technician',
			'value'   => $userID,
			'compare' => 'IN'
		];
	}

	return ordersDashoboard( [
		'dc_technician',
	], $title, $args, [ 'cssClass' => 'dcdone' ] );
}

function acSchedulingDashboard(): bool {
	$args  = [
		'meta_query' => [
			[
				'key'   => 'step',
				'value' => 5,
			],
			'dc_appointment' => [
				'key'     => 'dc_appointment',
				'type'    => 'CHAR',
				'compare' => 'EXISTS',
			],
		],

		'orderby' => [
			'dc_appointment' => 'ASC'
		],

		'posts_per_page' => - 1,

	];
	$title = 'IN ELEKTRO TERMINIERUNG';

	return ordersDashoboard( 
		[ 'administrator', 
// 		 'director', 
		 'disposition' 
		], $title, $args, [ 'step' => 5 ] );
}

function acAssemblyDashboard( $title = 'IN ELEKTRO MONTAGE', $template = 'dashboards/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 6,
			],
			'ac_appointment' => [
				'key'     => 'ac_appointment',
				'type'    => 'CHAR',
				'compare' => 'EXISTS',
			],
		],
		'orderby'        => [
			'ac_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'ac_project_manager' ] ) !== true ) {
		$args['meta_query'][] = [
			'key'     => 'ac_technician',
			'value'   => $userID,
			'compare' => 'IN'
		];
	}

	return ordersDashoboard( [
		'administrator',
// 		'director',
// 		'ac_project_manager',
		'elt_monteur',
	], $title, $args, [ 'step' => 6 ], $template );
}

function defectsAssemblyDashboard( $title = 'WP MÄNGELBESEITIGUNG', $template = 'dashboards/section' ): bool {

	if ( checkRoles( 'ac_technician' ) ) {
		$args = [
			'meta_query'     => [

				[
					'key'     => 'step',
					'value'   => 6,
					'compare' => '>='
				],

				'relation' => 'AND', // Ändere dies auf 'OR', wenn du eine ODER-Verknüpfung wünschst
				[
					'relation' => 'OR', // Ändere dies auf 'OR', wenn du eine ODER-Verknüpfung wünschst
					[
						'relation' => 'AND', // Ändere dies auf 'OR', wenn du eine ODER-Verknüpfung wünschst
						[
							'key'     => 'ac-defects',
							'compare' => 'EXISTS', // Oder eine andere Vergleichsoperation
						],
						[
							'key'     => 'defect_appointment',
							'compare' => 'EXISTS', // Oder eine andere Vergleichsoperation
						],
					],
					[
						'relation' => 'AND', // Ändere dies auf 'OR', wenn du eine ODER-Verknüpfung wünschst
						[
							'key'     => 'op_defect_appointment',
							'compare' => 'EXISTS', // Oder eine andere Vergleichsoperation
						],
						[
							'key'     => 'operator-defects',
							'compare' => 'EXISTS', // Oder eine andere Vergleichsoperation
						],
					],

				]
			],
			'posts_per_page' => - 1,
		];

	} else {
		$args = [
			'meta_query'     => [
				[
					'key'     => 'step',
					'value'   => 6,
					'compare' => '>='
				],
				'ac-defects'         => [
					'key'     => 'ac-defects',
					'compare' => 'EXISTS',
				],
				'defect_appointment' => [
					'key'     => 'defect_appointment',
					'type'    => 'CHAR',
					'compare' => 'EXISTS',
				]
			],
			'posts_per_page' => - 1,
		];
	}


	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray  = (array) json_decode( $userGroup );
		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];
	} else {
		$userID = get_current_user_id();
	}

	if ( checkRoles( [ 'administrator', 'director', 'dc_project_manager' ] ) !== true ) {
		$args['meta_query'] = [
			[
				'relation' => 'OR', // Definiert die logische Verknüpfung
				[
					'key'     => 'op_defect_technician',
					'value'   => $userID,
					'compare' => 'IN'
				],
				[
					'key'     => 'defect_technician',
					'value'   => $userID,
					'compare' => 'IN'
				]
			]
		];

		$title = 'WP & ELT MÄNGELBESEITIGUNG';
	}

	return ordersDashoboard( [
		'administrator',
		'wp_monteur'
// 		'director',
// 		'ac_project_manager',
// 		'ac_technician',
	], $title, $args, [ 'cssClass' => 'defect' ], $template );
}


function opDefectsAssemblyDashboard( $title = 'ELT MÄNGELBESEITIGUNG', $template = 'dashboards/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 6,
				'compare' => '>'
			],
			'op_defect_appointment' => [
				'key'     => 'op_defect_appointment',
				'type'    => 'CHAR',
				'compare' => 'EXISTS',
			],
			'operator-defects'      => [
				'key'     => 'operator-defects',
				'compare' => 'EXISTS',
			],
		],
		'orderby'        => [
			'op_defect_appointment' => 'ASC',
		],
		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'wp_monteur',
	], $title, $args, [ 'cssClass' => 'op-defect' ], $template );
}

function finishedOrdersDashboard( $title = 'IN FERTIGMELDUNG', $template = 'dashboards/section', $filter = false, $filterValue = false, $compare = false ): bool {

	if ( $filter === 'qacall' ) {
		$compare2 = '>=';
	} else {
		$compare2 = '';
	}

	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 7,
				'compare' => $compare2
			],
		],
		'posts_per_page' => - 1,
	];

	if ( $filter && $filterValue && $compare ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'value'   => $filterValue,
				'compare' => $compare,
			]
		];
	} else if ( $filter ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'compare' => 'NOT EXISTS',
			]
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'registration'
	], $title, $args, [ 'step' => 8 ], $template );
}

function PROCUREMENTGOODSDELIVERY( $title = 'WARENBESCHAFUNG & LIEFERUNG', $template = 'dashboards/section', $filter = false, $filterValue = false, $compare = false ): bool {

	if ( $filter === 'qacall' ) {
		$compare2 = '>=';
	} else {
		$compare2 = '';
	}

	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 7,
				'compare' => $compare2
			],
		],
		'posts_per_page' => - 1,
	];

	if ( $filter && $filterValue && $compare ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'value'   => $filterValue,
				'compare' => $compare,
			]
		];
	} else if ( $filter ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'compare' => 'NOT EXISTS',
			]
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'registration'
	], $title, $args, [ 'step' => 7 ], $template );
}

function dispo( $title = 'DISPO', $template = 'dashboards/section', $filter = false, $filterValue = false, $compare = false ): bool {

	if ( $filter === 'qacall' ) {
		$compare2 = '>=';
	} else {
		$compare2 = '';
	}

	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 7,
				'compare' => $compare2
			],
		],
		'posts_per_page' => - 1,
	];

	if ( $filter && $filterValue && $compare ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'value'   => $filterValue,
				'compare' => $compare,
			]
		];
	} else if ( $filter ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'compare' => 'NOT EXISTS',
			]
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'registration'
	], $title, $args, [ 'step' => 7 ], $template );
}
function NACHTRAG( $title = 'NACHTRAG', $template = 'dashboards/section', $filter = false, $filterValue = false, $compare = false ): bool {

	if ( $filter === 'qacall' ) {
		$compare2 = '>=';
	} else {
		$compare2 = '';
	}

	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 7,
				'compare' => $compare2
			],
		],
		'posts_per_page' => - 1,
	];

	if ( $filter && $filterValue && $compare ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'value'   => $filterValue,
				'compare' => $compare,
			]
		];
	} else if ( $filter ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'compare' => 'NOT EXISTS',
			]
		];
	}

	return ordersDashoboard( [
		'administrator',
		'director',
		'registration'
	], $title, $args, [ 'step' => 8 ], $template );
}
function qualityDashboard2( $title = 'Qualitätssicherung', $template = 'dashboards/section', $filter = false, $filterValue = false, $compare = false ): bool {

	if ( $filter === 'qacall' ) {
		$compare2 = '>=';
	} else {
		$compare2 = '';
	}

	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 9,
				'compare' => $compare2
			],
		],
		'posts_per_page' => - 1,
	];

	if ( $filter && $filterValue && $compare ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'value'   => $filterValue,
				'compare' => $compare,
			]
		];
	} else if ( $filter ) {
		$args['meta_query'][] = [
			[
				'key'     => $filter,
				'compare' => 'NOT EXISTS',
			]
		];
	}

	return ordersDashoboard( [ 'qa_manager', 'director', 'administrator' ], $title, $args, [ 'step' => 8 ], $template );
}

function QualityDashboard( $title = 'IN FERTIGMELDUNG', $template = 'dashboards/section', $filter = false, $filterValue = false ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 7,
				'compare' => '>=',
			],
		],
		'posts_per_page' => - 1,
	];

	$args['meta_query'][] = [
		[
			'key'   => $filter,
			'value' => $filterValue,
		]
	];

	return ordersDashoboard( [ 'administrator', 'director', 'qa_manager' ], $title, $args, [ 'step' => 7 ], $template );
}

function firstBillingDashboard(): bool {
	$args  = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 4,
				'compare' => '>',
			],
			[
				'key'     => 'first-billing',
				'compare' => 'NOT EXISTS',
			],
		],
		'posts_per_page' => - 1,
	];
	$title = 'IN BUCHHALTUNG 80%';

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'qa_manager',
	], $title, $args, [ 'forceControllingView' => true, 'cssClass' => 'bh90 step-90' ] );
}

function secondBillingDashboard(): bool {
	$args  = [
		'meta_query'     => [
			[
				'key'     => 'step',
				'value'   => 6,
				'compare' => '>',
			],
			[
				'key'     => 'second-billing',
				'compare' => 'NOT EXISTS',
			],
		],
		'posts_per_page' => - 1,
	];
	$title = 'IN BUCHHALTUNG 20%';

	return ordersDashoboard( [
		'administrator',
// 		'director',
		'controlling',
	], $title, $args, [ 'forceControllingView' => true, 'cssClass' => 'bh10 step-10' ] );
}

function registeredDashboard( $title = 'Anmeldung abgeschlossen', $template = 'dashboards/section', $qty = 100, $onlyIncomplete = false, $filter = false ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => 'registration',
				'compare' => 'EXISTS',
			],
		],
		'posts_per_page' => $qty,
	];

	if ( $onlyIncomplete ) {
		$args['meta_query'][]            = [
			[
				'key'     => 'step',
				'value'   => 8,
				'compare' => '<',
			]
		];
		$args['orderby']['registration'] = 'ASC';
	}

	if ( $filter ) {
		$args['meta_query'] = [
			[
				'key'     => $filter,
				'compare' => 'EXISTS',
			]
		];
	}

	return ordersDashoboard( [ 'administrator', 'director', 'registration' ], $title, $args, [], $template );

}

add_action( 'wp_ajax_registrationCounter', 'registrationCounter' );
add_action( 'wp_ajax_registrationDoneCounter', 'registrationDoneCounter' );

function registrationCounter( $date ) {

	if ( $_POST['date'] ) {
		$date = $_POST['date'];
	}

	$cssID = 'registration';

	$args = [
		'meta_query'     => [
			[
				'key'     => 'registration',
				'value'   => '^' . $date,
				'compare' => 'REGEXP',
			],
		],
		'posts_per_page' => - 1,
	];

	$args['post_type']   = 'customer';
	$args['post_status'] = 'private';

	$registrations = get_posts( $args );
	view( 'global/counter', compact( [ 'registrations', 'cssID' ] ) );
}

function registrationDoneCounter( $date ) {

	if ( $postDate = $_POST['date'] ) {
		$date = $postDate;
	}

	$cssID = 'registration-done';

	$args = [
		'meta_query'     => [
			[
				'key'     => 'registrationDone',
				'value'   => '^' . $date,
				'compare' => 'REGEXP',
			],
		],
		'posts_per_page' => - 1,
	];

	$args['post_type']   = 'customer';
	$args['post_status'] = 'private';

	$registrations = get_posts( $args );
	view( 'global/counter-registration-done', compact( [ 'registrations', 'cssID' ] ) );
}

function openRegistrationCounter(): int {
	$args                = [
		'meta_query'     => [
			[
				'key'     => 'registration',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'step',
				'value'   => 2,
				'compare' => '>',
			],
		],
		'posts_per_page' => - 1,
	];
	$args['post_type']   = 'customer';
	$args['post_status'] = 'private';

	return count( get_posts( $args ) );
}

function openRegistrationDoneCounter(): int {
	$args                = [
		'meta_query'     => [
			[
				'key'   => 'step',
				'value' => 7,
			],
		],
		'posts_per_page' => - 1,
	];
	$args['post_type']   = 'customer';
	$args['post_status'] = 'private';

	return count( get_posts( $args ) );
}


function ordersOverviewDashboard( $title = 'Auftragsliste', $template = 'orders-dashboard/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'dc_appointment' => [
					'key'     => 'dc_appointment',
					'type'    => 'CHAR',
					'compare' => 'EXISTS',
				]
			]
		],
		'orderby'        => [
			'dc_appointment' => 'ASC'
		],
		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [ 'administrator', 'director', 'registration' ], $title, $args, [], $template );

}

function SevdeskOverviewDashboard( $title = 'Auftragsliste', $template = 'orders-dashboard/section' ): bool {
	$args = [
		'meta_query' => [
			'relation' => 'AND', // Relation zwischen den Meta-Abfragen (AND bedeutet, dass beide erfüllt sein müssen)
			[
				'key'     => 'sevdesk_reminder_pdf',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'sevdesk_invoice_pdf',
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'step',
				'compare' => '>',
				'value'   => 3,
				'type'    => 'NUMERIC', // Falls 'step' ein numerisches Feld ist
			],
			[
				'key'     => 'order_start_date',
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'sevdesk_paid_due_amount',
				'compare' => 'NOT EXISTS'
			],
			[
				'key'     => 'sevdesk_ready_to_remind',
				'compare' => 'EXISTS'
			]
		],

		'orderby' => [
			'sevdesk_paid_amount_percentage' => 'DESC'
		],

		'meta_key'  => 'sevdesk_paid_amount_percentage',
		'meta_type' => 'DECIMAL',

		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [
		'administrator',
		'controlling',
		'director'
	], $title, $args, [ 'sevdesk' => true ], $template );

}

function sevdeskRemindedDashboard( $title = 'Auftragsliste', $template = 'orders-dashboard/section' ): bool {
	$args = [

		'meta_query' => [
			'relation' => 'AND', // Relation zwischen den Meta-Abfragen (AND bedeutet, dass beide erfüllt sein müssen)
			[
				'key'     => 'sevdesk_reminder_pdf',
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'sevdesk_reminder_counter',
				'value'   => 4,
				'compare' => '<',
			],
			[
				'key'     => 'sevdesk_paid_due_amount',
				'compare' => 'NOT EXISTS'
			],
			[
				'key'     => 'step',
				'compare' => '>',
				'value'   => 3,
				'type'    => 'NUMERIC', // Falls 'step' ein numerisches Feld ist
			]
		],

		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [
		'administrator',
		'controlling',
		'director'
	], $title, $args, [ 'sevdesk' => true ], $template );

}

function sevdeskInkassoDashboard( $title = 'Auftragsliste', $template = 'orders-dashboard/section' ): bool {
	$args = [
		'p'          => 24755, //TODO REMOVE THIS
		'meta_query' => [
			'relation' => 'AND', // Relation zwischen den Meta-Abfragen (AND bedeutet, dass beide erfüllt sein müssen)
			[
				'key'     => 'sevdesk_reminder_counter',
				'value'   => 4,
				'compare' => '=',
			],
			[
				'key'     => 'sevdesk_paid_due_amount',
				'compare' => 'NOT EXISTS'
			],
			[
				'key'     => 'step',
				'compare' => '>',
				'value'   => 3,
				'type'    => 'NUMERIC', // Falls 'step' ein numerisches Feld ist
			]
		],

		'posts_per_page' => - 1,
	];

	return ordersDashoboard( [
		'administrator',
		'controlling',
		'director'
	], $title, $args, [ 'sevdesk' => true ], $template );

}

function defectsDashboardList( $title = 'Anmeldung abgeschlossen', $filter = false, $template = 'defects-dashboard/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => $filter,
				'compare' => 'EXISTS',
			]
		],
		'posts_per_page' => - 1
	];

	$args['orderby'][ $filter ] = 'ASC';

	return ordersDashoboard( [
		'administrator',
		'director',
		'ac_project_manager',
		'dc_project_manager'
	], $title, $args, [ 'filter' => $filter ], $template );
}

function storageDeliveryList( $title = 'Anmeldung abgeschlossen', $filter = false, $template = 'defects-dashboard/section' ): bool {
	$args = [
		'meta_query'     => [
			[
				'key'     => $filter,
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'ac_appointment',
				'compare' => 'NOT EXISTS'
			]
		],
		'posts_per_page' => - 1
	];

	$args['orderby'][ $filter ] = 'ASC';

	return ordersDashoboard( [
		'administrator',
		'director',
		'ac_project_manager',
		'dc_project_manager'
	], $title, $args, [], $template );
}

function registrationDoneDashboard( $title = 'Fertigmeldung abgeschlossen', $template = 'dashboards/section', $qty = 10, $step = 8, $orderBy = false ): bool {

	$args['meta_query'][] = [
		[
			'key'   => 'step',
			'value' => 8,
		],
		'registrationDone' => [
			'key' => 'registrationDone',
		]
	];

	$args['orderby']['registrationDone'] = 'ASC';

	return ordersDashoboard( [
		'administrator',
		'director',
		'registration',
		'dc_project_manager',
		'ac_project_manager',
	], $title, $args, [ 'step' => $step ], $template );
}

function openLeadsDashboard(): bool {
	$args = [
		'posts_per_page' => 100,
	];

	if ( checkRoles( 'seller' ) ) {
		$args = [
			'author' => get_current_user_id(),
		];
	}

	$title = 'Hochgeladene Leads';

	return leadsDashboard( [
		'administrator',
		'director',
		'seller'
	], $title, $args, [ 'step' => 'leads' ] );
}

add_action( 'load-edit.php', 'wpse14230_load_edit' );
function wpse14230_load_edit() {
	add_action( 'request', 'wpse14230_request' );
}

function wpse14230_request( $query_vars ) {
	if ( ! current_user_can( $GLOBALS['post_type_object']->cap->edit_others_posts ) ) {
		$query_vars['author'] = get_current_user_id();
	}

	return $query_vars;
}

function custom_login_redirect( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'seller', $user->roles ) || in_array( 'director-ip', $user->roles ) ) {
			$redirect_to = '/wp-admin/edit.php?post_type=customer';
		} else {
			$redirect_to = '/wp-admin/edit.php?post_type=customer&page=dashboard';
		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );


/// add dashboards
add_action( 'admin_menu', 'addSpreadsheetPage' );
function addSpreadsheetPage() {
	if ( ! checkRoles( [
		'administrator',
		'director',
		'project_manager',
		'dc_project_manager',
		'ac_project_manager',
	] ) ) {
		return;
	}
	add_submenu_page( '', 'Spreadsheet', 'Spreadsheet', 'spread_sheet_orders', 'orders_spreadsheet', static function () {
	}, 0 );
}

add_filter( 'init',

	/**
	 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
	 */

	function () {
		$page = get_request_parameter( 'page' );
		if ( $page !== 'orders_spreadsheet' ) {
			return;
		}
		$orderId = get_request_parameter( 'order-id', null );

		generateDeliverySpreadsheet( $orderId );
	} );

/**
 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
 */
function generateDeliverySpreadsheet( $orderIds ) {
	$spreadsheet = new Spreadsheet();
	$sheet       = $spreadsheet->getActiveSheet();

	$args   = [
		'post__in'    => is_array( $orderIds ) ? $orderIds : [ $orderIds ],
		'post_status' => 'private',
		'post_type'   => 'customer',
		'meta_query'  => [
			[
				'key'   => 'step',
				'value' => 4,
			],
		],
	];
	$orders = get_posts( $args );
	if ( $orders === null || count( $orders ) === 0 ) {
		return;
	}

	$headers    = [
		'#',
		'Name',
		'Vorname',
		'Anschrifft',
		'Telefonnummer',
		'Mobil',
		'E-Mail',
		'Speicher',
		'Module',
		'Anzahl der Module',
		'Zusatzvereinbarungen',
		'DC Montage Liefertermin',
		'Gesamtnetto Preis',
	];
	$lastColumn = chr( substr( "000" . ( count( $headers ) + 65 ), - 3 ) );
	$sheet->fromArray( $headers, null, 'A1' );
	$sheet->getStyle( 'A1:' . $lastColumn . '1' )->applyFromArray( [
		'font'        => [
			'name'          => 'Arial',
			'bold'          => true,
			'size'          => 14,
			'italic'        => false,
			'strikethrough' => false,
			'color'         => [
				'rgb' => '808080',
			],
		],
		'borders'     => [
			'bottom' => [
				'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
				'color'       => [
					'rgb' => '808080',
				],
			],
			'top'    => [
				'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
				'color'       => [
					'rgb' => '808080',
				],
			],
		],
		'alignment'   => [
			'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			'vertical'   => PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			'wrapText'   => false,
		],
		'quotePrefix' => true,
	] );
	$dateFormat = get_option( 'date_format' );

	$count = 0;
	foreach ( $orders as $order ) {
		$count ++;

		$address = get_post_meta( $order->ID, 'street', true ) . ' ' . get_post_meta( $order->ID, 'houseNumber', true ) . PHP_EOL . get_post_meta( $order->ID, 'zip', true ) . ', ' . get_post_meta( $order->ID, 'city', true );

		$totalExcl           = number_format( (int) get_post_meta( $order->ID, 'totalExcl', true ), 2, ',', '.' ) . ' €';
		$collectedAgreements = [];
		$additionals         = get_post_meta( $order->ID, 'additionals', true );
		if ( ! empty( $additionals ) ) {
			$collectedAgreements[] = $additionals;
		}
		$orderAgreements = get_post_meta( $order->ID, 'agreements', true );
		if ( ! is_array( $orderAgreements ) ) {
			$orderAgreements = [];
		}

		foreach ( $orderAgreements as $iValue ) {
			$collectedAgreements[] = get_post( $iValue )->post_title;
		}

		$args       = [ 'post_type' => 'agreement', 'posts_per_page' => - 1, 'post_status' => 'any' ];
		$agreements = get_posts( $args );

		foreach ( $agreements as $agreement ) {
			if ( get_post_meta( $agreement->ID, 'qty', true ) && $qtyFieldValue = get_post_meta( $order->ID, 'qty-' . $agreement->ID, true ) ) {
				$collectedAgreements[] = "$qtyFieldValue x " . get_post_meta( $agreement->ID, 'beschreibung', true );
			}
		}

		$content = [
			$count,
			get_post_meta( $order->ID, 'lastName', true ),
			get_post_meta( $order->ID, 'firstName', true ),
			$address,
			get_post_meta( $order->ID, 'phoneNumber', true ),
			get_post_meta( $order->ID, 'mobileNumber', true ),
			get_post_meta( $order->ID, 'emailAddress', true ),
			get_post_meta( get_post_meta( $order->ID, 'storage', true ), 'name', true ),
			get_post_meta( get_post_meta( $order->ID, 'module', true ), 'pvmoduleid', true ),
			get_post_meta( $order->ID, 'moduleqty', true ),
			implode( PHP_EOL, $collectedAgreements ),
			date_i18n( $dateFormat, strtotime( get_post_meta( $order->ID, 'dc_delivery', true ) ) ),
			$totalExcl,
		];


		$cellName = 'A' . ( $count + 1 );

		$sheet->fromArray( $content, null, $cellName );
	}

	//	$range = 'F3:F' . ( $count + 2 );
	//	$sheet->getStyle( $range )->getNumberFormat()->setFormatCode( PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER );

	foreach ( range( 'A', $lastColumn ) as $columnID ) {
		$sheet->getColumnDimension( $columnID )->setAutoSize( true );
	}

	$writer = new Xlsx( $spreadsheet );

	// We'll be outputting an excel file
	header( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
	header( 'Content-Transfer-Encoding: binary' );
	header( 'Cache-Control: must-revalidate' );
	header( 'Pragma: public' );

	header( 'Content-Disposition: attachment; filename="' . urlencode( 'Order_' . get_the_ID() . '_' . $order->ID ) . '.xlsx"' );

	// Write file to the browser
	$writer->save( 'php://output' );

	die();
}


//add_filter( 'views_edit-customer', 'orders_filter_admin_nav' );
/**
 * Filters admin navigation menus to show horizontal link bar
 *
 * @return array
 * @global array $submenu
 */
function orders_filter_admin_nav(): array {
	global $submenu;
	$submenus = [];
	$menuName = 'edit.php?post_type=customer';
	if ( ! isset( $submenu[ $menuName ] ) ) {
		return $submenu;
	}
	$thisMenu = $submenu[ $menuName ];

	unset( $thisMenu[0] );
	//
	//	$privateMenuItem = array(
	//		'<i class="pxt pxt-lock" title="' . __( 'Private', PXT_COURSES_SLUG_NAME ) . '" alt="' . __( 'Private',
	//			PXT_COURSES_SLUG_NAME ) . '"></i>',
	//		'edit_posts',
	//		'edit.php?post_status=private&post_type=' . PXT_COURSES_POST_TYPE,
	//	);
	$trashMenuItem = array(
		'<i class="pxt pxt-trash" title="' . 'Trash' . '" alt="' . 'Trash' . '"></i>',
		'edit_posts',
		'edit.php?post_status=trash&post_type=customer',
	);

	//	array_unshift( $thisMenu, $trashMenuItem );
	$post_status = get_request_parameter( 'post_status', 'all' );

	if ( $post_status === "trash" ) {
		$current = [ 0 => false, 1 => false, 2 => true ];
	} elseif ( $post_status === "private" ) {
		$current = [ 0 => false, 1 => true, 2 => false ];
	} else {
		$current = [ 0 => true, 1 => false, 2 => false ];
	}
	$count = 0;

	$ingonred_slugs = [
		'post-new.php?post_type=customer',
	];

	foreach ( $thisMenu as $item ) {
		$slug = $item[2];

		if ( in_array( $slug, $ingonred_slugs, true ) ) {
			continue;
		}

		$isCurrent            = ( $count < 3 ) ? $current[ $count ] : false;
		$isExternalPage       = strpos( $item[2], 'http' ) !== false;
		$isNotSubPage         = $isExternalPage || strpos( $item[2], '.php' ) !== false;
		$url                  = $isNotSubPage ? $slug : get_admin_url( null, 'admin.php?page=' . $slug );
		$target               = $isExternalPage ? '_blank' : '';
		$submenus[ $item[0] ] = '<a href="' . $url . '" target="' . $target . '" class="button action' . ( $isCurrent ? ' current' : '' ) . '">' . $item[0] . '</a>';
		$count ++;
	}

	$orderby_arr = [ 'title', 'date' ];
	$order       = ( isset( $_GET['order'] ) && ( strtoupper( $_GET['order'] ) === 'ASC' || strtoupper( $_GET['order'] ) === 'DESC' ) ) ? strtoupper( $_GET['order'] ) : 'DESC';
	$orderby     = ( isset( $_GET['orderby'] ) && ( in_array( strtolower( $_GET['orderby'] ), $orderby_arr ) ) ) ? strtolower( $_GET['orderby'] ) : 'term_id';

	$archived = isset( $_GET['archived'] ) ? (int) $_GET['archived'] : 0;

	//	$submenus[] = '<a class="button action" href="edit.php?&post_type=customer&orderby=' . $orderby . '&order=' . $order . '&archived=' . ! $archived . '">' . ( $archived ? 'Acrhiviert ausblenden' : 'Acrhiviert zeigen' ) . '</a>';


	return $submenus;
}

add_action( 'load-edit.php', static function () {
	add_filter( 'parse_query', 'restrict_manage_orders' );
} );
function restrict_manage_orders( $query ) {
	$screen = get_current_screen();
	if ( $screen !== null && $screen->id !== 'edit-customer' ) {
		return;
	}
	if ( ! isset( $query->query['post_type'] ) || $query->query['post_type'] !== 'customer' ) {
		return;
	}

	$priviligedUser = checkRoles( [
		'administrator',
		'director',
		'project_manager',
		'dc_project_manager',
		'ac_project_manager',
		'registration',
		'controlling',
		'qa_manager',
	] );
	$dcTechnician   = checkRoles( 'dc_technician' );
	$acTechnician   = checkRoles( 'ac_technician' );
	$seller         = checkRoles( 'seller' );
	$pvScout        = checkRoles( 'pv_scout' );

	$unpriviligedUser = $dcTechnician || $acTechnician || $seller || $pvScout;

	if ( $priviligedUser === true || $unpriviligedUser === false ) {
		return;
	}

	$userGroup = get_option( 'usergroups' );

	if ( array_key_exists( get_current_user_id(), (array) json_decode( $userGroup ) ) ) {
		$testArray = (array) json_decode( $userGroup );

		if ( $seller ) {
			$testArray[ get_current_user_id() ][] = get_current_user_id();
		}

		$userIDList = implode( ',', $testArray[ get_current_user_id() ] );
		$userID     = [ $userIDList ][0];

	} else {
		$userID = get_current_user_id();
	}

	if ( $dcTechnician ) {
		$query->set( 'meta_query', [
			[
				'key'     => 'dc_technician',
				'value'   => $userID,
				'compare' => 'IN'
			],
		] );

		return;
	}

	if ( $acTechnician ) {
		$query->set( 'meta_query', [
			[
				'key'   => 'ac_technician',
				'value' => get_current_user_id(),
			],
		] );

		return;
	}

	if ( $pvScout ) {
		$query->set( 'meta_query', [
			[
				'key'     => 'registration',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'pvscout_flag',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'step',
				'value'   => 1,
				'compare' => '>',
			],
		] );

		return;
	}

	if ( $seller ) {
		$query->set( 'author', $userID );
	} else {
		$query->set( 'author', get_current_user_id() );
	}
}

function no_wordpress_errors() {
	return 'Bitte überprüfe deine Eingabe';
}

add_filter( 'login_errors', 'no_wordpress_errors' );

function custom_wp_check_filetype_and_ext( $filetype_and_ext, $file, $filename ) {
	if ( ! $filetype_and_ext['ext'] || ! $filetype_and_ext['type'] || ! $filetype_and_ext['proper_filename'] ) {
		$extension   = pathinfo( $filename )['extension'];
		$mime_type   = mime_content_type( $file );
		$allowed_ext = array(
			'eps' => array( 'application/postscript', 'image/x-eps' ),
			'ai'  => array( 'application/postscript' ),
		);
		if ( $allowed_ext[ $extension ] ) {
			if ( in_array( $mime_type, $allowed_ext[ $extension ] ) ) {
				$filetype_and_ext['ext']             = $extension;
				$filetype_and_ext['type']            = $mime_type;
				$filetype_and_ext['proper_filename'] = $filename;
			}
		}
	}

	return $filetype_and_ext;
}

/** **/
add_filter( 'wp_check_filetype_and_ext', 'custom_wp_check_filetype_and_ext', 5, 5 );


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4 );

function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}

add_action( 'admin_head', 'fix_svg' );


function add_ajax_scripts() {
	wp_enqueue_script( 'ajaxcalls', get_template_directory_uri() . '/js/ajax-calls.js', array(), '1.0.0', true );

	wp_localize_script( 'ajaxcalls', 'ajax_object', array(
		'ajaxurl'   => admin_url( 'admin-ajax.php' ),
		'ajaxnonce' => wp_create_nonce( 'ajax_post_validation' )
	) );
}

add_action( 'wp_enqueue_scripts', 'add_ajax_scripts' );

function custom_update_post() {
	$post_id        = $_POST['post_id'];
	$checkbox_value = $_POST['checkbox_value'];
	$postMeta       = $_POST['post_meta'];

	if ( $checkbox_value == 0 ) {
		if ( $postMeta ) {
			update_post_meta( $post_id, $postMeta, $checkbox_value );
		} else {
			update_post_meta( $post_id, 'billed', $checkbox_value );
		}
	} else {
		if ( $postMeta ) {
			update_post_meta( $post_id, $postMeta, $checkbox_value );
		} else {
			update_post_meta( $post_id, 'billed', $checkbox_value );
		}
	}
	wp_die();
}

add_action( 'wp_ajax_custom_update_post', 'custom_update_post' );


add_action( 'wp_ajax_nopriv_set_seller', 'set_seller' );
add_action( 'wp_ajax_set_seller', 'set_seller' );

function set_seller() {
	$author_id = $_POST['author_id'];
	$post_id   = $_POST['post_id'];
	if ( isset( $author_id ) && $author_id !== '' ) {
		$arg = array(
			'ID'          => $post_id,
			'post_author' => $author_id,
			'post_status' => 'private'
		);

		wp_update_post( $arg );
		update_post_meta( $post_id, 'lead_status', 'assigned' );

		$current_time = current_time( 'timestamp' );

		$lead = get_post( $post_id );

		$custom_timestamp = get_user_meta( $author_id, 'lead_notification', true ) ?: 0;
		$time_diff        = $current_time - $custom_timestamp;

		if ( $time_diff > 86400 ) {
			notify( $lead, 'set-seller', 'lead' );
			update_user_meta( $author_id, 'lead_notification', $current_time );
		}
	}
}

use JeroenDesloovere\VCard\VCardParser;

// VCF-Parser initialisieren und Daten analysieren
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/vcard-master/src/VCardParser.php';

add_action( 'wp_ajax_nopriv_upload_vcf', 'upload_and_parse_vcf' );
add_action( 'wp_ajax_upload_vcf', 'upload_and_parse_vcf' );

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Parser.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Contracts/CharsetManager.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Contracts/Middleware.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/MiddlewareStack.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Attachment.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Exception.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/MimePart.php';
require_once __DIR__ . '/vendor/php-mime-mail-parser-8.0.0/src/Charset.php';

function upload_and_parse_vcf() {
	$files       = $_FILES['upload_vcf'];
	$upload_path = wp_upload_dir()['path'] . '/leads/';
	$upload_url  = wp_upload_dir()['url'] . '/leads/';

	$success_msg = '';
	$error_msg   = '';

	for ( $i = 0; $i < count( $files['name'] ); $i ++ ) {
		$originalFilename = $files['name'][ $i ];
		$filename         = sanitize_file_name( $files['name'][ $i ] );
		$filetmp          = $files['tmp_name'][ $i ];
		$filetype         = wp_check_filetype( $filename );
		if ( move_uploaded_file( $filetmp, $upload_path . $filename ) ) {
			// Überprüfen des Dateityps
			if ( $filetype['ext'] === 'vcf' ) {
				$parser = new VCardParser( $filetmp );
				$vcards = $parser->parseFromFile( $upload_path . $filename );

				// Neue Beiträge im Custom Post Type "leads" erstellen
				foreach ( $vcards as $vcard ) {
					$postarr = array(
						'post_title'  => $vcard->fullname,
						'post_type'   => 'lead',
						'post_status' => 'private'
					);
					$post_id = wp_insert_post( $postarr );

					// Benutzerdefinierte Felder mit den geparsten Daten füllen
					update_post_meta( $post_id, 'lead_name', $vcard->fullname );
					update_post_meta( $post_id, 'lead_firstName', $vcard->firstname );
					update_post_meta( $post_id, 'lead_lastName', $vcard->lastname );
					update_post_meta( $post_id, 'lead_email', $vcard->email );
					update_post_meta( $post_id, 'lead_phone', $vcard->phone );
					update_post_meta( $post_id, 'lead_address', $vcard->address );
					update_post_meta( $post_id, 'lead_organization', $vcard->organization );
					update_post_meta( $post_id, 'lead_note', $vcard->note );
				}

				// VCF-Datei löschen
				unlink( $upload_path . $filename );
				$success_msg .= sprintf( __( 'Die Datei <strong>%s</strong> wurde erfolgreich hochgeladen und verarbeitet.', 'textdomain' ), $filename ) . '<br>';

			} elseif ( $filetype['ext'] === 'eml' ) {
				$emlPath = $upload_path . $filename;
				$parser  = new PhpMimeMailParser\Parser();

				$parser->setPath( $emlPath );

				// Create new lead post
				$postarr = array(
					'post_title'  => $filename,
					'post_type'   => 'lead',
					'post_status' => 'private'
				);
				$post_id = wp_insert_post( $postarr );

				// Get email body and save it as post meta
				$body = '';
				if ( $parser->getMessageBody( 'html' ) ) {
					$body = $parser->getMessageBody( 'html' );
				} else {
					$body = $parser->getMessageBody();
				}

				var_dump( $body );
				update_post_meta( $post_id, 'lead_eml_body', $body );

				// Get email attachments and save them to the server
				$attachments     = $parser->getAttachments( false );
				$attachment_urls = array();
				foreach ( $attachments as $attachment ) {
					$attachment_filename = $attachment->getFilename();
					$attachment_path     = $upload_path;
					$attachment->save( $attachment_path );
					$attachment_urls[] = [
						'url'      => $upload_url . $attachment_filename,
						'filename' => $attachment_filename,
					];
				}
				update_post_meta( $post_id, 'lead_eml_attachments', $attachment_urls );

				// Save EML file URL as post meta
				$file_url = $upload_url . $filename;
				update_post_meta( $post_id, 'lead_eml', $file_url );

				$success_msg .= sprintf( __( 'Die Datei <strong>%s</strong> wurde erfolgreich hochgeladen.', 'textdomain' ), $filename ) . '<br>';
			} else {
				unlink( $upload_path . $filename );
				$error_msg .= sprintf( __( 'Die Datei %s hat ein ungültiges Dateiformat.', 'textdomain' ), $filename ) . '<br>';
			}

		} else {
			$error_msg .= sprintf( __( 'Es gab einen Fehler beim Hochladen der Datei %s', 'textdomain' ), $filename ) . '<br>';

		}
	}

	// Ausgabe der Erfolgs- und Fehlermeldungen
	if ( $success_msg ) {
		die( '<div class="success">' . $success_msg . '</div>' );
	}

	if ( $error_msg ) {
		die( '<div class="error">' . $error_msg . '</div>' );
	}
}


// Haken zur Verarbeitung des Formulars zum Hochladen von Dateien hinzufügen
add_action( 'admin_post_upload_vcf', 'upload_and_parse_vcf' );

// Funktion zum Erstellen des Formulars zum Hochladen von Dateien hinzufügen
function vcf_upload_form() {
	// Formular-HTML
	$output = '<form id="upload-form" method="post" enctype="multipart/form-data" class="vcf-form">';
	$output .= '<label class="label--upload" for="vcffiles">VCF Dateien hinzufügen</label>';
	$output .= '<input type="file" name="upload_vcf[]" multiple id="vcffiles">';
	$output .= '<input type="hidden" name="action" value="upload_vcf">';
	$output .= '<button type="submit" class="button-primary">Hochladen</button>';
	$output .= '</form>';
	$output .= '<div id="response"></div>';

	echo $output;
}

// Shortcode zum Anzeigen des Formulars zum Hochladen von Dateien hinzufügen
add_shortcode( 'vcf_upload', 'vcf_upload_form' );

/**
 * Enable vCard Upload
 *
 */
function be_enable_vcard_upload( $mime_types ) {
	$mime_types['vcf'] = 'text/vcard';

	return $mime_types;
}

add_filter( 'upload_mimes', 'be_enable_vcard_upload' );

/**
 * Enable EML Upload
 *
 */
function be_enable_eml_upload( $mime_types ) {
	$mime_types['eml'] = 'message/rfc822';
	$mime_types['msg'] = 'application/vnd.ms-outlook';

	return $mime_types;
}

add_filter( 'upload_mimes', 'be_enable_eml_upload' );


function restrict_uploads_for_logged_in_users() {
	if ( is_user_logged_in() ) {
		return;
	}

	// Wenn ein nicht eingeloggter Benutzer versucht, auf eine Datei im Verzeichnis "uploads/order-attachments" zuzugreifen
	if ( strpos( $_SERVER['REQUEST_URI'], '/wp-content/uploads/orders-attachments/' ) === 0 ) {
		header( 'HTTP/1.0 403 Forbidden' );
		die( 'Zugriff verweigert.' );
	}
}

add_action( 'init', 'restrict_uploads_for_logged_in_users' );

// Hook, um eine zusätzliche Spalte in der Übersicht der Custom Post Types hinzuzufügen
add_filter('manage_edit-storage_columns', 'custom_post_type_columns');
function custom_post_type_columns($columns) {
	// Teilen Sie das $columns-Array in zwei Teile und fügen Sie die 'post_id'-Spalte zwischen ihnen ein
	$first_part = array_slice($columns, 0, 2, true);
	$second_part = array_slice($columns, 2, null, true);
	$new_columns = $first_part + array('post_id' => 'ID') + $second_part;

	return $new_columns;
}

// Hook, um den Wert für die neue Spalte in der Übersicht anzuzeigen
add_action('manage_storage_posts_custom_column', 'custom_post_type_column_values', 10, 2);
function custom_post_type_column_values($column, $post_id) {
	if ($column === 'post_id') {
		echo '<strong>' . $post_id . '</strong>';
	}
}


add_filter('manage_edit-agreement_columns', 'custom_post_type_columns');
add_filter('manage_edit-module_columns', 'custom_post_type_columns');
add_action('manage_module_posts_custom_column', 'custom_post_type_column_values', 10, 2);
add_action('manage_agreement_posts_custom_column', 'custom_post_type_column_values', 10, 2);



/////////// CSV Upload
///
///

if(checkRoles('administrator')) {
	require_once 'plugins/marge.php';
}

function enqueue_jquery() {
    // Enqueue jQuery from the WordPress core
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

//custom login
function custom_login() {
     if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];
		 
		if (empty($username)) {
			wp_send_json_error(array('message' => 'Please enter your username'));
		}
		 
        $user = wp_signon(array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => isset($_POST['rememberme']),
        ));

        if (is_wp_error($user)) {
            // Login failed
            wp_send_json_error(array(
                'message' => 'Invalid username or password. Please try again.',
            ));
        } else {
            // Login successful
            wp_send_json_success(array(
                'redirect' => home_url('/wp-admin/admin.php?page=dashboard'), // Replace with your desired redirect URL
            ));
        }
    }else {
        wp_send_json_error(array('message' => 'Both username and password are required'));
    }
}

add_action('wp_ajax_custom_login', 'custom_login');
add_action('wp_ajax_nopriv_custom_login', 'custom_login');