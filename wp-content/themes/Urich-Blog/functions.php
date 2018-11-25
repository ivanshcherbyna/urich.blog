<?php
/*
 *  Author: Lenlay
 */

define('THEME_OPT', 'mytheme', true);
/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Localisation Support
    // load_theme_textdomain(THEME_OPT, get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// Load scripts
function lwp_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('themescripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('themescripts');
    }
}
function urich_blog_footer_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('my_common', get_template_directory_uri() . '/inc/urich/js/common.js', array('jquery'), '1.0.0',true); // Custom scripts
//        wp_enqueue_script('my_common');
        wp_register_script('scripts', get_template_directory_uri() . '/inc/urich/js/scripts.min.js', array('jquery'), '1.0.0',true); // Custom scripts
        wp_enqueue_script('scripts');
//        wp_register_script('custom_script', get_template_directory_uri() . '/inc/urich/js/custom_script.js', array('jquery'), '1.0.0',true); // Custom scripts
//        wp_enqueue_script('custom_script');

        wp_register_script('async_script',get_template_directory_uri().'/inc/urich/js/async_ajax.js',array('jquery'), '1.0.0',true);
        wp_enqueue_script('async_script');
        wp_localize_script( 'async_script', 'myajax',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }
}
function google_maps_script(){

    if (is_front_page()) {
        wp_enqueue_script('google_js', 'https://maps.googleapis.com/maps/api/js?key='/**/.'&callback=initMap', '', '', true);
        wp_register_script('google_map', get_template_directory_uri() . '/inc/urich/google_map.js', array('jquery'), '1.0.0');
        wp_enqueue_script('google_map');
        wp_localize_script('google_map', 'image_url', array('custom_url' => get_template_directory_uri() . '/inc/urich/map_marker.png'));
    }
}
// Load styles
function lwp_styles() {

    wp_register_style('themestyle', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css'), 'all');
    wp_enqueue_style('themestyle');

}
function urich_blog_styles() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/urich/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/inc/urich/css/bootstrap-theme.min.css');

    wp_register_style('urich_styles', get_template_directory_uri() . '/inc/urich/css/styles.min.css');
    wp_enqueue_style('urich_styles');

}


// HTML5 Blank navigation
function urich_blog_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'nav',
		'container_class' => 'header-info-nav',
		'container_id'    => '',
		'menu_class'      => 'header-info-nav',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="header-info-nav-list">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="header-info-nav-list-item"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

//add_filter( 'nav_menu_css_class', 'class_menu_li_element', 10, 4 );
//function class_menu_li_element( $classes, $item, $args, $depth ){
//    $classes[]='header-info-nav-list-li';
//    return $classes;
//}
// Register Navigation
function register_lwp_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', THEME_OPT),
    ));
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'teatrhotel'),
        'description' => __('Description for this widget-area...', THEME_OPT),
        'id' => 'widget-area-1',
        'before_widget' => '<ul class="off-canvas-list">',
        'after_widget' => '</ul>',
        'before_title' => '<li><label><h3>',
        'after_title' => '</h3></label></li>'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function lwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function lwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function lwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function lwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function lwpcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'lwp_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'urich_blog_footer_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'lwp_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'urich_blog_styles'); // Add ZAGA Theme Stylesheet
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('init', 'register_lwp_menu'); // Add HTML5 Blank Menu
add_action('init', 'lwp_pagination'); // Add our HTML5 Pagination
//add_action('wp_enqueue_scripts','google_maps_script');// custom incude maps scripts

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

include_once 'inc/loader.php';

function getContactForm($shortcode){
    global $mytheme;
    if($shortcode):?>
        <div class="contacts-img"><img src="<?= $mytheme['contact-form-img']['url'] ?>" class=""></div>
        <div class="contact-form">
            <h2 class="contractForm-form-header">CONTACT US</h2>
            <form class="">
                <?php echo do_shortcode($shortcode); ?>
        </div>
        <?php
    else: return; endif;
}
add_action('show_contact_form','getContactForm',10,1);

function breadcrumbs($separator = ' » ', $home = 'Головна') {
 global $post;
 if($post) {
     $post_categories = get_the_category($post->ID);
     // var_dump($post_categories);
     //last position in breadcrumbs
     $breadcrumbs_title[] = '<a href="#">' . get_the_title() . '</a>';
     //first position in breadcrumbs
     $breadcrumbs = array("</span><a href=\"/\"><span>$home</a></span>");
     //check blog page from parent category at cat_ID #5
     if (!empty($post_categories[0]) && ($post_categories[0]->term_id == 5 || $post_categories[0]->category_parent == 5)) {
         $breadcrumbs[] = '<a href="/blog/">Блог</a>';
     }
     $breadcrumbs[] = get_the_title();


     return implode($separator, $breadcrumbs);
 }
}
add_action('show_last_posts','get_my_last_posts',10,2);

