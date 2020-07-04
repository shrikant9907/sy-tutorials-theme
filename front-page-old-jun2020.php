<!doctype html>
<html <?php language_attributes(); ?>>
    <head> 
        
            
          <title>Shrikant Yadav | Fullstack Developer<?php //wp_title(); ?></title>
          
          <!-- Required meta tags -->
          <meta charset="<?php bloginfo( 'charset' ); ?>">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="google-site-verification" content="YLQihgCVo22EoKTfvFY58VvdD0R6ZGrq6Odor2ypjcI" />
 
          <!-- Text Fonts -->
          <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
          
          <!-- required CSS -->
          <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.min.css" />

          <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />
          <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/responsive.css" />
 
          <?php if(is_page('starcss') || is_singular('tutorial')) { ?>
            <!-- Code Mirror CSS -->
            <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/codemirror.css">
          <?php } ?>

          <?php wp_head(); ?>
 
    </head>

<body id="home" <?php body_class('module1 f_16_22'); ?>> 

<header class="fixed-top header">
    <div class="container">
        <div class="row">
            <div class="col-md-3"> 
                <a class="d-block logo_text p_t_20 text-white f_24_28 t_deco_none" href="<?php echo site_url(); ?>">
                  <strong>Shrikant</strong> Yadav 
                </a>
            </div>
            <div class="col-md-9  text-right header_mobile_control">
                <div class="header_menus">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('#about'); ?>">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('#services'); ?>">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('#blog'); ?>">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('/tutorials'); ?>">Tutorials</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('/examples'); ?>">Examples</a>
                            </li>
                            <li class="nav-item dropdown d-none"> 
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#tutorials" role="button" aria-haspopup="true" aria-expanded="false">Tutorials</a>
                                <div class="dropdown-menu"> 
                                    <a class="dropdown-item" href="<?php echo site_url('/tutorial_tag/web-design/'); ?>">Web Design</a>
                                    <a class="dropdown-item" href="<?php echo site_url('/tutorial_tag/wordpress/'); ?>">WordPress</a>
                                    <a class="dropdown-item" href="<?php echo site_url('/tutorial_tag/php/'); ?>">PHP</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('#contact'); ?>">Contact</a>
                            </li>
                          </ul>
                        </div>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</header>  



<?php $show_banner = $cfs->get('show_banner_section');

if(is_array($show_banner) && in_array('Yes',$show_banner)) {

 $banner_heading = $cfs->get('banner_heading');
 $banner_sub_heading = $cfs->get('banner_sub_heading');
 $banner_content = $cfs->get('banner_content');
 $banner_tag_line = $cfs->get('banner_tag_line');
 $banner_bg_img = $cfs->get('banner_background_image');
 $banner_social_links = $cfs->get('banner_social_links');

?>  

<!-- Banner Start -->
<?php 

if($banner_bg_img!='') {
?> 
    <div class="banner text-white p_b_100 box_vheight_100" style="background-image: url('<?php echo $banner_bg_img; ?>');" >  
<?php } else { ?>
    <div class="banner text-white p_b_100 box_vheight_100">  
<?php } ?>
    <div class="container w_1000"> 
        <div class="row"> 
        <div class="col-12"> 
                <h1 class="text-white p_t_50 m_b_20 f_50_50"><?php echo $banner_heading; ?></h1>
                <h2 class="m_b_20"><?php echo $banner_sub_heading; ?></h2>
                <div class="f_18_20 w_mx_100p mx-auto">
                    <p><?php echo $banner_content; ?><p>
                    <small class="heading_after2"><?php echo $banner_tag_line; ?></small>

                    <!-- Social Links Start -->
                    <?php if($banner_social_links) { ?>

                    <div class="social_links">
                        <?php foreach($banner_social_links as $links) { ?>
                            <a href="<?php echo $links['link']['url']; ?>" title="<?php echo $links['link']['text']; ?>" target="<?php echo $links['link']['target']; ?>"><?php echo $links['icon']; ?></a>
                        <?php } ?>
                    </div>  

                    <?php } ?>

                   <!-- Social Links End -->

                </div>
            
        </div>
        </div>
    </div>
    <div id="about"></div>
    <!-- Mouse scroller start -->
    <div  class="mouse_scroll_down">
        <div class="mouse light">
            <div class="scroller"></div>
        </div>
    </div>
    <!-- Mouse Scroller End -->
</div>
<?php } ?>
<!-- Banner End -->


