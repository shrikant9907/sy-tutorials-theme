<?php


// Register Nav Menu 
register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'skythemes-default' ),
        'footer' => __( 'Footer Menu', 'skythemes-default' ),
) );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Register Sidebar
function wpb_widgets_init() {

	register_sidebar( array( 
		'name' => __( 'Main Sidebar', 'wpb' ),
		'id' => 'sidebar-right',
		'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget-text">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
        
	register_sidebar( array( 
		'name' => __( 'Tutorials Sidebar', 'wpb' ),
		'id' => 'sidebar-tutorials',
		'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget-text">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
        
	register_sidebar( array( 
		'name' => __( 'Footer Sidebar1', 'wpb' ),
		'id' => 'footer-sidebar-1',
		'description' => __( 'The main sidebar appears on the footer on each page.', 'wpb' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-text">',
	) );
	
        register_sidebar( array( 
		'name' => __( 'Footer Sidebar2', 'wpb' ),
		'id' => 'footer-sidebar-2',
		'description' => __( 'The main sidebar appears on the footer on each page.', 'wpb' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-text">',
	) );
        
        register_sidebar( array( 
		'name' => __( 'Footer Sidebar3', 'wpb' ),
		'id' => 'footer-sidebar-3',  
		'description' => __( 'The main sidebar appears on the footer on each page.', 'wpb' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-text">',
	) );
        
        register_sidebar( array( 
		'name' => __( 'Footer Sidebar4', 'wpb' ),
		'id' => 'footer-sidebar-4',
		'description' => __( 'The main sidebar appears on the footer on each page.', 'wpb' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-text">',
	) );
                
	}

add_action( 'widgets_init', 'wpb_widgets_init' );

/*
 * Admin Scripts
 */
function istl_admin_enqueue_scripts() {
    global $pagenow, $typenow;
    // Admin Styles 
    wp_enqueue_style( 'istl-jquery-ui-style', get_stylesheet_directory_uri().'/css/jquery-ui.css' );
    wp_enqueue_style( 'istl-admin-style', get_stylesheet_directory_uri().'/css/admin-style.css' );
 
    // Admin Scripts
    wp_enqueue_script( 'istl-admin-scripts', get_stylesheet_directory_uri().'/js/admin-scripts.js', array( 'jquery-ui-datepicker'), '20170926', true );

}
add_action( 'admin_enqueue_scripts', 'istl_admin_enqueue_scripts' );

/*
 * Scripts
 */
add_action('wp_footer','istl_wp_footer_scripts');

function istl_wp_footer_scripts() {   
wp_enqueue_script( 'theme-scripts-ajax', get_stylesheet_directory_uri().'/js/theme-scripts-ajax.js' );     

     wp_localize_script('theme-scripts-ajax', 'local', array(
     'ajaxurl' => admin_url('admin-ajax.php')
     ));

 }  

/*
 * istl_theme_entry_meta
 */
function istl_theme_entry_meta() {
	
	// Translators: used between list items, there is a space after the comma.
	$categories_list = '<span class="category" itemprop="articleSection"><i class="fa fa-bookmark"></i>'. get_the_category_list( __( ', ', 'simple-east' ) ) . "</span>";
  

	$date = sprintf( '<span class="date"><i class="fa fa-clock-o"></i><a href="%1$s" title="%2$s" rel="bookmark"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span itemprop="author"><i class="fa fa-user"></i><span class="author"><a href="%1$s" title="%2$s" rel="">%3$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'simple-east' ), get_the_author() ) ),
		get_the_author()
	);
	
	$comment_number = get_comments_number();
	$comment_number = sprintf( _n( '1 Comment', '%s Comments', $comment_number, 'simple-east' ), $comment_number );
	$comment_number =  sprintf( ' <span class="comments" itemprop="interactionCount"> <i class="fa fa-comment"></i><a href="%1$s" title="%2$s" rel="comments">%2$s</a></span>',
		get_comments_link(),
		$comment_number
	);

	// Translators: used between list items, there is a space after the comma.
	$tag_list = '<span class="tags"> <i class="fa fa-tags"></i>'. get_the_tag_list( '', __( ', ', 'simple-east' ) ). '</span>';
  
 	
	$utility_text = __( ' %1$s %3$s %4$s %5$s %2$s ', 'simple-east' );	
	
  	// Translators: 1 is category, 2 is tag, 3 is the date, 4 is the author's name and 5 is comments.
	/*
	if ( $tag_list ) {
		$utility_text = __( ' %1$s %3$s %4$s %5$s %2$s ', 'simple-east' );
	} elseif ( $categories_list ) {
		$utility_text = __( ' %1$s %3$s %4$s %5$s %2$s ', 'simple-east' );
	} else {
		$utility_text = __( ' %1$s %3$s %4$s %5$s %2$s ', 'simple-east' );
	}
	*/
	
		echo $categories_list ;
		echo $tag_list ;
		echo $date ;
		echo $author ;
//		echo $comment_number ;
	
 /*	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author,
		$comment_number
	);
	*/
}

/*
 * File Upload Function 
 */
function istl_upload_file($xlsfile) {
        
        $output = array();
      
        if($xlsfile) { 

                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );

                $_FILES = array ("custom_file_upload" => $xlsfile); 
                $attachment_id = media_handle_upload( 'custom_file_upload', '' ); 

                if ( is_wp_error( $attachment_id ) ) {
                    $output['error'] = 1;
                } else {
                    
                    $file_path = get_attached_file( $attachment_id );
                    $file_url = wp_get_attachment_url( $attachment_id );
                    
                    $output['error'] = 0;
                    $output['attachment_id'] = $attachment_id; 
                    $output['file_path'] = $file_path;    
                    $output['file_url'] = $file_url;   

                }
        }  
        
        return $output; 
}

/*
 * File Upload Function 
 */
function istl_upload_file_php($xlsfile) {
        
        $output = array();
      
        if($xlsfile) { 
       
            $errors= array();
            $file_name = $xlsfile['name'];
            $file_size = $xlsfile['size'];
            $file_tmp = $xlsfile['tmp_name'];
            $file_type = $xlsfile['type'];
            $file_ext=strtolower(end(explode('.',$xlsfile['name'])));

            $expensions= array("xls");

            if(in_array($file_ext,$expensions)=== false){
               $errors[]="extension not allowed, please choose a Excel or .xls file.";
            }

            if($file_size > 2097152) {
               $errors[]='File size must be excately 2 MB';
            }
            
            $upload_dir = wp_upload_dir();
            $upload_dir_path = $upload_dir['basedir'];   

            if(empty($errors)==true) {
                move_uploaded_file($file_tmp, $upload_dir_path."/xlsfiles/".$file_name);
                $output['error'] = 0;
                $output['attachment_id'] = 0; 
                $output['file_path'] = $upload_dir_path."/xlsfiles/".$file_name;    
                $output['file_url'] = '';   
            }else{
                $output['error'] = 1;
                $output['error_message'] = $errors;
            } 
        }  
        
//         print_r($errors);
        return $output; 
}


/*
 * Get my IP
 */
function istl_get_my_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    //check ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    //to check ip is pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

/*
 * Format JSON
 */
function istl_format_json($json) { 

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;

        // If this character is the end of an element,
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }

        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }

        $prevChar = $char;
    }

    return $result;
}


 /*
  * Related Posts Function
  */
function istl_related_posts() {
    
    $categories = get_the_category();

    if ( $categories ) { ?>

        <div class="istl-related-posts">
            <h2><?php _e( 'Related Posts', 'hitmag' ); ?></h2>
                <div class="row">
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
        $query->set('post_type',array('post','codes','tutorial'));
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
            echo '<div><ul>';
            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
            foreach ( $page_format as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div>';
}
}