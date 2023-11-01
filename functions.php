<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

require_once get_template_directory() . '/fadeblock-widget.php';
// require_once get_template_directory() . '/Custom_Image_Text_Widget.php';
require_once get_template_directory() . '/ul_li_list-widget.php';


if ( ! function_exists( 'hsuhk_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function hsuhk_setup() {
		
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'hsuhk' ),
				'footer'  => esc_html__( 'Secondary menu', 'hsuhk' ),
			)
		);		
	}
}

function quickchic_widgets_init() {
	register_sidebar(array(
		'name' => "About Sidebar",
		'id' => 'about-sidebar',
	));
	register_sidebar(array(
		'name' => "Teaching & Learning Sidebar",
		'id' => 'teaching-learning-sidebar',
	));
	register_sidebar(array(
		'name' => "Research Sidebar",
		'id' => 'research-sidebar',
	));
	register_sidebar(array(
		'name' => "News & Events Sidebar",
		'id' => 'news-events-sidebar',
	));
	register_sidebar(array(
		'name' => "Admission Sidebar",
		'id' => 'admission-sidebar',
	));
	register_sidebar(array(
		'name' => "MSc-GSCM Sidebar",
		'id' => 'msc-gscm-sidebar',
	));
	register_sidebar(array(
		'name' => "BBA-SCM Sidebar",
		'id' => 'bba-scm-sidebar',
	));
	register_sidebar(array(
		'name' => "BMSIM Sidebar",
		'id' => 'bmsim-sidebar',
	));
	register_sidebar(array(
		'name' => "BMSIM Cover Menu",
		'id' => 'bmsim-cover-menu',
	));
}
add_action( 'init', 'quickchic_widgets_init' );


add_action( 'after_setup_theme', 'hsuhk_setup' );




/**
 */
function hsuhk_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}


	// Print styles.
	wp_enqueue_style( 'hsuhk-bootstrap-style', get_template_directory_uri() . '/static/bootstrap/css/bootstrap.min.css', array(), wp_get_theme()->get( 'Version' ), 'boostrap' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}

add_action( 'wp_enqueue_scripts', 'hsuhk_scripts' );

function redirect_to_language_url() {
    // Check if a language parameter is present in the URL
    if ( isset( $_GET['lang'] ) ) {
        $language = sanitize_text_field( $_GET['lang'] );
        
        // Modify the URL based on the selected language
        $current_url = home_url( add_query_arg( null, null ) );
        $redirect_url = str_replace( home_url(), home_url( $language ), $current_url );
        
        // Redirect the user to the modified URL
        wp_redirect( $redirect_url, 301 );
        exit;
    }
}
add_action( 'template_redirect', 'redirect_to_language_url' );


function add_categories_to_pages() {
    register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'add_categories_to_pages');

if ( ! is_admin() ) {
    add_action( 'pre_get_posts', 'category_and_tag_archives' );

}

function category_and_tag_archives( $wp_query ) {

 $my_post_array = array('post','page','faculty_staff');

 if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
    $wp_query->set( 'post_type', $my_post_array );

 if ( $wp_query->get( 'tag' ) )
    $wp_query->set( 'post_type', $my_post_array );
}


// Faculty Staff Post Type

function faculty_post_type() {
	register_post_type('faculty_staff',
		array(
			'rewrite' => array('slug' => 'faculty_staff'),
			'labels' => array(
				'name' => 'Faculty Staffs',
				'singular_name' => 'Faculty Staff',
				'add_new_item' => 'Add New Staff',
				'edit_item' => 'Edit Staff'
			),
			// 'menu-icon' => 'dashicons-buddicons-buddypress-logo',
			'public' => true,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array(
				'title', 'thumbnail', 'editor' //'excerpt', 'editor','comments'
			),
			'taxonomies'    => array( 'category' ), // Add this line
			'show_ui' => true, // Show the editing interface
			'show_in_menu' => true, // Show in the admin menu
			'capability_type' => 'post', // Required for editing capability
			'multilingual' => true, // Enable multilingual support
		)
	);
}

add_action('init', 'faculty_post_type');


function register_hsuhk_widgets() {
	register_widget( 'FadeBlock_Widget' );

	register_widget('UlLiWidget');
}
// Register Foo_Widget widget
add_action( 'widgets_init', 'register_hsuhk_widgets' );


