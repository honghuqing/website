<?php
add_action( 'after_setup_theme', 'newsframe_theme_setup' );
function newsframe_theme_setup() {
require_once ( get_template_directory() . '/theme-options.php' );
register_nav_menu( 'main-menu', __( 'Main Menu', 'newsframe' ) );
register_nav_menu( 'bottom-menu', __( 'Footer Menu', 'newsframe' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support ('custom-background');
set_post_thumbnail_size( 220, 220, true);
add_editor_style('/inc/custom-editor-style.css');
if ( ! isset( $content_width ) ) $content_width = 900;
function newsframe_new_excerpt_more($more) {
global $post;
return ' <a class="more" href="'. get_permalink() . '">' . __( '...全文', 'newsframe' ) . '</a>';
}
add_filter('excerpt_more', 'newsframe_new_excerpt_more');
function newsframe_custom_excerpt_length( $length ) {
return 100;
}
add_filter( 'excerpt_length', 'newsframe_custom_excerpt_length', 999 );
function newsframe_blank_slate_title($title) {
if ($title == '') {
return 'Untitled Post';
} else {
return $title;
}
}
add_filter('the_title', 'newsframe_blank_slate_title');
/* Thanks to One Trick Pony, StackExchange */
add_filter('post_class', 'newsframe_post_class');
function newsframe_post_class($classes){
  global $wp_query;
  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
  return $classes;
}
/* Secondary Excerpt by c.bavota - thanks! */
function newsframe_excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
}	
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}
function newsframe_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content); 
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}
}
function newsframe_wp_title( $title, $sep ) {
global $paged, $page;
if ( is_feed() )
return $title;
// Add the site name.
$title .= get_bloginfo( 'name' );
// Add the site description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
$title = "$title $sep $site_description";
// Add a page number if necessary.
if ( $paged >= 2 || $page >= 2 )
$title = "$title $sep " . sprintf( __( 'Page %s', 'newsframe' ), max( $paged, $page ) );
return $title;
}
add_filter( 'wp_title', 'newsframe_wp_title', 10, 2 );
// End theme setup
/* Scripts, Fonts & Styles */
/**
 * Enqueue Google Fonts
 */
