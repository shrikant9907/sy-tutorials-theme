<?php get_header(); ?>

<section class="page-section">
    <h1 class="text-white m_b_30 page-heading p_t_90 p_b_30 text-center f_26_28">Error 404</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-center">
                <i class="fas fa-frown-open"></i>
            </div>
            <div class="col-sm-6">
                <div class="p_y_20">
                    <h2 class="m_b_20 text-danger"><b>Sorry!</b></h2>
                    <h3 class="text-primary f_20_26 m_b_20">The page your are looking for does not exist.</h3>
                    <p>I can help you to reach your DESTINATION</p>
                    <p>You can view <a href='<?php echo site_url('/tutorials'); ?>'>Tutorials</a>, <a href='<?php echo site_url('/blog'); ?>'>Blog</a></p>
                    <p>OR</p>
                    <p><a href='<?php echo site_url('/'); ?>'>Go To Homepage</a></p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>