// function enqueue_script_for_widget_display( $instance, $widget, $args ) {
//     if ( $widget instanceof FadeBlock_Widget ) {
//         //wp_enqueue_script( 'your-script-handle' );
//     }
// }
// add_filter( 'widget_display_callback', 'enqueue_script_for_widget_display', 10, 3 );

function enqueue_editor_scripts() {
    wp_enqueue_editor();
	wp_enqueue_script( 'wp-editor' );
    wp_enqueue_script( 'wp-tinymce' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_editor_scripts' );

// Custom Shortcode

// [slidestart]
function slidestart_func( $atts ) {
	return '<div id="certify" class="mt-5"><div class="swiper-container"><div class="swiper-wrapper">';
}
add_shortcode( 'slidestart', 'slidestart_func' );

// [slideend]
function slideend_func( $atts ) {
	return '</div></div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
}
add_shortcode( 'slideend', 'slideend_func' );
// [slideimage]<img src="http://example.com/example.jpg">My Caption[/slideimage]
function slideimage_shortcode( $atts, $content = null ) {
	return '<div class="swiper-slide">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'slideimage', 'slideimage_shortcode' );

// [slidesectionstart]
function slidesectionstart_func( $atts ) {
	return '<section class="banner position-relative wow fadeInUp"><div class="swiper mySwiper"><div class="swiper-wrapper">';
}
add_shortcode( 'slidesectionstart', 'slidesectionstart_func' );

// [slidesectionend]
function slidesectionend_func( $atts ) {
	return '</div></div><div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div></section>';
}
add_shortcode( 'slidesectionend', 'slidesectionend_func' );


// [slidesectionitemstart]
function slidesectionitemstart_func( $atts ) {
	return '<div class="swiper-slide">';
}
add_shortcode( 'slidesectionitemstart', 'slidesectionitemstart_func' );

// [dlitem]
function dlitem_func( $atts , $content) {
	return '<dd>'.do_shortcode($content).'</dd>';
}
add_shortcode( 'dlitem', 'dlitem_func' );

// [slidesectionitemend]
function slidesectionitemend_func( $atts ) {
	return '</div>';
}
add_shortcode( 'slidesectionitemend', 'slidesectionitemend_func' );


// [slidesectionitemimage]
function slidesectionitemimage_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'url' =>'Details'
	), $atts );
	return '<div class="boximg"><img src="'.$a['url'].'" alt="banner"></div>';
}
add_shortcode( 'slidesectionitemimage', 'slidesectionitemimage_func' );
// [slidesectionitem]
function slidesectionitem_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'morebtntext' =>'Details',
		'morebtnurl' =>'',
	), $atts );

	return '<div class="inner"><div class="container"><div class="banText banText2"><h1 class="fs36 bold blueText">'.do_shortcode($content).'</h1><a href="'.$a['morebtnurl'].'" class="more">'.$a['morebtntext'].'</a></div></div></div>';
}
add_shortcode( 'slidesectionitem', 'slidesectionitem_func' );

// [homeslidestart]
function homeslidestart_func( $atts ) {
	return '<div class="col-md-5 col-sm-12 col-xs-12">	<div class="swiper mySwiper"><div class="swiper-wrapper">';
}
add_shortcode( 'homeslidestart', 'homeslidestart_func' );

// [homeslideend]
function homeslideend_func( $atts ) {
	return '</div></div></div>';
}
add_shortcode( 'homeslideend', 'homeslideend_func' );

// [homeslideitem]
function homeslideitem_func( $atts ) {
	$a = shortcode_atts( array(
		'topic' => '',
		'title' => '',
		'caption' => '',
		'morebtntext' =>'',
		'morebtnurl' =>'',
	), $atts );
	return '<div class="swiper-slide"><span class="label blueLight fs14">'.$a['topic'].'</span><h1 class="titleJa py-3 fs36 blueLight">'.$a['title'].'</h1><p class="slideHeader__text">'.$a['caption'].'</p><a href="'.$a['morebtnurl'].'" class="more">'.$a['morebtntext'].'</a></div>';
}
add_shortcode( 'homeslideitem', 'homeslideitem_func' );

// [homevideo]
function homevideo_func( $atts ) {
	$a = shortcode_atts( array(
		'videourl' => 'https://hsu1.10u.org//mobile/scm/video.mp4',
	), $atts );
	return '<div class="col-md-7 col-sm-12 col-xs-12"><div class="video-wrap"><video class="bg-video" playsinline="" autoplay="" loop="" muted=""><source src="'.$a["videourl"].'" type="video/mp4"></video></div></div>';
}
add_shortcode( 'homevideo', 'homevideo_func' );

