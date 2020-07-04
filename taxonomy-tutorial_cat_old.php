<?php get_header(); ?> 


<?php
// Current Term
$term_id = get_queried_object()->term_id;
$term = get_term_by('id', $term_id, 'tutorial_cat');
$term_name = $term->name; 
$term_slug = $term->slug; 
$term_taxonomy = $term->taxonomy; 
?>


<section class="page-section">
<h1 class="bg_orange bg_orange_grid m_b_30 p_t_20 p_b_20 text-white f_24_26 text-center">Category: <?php echo $term_name; ?></h1>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="category_menus r_5 bg-light p_20 m_b_30">
            <p class="m_b_5">Related Categories:</p> 
                <?php   
                // Post Tags
                $taxonomies = get_terms( array(
                        'taxonomy' => $term_taxonomy, 
                        'hide_empty' => true,
                        'parent'=>0,
                        'order' => 'desc',
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
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-12 page_content">
        <div class="row">
           
             <div class="col-xs-12 col-sm-8">
                <?php
                    $taxargs = array(
                      array(
                                'taxonomy' => $term_taxonomy,
                                'field' => 'id',
                                'terms' => $term_id, 
                                'include_children' => false
                            )
                         );

                $args  = array('post_type'=>'tutorial', 'posts_per_page'=>-1, 'orderby' => 'date', 'order' => 'asc', 'tax_query' => $taxargs );  
                query_posts($args);
                $count = 1;
                if(have_posts()):
            ?>
                <ul class='list-group list-group-flush list-unstyled'> 
            
                <?php          while(have_posts()): the_post();  
           $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; ?>
                
                    <li class="list-group-item p_10"><?php echo $count; ?>) <a href="<?php the_permalink(); ?>" target="_blank" ><?php the_title(); ?></a> <span class="post-date pull-right"></span></li> 
                 <?php 
                 $count++;
                 endwhile; ?>
                </ul>   
                <?php endif; ?>   
                 
            </div>
            <?php get_sidebar(); ?>
            
           </div>
        </div>
    </div>
</section>
      
<?php get_footer(); 