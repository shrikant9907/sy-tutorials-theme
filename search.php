<?php get_header(); ?> 
<div class="bg-dark ptb_20_10 text-center">
    
    <!--Form HTML Start-->
    <form action="" class="search_box relative w_600 mx_auto" method="get" autocomplete="off"> 
        <input type="hidden" name="post_type" value="tutorial" />
        <input class="r_20 p_x_20 border-0 w-100 p_y_10 m_b_10 " value="<?php echo $_GET['s']; ?>" type="text" name="s" required="required" placeholder="Search..." />
        <button class="bg-transparent border-0 absolute fixed_top_right top_10 c_p right_10" type="submit" title="Search Submit"><i class="fas fa-search"></i></button>
        <?php $search_result = false; 
            if($search_result) {
        ?>
        <div class="card text-left f_14_18 border-0">    
            <div class="card-body px-3">
            <h4 class="card-title f_16_18">Search result:</h4>
                <div class="list-group">
                    <a href="#" class="px-3 list-group-item list-group-item-action"></a>
                </div>
            </div>
        </div>
        <?php
            } 
        ?>
    </form>   
    <!--Form HTML End-->   
    
</div>
<section class="page-section">
    <h1 class="bg_orange bg_orange_grid m_b_30 p_t_20 p_b_20 text-white f_24_26 text-center">Search result for: <?php the_search_query(); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                 
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

                <?php //get_sidebar(); ?>
            </div>
            <div class="col-12 col-sm-7">
                <div class="left_side">
                    <?php  
                        if(have_posts()): 
                            $count = 0;
                            while(have_posts()): the_post();  
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
                                <?php echo wp_trim_words(get_the_content(), 50) ?>
                            </div>

                            <div class="button_wr p_t_10">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary px-3 f_14_16"> Read more <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php  
                        endwhile; 
                    ?>
                    <div class="pagenavi text-center">
                        <?php wp_pagenavi(); ?>
                    </div>
                    <?php
                        wp_reset_query();
                        endif; 
                    ?>      
                    <?php echo do_shortcode('[starbox id="23"]'); ?>       
                </div> 
            </div>
        </div>
    </div>
</section>
      
<?php get_footer(); 