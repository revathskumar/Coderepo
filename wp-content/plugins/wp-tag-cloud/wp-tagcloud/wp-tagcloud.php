<?php
/*
Plugin Name: Jquery Tag Cloud
Plugin URI: www.impettech.com
Description: A plugin to display tag cloud
Version: 1.00
Author: Ali Raza Alvi
Author URI: www.impettech.com
*/
//Function to show the HN Link.
function display_cloud_tag()
{
//echo '<script src="jquery.js" type="text/javascript">;
$options['cloud_tag_width'] = get_option('cloud_tag_width'); 
$options['tag_cloud_height'] = get_option('tag_cloud_height');
$options['tag_cloud_background_color'] = get_option('tag_cloud_background_color');


if(isset($options['cloud_tag_width']) && $options['cloud_tag_width']!="")
$options['cloud_tag_width']=$options['cloud_tag_width'];
else
$options['cloud_tag_width'] = 300;


if(isset($options['tag_cloud_height']) && $options['tag_cloud_height']!="")
$options['tag_cloud_height']=$options['tag_cloud_height'];
else
$options['tag_cloud_height'] = 300;

if(isset($options['tag_cloud_background_color']) && $options['tag_cloud_background_color']!="")
$options['tag_cloud_background_color']='#'.$options['tag_cloud_background_color'];
else
$options['tag_cloud_background_color'] = '#000';
echo '<div id="div_tag_cloud" style="width:'.$options['cloud_tag_width'].'px;height:'.$options['tag_cloud_height'].'px; word-wrap: break-word;">';
echo '<canvas width="'.$options['cloud_tag_width'].'px" height="'.$options['tag_cloud_height'].'px" id="myCanvas" style="background-color:'.$options['tag_cloud_background_color'].';">';
//wp_tag_cloud( $args = array('format'=> 'flat') );
$tag = wp_tag_cloud('smallest=14&largest=30&number=50&orderby=count&format=array' );
foreach($tag as $tags)
{
	echo "$tags&nbsp;&nbsp;";
}
echo '</canvas>';
echo '</div>';
}

function tag_cloud_add_files()
{
$plug_path=plugin_basename(dirname(__FILE__));

echo '<script src="'. WP_PLUGIN_URL.'/'.$plug_path.'/jquery.js" type="text/javascript"></script>';
echo '<script src="'. WP_PLUGIN_URL.'/'.$plug_path.'/jq.tagcanvas.js" type="text/javascript"></script>';

$options['tag_cloud_max_speed'] = get_option('tag_cloud_max_speed'); 
$options['tag_cloud_depth'] = get_option('tag_cloud_depth');
$options['tag_cloud_text_color'] = get_option('tag_cloud_text_color');


if(isset($options['tag_cloud_max_speed']) && $options['tag_cloud_max_speed']!="")
$options['tag_cloud_max_speed']=$options['tag_cloud_max_speed'];
else
$options['tag_cloud_max_speed'] = 0.01;

if(isset($options['tag_cloud_depth']) && $options['tag_cloud_depth']!="")
$options['tag_cloud_depth']=$options['tag_cloud_depth'];
else
$options['tag_cloud_depth'] = 0.75;

if(isset($options['tag_cloud_text_color']) && $options['tag_cloud_text_color']!="")
$options['tag_cloud_text_color']='#'.$options['tag_cloud_text_color'];
else
$options['tag_cloud_text_color'] = '#ffffff';

?>
<style>
#div_tag_cloud a
{
	color:#<?php echo $options['tag_cloud_text_color']?>;
	text-decoration:none;

}
</style>
<script language="javascript"> 
 $(document).ready(function() {
   if( ! $('#myCanvas').tagcanvas({
     textColour :  '<?php echo $options['tag_cloud_text_color']?>',
     outlineThickness : 1,
     maxSpeed : <?php echo $options['tag_cloud_max_speed']?>,
     depth : <?php echo $options['tag_cloud_depth'] ?>
   })) {
     // TagCanvas failed to load
     $('#myCanvasContainer').hide();
   }
   // your other jQuery stuff here...
 });
 </script>
<?php
}


function tag_cloud_admin_menu()  
{  
	// this is where we add our plugin to the admin menu  
	add_options_page('Tag Cloud', 'Tag Cloud', 9, basename(__FILE__), 'tag_cloud_settings');  
}  

