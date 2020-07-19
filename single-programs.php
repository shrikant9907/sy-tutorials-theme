<?php get_header();

$programsPath = get_template_directory().'/tutscodes/programs/';
$term_taxonomy = 'programs-category';
$term_obj_list = get_the_terms( $post->ID, $term_taxonomy );
$term_id = $term_obj_list['0']->term_id;
$term_name = $term_obj_list['0']->name;

 ?> 
           
<section class="page-section">
<h1 class="bg_orange bg_orange_grid m_b_30 p_t_20 p_b_20 text-white f_24_26 text-center"><?php the_title(); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">

                <!-- Tutorials List -->
                <?php
                $args   =   array(
                                    'post_type'         =>  'programs',
                                    'posts_per_page'    =>  -1, 
                                    'orderby'           =>  'date', 
                                    'order'             =>  'asc', 
                                    'tax_query'         =>  array(
                                                                array(
                                                                        'taxonomy' => $term_taxonomy,
                                                                        'field' => 'id',
                                                                        'terms' => $term_id, 
                                                                        'include_children' => false
                                                                    )
                                                                )
                                );  
                query_posts($args);
                $count = 1;
                if(have_posts()):
                ?>
                <ul class='list-group list-group-flush list-unstyled m_b_30'> 
                    <li class=" r_2 bg_orange p_y_10 p_x_20 text-white font_bold"><?php echo $term_name; ?></li>
                    <?php   
                        while(have_posts()): the_post();  
                        $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
                    ?>
                        <li class="list-group-item bg-light p_10 p_x_20 f_14_16">
                        <?php echo $count; ?>) <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="post-date pull-right"></span>
                        </li> 
                    <?php 
                        $count++;
                        endwhile; 
                        wp_reset_query();
                    ?>
                </ul>   
                <?php endif; ?>   

                <!-- Related Posts -->
                <div class="category_menus r_5 bg-light p_20 m_b_30">
                    <p class="m_b_5">Recommended programs for you:</p> 
                    <?php   
                    // Post Tags
                    $taxonomies = get_terms( array(
                            'taxonomy' => 'programs-category', 
                            'hide_empty' => true,
                            'parent'=>0,
                            'order' => 'asc',
                            'orderby' => 'name'
                        )
                    );

                    if ( !empty($taxonomies) ) { 
                        foreach( $taxonomies as $category ) { 
                        $term_link = get_term_link( $category );
                            if($category->parent == 0) {
                                $output.= '<a class="badge badge-primary bg-primary badge-pills btn-sm m_r_5 m_b_5" href="'.$term_link.'">'. esc_html( $category->name ) .'</a>';
                            }
                        }
                        echo $output; 
                    } 
                    ?>  
                </div>

            <?php //get_sidebar(); ?>
            </div>
            <div class="col-12 col-md-7">
                    <div class="left_side">
                        <?php 
                            if(have_posts()):   
                                $count = 0;
                                while(have_posts()): the_post();  
                        ?>
                        <div class="card m_b_30">
                            
                            <div class="card-header bg_orange"><h3 class="f_18_22 m-0 text-white"><?php the_title(); ?></h3></div>
                            
                            <div class="card-body f_14_22">
                                <?php 
                                $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
                                ?>

                                <?php if(has_post_thumbnail()) { ?>
                                    <div class='article-image-wr'>
                                        <img src='<?php echo $image; ?>' alt='<?php the_title(); ?>' />
                                    </div> 
                                <?php } ?>
                                <!-- <div class='article-meta-data'><?php //istl_theme_entry_meta(); ?></div> -->
                   
                                <div class="article-content">
                                    <?php the_content(); ?>
                                    <div class="tutorials_article">
                                    <?php 
                                    $methods = $cfs->get('methods'); 
                                    if($methods){ ?>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/xml.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/javascript.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/css.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/clike.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/php.js"></script> 
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/python.js"></script> 
                                        <?php 
                                        $count = 1;
                                        foreach($methods as $method){
                                            
                                            $methodTitle = $method['method_title'];
                                            $methodOptions = $method['method_options'];
                                            echo '<div class="method p_b_20 m_b_20 border-bottom">';
                                            echo "<h3 class='f_18_20 text_orange'>$methodTitle</h3>";
                                            foreach($methodOptions as $option) {
                                                $mode = $option['mode'];
                                                $description = $option['description'];
                                                $note = $option['note'];
                                                $file = htmlspecialchars($option['file']);
                                                if($file!=''){   
                                                    $headerfile = $programsPath.$mode.'/'.$file;    
                                                    $headercode = htmlspecialchars(file_get_contents($headerfile));  
                                                    echo "<textarea id='showcode_2$count'>$headercode</textarea>";
                                                ?>
                                                <script>
                                                  var editor = CodeMirror.fromTextArea(document.getElementById("showcode_2<?php echo $count; ?>"), {
                                                    lineNumbers: true,
                                                    styleActiveLine: false,
                                                    matchBrackets: true,
                                                    mode: "<?php echo $mode; ?>",
                                                    readOnly: true
                                                  });
                                                </script> 
                                            <?php
       
                                                }                                        
                                            }
                                            echo '<div class="description m_t_20">'.$description.'</div>';
                                            if ($note){
                                                echo '<div class="alert-warning rounded p_x_20 p_y_10 m_t_10">'.$note.'</div>';
                                            }
                                            echo "</div>";
                                            $count++;
                                        }
                                    }?>
                                                
                                    </div>    
                                </div>
                            </div> 
                        </div>
                        <div class="single_posts_nav d-flex justify-content-between">
                             <?php
                            $prev_post = get_previous_post();
                            if (!empty( $prev_post )): ?>
                             <div class='article-prev'>
                                <a class="btn btn-secondary m_b_20 d-inline-block" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">Previous: <?php //echo esc_attr( $prev_post->post_title ); ?></a>
                            </div>
                            <?php endif ?>

                            <?php
                            $next_post = get_next_post();
                            if (!empty( $next_post )): ?>
                            <div class='article-nextpost'>
                                <a class="btn btn-secondary d-inline-block" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">Next: <?php //echo esc_attr( $next_post->post_title ); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php // echo do_shortcode('[starbox id="23"]'); ?>                 
                        
                        <?php  
                            endwhile; 
                            endif; 
                        ?>      
                
                    </div> 
                
                <!--Related Posts-->
                <?php istl_related_posts(); ?>
                
                <?php comment_form(); ?>

            </div>
          </div>
        </div>
    </div>
</section>
      
<?php get_footer(); ?> 