// [textwithimage]
function textwithimage_func( $atts ) {
	$a = shortcode_atts( array(
		'text' => '',
		'imageurl' => 'd'
	), $atts );
	return '<div class="row mb-3"><div class="col-md-8 col-sm-12 col-xs-12">'.$a['text'].'</div><div class="col-md-4 col-sm-12 col-xs-12"><img  src="'.$a["imageurl"].'" alt="images" /></div></div>';
}
add_shortcode( 'textwithimage', 'textwithimage_func' );

// [svg_address]
function svg_address_func( $atts ) {
	return '<i style="width:45px;margin-right: 5px;" class="icos"><img src="'.get_template_directory_uri() .'/static/images/mi1.svg" alt="address" /></i>';
}
add_shortcode( 'svg_address', 'svg_address_func' );

// [svg_tel]
function svg_tel_func( $atts ) {
	return '<i class="icos"><img src="'.get_template_directory_uri() .'/static/images/mi2.svg" alt="tel" /></i>';
}
add_shortcode( 'svg_tel', 'svg_tel_func' );

// [svg_tel_fill]
function svg_tel_fill_func( $atts ) {
	return '<i class="icos"><img src="'.get_template_directory_uri() .'/static/images/mi3.svg" alt="tel" /></i></i>';
}
add_shortcode( 'svg_tel_fill', 'svg_tel_fill_func' );

// [svg_facebook]
function svg_facebook_func( $atts ) {
	return '<i class="icos"><img src="'.get_template_directory_uri() .'/static/images/mi4.svg" alt="facebook" /></i>';
}
add_shortcode( 'svg_facebook', 'svg_facebook_func' );

// [svg_datetime]
function svg_datetime_func( $atts ) {
	return '<i class="icos"><img class="datetitme" src="'.get_template_directory_uri() .'/static/images/mi5.svg" /></i>';
}
add_shortcode( 'svg_datetime', 'svg_datetime_func' );


// [icon_angle_up]
function icon_angle_up_func( $atts ) {
	return '<i class="fa fa-angle-up" aria-hidden="true"></i>';
}
add_shortcode( 'icon_angle_up', 'icon_angle_up_func' );

// [icon_envelope]
function icon_envelope_func( $atts ) {
	return '<i class="fa fa-envelope" aria-hidden="true"></i>';
}
add_shortcode( 'icon_envelope', 'icon_envelope_func' );


// [icon_link]
function icon_link_func( $atts ) {
	return '<i class="fa fa-link" aria-hidden="true"></i>';
}
add_shortcode( 'icon_link', 'icon_link_func' );


// [icon_phone]
function icon_phone_func( $atts ) {
	return '<i class="fa fa-phone" aria-hidden="true"></i>';
}
add_shortcode( 'icon_phone', 'icon_phone_func' );

// [icon_angle_down]
function icon_angle_down_func( $atts ) {
	return '<i class="fa fa-angle-down" aria-hidden="true"></i>';
}
add_shortcode( 'icon_angle_down', 'icon_angle_down_func' );

// [contact_start]
function contact_start_func( $atts ) {
	return '<div class="faq"><ul>';
}
add_shortcode( 'contact_start', 'contact_start_func' );

// [contact_end]
function contact_end_func( $atts ) {
	return '</ul></div>';
}
add_shortcode( 'contact_end', 'contact_end_func' );

// [list_start]
function list_start_func( $atts ) {
	return '<li class="li li2 wow fadeInUp">';
}
add_shortcode( 'list_start', 'list_start_func' );

// [list_end]
function list_end_func( $atts ) {
	return '</li>';
}
add_shortcode( 'list_end', 'list_end_func' );


// [toggle_btn]
function toggle_btn_func( $atts ) {
	$a = shortcode_atts( array(
		'title' => '',
	), $atts );
	return '<a class="fs18 bold" title="'.$a['title'] .'">'.$a['title'] .'<i class="fa fa-angle-down" aria-hidden="true"></i><i class="fa fa-angle-up" aria-hidden="true"></i></a>';
}
add_shortcode( 'toggle_btn', 'toggle_btn_func' );

