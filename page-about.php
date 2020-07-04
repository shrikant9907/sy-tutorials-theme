<?php get_header(); ?> 
 
<section class="page_content_section bg-white">
<h1 class="page-main-heading"><?php the_title(); ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-12 page_content">
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