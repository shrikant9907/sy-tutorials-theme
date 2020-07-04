<?php 

$myuser_roles = implode(',',$user_roles);

?>
<div class="user_profile_view clearfix">
        <div class="col-sm-4 view_profile_details">
            <img src="http://shrikantyadav.com/wp-content/uploads/2018/01/shrikant-img1.png" alt="Shrikant Yadav Profile Image">
            <h2>Hi, <?php echo $firstname; ?> </h2>
            <p><i class="fa fa-envelope"></i><?php echo $user_email; ?></p>
            <?php if($user_contact!='') { ?>
            <p><i class="fa fa-phone"></i><?php echo $user_contact; ?></p> 
            <?php } if($skype_id!='') {?>
            <p><i class="fa fa-skype"></i><?php echo $skype_id; ?></p>  
            <?php } if($user_address!='') {?>
            <?php } if($user_url!='') {?>
            <p><i class="fa fa-globe"></i><?php echo $user_url; ?></p>  
            <?php } if($user_address!='') {?>
            <p><i class="fa fa-map-marker"></i><?php echo $user_address; ?></p>  
            <?php } ?>
        </div>
        <div class="col-sm-8 view_profile_detail_fields">
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Username:</div><div class="col-xs-12 col-sm-8"><?php echo $user_login; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Display Name:</div><div class="col-xs-12 col-sm-8"><?php echo $displayname; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">First Name:</div><div class="col-xs-12 col-sm-8"><?php echo $firstname; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Last Name:</div><div class="col-xs-12 col-sm-8"><?php echo $lastname; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Email ID:</div><div class="col-xs-12 col-sm-8"><?php echo $user_email; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Alternative Email ID:</div><div class="col-xs-12 col-sm-8"><?php echo $user_email; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Address:</div><div class="col-xs-12 col-sm-8"><?php echo $user_address; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Contact Number:</div><div class="col-xs-12 col-sm-8"><?php echo $user_contact; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Alternative Number:</div><div class="col-xs-12 col-sm-8"><?php echo $user_contact; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Fax Number:</div><div class="col-xs-12 col-sm-8"><?php echo $user_fax; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Skype ID:</div><div class="col-xs-12 col-sm-8"><?php echo $skype_id; ?></div></div>
            <div class=" profile_view_row"><div class="col-xs-12 col-sm-4 ">Roles:</div><div class="col-xs-12 col-sm-8"><?php echo $myuser_roles; ?></div></div>
        </div>
</div>