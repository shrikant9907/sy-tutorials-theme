<?php get_header(); ?>

<section class="page-section bg-white">
    <h1 class="text-center p_y_40 f_30_34">Page not found.</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <i class="fas display-1 text_orange fa-frown-open"></i>
                <div class="p_y_20">
                    <h2 class="m_b_20 text-danger"><b>Opps!</b></h2>
                    <h3 class="text_orange f_20_26 m_b_20">The page your are looking for does not exist.</h3>
                    <p><a class="btn btn-primary p_x_30" href='<?php echo site_url('/'); ?>'>Go To Home page</a></p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>