function newsframe_font() {
	$protocol = is_ssl() ? 'https' : 'http';
		wp_register_style( 'newsframe-old-standard-tt', "$protocol://fonts.googleapis.com/css?family=Old+Standard+TT" );
}
add_action( 'init', 'newsframe_font' );
function newsframe_scripts_styles() {
	global $wp_styles;
	wp_register_style( 'newsframe-foundation-style', get_template_directory_uri() . '/stylesheets/foundation.min.css', 
	array(), 
	'2132013', 
	'all' );
	wp_register_script( 'newsframe-modernizr', get_template_directory_uri() . '/javascripts/modernizr.foundation.js', array(), '1.0', true );
	wp_register_script( 'newsframe-navigation', get_template_directory_uri() . '/javascripts/navigation.js', array(), '1.0', true );
	wp_register_script( 'newsframe-comment-class', get_template_directory_uri() . '/javascripts/comment-class.js', array("jquery"), '1.0', true );
	wp_register_script ( 'newsframe-top-scroll', get_template_directory_uri() . '/javascripts/top-return.js', array( 'jquery' ), '1.0', true);
		// enqueing:
	wp_enqueue_style( 'newsframe-foundation-style' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'newsframe-old-standard-tt' );
	wp_enqueue_script( 'newsframe-navigation');
	wp_enqueue_script( 'newsframe-modernizr');
	wp_enqueue_script ('newsframe-top-scroll');
	
	wp_enqueue_script( 'newsframe-comment-class');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
}
add_action( 'wp_enqueue_scripts', 'newsframe_scripts_styles' );
/* Sidebar Areas */
function newsframe_register_sidebars() {
register_sidebar(array(
'name' => __( 'Right Sidebar', 'newsframe' ),
'id' => 'sidebar',
'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'newsframe' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
register_sidebar(array(
'name' => __( 'Below Posts' , 'newsframe' ),
'id' => 'belowposts-sidebar',
'description' => __( 'Widgets in this area will be shown beneath the blog post type. Use this for sharing, related articles and more.' , 'newsframe' ),
'before_title' => '<div class="sidebar-title-block"><h4 class="belowposts">',
'after_title' => '</h4></div>',
'before_widget' => '<div class="bottom-widget">',
'after_widget' => '</div>',
));
register_sidebar(array(
'name' => __( 'Homepage Widget Block 1', 'newsframe' ),
'id' => 'home-1',
'description' => __( 'Homepage Widget Block 1.', 'newsframe' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
register_sidebar(array(
'name' => __( 'Homepage Widget Block 2', 'newsframe' ),
'id' => 'home-2',
'description' => __( 'Homepage Widget Block 2.', 'newsframe' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
register_sidebar(array(
'name' => __( 'Homepage Widget Block 3', 'newsframe' ),
'id' => 'home-3',
'description' => __( 'Homepage Widget Block 3.', 'newsframe' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
}
/* Custom Widget */
class Newsframe_Category_Posts_Widget extends WP_Widget {
			
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'widget_category_entries', 
			'description' => __('Display recent posts from a specific category.')
		);
    	parent::__construct('newsframe-category-posts', __('Newsframe Category Posts'), $widget_ops);
	}
	function widget($args, $instance) {
           
			extract( $args );
		
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Category Posts' : $instance['title'], $instance, $this->id_base);			
			if ( ! $number = absint( $instance['number'] ) ) $number = 5;
						
			if( ! $cats = $instance["cats"] )  $cats='';
					
			// array to call category posts.
			
			$newsframe_args=array(
						   
				'showposts' => $number,
				'category__in'=> $cats,
				);
			
			$newsframe_widget = null;
			$newsframe_widget = new WP_Query($newsframe_args);
			
			echo $before_widget;
			
			// Widget title
			
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			
			// Post list in widget
			
			echo "<ul>\n";
			
		while ( $newsframe_widget->have_posts() )
		{
			$newsframe_widget->the_post();
		?>
			<li class="newsframe-item">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="newsframe-title"><?php the_title(); ?></a>
		
			</li>
		<?php
		}
		 wp_reset_query();
		echo "</ul>\n";
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        	$instance['cats'] = $new_instance['cats'];
		$instance['number'] = absint($new_instance['number']);
	     
        		return $instance;
	}
	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the category posts list:');?> 
            
                <?php
                   $cats = get_categories('hide_empty=1');
                     echo "<br/>";
                     foreach ($cats as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (is_array($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
			    $option .= '&nbsp;';
                            $option .= $cat->cat_name;
                            $option .= '<br />';
                            echo $option;
                         }
                    
                    ?>
            </label>
        </p>
        
<?php
	}
}
class NfPro_Ad_Widget extends WP_Widget {
 
  function __construct() {
    parent::__construct(
      'nfpro_ad_widget_text',
      __('NewsFrame Pro Ad Widget'),
      array( 'description' => __( 'Use this widget for advertisements.', 'nfpro_ad' ), ) 
    );
  }
 
  function widget( $args, $instance ) {
    extract($args);
    $title = apply_filters( 'nfpro_ad_widget_text', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $text = apply_filters( 'nfpro_ad_widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
    $class = apply_filters( 'nfpro_ad_widget_text', empty( $instance['class'] ) ? '' : $instance['class'], $instance );
 
    echo $before_widget;
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
      <div class="nfpro_ad-textwidget <?php echo $class; ?>"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
    <?php
    echo $after_widget;
  }
 
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['class'] = strip_tags($new_instance['class']);
 
    if ( current_user_can('unfiltered_html') )
      $instance['text'] =  $new_instance['text'];
    else
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
    $instance['filter'] = isset($new_instance['filter']);
 
    return $instance;
  }
 
  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array(
        'title' => '',
        'text' => '',
        'class' => ''
      )
    );
    $title = strip_tags($instance['title']);
    $text = esc_textarea($instance['text']);
    $class = esc_textarea($instance['class']);
  ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
 
    <p><label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="text" value="<?php echo esc_attr($class); ?>" /></p>
 
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>">
        <?php echo $text; ?>
    </textarea>
 
    <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
  <?php
  }
}
function newsframe_register_widgets() {
	register_widget( 'Newsframe_Category_Posts_Widget' );
	register_widget( 'NfPro_Ad_Widget' );
}
add_action( 'widgets_init', 'newsframe_register_widgets' );
add_action( 'widgets_init', 'newsframe_register_sidebars' );
/* Twenty Twelve Comment System */
if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
* Template for comments and pingbacks.
* To override this walker in a child theme without modifying the comments template
* simply create your own twentytwelve_comment(), and that function will be used instead.
* Used as a callback by wp_list_comments() for displaying the comments.
* @since Twenty Twelve 1.0
*/
function newsframe_twentytwelve_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
// Display trackbacks differently than normal comments.
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<p><?php esc_attr_e( 'Pingback:', 'newsframe' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'newsframe' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php
break;
default :
// Proceed with normal comments.
global $post;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<article id="comment-<?php comment_ID(); ?>" class="comment">
<header class="comment-meta comment-author vcard">
<?php
echo get_avatar( $comment, 77 );
printf( '<cite class="fn">%1$s %2$s</cite>',
get_comment_author_link(),
// If current post author is also comment author, make it known visually.
( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'newsframe' ) . '</span>' : ''
);
printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
esc_url( get_comment_link( $comment->comment_ID ) ),
get_comment_time( 'c' ),
/* translators: 1: date, 2: time */
sprintf( __( '%1$s at %2$s', 'newsframe' ), get_comment_date(), get_comment_time() )
);
?>
</header><!-- .comment-meta -->
<?php if ( '0' == $comment->comment_approved ) : ?>
<p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'newsframe' ); ?></p>
<?php endif; ?>
<section class="comment-content comment">
<?php comment_text(); ?>
<?php edit_comment_link( __( 'Edit', 'newsframe' ), '<p class="edit-link">', '</p>' ); ?>
</section><!-- .comment-content -->
<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'newsframe' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div><!-- .reply -->
</article><!-- #comment-## -->
<?php
break;
endswitch; // end comment_type check
}
endif;
add_action( 'add_meta_boxes', 'newsframe_add_custom_box', 1 );
// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'newsframe_add_custom_box', 1 );
/* Do something with the data entered */
add_action( 'save_post', 'newsframe_save_postdata' );
/* Adds a box to the main column on the Post and Page edit screens */
function newsframe_add_custom_box() {
        add_meta_box(
            'newsframe_sectionid',
            __( 'Post Extras', 'newsframe' ),
            'newsframe_inner_custom_box',
		'post', 'normal', 'high'
        );
    }
	
/* Prints the box content */
function newsframe_inner_custom_box( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'newsframe_noncename' );
  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, 'subtitle', true );
    echo '<label for="subtitle_field"><h4>';
       _e("Article Subtitle", 'newsframe' );
  echo '</h4></label>';
  echo '<input type="text" id="subtitle_field" name="subtitle_field" value="'.esc_attr($value).'" size="80" /><br>';
  
  // Videos
	$value = get_post_meta( $post->ID, 'newsframe_video', true );
  echo '<label for="videos"><h4>';
       _e("Featured Video Embed Code", 'newsframe' );
  echo '</h4></label>';
  echo '<textarea id="video_field" name="video_field" rows="10" cols="80">'.esc_attr($value).'</textarea><br>';
}
/* When the post is saved, saves our custom data */
function newsframe_save_postdata( $post_id ) {
  // First we need to check if the current user is authorized to do this action. 
  if ( 'post' == $_POST ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }
  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['newsframe_noncename'] ) || ! wp_verify_nonce( $_POST['newsframe_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  // Thirdly we can save the value to the database
  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
	$subtitlefield = sanitize_text_field( $_POST['subtitle_field'] );
	$videofield= ( $_POST['video_field'] );
	
  update_post_meta($post_ID, 'subtitle', $subtitlefield);
  update_post_meta($post_ID, 'newsframe_video', $videofield);
  
  // or a custom table (see Further Reading section below)
}
function newsframe_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('upload-script', get_template_directory_uri().'/javascripts/upload-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('upload-script');
}
 
function newsframe_admin_styles() {
wp_enqueue_style('thickbox');
}
 
if (isset($_GET['page']) && $_GET['page'] == 'theme_options') {
add_action('admin_print_scripts', 'newsframe_admin_scripts');
add_action('admin_print_styles', 'newsframe_admin_styles');
}

function get_post_thumbnail_url($post_id){
        $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
        $thumbnail_id = get_post_thumbnail_id($post_id);
        if($thumbnail_id ){
                $thumb = wp_get_attachment_image_src($thumbnail_id, 'large');
                return $thumb[0];
        }else{
                return false;
        }
}

function get_system_info($name){
	global $wpdb;
	$value=$wpdb->get_var("select option_value from wp_options where option_name='$name'");
	return $value;
}


function add_views($post_id) {
	global $wpdb;
	$wpdb->query('update wp_posts set click=click+1 where ID='.$post_id);
}

function the_click($post_id) {
	global $wpdb;
	return $wpdb->get_var('select click from wp_posts where ID='.$post_id);
}

function new_article($limit){
	global $wpdb;
	$sql="select ID,post_title,post_date from $wpdb->posts where post_status='publish' and post_type='post' order by post_date desc limit $limit";
	$res=$wpdb->get_results($sql);
	return $res;
}


function category_news_posts(){
	
	$news_list=array();
	$cat_list=get_categories();
	foreach($cat_list as $k=>$v){
		$arg['category']=$v->term_id;
		$arg['orderby']='post_date';
		$arg['order']='DESC';
		$posts=get_posts($arg);
		foreach($posts as $row){
			if(!array_key_exists($row->ID,$news_list)){
				$news_list[$row->ID]['image']=get_post_thumbnail_url($row->ID);
				$news_list[$row->ID]['post_title']=$row->post_title;
				$news_list[$row->ID]['guid']=$row->guid;			
			}
			break;
		}
	}
	return $news_list;
}










