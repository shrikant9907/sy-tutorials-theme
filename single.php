<?php get_header(); ?> 
 
<section class="page-section">
<h1 class="bg_orange bg_orange_grid m_b_30 p_t_20 p_b_20 text-white f_24_26 text-center">Blog Details</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                
                <?php echo get_sidebar(); ?>
            
                <!-- Related Posts -->
                <div class="category_menus r_5 bg-light p_20 m_b_30">
                    <p class="m_b_5">Recommended tutorials for you:</p> 
                    <?php   
                    // Post Tags
                    $taxonomies = get_terms( array(
                            'taxonomy' => 'tutorial_cat', 
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


            </div> 
            <div class="col-12 col-md-7">
                    <div class="left_side">
                        <?php  
                            if(have_posts()): 
                                $count = 0;
                                while(have_posts()): the_post();  
                        ?>
                        <div class="card m_b_30">
                             <div class="card-header bg-light"><h3 class="f_18_22 m-0"><a class="t_deco_none d-block" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3></div>

                            <div class="card-body f_14_22">
                                <?php 
                                $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
                                ?>

                                <?php if(has_post_thumbnail()) { ?>
                                    <div class='article-image-wr'>
                                        <img src='<?php echo $image; ?>' alt='<?php the_title(); ?>' />
                                    </div>
                                <?php } ?>
                                <div class="row text-muted f_12_14 m_b_20">
                                    <div class="col-4">
                                        <span><i class="fa fa-bookmark m_r_10"></i> Categories:  
                                            <?php

                                                $categories = get_the_category();
                                                $separator = ' ';
                                                $output = '';
                                                if ( ! empty( $categories ) ) {
                                                    foreach( $categories as $category ) {
                                                        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                                    }
                                                    echo trim( $output, $separator );
                                                }

                                            ?></span>
                                    </div>
                                    <div class="col-4">
                                        <span><i class="fas fa-tags m_r_10"></i> Tags: 
                                            <?php
                                                $tags = get_the_tags();
                                                foreach ( $tags as $tag ) {
                                                    $tag_link = get_tag_link( $tag->term_id );
                                                             
                                                    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                                                    $html .= "{$tag->name}</a>";
                                                }
                                                echo $html;
                                            ?>
                                        </span>
                                    </div>

                                    <div class="col-4">
                                        <span><i class="fas fa-clock m_r_10"></i>Posted on: <?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                          
                                <?php the_content(); ?>
                            </div>


                        </div>
                                         
                        <div class="single_posts_nav">
                             <?php
                            $prev_post = get_previous_post();
                            if (!empty( $prev_post )): ?>
                             <div class='article-prev'>
                                <a class="btn btn-secondary" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">Previous: <?php echo esc_attr( $prev_post->post_title ); ?></a>
                            </div>
                            <?php endif ?>

                            <?php
                            $next_post = get_next_post();
                            if (!empty( $next_post )): ?>
                            <div class='article-nextpost'>
                                <a class="btn btn-secondary" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">Next: <?php echo esc_attr( $next_post->post_title ); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php // echo do_shortcode('[starbox id="23"]'); ?>                 
                                
                        <?php  
                            endwhile; 
                            endif; 
                        ?>      
                
                    </div>
                
                <?php  //comment_form(); ?>

            </div>
            
            <?php //get_sidebar(); ?>  
            
          </div>
        </div>
    </div>
</section>
       
<?php get_footer(); 