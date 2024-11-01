<?php
/*
Plugin Name: TWP Pricing Table
Description: Responsive and Lightweight, ready to use in any pricing table design
Author: Teach Wordpress Plugin
Author URI: 
Version: 1.0
Requires at least: 4.9
Tested up to: 5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// Plugin constants
define( 'TWPTABLE_FRONTVIEW_VERSION', '1' );
define( 'TWPTABLE_FRONTVIEW_FOLDER', 'twp-table' );

define( 'TWPTABLE_FRONTVIEW_URL', plugin_dir_url( __FILE__ ) );
define( 'TWPTABLE_FRONTVIEW_DIR', plugin_dir_path( __FILE__ ) );
define( 'TWPTABLE_FRONTVIEW_BASENAME', plugin_basename( __FILE__ ) );


include('admin/admin.php');


function TWPTABLE_front_css() {
	 
	 
	 
	 wp_register_style('twp-redhatfont', 'https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700;900&display=swap');
	 wp_enqueue_style( 'twp-redhatfont');
	
	 wp_register_style('twp-front-css', TWPTABLE_FRONTVIEW_URL.'css/fontview.css');
	 wp_enqueue_style( 'twp-front-css' );
	 
	 wp_register_script('twp-front-script', TWPTABLE_FRONTVIEW_URL.'js/twp-fontview.js', array( 'jquery' ));
	 wp_enqueue_script('twp-front-script');
	
	 
}

add_action('wp_enqueue_scripts', 'TWPTABLE_front_css');


/* Front View */
add_shortcode('twp-pricing-table', 'TWPTABLE_front_listing');