// [faq_list_content]
function faq_list_content_func( $atts, $content ) {
	return '<div class="con">'.do_shortcode($content).'</div>';
}
add_shortcode( 'faq_list_content', 'faq_list_content_func' );


// [faq_list_content_row]
function faq_list_content_row_func( $atts, $content ) {
	return '<div class="con"><div class="row">'.do_shortcode($content).'</div></div>';
}
add_shortcode( 'faq_list_content_row', 'faq_list_content_row_func' );

// [sd_list class]
function sd_list_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'class' => '',
	), $atts );
	return '<div class="sdlist '.$a['class'].'"><div class="row">'.do_shortcode($content).'</div></div>';
}
add_shortcode( 'sd_list', 'sd_list_func' );

// [sd_list_item]
function sd_list_item_func( $atts, $content ) {
	return '<div class="col-md-4 col-sm-12 col-xs-12 mt-3 wow fadeInUp"><div class="imgs">'.do_shortcode($content).'</div></div>';
}
add_shortcode( 'sd_list_item', 'sd_list_item_func' );
// [dd_list_start]
function dd_list_start_func( $atts ) {
	$a = shortcode_atts( array(
		'column' => 'false',
	), $atts );
	if($a['column'] === 'false') {
		return '<div class="con"><dl class="contact">';
	} else {
		return '<div class="con"><div class="row"><div class="col-md-'.$a['column'].' col-sm-12 col-xs-12"><dl class="contact">';
	}
}
add_shortcode( 'dd_list_start', 'dd_list_start_func' );

// [column number="12"]
function column_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'number' => '12',
	), $atts );
	return '<div class="col-md-'.$a['number'].' col-sm-12 col-xs-12">'.do_shortcode($content).'</div>';
}
add_shortcode( 'column', 'column_func' );

// [dd_list_end]
function dd_list_end_func( $atts ) {
	return '</dl></div>';
}
add_shortcode( 'dd_list_end', 'dd_list_end_func' );

// [location_image_start]
function location_image_start_func( $atts ) {
	$a = shortcode_atts( array(
		'column' => '4',
	), $atts );
	return '<div class="col-md-'.$a['column'].' col-sm-12 col-xs-12">';
}
add_shortcode( 'location_image_start', 'location_image_start_func' );

// [location_image_end]
function location_image_end_func( $atts ) {
	return '</div></div></div>';
}
add_shortcode( 'location_image_end', 'location_image_end_func' );



function recent_posts_bmsim_career_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'bmsim-career',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="IOlist"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
				<a href="javascript:;">
					<div class="imgs"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
					<div class="right">
						<h4 class="fs20 blueText bold">'.get_the_title().'</h4>
						<p class="fs18">Class of '.get_field( 'graduate_year' ).' '.get_field( 'degree' ).' '.get_field( 'expertise' ).'</p>
					</div>
				</a>
				<div class="pup">
					<div class="pupback"></div>
					<div class="container">
						<div class="conbox">
							<div class="close"></div> 
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
									<div class="pic"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
								</div>
								<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
									<div class="fs32 bold blueText">'. get_the_title().'</div>
									<div class="txt fs18 mt-2">
										<p>'.get_field( 'expertise' ).'<br/>Class of '.get_field( 'graduate_year' ).'<br/>'.get_field( 'degree' ).'</p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-posts-bmsim-career', 'recent_posts_bmsim_career_shortcode' );


function recent_posts_bba_scm_career_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'bba-scm-career',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="IOlist"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
				<a href="javascript:;">
					<div class="imgs"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
					<div class="right">
						<h4 class="fs20 blueText bold">'.get_the_title().'</h4>
						<p class="fs18">Class of '.get_field( 'graduate_year' ).' '.get_field( 'degree' ).' '.get_field( 'expertise' ).'</p>
					</div>
				</a>
				<div class="pup">
					<div class="pupback"></div>
					<div class="container">
						<div class="conbox">
							<div class="close"></div> 
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
									<div class="pic"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
								</div>
								<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
									<div class="fs32 bold blueText">'. get_the_title().'</div>
									<div class="txt fs18 mt-2">
										<p>'.get_field( 'expertise' ).'<br/>Class of '.get_field( 'graduate_year' ).'<br/>'.get_field( 'degree' ).'</p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-posts-bba-scm-career', 'recent_posts_bba_scm_career_shortcode' );

