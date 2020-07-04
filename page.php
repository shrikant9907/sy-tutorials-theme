<?php get_header(); ?> 
 
<section class="page-section">
    <h1 class="text-white m_b_30 page-heading p_t_90 p_b_30 text-center f_26_28"><?php the_title(); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php 
                if(have_posts()): while(have_posts()): the_post(); 
                the_content(); 
                endwhile; endif; 
                ?>
            </div>
        </div>
    </div>
</section>
      
<?php get_footer();  