//for home page with use slider (slick)
//function get_my_last_posts($category_slug=null, $numbers=-1)
//    {
//        $args = array(
//            'orderby' => 'date',
//            'order' => 'DESC',
//            'numberposts' => $numbers,
//            'category_name' => $category_slug,
//            'post_status' => 'publish',
//            'post_type' => array('post')
//        );
//
//        $posts = get_posts($args);
//        if($posts) {
//            echo '<section class="news">';
//                echo '<h2 class="news-header">Наші новини</h2>';
//                echo '<hr class="line news-hr">';
//                echo '<div class="slick-slider news-content wrapper">';
//                show_posts_html($posts);
//                echo '</div>';
//            echo '</section>';
//        }
//
//    }


//function get_same_posts($category, $exclude_post_id, $category_slug=null, $numbers=3)
//{
//
//    $args = array(
//        'orderby' => 'date',
//        'order' => 'ASC',
//        'numberposts' => $numbers,
//        'category' => $category,
//        'category_name' => $category_slug,
//        'exclude' => $exclude_post_id,
//        'post_status' => 'publish',
//        'post_type' => array('post')
//
//    );
//    $posts = get_posts($args);
//    if($posts) {
//        show_view_posts_html($posts);
//    }
//}
//add_action('show_same_posts','get_same_posts',10,4);

function get_blog_posts($category_ids, $numbers=6,$blog_categories_ids, $searched_string=null, $exclude_post_id=null)
{
    $all_posts_args=array(
        'orderby' => 'date',
        'order' => 'DESC',
        'numberposts' => -1,
        'category' => $category_ids,
        'post_status' => 'publish',
        'fields'          => 'ids',
        'post_type' => array('post'),
    );
    if($searched_string) {
        $all_posts_args['s'] = $searched_string;
    }
    $all_post_ids=get_posts($all_posts_args);
    $string_all_post_ids=implode( "," ,$all_post_ids);

    $args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'category' => $category_ids,
//        'category_name' => $category_slug,
        'post_status' => 'publish',
        'post_type' => array('post'),
    );

    $pagination =  $numbers; //if set current pagination
    $numberposts = empty($pagination)? 6: null; // if not set current pagination (show last 6 posts) for start page

    $args['include'] = $pagination;
    $args['numberposts'] = $numberposts;
    if ($searched_string) {
        $args['s'] = $searched_string;
    }
    $posts = get_posts($args);

    if(is_archive()){
        // if this function work in archive page template
        $obj_id = get_queried_object_id();
        $current_url = get_term_link($obj_id);
        echo '<input type="hidden" class="all-numbers-posts hidden" value="'.$string_all_post_ids.'" data="'.$current_url.'"/>';
    }
    else{
        //default some page template
        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        echo '<input type="hidden" class="all-numbers-posts hidden" value="'.$string_all_post_ids.'" data="'.$url.'"/>';
    }
    if($posts) {
        ?>
        <div class="blog-content">
            <?php show_view_posts_html($posts); ?>
        </div>
    <?php
        }
}

add_action('show_blog_posts','get_blog_posts',10,4);
//use for add_action to generate html content
function show_view_posts_html($posts){

    foreach ($posts as $post) :

        setup_postdata($post);
        $post_cat ='';
        $i =0;
        foreach (get_the_category($post->ID) as $cat){
            if ($cat->category_parent){
                $i++;
                if($i>1) $post_cat.=', ';
                $post_cat .= $cat->name;
            }
        }
        $link = get_permalink($post->ID);

        $post_author_id=$post->post_author;
        $post_author= get_the_author_meta( 'display_name' , $post_author_id );
        $post_author_url = esc_attr(get_the_author_posts_link());
        $content = $post->post_content;
        $part_content = mb_substr($content,0,530); // only 530 symbols of post content preview
        $part_content = sanitize_text_field($part_content);
        $part_content .= '&hellip;'; 

        $post_date_string = $post->post_date; //string format in db 2018-07-25 12:31:08
        $post_date = new DateTime($post_date_string);
        $formatted_post_date = $post_date->format("F Y"); // object format 6.02.1999
        $title = get_the_title($post);
        $image = get_the_post_thumbnail_url($post, 'medium');
//        var_dump(esc_attr($post_author_url));
        ?>
        <a class="blog-content-item" data-category="<?= $post_cat ?>"  href="<?= $link ?>">
            <div class="blog-content-item-info">
                <img src="<?= $image ?>" style="max-height:161px;" alt="#" class="blog-content-item-info-img">
            </div>
            <div class="blog-content-item-text">
                <div class="blog-content-item-text-info"><span class="blog-content-item-text-info-company"><?= $post_author; ?> </span><span>/<?= $formatted_post_date ?></span>
                </div>
                <h4 class="blog-content-item-info-text-header"><?= $title ?></h4>
                <p class="blog-content-item-info-text-content"><?= $part_content ?></p>
            </div>
        </a>

    <?php
    endforeach;
    wp_reset_postdata();
    ?>
    <a class="blog-content-item blog-content-item-empty" data-category=""></a>
    <a class="blog-content-item blog-content-item-empty" data-category=""></a>
    <a class="blog-content-item blog-content-item-empty" data-category=""></a>
    <?php
}
function paginationUrich(){
    ?>
    <div class="pagination-content">
        <div class="pagination-content-arrow" id="pagination-prev">
            <img src="<?= get_template_directory_uri();?>/inc/urich/img/left-arrow-icon.png" alt="arrow">
        </div>
        <ul class="pagination pagination-list">

        </ul>
        <div class="pagination-content-arrow" id="pagination-next">
            <img src="<?= get_template_directory_uri();?>/inc/urich/img/right-arrow-icon.png" alt="arrow">
        </div>
    </div>
    <?php
}
add_action('show_pagination','paginationUrich');