function recent_posts_msc_gscm_career_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'msc-gscm-career',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="IOlist"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
				<a href="javascript:;">
					<div class="imgs"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
					<div class="right">
						<h4 class="fs20 blueText bold">'.get_the_title().'</h4>
						<p class="fs18">Class of '.get_field( 'graduate_year' ).' '.get_field( 'degree' ).' '.get_field( 'expertise' ).'</p>
					</div>
				</a>
				<div class="pup">
					<div class="pupback"></div>
					<div class="container">
						<div class="conbox">
							<div class="close"></div> 
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
									<div class="pic"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
								</div>
								<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
									<div class="fs32 bold blueText">'. get_the_title().'</div>
									<div class="txt fs18 mt-2">
										<p>'.get_field( 'expertise' ).'<br/>Class of '.get_field( 'graduate_year' ).'<br/>'.get_field( 'degree' ).'</p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-posts-msc-gscm-career', 'recent_posts_msc_gscm_career_shortcode' );


function recent_posts_bmsim_experience_and_opportunity_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'bmsim-experience-opportunities',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="IOlist"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
				<a href="javascript:;">
					<div class="imgs"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
					<div class="right">
						<h4 class="fs20 blueText bold">'.get_the_title().'</h4>
						<p class="fs18">Class of '.get_field( 'graduate_year' ).' '.get_field( 'degree' ).' '.get_field( 'expertise' ).'</p>
					</div>
				</a>
				<div class="pup">
					<div class="pupback"></div>
					<div class="container">
						<div class="conbox">
							<div class="close"></div> 
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
									<div class="pic"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
								</div>
								<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
									<div class="fs32 bold blueText">'. get_the_title().'</div>
									<div class="txt fs18 mt-2">
										<p>'.get_field( 'expertise' ).'<br/>Class of '.get_field( 'graduate_year' ).'<br/>'.get_field( 'degree' ).'</p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-posts-bmsim-exp-and-opp', 'recent_posts_bmsim_experience_and_opportunity_shortcode' );

function recent_posts_bba_scm_experience_and_opportunity_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'bba-scm-experience-opportunities',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="IOlist"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
				<a href="javascript:;">
					<div class="imgs"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
					<div class="right">
						<h4 class="fs20 blueText bold">'.get_the_title().'</h4>
						<p class="fs18">Class of '.get_field( 'graduate_year' ).' '.get_field( 'degree' ).' '.get_field( 'expertise' ).'</p>
					</div>
				</a>
				<div class="pup">
					<div class="pupback"></div>
					<div class="container">
						<div class="conbox">
							<div class="close"></div> 
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
									<div class="pic"><img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
								</div>
								<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
									<div class="fs32 bold blueText">'. get_the_title().'</div>
									<div class="txt fs18 mt-2">
										<p>'.get_field( 'expertise' ).'<br/>Class of '.get_field( 'graduate_year' ).'<br/>'.get_field( 'degree' ).'</p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-posts-bba-scm-exp-and-opp', 'recent_posts_bba_scm_experience_and_opportunity_shortcode' );

function recent_news_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'news',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="news mt-5"><div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="col-md-6 col-sm-12 col-xs-12 mb-4 wow fadeInUp">
			<a href="'.get_the_permalink().'">
			<div class="date">
				<strong class="day fs42">'.get_the_date('d').'</strong>
				<em class="year">'.get_the_date('M, Y').'</em>
					</div>
					<div class="boximg">
					<img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="pic">
					
					</div>
					<div class="con fs20">
						<p>'.get_the_title().'</p>
					</div>
				</a>
			</div>';
		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-news', 'recent_news_shortcode' );

