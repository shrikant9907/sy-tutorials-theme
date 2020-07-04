<div id="welcome-message-box" class="welcome-message-panel text-center">
    <div class="welcome-panel-message">
        <h2>Welcome to WordPress Front End Dashboard</h2>
        <p class="about-description">We’ve assembled some links to get you started:</p>
    </div>
</div> 

<div class="row">
    <div class="col-sm-4 col-xs-12">
        <div class="your-active-plan">
                <h2>Active Plan</h2>
                <?php if($active_plan!='') { ?>
                    <p>
                        <b><?php echo $active_plan; ?></b>
                    </p>
                    <p><a href="#">Send us a mail</a> to upgrade/change your plan.</p> 
                <?php } else { ?>
                    <p>You don't have any active plan.</p> 
                    <p><a href="#">Send us a mail</a> to get a free plan.</p> 
                <?php } ?>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="our-plugins col-fd-common">
                <h2>Free Plugins</h2>
                <p>You will get access to your plugins based on active plans.</p> 
                <p><a href="#">Click here</a> to view the plugins.</p> 
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="our-themes col-fd-common">
                <h2>Free Themes</h2>
                <p>You will get access to your themes based on active plans.</p> 
                <p><a href="#">Click here</a> to view the themes.</p> 
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-sm-4 col-xs-12">
        <div class="my-links col-fd-common">
                <h2>My Links</h2> 
                <p>You can manage links here.</p>  
                <p><a href="#">Click here</a> to view links.</p> 
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="my-notifications col-fd-common">
                <h2>Notifications</h2>
                <p>You will get access to your plugins based on active plans.</p> 
                <p><a href="#">Click here</a> to view the plugins.</p> 
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="my-recommendation col-fd-common">
                <h2>Settings</h2>
                <p><a href="#">Click here</a> to manage your account.</p> 
        </div>
    </div>
</div>    