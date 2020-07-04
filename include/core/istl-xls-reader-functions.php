<?php
/*
 * XLS Importer
 */
function istl_xls_reader($xls_file_url) {    
    $xlsrecords = ''; 
//    $xls_file_url             = get_option('xls_file_url');
     if($xls_file_url!='') {
         include_once(get_stylesheet_directory().'/include/core/xls-file-reader/excel_reader.php');     // include the class
         $data = new PhpExcelReader;       
         $data->read($xls_file_url);          
         $sheetsdata = $data->sheets; 
         $xlsrecords = $sheetsdata['0']['cells'];
     }  else {
         echo 'Excel(.xls) file path not given.';
     }
    return $xlsrecords; 
}


/*
 * Custom XLS Reader Settings page
 */
add_action('admin_menu','istl_xls_reader_admin_menu');
function istl_xls_reader_admin_menu() {
    add_menu_page(
        __( 'Excel Reader Settings', 'textdomain' ),
        __( 'Excel Reader Settings', 'textdomain' ),
        'manage_options',
        'xls_reader_apis-settings',
        'xls_reader_settings_callback' 
    );
}


/*
 * Custom XLS Reader Settings Callback
 */ 
function xls_reader_settings_callback() {    
       ?>
    <div class="wrap">
        <h1><?php _e( 'Excel Reader Settings', 'textdomain' ); ?></h1>
        
        <?php if(isset($_POST['update_xls_reader_settings'])) {    
             
            $xls_file_url = trim($_POST['xls_file_url']);           
            update_option('xls_file_url',$xls_file_url);
            ?>
                <div class="notice notice-success is-dismissible">
                    <p>Settings updated.</p>
                </div>
            <?php 
        }  
        
        // Get Options
        $xls_file_url             = get_option('xls_file_url');

        $upload_dir   = wp_upload_dir();
        $example_xls = $upload_dir['path'];            
        
        if($xls_file_url=='') {      
            $xls_file_url = $upload_dir['path'];            
        } 
        
        ?>
        <div style="width:100%; display: inline-block;">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label>XLS File Path</label> <br />
                    <input style="width:100%; display: inline-block;" type="text" required="required" name="xls_file_url" value="<?php echo $xls_file_url; ?>"  />
                </p>
                <p class="description">example:  <code><?php echo $example_xls.'/sample.xls'; ?></code></p>
                <p><input type="submit" class="button button-primary" value="Update" name="update_xls_reader_settings" /></p>
            </form>
        </div>
    </div>
    <?php
} 

/*
 * XLS to Array Convertor Shortcode
 */  
//[show_xls_to_array]
add_shortcode('show_xls_to_array','istl_xls_to_array_convertor');
function istl_xls_to_array_convertor() {
    
    ?> 

    <h3>Upload excel file.</h3> 
    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
            <div id="drag_upload_file"> 
                    <p>Drop file here</p>
                    <p>or</p>
                    <p><input type="button" class="btn btn-default" value="Select File" onclick="file_explorer();"></p>
                    <input type="file" id="selectfile">
            </div>
    </div>
    <h3>Excel To Array</h3>
    <?php       
    $xls_file_url             = get_option('xls_file_url');
    $xls_output = istl_xls_reader($xls_file_url); 
    echo '<pre class="xls_output_result">';
    print_r($xls_output); 
    echo '</pre>';
    
    ?>


<?php 
} 


/*
 * Scripts
 */
add_action('wp_footer','istl_dropzone_scripts');  
function istl_dropzone_scripts() {   
//    wp_enqueue_script( 'istl-dropzone-script', get_stylesheet_directory_uri().'/js/dropzone/dropzone.js' );         
    $url         = admin_url( 'admin-ajax.php' );
    ?>
   <script >
	var fileobj; 
	function upload_file(e) {
		e.preventDefault();
		fileobj = e.dataTransfer.files[0];
		ajax_file_upload(fileobj);
	}

	function file_explorer() {
		document.getElementById('selectfile').click();
		document.getElementById('selectfile').onchange = function() {
		    fileobj = document.getElementById('selectfile').files[0];
			ajax_file_upload(fileobj);
		};
	}

	function ajax_file_upload(file_obj) {

		if(file_obj != undefined) {
		    var form_data = new FormData();                  
		    form_data.append('file', file_obj);
		    form_data.append('action', 'dragdrop_upload');
                    var uploadedfilename = form_data.get('file').name; 
                    jQuery('.uploaded_filename').remove(); 
                    jQuery('#drop_file_zone').append('<div class="uploaded_filename">'+uploadedfilename+'</div>');
			jQuery.ajax({
				type: 'POST', 
				url: '<?php echo $url; ?>',
                                contentType: false,  
				processData: false, 
                                data:form_data, 
				success:function(response) {
                                        alert(response);
                                        if(response==='Excel File Updated') {
                                            location.reload(); 
                                        }
					jQuery('#selectfile').val('');
				}, 
                                error: function(response){
                                    alert('Error');
                                }
			});
		}
	}
</script>
    <?php 
}
/*
 * Stype
 */
add_action('wp_head','istl_dropzone_style');
function istl_dropzone_style() {   
//    wp_enqueue_style( 'istl-dropzone-style', get_stylesheet_directory_uri().'/css/dropzone/dropzone.css' );
    ?>
        <style type="text/css">
        #drop_file_zone {
                background-color: #cc3433;
                border: 2px dashed #fff;
                width: 100%;
                height: 200px;
                padding: 20px 0;
                font-size: 20px;
                text-align: center;
                border-radius: 10px;
                box-shadow: 0 0 16px 0px #000;
                color: #fff;
        }
	#drag_upload_file {
		width:50%;
		margin:0 auto;
	}
	#drag_upload_file p {
		text-align: center;
	}
	#drag_upload_file #selectfile {
		display: none;
	}
        .xls_output_result {
            height: 400px;
            width: 100%; 
        } 
</style>
      <?php 
}
 

 
add_action( 'wp_ajax_nopriv_dragdrop_upload', 'istl_dropzonejs_upload' ); //allow on front-end
add_action( 'wp_ajax_dragdrop_upload', 'istl_dropzonejs_upload' );
function istl_dropzonejs_upload() {
    
        $xlsfile = $_FILES['file']; 
        
        if($xlsfile) {
            
            $filetype = $xlsfile['type'];
            
            if($filetype=='application/vnd.ms-excel') {
                
                $filename = $xlsfile['name'];
                $tmp_name = $xlsfile['tmp_name'];
                $error = $xlsfile['error'];
                $size = $xlsfile['size'];
                 
//                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );

                $_FILES = array ("demo_excel_file" => $xlsfile); 

                $attachment_id = media_handle_upload( 'demo_excel_file', '' ); 

                if ( is_wp_error( $attachment_id ) ) {
                    // There was an error uploading the image.
                } else {
                // The image was uploaded successfully!
                    echo 'Excel File Updated';
                    $fullsize_path = get_attached_file( $attachment_id );
                    update_option('xls_file_url',$fullsize_path); 
                }

                
            } else {
                echo "Incorrect file format. Please upload .xls file.";
            }
            
        }
        
    	wp_die(); 
}
