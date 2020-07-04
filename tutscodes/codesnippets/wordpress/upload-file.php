<?php
/*
 * File Upload Function 
 */
function istl_upload_file_php($xlsfile) {
        
        $output = array();
      
        if($xlsfile) { 
       
            $errors= array();
            $file_name = $xlsfile['name'];
            $file_size = $xlsfile['size'];
            $file_tmp = $xlsfile['tmp_name'];
            $file_type = $xlsfile['type'];
            $file_ext=strtolower(end(explode('.',$xlsfile['name'])));

            $expensions= array("xls");

            if(in_array($file_ext,$expensions)=== false){
               $errors[]="extension not allowed, please choose a Excel or .xls file.";
            }

            if($file_size > 2097152) {
               $errors[]='File size must be excately 2 MB';
            }
            
            $upload_dir = wp_upload_dir();
            $upload_dir_path = $upload_dir['basedir'];   

            if(empty($errors)==true) {
                move_uploaded_file($file_tmp, $upload_dir_path."/xlsfiles/".$file_name);
                $output['error'] = 0;
                $output['attachment_id'] = 0; 
                $output['file_path'] = $upload_dir_path."/xlsfiles/".$file_name;    
                $output['file_url'] = '';   
            }else{
                $output['error'] = 1;
                $output['error_message'] = $errors;
            } 
        }  
        
//         print_r($errors);
        return $output; 
}
