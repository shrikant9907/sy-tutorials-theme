<div class="bg_orange ptb_20_10 text-center">
        
        <!--Form HTML Start-->
        <form action="" class="search_box relative w_600 mx_auto" method="get" autocomplete="off"> 
            <input type="hidden" name="post_type" value="tutorial" />
            <input class="r_10 p_x_20 border-0 w-100 p_y_10 m_b_10 " type="text" name="s" required="required" placeholder="Enter keywords to search programs..." />
            <button class="bg-transparent border-0 absolute fixed_top_right top_10 c_p right_10" type="submit" title="Search Submit"><i class="fas fa-search text_orange"></i></button>
            <?php $search_result = false; 
                if($search_result) {
            ?>
            <div class="card text-left f_14_18 border-0">    
                <div class="card-body px-3">
                <h4 class="card-title f_16_18">Enter keywords to search programs.</h4>
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