function TWPTABLE_front_listing($atts) {
    // ob_start();
  
    $atts =  shortcode_atts(array(
       'id' => $atts['id']
    ), $atts);
	
	$tdID =  $atts['id'];
	
      $twp_theme_background_color = get_post_meta( $tdID, 'twp_theme_background_color', true );
	  $twp_title_text_color = get_post_meta( $tdID, 'twp_title_text_color', true );
	  $twp_package_title = get_post_meta( $tdID, 'twp_package_title', true );
	  $twp_package_title_subheader = get_post_meta( $tdID, 'twp_package_title_subheader', true );
	  $twp_content_header = get_post_meta( $tdID, 'twp_content_header', true );
	  $twp_content_subheader = get_post_meta( $tdID, 'twp_content_subheader', true );
	  $twp_content_header_color = get_post_meta( $tdID, 'twp_content_header_color', true );
	  $twp_list_icon = get_post_meta( $tdID, 'twp_list_icon', true );
	  $iwp_item_list = get_post_meta( $tdID, 'iwp_item_list', true );
	  $twp_list_alignment = get_post_meta( $tdID, 'twp_list_alignment', true );
	 
	
	   
	   $twp_theme_background_color =  explode(",", $twp_theme_background_color);
	   $twp_title_text_color =  explode(",", $twp_title_text_color);
	   $twp_package_title =  explode("{-}", $twp_package_title);
	   $twp_package_title_subheader =  explode("{-}", $twp_package_title_subheader);
	   $twp_content_header =  explode("{-}", $twp_content_header);
	   $twp_content_subheader =  explode("{-}", $twp_content_subheader);
	   $twp_content_header_color =  explode(",", $twp_content_header_color);
	   $twp_list_icon =  explode("{-}", $twp_list_icon);
	   $iwp_item_list =  explode("{-}", $iwp_item_list);
       $twp_list_alignment =  explode(",", $twp_list_alignment);
		
	   //display by
	   $twp_display_by = get_post_meta( $tdID, 'twp_display_by', true );
	   $twp_pagination_position = get_post_meta( $tdID, 'twp_pagination_position', true );
	   
	   
	   $twp_default_font = get_post_meta( $tdID, 'twp_default_font', true );
	   $twp_default_font =  ($twp_default_font =='yes')?'style="font-family: \'Red Hat Display\', sans-serif !important;"':'';
	   
	   
        echo '<div class="twp-table-main-wrapper" id="twp-table-main-wrapper" '.$twp_default_font.'>';	   
        
		
		
	    if(isset($twp_package_title)) {
			
			 $n = 1;
			 $index = 1;
			 $item_row = 1;
			 
			 for ($j=0;$j<count($twp_package_title);$j++){
		            
					$style = '';
					if( $twp_display_by >1 ){
						 if ($index % $twp_display_by  == 1 || $index == 1) { // beginning of the row or first
						
						   $style = ($item_row > 1)?'style="display:none;"':'';
							echo '<div class="twp-table-wrapper" id="twp-table-wrapper-'.$item_row.'" wrap-number="'.$item_row.'" '.$style.'>';
							 $item_row ++;
						}
						
					} else {
						
						$style = ($n > 1)?'style="display:none;"':'';
						echo '<div class="twp-table-wrapper"  id="twp-table-wrapper-'.$n.'" wrap-number="'.$n.'" '.$style.'>';
						
					}
					
					$allowed_html = [
					'a'      => [
					'href'  => [],
					'title' => [],
					'target'  => [],
					'class' => [],
					
					],
					'br'     => [],
					'em'     => [],
					'strong' => [],
					];
					
				  
				?>
					<div class="table-item" id="table-item-<?php echo $n;?>">
					   <div class="table-head table-head-<?php echo $n;?>" style="background-color:<?php echo ($twp_theme_background_color[$j])?esc_html_e($twp_theme_background_color[$j]):'';?>;;">
					      <h3 class="package-title" style="color:<?php echo ($twp_title_text_color[$j])?$twp_title_text_color[$j]:'';?>"><?php echo ($twp_package_title[$j])?wp_kses($twp_package_title[$j],$allowed_html):'';?></h3>
						  <p style="color:<?php echo ($twp_title_text_color[$j])?$twp_title_text_color[$j]:'';?>"><?php echo ($twp_package_title_subheader[$j])?wp_kses($twp_package_title_subheader[$j],$allowed_html):'';?></p>
					   </div>
					   <div class="table-content">
						   <div class="box-content"  style="background-color:<?php echo ($twp_theme_background_color[$j])?esc_html_e($twp_theme_background_color[$j]):'';?>">
						     <h5 style="color:<?php echo ($twp_content_header_color[$j])?$twp_content_header_color[$j]:'';?>"><?php echo ($twp_content_header[$j])?esc_html_e($twp_content_header[$j]):'';?></h5>
							 <p style="color:<?php echo ($twp_content_header_color[$j])?$twp_content_header_color[$j]:'';?>"><?php echo ($twp_content_subheader[$j])?esc_html_e($twp_content_subheader[$j]):'';?></p>
						   </div>
						  
						   <ul class="feature-list <?php echo esc_html_e($twp_list_alignment[$j]);?>">
						    
							 <?php 
							  if(isset($iwp_item_list[$j])) {
								  
							  $iwp_item_listing =  explode("[,]", $iwp_item_list[$j]);  
							   foreach ($iwp_item_listing as $Itemlist) {
                                  
								   ?>
								   
								    <li  <?php echo (!$twp_list_icon[$j])?'style="padding-left:0px;"':'';?> > <?php echo ($twp_list_icon[$j])?'<img src="'.esc_url($twp_list_icon[$j]).'" alt="" />':'';?> <?php echo wp_kses($Itemlist,$allowed_html); ?></li>
								   
							  <?php }
							  }
							  ?>
						   </ul>
					   </div>
					</div>
					
				<?php
				
					if( $twp_display_by >1 ){
							
							if ($index % $twp_display_by  == 0 || $index == count($twp_package_title)) { // end of the twp-table-wrapper or last
								echo '</div><!-- .twp-table-wrapper -->';
							}
						 
							$index++;
							
					} else {
						echo '</div>';
						
					}
				
				
				$n++;
				
				
			}
	   }
	   
	   echo '</div>';
	   
	   
	   
	   /*Pagination Here*/
	    // echo $item_row;
	     if(isset($twp_package_title) &&  $item_row > 2 ) {
			 
			echo '<ul id="twp-pagination" class="'.$twp_pagination_position.'" '.$twp_default_font.'>';
			 $n = 1;
			 $index = 1;
			 $item_row = 1;
			 
			 for ($j=0;$j<count($twp_package_title);$j++){
		            
					$style = '';
					if( $twp_display_by >1 ){
						 if ($index % $twp_display_by  == 1 || $index == 1) { // beginning of the row or first
						
						 
							echo '<li>';
							  echo '<a class="number" id="div-'.$item_row.'" number="'.$item_row.'" href="#">'.$item_row.'</a>';
						}
						
					} else {
						
						
						 echo '<li>';
						  echo '<a class="number"  id="div-'.$n.'" number="'.$n.'" href="#">'.$item_row.'</a>';
						
					}
			
				  
					
					if( $twp_display_by >1 ){
							
							if ($index % $twp_display_by  == 0 || $index == count($twp_package_title)) { // end of the twp-table-wrapper or last
								echo '</li>';
								 $item_row ++;
							}
						 
							$index++;
							
					} else {
						echo '</li>';
						
					}
				
				
				$n++;
			
			}
			
		 echo '</ul>';
		 
	   }
	   
	
	   
	  

   //  ob_get_clean();
    //return $blog;  

}