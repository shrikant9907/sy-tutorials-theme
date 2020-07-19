<?php get_header(); ?> 

<?php
// Current Term
$term_id = get_queried_object()->term_id;
$term = get_term_by('id', $term_id, 'programs-category');
$term_name = $term->name; 
$term_slug = $term->slug; 
$term_taxonomy = $term->taxonomy; 
?>

<section class="page-section">
    <h1 class="bg_orange bg_orange_grid m_b_30 p_t_20 p_b_20 text-white f_24_26 text-center">Category: <?php echo $term_name; ?></h1>
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
                    <li class="bg_orange p_y_10 p_x_20 text-white font_bold"><?php echo $term_name; ?></li>
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
                    ?>
                </ul>   
                <?php endif; ?>   
                
                <!-- Related Posts -->
                <div class="category_menus r_5 bg-light p_20 m_b_30">
                    <p class="m_b_5">Recommended tutorials for you:</p> 
                    <?php   
                    // Post Tags
                    $taxonomies = get_terms( array(
                            'taxonomy' => $term_taxonomy, 
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
            <div class="col-12 col-sm-7">
                <div class="left_side">
                    <?php  
                        $args   =   array(
                            'post_type'         =>  'programs',
                            'posts_per_page'    =>  5, 
                            'orderby'           =>  'date', 
                            'order'             =>  'desc', 
                            'tax_query'         =>  array(
                                                        array(
                                                                'taxonomy' => $term_taxonomy,
                                                                'field' => 'id',
                                                                'terms' => $term_id, 
                                                                'include_children' => false
                                                            )
                                                        )
                        );  
                        $the_query = new WP_Query( $args ); 
                        if($the_query->have_posts()): 
                            $count = 0;
                            while($the_query->have_posts()): $the_query->the_post();  
                    ?>
                    <div class="card rounded-0 m_b_30 border-0">
                        <div class="card-header bg-white p_20"><h3 class="f_18_22 m-0"><a class="t_deco_none d-block" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3></div>

                        <div class="card-body f_14_22">
                            <?php 
                            $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
                            ?>

                            <?php if(has_post_thumbnail()) { ?>
                                <div class='article-image-wr'>
                                    <img src='<?php echo $image; ?>' alt='<?php the_title(); ?>' />
                                </div>
                            <?php } ?>
                            
                            <div class="article-content">
                                <?php the_content(); ?>
                                <div class="tutorials_article">
                                    <?php 
                                    $tutorials = $cfs->get('tutorials_loops'); 
                                    $download_url = $cfs->get('_download_url'); 
                                    $demo_url = $cfs->get('_demo_link'); 
//                                    print_r($tutorials);  
                                    if($tutorials){ ?>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/xml.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/javascript.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/css.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/clike.js"></script>
                                        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/php.js"></script> 
                                        <?php 
                                        $count = 1;
                                        foreach($tutorials as $tutorial){
                                            
                                            $text = $tutorial['_text'];
                                            $image = $tutorial['_image'];   
                                            $code = htmlspecialchars($tutorial['_code']);
                                            $code2 = htmlspecialchars($tutorial['_code2']);
                                              
                                            echo $text;
                                            if($code2!=''){   
                                                 echo "<textarea id='showcode_1$count'>$code2</textarea>";
                                                 ?>
                                            <script>

                                            //  Editor 1  
                                              var editor = CodeMirror.fromTextArea(document.getElementById("showcode_1<?php echo $count; ?>"), {
                                                lineNumbers: true,
                                                styleActiveLine: false,
                                                matchBrackets: false
                                              });

                                            </script> 
                                                 <?php
                                            }
                                            if($code!=''){   
                                                // Get File 
                                                $headerfile = CODEPATH.$code;    
                                                $headercode = htmlspecialchars(file_get_contents($headerfile));  
                
                                                echo "<textarea id='showcode_2$count'>$headercode</textarea>";
                                                     ?>
                                            <script>

                                            //  Editor 2  
                                              var editor = CodeMirror.fromTextArea(document.getElementById("showcode_2<?php echo $count; ?>"), {
                                                lineNumbers: true,
                                                styleActiveLine: false,
                                                matchBrackets: false
                                              });

                                            </script> 
                                             
                                                <?php
   
                                            }
                                             
                                            if($image!='') {    
                                                ?>
                                                <img class="img-fluid tutorials_image" src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
                                                <?php 
                                            } 
                                            
                                            $count++;
                                        }
                                    }?>
                                                 
                                    <div class="article_buttons">   
                                        <?php if($download_url!='') { ?>
                                            <a href="<?php echo $download_url; ?>" class="btn btn-primary" download>Download</a>      
                                        <?php } ?>
                                        <?php if($demo_url!='') { ?>
                                            <!-- <a href="<?php echo $demo_url; ?>" target="_blank" class="btn btn-primary">View Demo</a>       -->
                                        <?php } ?>
                                    </div>
                                                
                                    </div>    
                                </div>
                            </div>
                        </div>
                    <?php  
                        endwhile; 
                        wp_reset_query();
                        endif; 
                    ?>      
                    <?php // echo do_shortcode('[starbox id="23"]'); ?>       
                </div> 
            </div>
        </div>
    </div>
</section>
      
<?php get_footer(); 