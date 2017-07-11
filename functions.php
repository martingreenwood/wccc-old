<?php
/**
 * wccc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wccc
 */

if (!is_dir(get_stylesheet_directory() . '/cache')) {
	mkdir(get_stylesheet_directory() . '/cache');
}

if ( ! function_exists( 'wccc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wccc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wccc, use a find and replace
	 * to change 'wccc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wccc', get_template_directory() . '/languages' );

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
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slide-thumb', '215', '215', true );
	add_image_size( 'poster', '400', '600', true );

	/*
	 * Enable support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'wccc' ),
		'menu-2' => esc_html__( 'Footer Quick Links', 'wccc' ),
		'menu-3' => esc_html__( 'Footer Tickets', 'wccc' ),
		'menu-4' => esc_html__( 'Footer Commercial', 'wccc' ),
		'menu-5' => esc_html__( 'Footer Shop', 'wccc' ),
		'menu-6' => esc_html__( 'Footer Contact', 'wccc' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wccc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wccc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wccc_content_width', 1280 );
}
add_action( 'after_setup_theme', 'wccc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wccc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wccc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar [Archive]', 'wccc' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'wccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar [Pages]', 'wccc' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'wccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Topbar [No Sidebar]', 'wccc' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'wccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar [Events]', 'wccc' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'wccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wccc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wccc_scripts() {
	wp_enqueue_style( 'wccc-style', get_stylesheet_uri() );
	wp_enqueue_style( 'wccc-opta-css', '//widget.cloud.opta.net/v3/css/v3.cricket.opta-widgets.css' );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'wccc_opt', '//widget.cloud.opta.net/v3/v3.opta-widgets.js', '', '', false);
	wp_enqueue_script( 'wccc_ggl', '//maps.googleapis.com/maps/api/js?key=AIzaSyAT5vS9U3S5QkN-f2cwPN-Am4C1vc7zElE', '', '', false);
	wp_enqueue_script( 'wccc-fnt', '//use.fontawesome.com/06a97ff7a0.js', '', '', true );
	wp_enqueue_script( 'wccc-mod', get_template_directory_uri() . '/assets/js/modernizr.js', '', '', true );
	wp_enqueue_script( 'wccc-acc', get_template_directory_uri() . '/assets/js/jquery.accordion.js', '', '', true );
	wp_enqueue_script( 'wccc-nav', get_template_directory_uri() . '/assets/js/navigation.js', '', '', true );
	wp_enqueue_script( 'wccc-grid', get_template_directory_uri() . '/assets/js/grid.js', '', '', true );
	wp_enqueue_script( 'wccc-map', get_template_directory_uri() . '/assets/js/map.js', '', '', true );
	if (is_front_page()) {
		wp_enqueue_script( 'wccc-ctd', get_template_directory_uri() . '/assets/js/countdown.js' );
	}
	wp_enqueue_script( 'wccc-app', get_template_directory_uri() . '/assets/js/app.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'wccc_scripts' );

/*==================================
=            ADD TYPEIT            =
==================================*/

function typekit_me() {
?><script>
  (function(d) {
    var config = {
      kitId: 'cpx7ese',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script><?php
}
add_action( 'wp_head', 'typekit_me', 99 );

/*================================
=            ADD OPTA            =
================================*/

function opta_me() {
?><script>
var opta_settings = {
	subscription_id: '7f86c9ef2677acc7481e8ea18f9d16b8',
	language: 'en_GB',
	timezone: 'Europe/London'
};
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script><?php
}
add_action( 'wp_head', 'opta_me', 100 );


/*====================================
=            MOVE JETPACK            =
====================================*/

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );


/*================================
=            FILTERS§            =
================================*/

function makePretty($value) 
{
    $value = str_replace("_"," ",$value);
    $value = str_replace("-"," ",$value);
    return ucwords($value);
}


function wccc_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAT5vS9U3S5QkN-f2cwPN-Am4C1vc7zElE');
}
add_action('acf/init', 'wccc_acf_init');


// Adds $img content after after first paragraph (!.e. after first `</p>` tag)
add_filter('the_content', function($content)
	{
		global $post;
		if (is_singular('post')) {
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$img = '<img src="'.$url.'" alt="" title=""/>';
			$content = preg_replace('#(<p>.*?</p>)#','$1'.$img, $content, 1);
			return $content;
		}
		else {
			return $content;
		}
});

add_filter( 'get_the_archive_title', function ($title) {

	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>' ;

	}

	return $title;

});

/*================================
=            COOKIES            =
================================*/

function coooooookies() { 
	?>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
	<script>
	window.addEventListener("load", function(){
	window.cookieconsent.initialise({
		"palette": {
			"popup": {
				"background": "#3c404d",
				"text": "#d6d6d6"
			},
			"button": {
				"background": "#8bed4f"
			}
		},
		"theme": "edgeless",
		"position": "bottom-right"
		})
	});
	</script>
	<?php

}
add_action('wp_head', 'coooooookies');

/*==============================================
=            ADD PHP TO TEXT WIDETS            =
==============================================*/

function php_execute($html){
	if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}
add_filter('widget_text','php_execute',100);


/*================================
=            INCLUDES            =
================================*/

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/cricket.php';

/**
 * Custom post types
 */
require get_template_directory() . '/inc/cpts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Twitter Auth
 */
require get_template_directory() . '/inc/twitteroauth/twitteroauth.php';

/**
 * Load OpenWeatherMapAPI API
 */
require get_template_directory() . '/inc/cmfcmf/OpenWeatherMap.php';

