<?php

/*
* Sign Blog Popup
*/

function jscript_redirect($url) {

	?> 
	<script >
	window.location.href="<?php echo $url; ?>"; 
	</script>
	
	<?php
	die();

}