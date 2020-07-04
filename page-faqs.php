<?php get_header(); ?> 
 
<section class="page_content_section faqs_page">
<h1 class="page-main-heading">Frequently Asked Questions (FAQs)</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 page_content faq_questions_content">
                
                <div class="nav flex-column nav-pills faq_vertical_menus" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">Students</a>
                    <a class="nav-link" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="true">Tutors</a>
                </div>
                
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
                        <h3>Students</h3>
                        
                        <div id="accordion" class="accordion">
                        <?php 
                            $args  = array(
                                'post_type'=>'faq', 
                                'posts_per_page'=>-1, 
                                'orderby' => 'date', 
                                'order' => 'desc',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'faq_cat',
                                        'terms' => 5,
                                        'include_children' => false // Remove if you need posts from term 7 child terms
                                    ),
                                ),
                                );   
                            $posts = query_posts($args); 

                            if(have_posts()): 
                                $count = 0;
                                while(have_posts()): the_post();  

                        ?>
                          <div class="card">
                            <div class="card-header" id="headingOne<?php the_ID(); ?>">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapseOne<?php the_ID(); ?>">
                                 <?php the_title(); ?>
                                
                                <i class="fas fa-angle-down"></i>
                                <i class="fas fa-angle-up"></i>
                                
                                </button>
                              </h5>
                            </div>
     
                            <div id="collapseOne<?php the_ID(); ?>" class="collapse <?php if($count==0) { echo 'show'; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <?php the_content(); ?>
                              </div>
                            </div>
                          </div>
                            
                        <?php 
                            $count++;    
                            endwhile; 
                        wp_reset_query(); endif; ?>      
                
                        </div>
                        
                    </div>
                    <div class="tab-pane fade show" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                        <h3>Tutors</h3>
                        <div id="accordion" class="accordion">
                        <?php 
                            $args  = array(
                                'post_type'=>'faq', 
                                'posts_per_page'=>-1, 
                                'orderby' => 'date', 
                                'order' => 'desc',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'faq_cat',
                                        'terms' => 4,
                                        'include_children' => false // Remove if you need posts from term 7 child terms
                                    ),
                                ),
                                );    
                            $posts = query_posts($args); 

                            if(have_posts()): 
                                $count = 0;
                                while(have_posts()): the_post();  

                        ?>
                          <div class="card">
                            <div class="card-header" id="headingOne<?php the_ID(); ?>">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapseOne<?php the_ID(); ?>">
                                 <?php the_title(); ?>
                                
                                <i class="fas fa-angle-down"></i>
                                <i class="fas fa-angle-up"></i>
                                
                                </button>
                              </h5>
                            </div>
     
                            <div id="collapseOne<?php the_ID(); ?>" class="collapse <?php if($count==0) { echo 'show'; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <?php the_content(); ?>
                              </div>
                            </div>
                          </div>
                            
                        <?php 
                            $count++;    
                            endwhile; 
                        wp_reset_query(); endif; ?>      
                
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
      
<?php get_footer(); 