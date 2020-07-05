<?php


// Register Nav Menu 
register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'skythemes-default' ),
        'footer' => __( 'Footer Menu', 'skythemes-default' ),
) );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );


/* Setup Theme Widgets */
function custom_tutorsincity_widgets_init() { 

  register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'tutorsincity' ),
    'description'   => 'It will display on Post Details OR Listing pages.',
    'id'            => 'main-sidebar-1',
    'before_widget' => '<div id="%1$s" class="card widget_card %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<div class="card-header bg-primary"><h3 class="text-white">',
    'after_title'   => '</h3></div><div class="card-body">',
  ));  
    
  register_sidebar( array(
    'name'          => __( 'Footer Sidebar1', 'tutorsincity' ),
    'id'            => 'footer-sidebar-1',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title f_20_26 m_b_20 text-uppercase">',
    'after_title'   => '</h3>',
  ));  
   
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar2', 'tutorsincity' ),
    'id'            => 'footer-sidebar-2',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title f_20_26 m_b_20 text-uppercase">',
    'after_title'   => '</h3>',
  )); 
    
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar3', 'tutorsincity' ),
    'id'            => 'footer-sidebar-3',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title f_20_26 m_b_20 text-uppercase">',
    'after_title'   => '</h3>',
  )); 
   
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar4', 'tutorsincity' ),
    'id'            => 'footer-sidebar-4',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title f_20_26 m_b_20 text-uppercase">',
    'after_title'   => '</h3>',
  )); 
  
         
}  
add_action( 'widgets_init', 'custom_tutorsincity_widgets_init',10, 0 ); 
 

 /*
  * Related Posts Function
  */
function istl_related_posts() {
    
    $categories = get_the_category();

    if ( $categories ) { ?>

        <div class="istl-related-posts">
            <h2><?php _e( 'Related Posts', 'hitmag' ); ?></h2>
                <div class="form-row">
                    <?php
                    $first_category = esc_attr( $categories[0]->term_id );
                    $args = array(
                        'cat'                   => array($first_category),
                        'post__not_in'          => array($post->ID),
                        'posts_per_page'        => 4,
                        'ignore_sticky_posts'   => true
                    );

                    $related_posts = new WP_Query($args);

                    if( $related_posts->have_posts() ) :
                        while ($related_posts->have_posts()) : $related_posts->the_post(); ?>

                            <div class="col-sm-6">
                                <div class="istl_related_post">
                                    <a class="img_thum_wr" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('medium'); ?> 
                                    </a>
                                    <h3 class="istl_related_post-title">
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="istl_related_post_text"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                    <!--<p class="hms-meta"><?php //echo hitmag_posted_datetime() ?></p>--> 
                                </div>
                            </div>

                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                    
            </div>
        </div>

        <?php

    }
    
}

/*
  * Related Posts Function
  */
function istl_related_custom_posts($taxonomy = 'tutorial_cat', $post_id = '') {
    
    if($post_id=='') {
        $post_id = get_the_ID(); 
    }
    if($taxonomy!='') {
    $categories = get_the_terms(get_the_ID(),$taxonomy);
 
    if ( $categories ) { ?>

        <div class="istl-related-posts">
            <h2><?php _e( 'Related Posts', 'hitmag' ); ?></h2>
                <div class="row">
                    <?php
                    $first_category = esc_attr( $categories[0]->term_id );
                     $taxargs = array(
                      array(
                                'taxonomy' => $taxonomy,  
                                'field' => 'id',
                                'terms' => $first_category,  
                                'include_children' => false
                            )
                         );
                    

                    $args = array(
                        'post__not_in'          => array($post_id),
                        'posts_per_page'        => 4,
                        'ignore_sticky_posts'   => true,
                        'post_type' => 'tutorial',
                        'tax_query' => $taxarg
                    );

                    $related_posts = new WP_Query($args);

                    if( $related_posts->have_posts() ) :
                        while ($related_posts->have_posts()) : $related_posts->the_post(); ?>

                            <div class="col-sm-6">
                                <div class="istl_related_post">
                                    <a class="img_thum_wr" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('medium'); ?> 
                                    </a>
                                    <h3 class="istl_related_post-title">
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="istl_related_post_text"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                    <!--<p class="hms-meta"><?php //echo hitmag_posted_datetime() ?></p>--> 
                                </div>
                            </div>

                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                    
            </div>
        </div>

        <?php
        }
    }
    
}

