

<?php get_header(); ?>

<!-- Banner Section  -->

<section class="section-banner section-banner-pages">
    <div class="container text-center">
         <h2>Search Results Found For: <?php the_search_query(); ?></h2>
    </div>
</section>

<!-- Banner Section End -->

 <section class="section-recommandedtheme section-common">
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <h2 class="main-heading">From <span>Posts, Codes, Tutorials</span></h2>    
        
        <?php 
            if(have_posts()): while(have_posts()): the_post();
            $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
        ?>
        <div class="col-sm-4 col-xs-12">
            <div class="products_item">
                    <div class="product_description">
                        <h2><a target="_blank" href="<?php the_permalink(); ?>">  <?php the_title(); ?></a></h2>  
                        <p><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                    </div>
            </div>
        </div>

        <?php endwhile; wp_pagenavi(); ?>
       <?php endif; ?>  
        </div>
    </div>        
    </div>
</section>

<?php /*
 <section class="section-recommandedhosting section-common section-purple">
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <h2 class="main-heading"> From <span>Tutorials</span></h2>   
        <?php 
            $args  = array('post_type'=>'tutorial', 'posts_per_page'=>6, 'orderby' => 'date', 'order' => 'asc');  
            query_posts($args);
            if(have_posts()): while(have_posts()): the_post();
            $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
        ?>
        <div class="col-sm-4 col-xs-12">
            <div class="products_item">
                <a target="_blank" href="<?php the_permalink(); ?>"> <div class="product-box">
                     
                    <?php if(has_post_thumbnail()) { ?>
                    <img class="img-responsive" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
                    <?php } ?>
                    
                </div>
                </a>    
                <div class="product_description">
                    <h2><a target="_blank" href="<?php the_permalink(); ?>">  <?php the_title(); ?></a></h2>  
                    <p><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                   </div>
            </div>
        </div>

        <?php endwhile; wp_reset_query();  ?>
       <?php endif; ?>         
        </div>
    </div>        
    </div>
</section>

 <section class="section-recommandedservices section-common">
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <h2 class="main-heading"> From <span>Codes</span></h2>    
        <?php 
            $args  = array('post_type'=>'codes', 'posts_per_page'=>6, 'orderby' => 'date', 'order' => 'asc');  
            query_posts($args);
            if(have_posts()): while(have_posts()): the_post();
            $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ; 
        ?>
        <div class="col-sm-4 col-xs-12">
            <div class="products_item codes">
                <div class="product_description">
                    <h2><a target="_blank" href="<?php the_permalink(); ?>">  <?php the_title(); ?></a></h2>  
                    <p><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                   </div>
            </div>
        </div>

        <?php endwhile; wp_reset_query();  ?>
       <?php endif; ?>  
 
        </div>
    </div>        
    </div>
</section>
 
*/?>
 


<?php get_footer(); ?>