<!-- About Section Start -->
<?php $show_about = $cfs->get('show_about_section');

if(is_array($show_about) && in_array('Yes',$show_about)) {

 $about_heading = $cfs->get('about_heading');
 $about_sub_heading = $cfs->get('about_sub_heading');
 $about_description = $cfs->get('about_description');
 $about_skills = $cfs->get('about_skills');
 $cv_link = $cfs->get('about_download_cv_link');
 $contact_link = $cfs->get('about_contact_link');

?>   
<section  class="about_section bg_grey p_b_50">  
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="p_40 w_1000 r_10 box_shw2 mx-auto bg-white m_t_n100">
                    <h2 class="heading_style type_2 text-center m_b_40 text-primary"><span><?php echo $about_heading; ?></span></h2>
                    <h3 class="m_b_20 f_20_26 text-center"><?php echo $about_sub_heading; ?></h3>
                    <p class="m_b_20"><?php echo $about_description; ?></p>
                
                    <h3 class="m_b_10 f_20_26">Skills</h3>
                    <div class="form-row">
                        <?php if($about_skills) { 
                            foreach($about_skills as $skill) { ?>
                            <div class="col-12 col-md-6">
                                <div class="progress h_20 m_b_10 rounded-0">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $skill['skill_marks']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skill['skill_marks']; ?>%"><?php echo $skill['skill_name']; ?> - <?php echo $skill['skill_marks']; ?>%</div>
                                </div>
                                <div class="skill_description d-none"><?php echo $skill['skill_description']; ?></div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 col-md-6"></div> -->
            
        </div>

    </div>  
</section> 
    <?php } ?>
<!-- About Section End -->


<!-- Services Section Start -->
<?php $show_services = $cfs->get('show_services_section');

if(is_array($show_services) && in_array('Yes',$show_services)) {

 $services_heading = $cfs->get('services_heading');
 $services_sub_heading = $cfs->get('services_sub_heading');
 $services_description = $cfs->get('services_description');
 $services_list = $cfs->get('services_list');

?>   
<section id="services" class="ptb_80_70 bg_grey_light">  
    <div class="container">
        
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style type_2 text-center m_b_40 text-primary"><?php echo $services_heading; ?></h2>
                    <h3 class="m_b_30 f_20_26"><?php echo $services_sub_heading; ?></h3>
                    <p class="m_b_50"><?php echo $services_description; ?></p>
                </div>

            </div>
        </div>             
        
        <div class="w_1000 mx-auto">
            <div class="row">
        
                <!--Card Start -->
                <?php if($services_list) { 

                foreach($services_list as $service) {
                $link = $service['link'];
                ?>
                <div class='col-12 col-sm-6 col-md-4'>
                    <div class="card m_b_10 p_y_30 font-weight-bold border-0 text-center bg-light">
                        <?php echo $service['name']; ?>
                    </div>
                </div>  
                <?php } ?>
            <?php } else { ?>
                <div class='col-12'>
                    <p>Services not found.</p>
                </div>  
            <?php } ?>
                <!-- Card End -->
            
            </div>
        </div> 
    </div>  
</section> 
    <?php } ?>
<!-- Services Section End -->

<!-- Snippets Section Start -->
<?php $show_snippets = $cfs->get('show_snippets');

if(is_array($show_snippets) && in_array('Yes',$show_snippets)) {

 $snippets_heading = $cfs->get('snippets_heading');
 $snippets_sub_heading = $cfs->get('snippets_sub_heading');
 $snippets_description = $cfs->get('snippets_description');
 $snippets_numbers = $cfs->get('snippets_numbers');
 $snippets_view_more = $cfs->get('snippets_view_more');

?> 
<section id="snippets" class="ptb_80_70 bg_grey_light">
    <div class="container">
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style type_2 text-center m_b_40 text-primary"><?php echo $snippets_heading; ?></h2>
                    <h3 class="m_b_30 f_20_26"><?php echo $snippets_sub_heading; ?></h3>
                    <p class="m_b_50"><?php echo $snippets_description; ?></p>
                </div>

            </div>
        </div>             
        
        <div class="w_1000 mx-auto">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card box_shw2 border-0" >
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p class="text-center"><a href="#" class="btn btn-primary">View More</a></p>  
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card box_shw2 border-0" >
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p class="text-center"><a href="#" class="btn btn-primary">View More</a></p>  
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card box_shw2 border-0" >
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p class="text-center"><a href="#" class="btn btn-primary">View More</a></p>  
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?php } ?>
<!-- Snippets Section End -->
 

<!-- Portfolio Section Start -->
<?php $show_portfolio = $cfs->get('show_portfolio_section');

if(is_array($show_portfolio) && in_array('Yes',$show_portfolio)) {

 $portfolio_heading = $cfs->get('portfolio_heading');
 $portfolio_sub_heading = $cfs->get('portfolio_sub_heading');
 $portfolio_description = $cfs->get('portfolio_description');
 $portfolio_items = $cfs->get('portfolio_items');

?> 
<section id="portfolio" class="ptb_80_50 bg-primary text-white">
    <div class="container">
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style type_2 text-center m_b_40 text-white"><?php echo $portfolio_heading; ?></h2>
                    <h3 class="m_b_30 f_20_26"><?php echo $portfolio_sub_heading; ?></h3>
                    <p class="m_b_50"><?php echo $portfolio_description; ?></p>
                </div>

            </div>
        </div>             
        

        <div class="w_1000 mx-auto">
            <div class="form-row">
                <?php if($portfolio_items) {
                    foreach($portfolio_items as $portfolio_item) {
                        ?>
                        <div class="col-12 col-md-3">
                            <div class="card m_b_30 border-0 " >
                                <img src="<?php echo $portfolio_item['image']; ?>" class="card-img-top" alt="<?php echo $portfolio_item['description']; ?>">
                                <div class="card-body d-none">
                                    <p class="card-text"><?php echo $portfolio_item['description']; ?></p>
                                    <p class="text-center"><a href="<?php echo $portfolio_item['item']['url']; ?>" target="<?php echo $portfolio_item['item']['target']; ?>" class="btn btn-primary">View More</a></p>  
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>
</section>
<?php } ?>
<!-- Portfolio Section End -->

<!-- Reviews Section Start -->
<?php $show_reviews = $cfs->get('show_reviews_section');
if(is_array($show_reviews) && in_array('Yes',$show_reviews)) {

 $reviews_heading = $cfs->get('reviews_heading'); 
 $reviews_sub_heading = $cfs->get('reviews_sub_heading'); 
 $reviews_description = $cfs->get('reviews_description'); 
 $reviews_numbers = $cfs->get('reviews_numbers');
 $reviews_view_more = $cfs->get('reviews_view_more');
  
?> 
<section id="reviews" class="ptb_80_50 bg_grey_light">
    <div class="container">
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style type_2 text-center m_b_40 text-primary"><?php echo $reviews_heading; ?></h2>
                    <h3 class="m_b_30 f_20_26"><?php echo $reviews_sub_heading; ?></h3>
                    <p class="m_b_50"><?php echo $reviews_description; ?></p>
                </div>

            </div>
        </div>             
        
        <div class="w_1000 mx-auto">
            <div class="row">
                <?php

                $args  = array('post_type'=>'testimonials', 'posts_per_page'=> $reviews_numbers, 'orderby' => 'date', 'order' => 'desc');  
                query_posts($args);
                $count = 1;
                if(have_posts()):
                    while(have_posts()): the_post();  
                    $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ;
                    $post_id = get_the_ID();
                    $company = get_post_meta($post_id, 'company', true);
                    $star_rate = get_post_meta($post_id, 'star_rate', true);
                ?>
                <div class="col-12 col-md-4">
                    <div class="card bg-primary text-white h_300 mb-3 py-4 testimonials_card3 position-releative border-0 rounded-lg">
                        <div class="mx-auto text-center py-2">
                            <img class=" d-none card_image img-thumbnail" src="<?php echo $image; ?>">
                            <div class="card-icon position-absolute">
                                <i class="fas fa-quote-left text-light"></i>
                            </div>
                            <div class="card-icon card-icon2 position-absolute">
                                <i class="fas fa-quote-right text-light"></i>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="card-text mb-3 mi_h_100">
                                <?php the_content(); ?>
                            </div>
                            <h5 class="card-title font-weight-bold"><?php the_title(); ?></h5>
                            <p class="d-none"><small class="text-secondary"> - <?php echo  $company; ?></small></p>
                        </div>
                
                    </div>
                </div>
                <?php 
                    $count++;
                    endwhile; 
                    wp_reset_query();
                endif; 
                ?>  
            </div>
        </div>

    </div>
</section>
<?php } ?>
<!-- Reviews Section End -->

<!-- Blog Section Start -->
<?php $show_blogs = $cfs->get('show_blog_section');
if(is_array($show_blogs) && in_array('Yes',$show_blogs)) {

 $blog_heading = $cfs->get('blog_heading'); 
 $blog_sub_heading = $cfs->get('blog_sub_heading'); 
 $blog_description = $cfs->get('blog_description'); 
 $blog_post_numbers = $cfs->get('blog_post_numbers');
 $blog_view_more = $cfs->get('blog_view_more');
 
?> 
<section id="blog" class="ptb_80_50 bg-light">
    <div class="container">
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style type_2 text-center m_b_40 text-primary"><?php echo $blog_heading; ?></h2>
                    <h3 class="m_b_30 f_20_26"><?php echo $blog_sub_heading; ?></h3>
                    <p class="m_b_50"><?php echo $blog_description; ?></p>
                </div>

            </div>
        </div>             
        
        <div class="w_1000 mx-auto">
            <div class="row">
                <div class="col-12">
                    <div class="card box_shw2 border-0 m_b_40 p_l_30 p_20 w_700 mx-auto" >
                        <ul class="list-group list-group-flush list-unstyled">
                                <?php
                                $args  = array('post_type'=>'post', 'posts_per_page'=> $blog_post_numbers, 'orderby' => 'date', 'order' => 'desc');  
                                query_posts($args);
                                $count = 1;
                                if(have_posts()):
                                    while(have_posts()): the_post();  
                                    $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ;
                                ?>
                                    
                                    <li class="list-group-item pl-0 border-0 pr-0"><i class="fas fa-chevron-right text-primary m_r_10"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                               
                                <?php 
                                    $count++;
                                    endwhile; 
                                    wp_reset_query();
                                endif; 
                                ?>  
                        </ul>
                    </div>
                    <p class="text-center"><a  target="_blank" href="<?php echo site_url('/blog'); ?>" class="btn btn-primary btn-lg rounded-0 f_16_22">Click here to view more blog posts</a></p>
                </div>
            </div>
        </div>

    </div>
</section>
<?php } ?>
<!-- Blog Section End -->

<!-- Tutorials Section Start -->
<section id="tutorials" class="ptb_50_40 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="heading_style type_2 text-center m_b_50 text-primary">Tutorials / Codes / Snippet</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center">Latest updates from tutorials and codes.</p>
                <div class="card box_shw2 border-0 m_b_40 p_l_30 p_20 w_700 mx-auto" >
                    <ul class="list-group list-group-flush list-unstyled m_b_30">
                            <?php
                            $args  = array('post_type'=>'tutorial', 'posts_per_page'=> 5, 'orderby' => 'date', 'order' => 'desc');  
                            query_posts($args);
                            $count = 1;
                            if(have_posts()):
                                while(have_posts()): the_post();  
                                $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ;
                            ?>
                                
                                <li class="list-group-item pl-0 border-0 pr-0"><i class="fas fa-chevron-right text-primary m_r_10"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                           
                            <?php 
                                $count++;
                                endwhile; 
                                wp_reset_query();
                            endif; 
                            ?>  
                    </ul>
                          <p class="text-center"><a  target="_blank" href="<?php echo site_url('/tutorials'); ?>" class="btn btn-primary btn-lg rounded-0 f_16_22">Click here to view more tutorials</a></p>
                    </div>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="m_b_20 f_20_26">Categories</h3>
                <div class="page_content">
                    <ul class="p-0">
                        <?php 
                        $terms = get_terms( 'tutorial_cat', array(
                                'hide_empty' => true,
                        ) );

                        if($terms) {
                            foreach($terms as $term_key => $term_val) {
                                $term_link = get_term_link( $term_val );
                                echo '<li class="d-inline"><a  class="badge badge-primary bg-primary m_b_5 m_r_5" href="'.$term_link.'">'.$term_val->name.'</a></li>';

                            }
                        } 
                        ?>                        
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="m_b_20 f_20_26">Tags</h3>
                <div class="page_content">
                    <ul class="p-0">
                        <?php 
                        $terms = get_terms( 'tutorial_tag', array(
                                'hide_empty' => true,
                        ) );

                        if($terms) {
                            foreach($terms as $term_key => $term_val) {
                                $term_link = get_term_link( $term_val );
                                echo '<li class="d-inline"><a class="badge badge-primary bg-primary m_b_5 m_r_5" href="'.$term_link.'">'.$term_val->name.'</a></li>';

                            }
                        } 
                        ?>                        
                    </ul>
                </div>
            </div>


        </div>
           
   </div>
</section>
<!-- Tutorials Section End -->


<!-- Facts Section Start -->
<?php $show_facts = $cfs->get('show_facts_section');
if(is_array($show_facts) && in_array('Yes',$show_facts)) {

 $facts_heading = $cfs->get('facts_heading'); 
 $facts_items = $cfs->get('facts_items');
 
?> 
<section id="facts" class="ptb_50_40 bg-primary">
    <div class="container w_1000">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="heading_style type_2 text-center m_b_50 text-white"><?php echo $facts_heading; ?></h2>
            </div>
        </div>
    
        <div class="row">
            <?php 
                if($facts_items) { 
                    foreach($facts_items as $fact) {
                        ?>
                        <div class="col-12 col-md-4">
                            <div class="card-facts order-0 text-center text-white" >
                                <div class="card-text f_18_22 text-uppercase m_b_20"><?php echo $fact['name']; ?></div>
                                <div class="card-number font-weight-bold f_30_34 m_b_20"><?php echo $fact['numbers']; ?></div>
                            </div>
                        </div>
                        <?php 
                    }
                } 
            ?>       
        </div>
    </div>
</section>
<?php } ?>
<!-- Facts Section End -->



<!-- Contact Section Start -->
<?php $show_contact = $cfs->get('show_contact_section');
if(is_array($show_contact) && in_array('Yes',$show_contact)) {

 $contact_column_type       =   $cfs->get('contact_column_type'); 
 $contact_heading           =   $cfs->get('contact_heading'); 
 $contact_sub_heading       =   $cfs->get('contact_sub_heading'); 
 $contact_description       =   $cfs->get('contact_description');
 $contact_form_shortcode    =   $cfs->get('contact_form_shortcode');
 // $contact_map_iframe = $cfs->get('contact_map_iframe');
  
?> 
<section id="contact" class="ptb_80_70 position-relative bg_grey">
    <!-- <iframe class="google_map_contactpage position-absolute" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117738.34447462665!2d77.66118265817344!3d22.75338153112091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397dcfb9c99dc1ef%3A0x46fc29c3c4b1b05c!2sHoshangabad%2C+Madhya+Pradesh!5e0!3m2!1sen!2sin!4v1537082442731" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
    <div class="container">
        <div class="w_800 mx-auto">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="heading_style m_b_30"><?php echo $contact_heading; ?></h2>
                    <!-- <h3 class="m_b_30 f_20_22"><?php //echo $contact_sub_heading; ?></h3> -->
                    <!-- <div class="m_b_50"><?php //echo $contact_description; ?></divr> -->
                </div>

            </div>
        </div>             
        
        <div class="w_1000 mx-auto">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                    <div class="card box_shw2 border-0 p_20 r_10 m_b_10" >
                        <div class="card-header bg-white f_20_22 border-0 text-center">Contact me for your queries.</div>
                        <div class="card-body">
                            <?php echo do_shortcode($contact_form_shortcode); ?>       
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php } ?>
<!-- Contact Section End -->

     <footer class="footer_style1 p_t_20 f_14_18 bg_grey">

            <div class="container">
                <div class="row">
                   <div class="col-12 text-center">
                     <div class=" p_y_10 bg-light w_600 mx-auto r_20">
                       
                            <ul class="menu inline-item-group p_x_20 m-0">
                              <li class="d-inline-block"><a href="<?php echo site_url('/faqs/'); ?>">FAQs</a></li>
                              <li class="d-inline-block p_x_20"><a href="<?php echo site_url('/privacy-policy/'); ?>">Privacy Policy</a></li>
                              <li class="d-inline-block p_x_20"><a href="?php echo site_url('/sitemap/'); ?>">Sitemap</a></li>
                            </ul>

                     </div>
                   </div>
                </div> 
                <div class="row">     
                    <div class="col-12 text-center p_y_20">© <?php echo date('Y'); ?>. All rights reserved.</div>
                </div>
            </div>
        </div>
    
    </footer>     
    
    <?php wp_footer(); ?>
    
    <?php if(is_page('starcss')) { ?>

      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/xml.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/javascript.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/css.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/clike.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/codemirror/mode/php.js"></script> 

    <?php } ?>
   
  </body>
</html> 