function get_my_blog($category_slug, $number_pagination=null)
    {

        $all_posts_args=array(
            'orderby' => 'date',
            'order' => 'DESC',
            'numberposts' => -1,
            'category_name' => $category_slug,
            'post_status' => 'publish',
            'fields'          => 'ids',
            'post_type' => array('post')

        );
        $all_post_ids=get_posts($all_posts_args);


    $args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => $category_slug,
        'post_status' => 'publish',
        'post_type' => array('post'),
    );

        $pagination =  $number_pagination; //if set current pagination
        $numberposts = empty($pagination)? -1 :$pagination; // if not set current pagination (show last 3 posts) for start page

    $args['include']=$pagination;
    $args['numberposts']=$numberposts;


    $posts = get_posts($args);

    echo '<input type="hidden" class="all-numbers-posts hidden" value="'.implode( "," ,$all_post_ids).'" data="'.get_permalink().'"/>';


        foreach ($posts as $post) :

    setup_postdata($post);
    $title = get_the_title($post);

    $content=$post->post_content;
    $post_author_id=$post->post_author;
    $post_author= get_the_author_meta( 'display_name' , $post_author_id );
    $part_content= substr($content,0,230); // only 150 symbols of post content preview
    $link =get_permalink($post->ID);
    $post_date_string=$post->post_date; //string format in db 2018-07-25 12:31:08
    $post_date = new DateTime($post_date_string);
    $post_date=$post_date->format('d F Y'); // object format in June 2, 2018
        $size= array('368','239');
    $image=get_the_post_thumbnail_url($post, 'full');

    ?>
       <!-- Post -->
            <article class="blog-list-item">
                <div class="blog-list-item-img"><img class="blog-list-item-img-bg"  src="<?=$image?>" alt="article"></div>
                <div class="blog-list-item-content">
                    <div class="blog-list-item-content-wrap">
                        <div class="blog-list-item-content-header"><?=$post_date?></div>
                        <div class="blog-list-item-content-body">
                            <h4 class="blog-list-item-content-body-head"><?=$title?> </h4>
                            <p class="blog-list-item-content-body-text"><?=$part_content?></p>
                        </div>
                        <div class="blog-list-item-content-footer">
                            <a href='<?=$link?>' class="content-button">Read</a>
                        </div>
                    </div>
                </div>
            </article>
        <!-- Post -->
<?php
endforeach;
?>
 <div class="pagination">
                <ul>

                </ul>
            </div>
<?php
wp_reset_postdata(); // reset
}

/*------ajax social share-----*/
add_action('wp_ajax_social_share','social_save_update');
add_action('wp_ajax_nopriv_social_share','social_save_update');
function social_save_update(){
    $result = false;
    $post_id = sanitize_text_field($_POST['current_post_id']);

    $social = isset($_POST['social_value'])? sanitize_text_field($_POST['social_value']) : null;

    $social_key = '';
    if( !empty($social) && $social == 'share_btn_gl') $social_key='google_plus_count';
    elseif (!empty($social) && $social == 'share_btn_tw') $social_key='twitter_count';
    elseif (!empty($social) && $social == 'share_btn_fb') $social_key='facebook_count';
    else return $result;

    if (!empty($post_id) ) {

        $exist_social_value = !empty(get_post_meta($post_id, $social_key, true)) ? get_post_meta($post_id, $social_key, true) : 0;
        ++$exist_social_value;
        update_post_meta($post_id, $social_key, $exist_social_value);

        $result= true;
    }
    return wp_send_json_success($result);

    wp_die();
}


remove_action('wp_head', 'wp_generator');


?>
