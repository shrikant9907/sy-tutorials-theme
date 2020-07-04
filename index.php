<?php get_header(); ?> 
 
<section class="page-section">
    <h1 class="text-white m_b_30 page-heading p_t_90 p_b_30 text-center f_26_28"><?php the_title(); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="left_side">
                    <?php 
                        if(have_posts()): 
                            $count = 0;
                            while(have_posts()): the_post();  
                    ?>
                    <div class="card m_b_30">
                            <div class="card-header bg-light"><h3 class="f_18_22 m-0"><a class="t_deco_none d-block" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3></div>
                            <div class="card-body f_14_22">
                                <?php echo wp_trim_words(get_the_content(), 30); ?>
                                <div class="row text-muted f_12_14 m_t_20">
                                    <div class="col-6">
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
                                    <div class="col-6">
                                        <span><i class="fas fa-tags m_r_10"></i> Tags: 
                                            <?php
                                                $tags = get_tags();
                                                foreach ( $tags as $tag ) {
                                                    $tag_link = get_tag_link( $tag->term_id );
                                                             
                                                    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                                                    $html .= "{$tag->name}</a>";
                                                }
                                                echo $html;
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light f_12_16">
                                <div class="form-row">
                                    <div class="col-8">
                                         <?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): 
                                              $author_id =  get_the_author_meta('ID'); ?>
                                            <span class="w_40 d-inline-block m_r_10"><img src="<?php echo esc_url( get_avatar_url( $author_idD ) ); ?>" class="img-fluid img-thumbnail rounded-circle" alt=""></span>
                                        <?php endif; ?> 
                                         <span class="d-inline-block">Posted by: <?php the_author(); ?>, <?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' ); ?></span>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="m_t_10">Posted on: <?php echo get_the_date(); ?></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                         
                    <?php 
                        endwhile; 
                        sy_wp_pagination();
                        endif; 
                    ?>      
            
                    </div>
        
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
      
<?php get_footer(); 