function recent_events_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => 6,
	), $atts );

	$args = array(
		'post_type' => 'post',
		'category_name' =>'events',
		'posts_per_page' => intval($a['posts_per_page']),
		'paged' => get_query_var('paged') // Add this line to update the page number
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		$output = '<div class="news mt-5"><div class="evlist">';
		while ($query->have_posts()) {
			$query->the_post();
			$output .='
			<div class="items">  
				<a href="javascript:;">
					<div class="boximg"><img src="'. get_the_post_thumbnail_url(get_the_ID()).'"></div>
					<div class="conbox">
						<h5 class="tit fs20">'.get_the_title().'</h5>
						<em class="date">'.get_the_time('F j, Y').'</em>';
						if(get_the_content() !== null) {
							$post_content = get_the_content(); // Get the post content
							$text_content = wp_strip_all_tags($post_content); // Remove HTML tags from the content
							$trimmed_content = wp_trim_words($text_content, 100, ''); // Trim the content to 100 characters
							$output .= $trimmed_content;
						}
			$output .='</div></a>
				<div class="pup" id="events-'.get_the_ID().'">
						<div class="pupback"></div>
						<div class="container">
							<div class="conbox">
								<div class="close"></div> 
								<div class="row">
									<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
										<div class="pic"><img src="'. get_the_post_thumbnail_url(get_the_ID()).'" alt="pic"></div>
									</div>
									<div class="col-md-8 col-sm-12 col-xs-12 mb-3">
										<div class="fs24 bold blueLight">'.get_the_title().'</div><div class="txt fs18 mt-2"><p></p>';
				if(get_the_content() !== null) {
					$output .= get_the_content();
				}
				$output .= '</div></div></div></div></div></div></div>';

		}

		$output .= '<div class="pageinfo">';

		$big = 999999999; // Set a large number
		// Define the pagination arguments
		$args = array(
			'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'     => '?paged=%#%',
			'mid_size'   => 2,
			'prev_next'  => True,
			'prev_text'  => __('Previous Page'),
			'next_text'  => __('Next Page'),
			'current'    => max( 1, get_query_var('paged') ),
			'total'      => $query->max_num_pages,
			'type'       => 'list'
		);

		$pages = paginate_links($args);

		// Display the pagination
		$output .= paginate_links( $args );
		$output .= '</div></div></div>';

		wp_reset_postdata();

		return $output;
	}
}
add_shortcode( 'recent-events', 'recent_events_shortcode' );





//Display graduates accoroding to the year
function enqueue_custom_scripts() {
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/static/js/year_selection.js', array('jquery'), '1.0', true);
	session_start();
	if (isset($_SESSION['year'])) {
		$year = $_SESSION['year'];	
	} else { $year = date('Y'); }
	wp_localize_script('custom-script', 'data_vars',
	array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'current_year' => $year
	));

  }
  add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function filter_graduates_by_year() {
	session_start();
	if(isset($_POST['year'])) {
		$_SESSION['year'] = $_POST['year'];
		echo json_encode(array('success' => true));		
	} else {
		echo json_encode(array('error' => true));		
	}
  	die();
  }
  add_action('wp_ajax_filter_graduates_by_year', 'filter_graduates_by_year');
  add_action('wp_ajax_nopriv_filter_graduates_by_year', 'filter_graduates_by_year');

// Facutly Staff Shortcodes

// [staff_content_list]
function faculty_staff_shortcode_func($atts) {
    // $a = shortcode_atts(array(
    //     'items' => array()
    // ), $atts, 'staff_content_list');
	print_r($atts);
    $items = json_decode(str_replace("'", '"', $atts['items']), true);
    
    // Generate the output HTML
    $i = 0;
    ob_start();
    ?>
    <div class="tags mt-5">
        <div class="in"> 
            <?php
                // Process the list items
                foreach ($items as $item) {
                    $item_id = 'staff'. $i; // Generate an ID for each item based on its title
                    $class = ($i === 0) ? 'active' : ''; // Check if it's the first item

                    // Output the link
                    printf('<a href="#%s" class="%s">%s</a>', esc_attr($item_id), esc_attr($class), esc_html($item['title']));
                    $i++;
                }
            ?>
        </div>
    </div>

    <div class="itlist">
        <?php
            // Process the list items
            foreach ($items as $item) {
                $item_id = sanitize_title($item['title']); // Generate an ID for each item based on its title
                $class = ($item_id === 'one') ? 'active' : ''; // Check if it's the first item
        ?>
            <div class="items" id="<?php echo esc_attr($item_id); ?>">
                <h4 class="fs20 bold"><?php echo esc_html($item['title']); ?>:</h4>
                <div class="txt fs18">
                    <?php echo esc_html($item['content']); ?>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('staff_content_list', 'faculty_staff_shortcode_func');




function add_the_table_button( $buttons ) {
	array_push( $buttons, 'separator', 'table' );
	return $buttons;
 }
 add_filter( 'mce_buttons', 'add_the_table_button' );
 function add_the_table_plugin( $plugins ) {
	 $plugins['table'] = includes_url().'js/tinymce/plugins/table/plugin.min.js';
	 return $plugins;
 }
 add_filter( 'mce_external_plugins', 'add_the_table_plugin' );