//Current Page Class in Body
function add_page_name_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $page_slug = $post->post_name;    
        $classes[] = 'page-'.$page_slug;
    }
    return $classes;
}
add_filter( 'body_class', 'add_page_name_class' );

/*
 * Limit Search To Post Type
 */
function searchfilter($query) {
 
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('tutorial'));
    }
 
return $query;
}
 
add_filter('pre_get_posts','searchfilter');


/*
 * Sy Pagination
 */
function sy_wp_pagination() {
global $wp_query;
$big = 999999999999;
$page_format = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type'  => 'array'
) );
if( is_array($page_format) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="custom_paginations"><ul>';
            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
            foreach ( $page_format as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div>';
}
}


/*
* Sign Blog Popup
*/

function jscript_redirect($url) {

	?> 
	<script >
	window.location.href="<?php echo $url; ?>"; 
	</script>
	
	<?php
	die();

}

  
/*
* Admin Script and Styles
*/
function rmradvsys_admin_enqueue_scripts() {
                  
    wp_enqueue_media();
             
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script( 'rmradvsys-scripts', get_stylesheet_directory_uri().'/js/custom.js', array( 'jquery'), '20181001', true );
    wp_localize_script( 'rmradvsys-scripts', 'LOCOBJ', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'tic_security' => wp_create_nonce( 'tic_setting_nonce_action' ),
    )); 
     
} 
add_action( 'wp_footer', 'rmradvsys_admin_enqueue_scripts' );  


/*
 * Function Actived Links
 */
function activated($v1, $v2) {
    if($v1==$v2) {
        echo 'active';
    }
}
  

  
/*
 * istl_theme_entry_meta
 */
function istl_theme_entry_meta() {
    
    // Translators: used between list items, there is a space after the comma.
        $categories = get_the_category_list( __( ', ', 'tutorsincity' ) );
        if($categories!='') {
            $categories_list = '<span class="category" itemprop="articleSection"><i class="fa fa-bookmark"></i> '. $categories . "</span>";
            echo $categories_list;
        }
  

    $date = sprintf( '<span class="date"><i class="fas fa-clock"></i> <a href="%1$s" title="%2$s" rel="bookmark"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a></span>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ), 
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
        echo $date;

//  $author = sprintf( '<span itemprop="author"><i class="fas fa-user"></i><span class="author"><a href="%1$s" title="%2$s" rel="">%3$s</a></span></span>',
//      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
//      esc_attr( sprintf( __( 'View all posts by %s', 'tutorsincity' ), get_the_author() ) ),
//      get_the_author()
//  );
    
//  $comment_number = get_comments_number();
//  $comment_number = sprintf( _n( '1 Comment', '%s Comments', $comment_number, 'tutorsincity' ), $comment_number );
//  $comment_number =  sprintf( ' <span class="comments" itemprop="interactionCount"> <i class="fa fa-comment"></i><a href="%1$s" title="%2$s" rel="comments">%2$s</a></span>',
//      get_comments_link(),
//      $comment_number
//  );

    // Translators: used between list items, there is a space after the comma.
        $tags = get_the_tag_list( '', __( ', ', 'tutorsincity' ) );
        if($tags!='') {
            $tag_list = '<span class="tags"> <i class="fas fa-tags"></i> '.$tags. '</span>';
            echo $tag_list;
        }
  
//        echo $author ;
//        echo $comment_number ;

}