function tag_cloud_settings()
{
	echo '<style>.tag_cloud_admin_instruction{color:#09F;}</style>';

	$message='';
	if ($_POST['action'] == 'update')  
      {  
          $_POST['cloud_tag_width'] != "" ? update_option('cloud_tag_width', $_POST['cloud_tag_width']) : update_option('cloud_tag_width', '');  
		  $_POST['tag_cloud_height'] != "" ? update_option('tag_cloud_height', $_POST['tag_cloud_height']) : update_option('tag_cloud_height', '');  
		  $_POST['tag_cloud_max_speed'] != "" ? update_option('tag_cloud_max_speed', $_POST['tag_cloud_max_speed']) : update_option('tag_cloud_max_speed', '');  
		  $_POST['tag_cloud_depth'] != "" ? update_option('tag_cloud_depth', $_POST['tag_cloud_depth']) : update_option('tag_cloud_depth', '');  
  		  $_POST['tag_cloud_text_color'] != "" ? update_option('tag_cloud_text_color', $_POST['tag_cloud_text_color']) : update_option('tag_cloud_text_color', '');  
		  $_POST['tag_cloud_background_color'] != "" ? update_option('tag_cloud_background_color', $_POST['tag_cloud_background_color']) : update_option('tag_cloud_background_color', '');  

		  $message = '<div id="message" class="updated fade"><p><strong>Options Saved</strong></p></div>';  
   	  }  
     $options['cloud_tag_width'] = get_option('cloud_tag_width'); 
	 $options['tag_cloud_height'] = get_option('tag_cloud_height'); 
     $options['tag_cloud_max_speed'] = get_option('tag_cloud_max_speed'); 
     $options['tag_cloud_depth'] = get_option('tag_cloud_depth');
	 $options['tag_cloud_text_color'] = get_option('tag_cloud_text_color'); 
     $options['tag_cloud_background_color'] = get_option('tag_cloud_background_color'); 
	 ?>
     <div style="border:medium; border-color:#09F; border-width:1px; border-style:solid;width:800px;  margin-top:20px;">
     	<div><?php echo $message?></div>
       
        <div style="padding:10px 10px 10px 10px;">
        	 <div><h2>Tag Cloud Settings</h2></div>
            <form id="frm_tag_cloud" method="post" action="">
        	<input type="hidden" id="action" value="update" name="action" " />
            <div style="height:60px;">
            	<div style="float:left; width:180px;" >Max Speed  :</div>
                <div><input type="text" id="tag_cloud_max_speed" name="tag_cloud_max_speed" value="<?php echo $options['tag_cloud_max_speed']?>" style="width:250px;" /><br /><span class="tag_cloud_admin_instruction">Put the numbers e,g 1 or 2 or 5 etc</span></div>
            </div>
            <div style="height:60px;">
            	<div style="float:left;width:180px;">Tag cloud depth</div>
                <div><input type="text" id="tag_cloud_depth" name="tag_cloud_depth" value="<?php echo $options['tag_cloud_depth']?>" style="width:250px;" /><br /><span class="tag_cloud_admin_instruction">Put the numbers e.g 0.1 or 0.5 or 1 etc</span></div>
            </div>
            <div style="height:60px;">
            	<div style="float:left;width:180px;">Text Color</div>
                <div><input type="text" id="tag_cloud_text_color" name="tag_cloud_text_color" value="<?php echo $options['tag_cloud_text_color']?>" style="width:250px;" /><br /><span class="tag_cloud_admin_instruction">These should be hex color values without the # prefix (000000 for black, ffffff for white</span></div>
            </div>
            
            <div style="height:60px;">
            	<div style="float:left;width:180px;">Background Color</div>
                <div><input type="text" id="tag_cloud_background_color" name="tag_cloud_background_color" value="<?php echo $options['tag_cloud_background_color']?>" style="width:250px;" /><br /><span class="tag_cloud_admin_instruction">These should be hex color values without the # prefix (000000 for black, ffffff for white</span></div>
            </div>
            
            <div style="height:30px;">
            	<div style="float:left;width:180px;">Width</div>
                <div><input type="text" id="cloud_tag_width" name="cloud_tag_width" value="<?php echo $options['cloud_tag_width']?>" style="width:250px;" /></div>
            </div>
            <div style="height:30px;">
            	<div style="float:left;width:180px;">Height</div>
                <div><input type="text" id="tag_cloud_height" name="tag_cloud_height" value="<?php echo $options['tag_cloud_height']?>" style="width:250px;" /></div>
            </div>
            <div>
                <input type="submit" class="button-primary" value="Save Changes" />
            </div>
        </form>
        </div>
     </div>
     <?php
}
add_action('wp_head', 'tag_cloud_add_files');
add_action('admin_menu', 'tag_cloud_admin_menu'); 


?>