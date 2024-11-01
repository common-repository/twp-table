<?php
// Add the custom columns to the twp-table post type:
add_filter( 'manage_twp-table_posts_columns', 'set_custom_edit_TWPTABLE__columns' );
function set_custom_edit_TWPTABLE__columns($columns) {
  
   $columns = array(
      'cb' => $columns['cb'],
	  'title' => __( 'Name' ),
      'twp_shortcode' => __( 'Shortcode' )
     
    );
	
    return $columns;
}


// Add the data to the custom columns for the twp-table post type:
add_action( 'manage_twp-table_posts_custom_column' , 'TWPTABLE_custom_column', 1, 2 );
function TWPTABLE_custom_column( $column, $post_id ) {
    switch ( $column ) {

        case 'twp_shortcode' :
            echo '[twp-pricing-table id="'.$post_id.'"]'; 
            break;

    }
}


function TWPTABLE_post_type_registration() {
  $labels = array(
    'name'               => _x( 'TWP Tables', 'post type general name' ),
    'singular_name'      => _x( 'TWP Table', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Table' ),
    'edit_item'          => __( 'Edit Table' ),
    'new_item'           => __( 'New Table' ),
    'all_items'          => __( 'All Tables' ),
    'view_item'          => __( 'View Tables' ),
    'search_items'       => __( 'Search Tables' ),
    'not_found'          => __( 'No tables found' ),
    'not_found_in_trash' => __( 'No tables found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'TWP Tables'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => '',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title' ),
    'has_archive'   => true,
  );
  register_post_type( 'twp-table', $args ); 
}
add_action( 'init', 'TWPTABLE_post_type_registration' );

/*Donation Sidebox*/
add_action( 'add_meta_boxes', 'TWPTABLE_donation_metabox' );
function TWPTABLE_donation_metabox() {
    add_meta_box( 
        'twp-donation-metabox',
        __( 'Give and Take', 'twp-table' ),
        'TWPTABLE_donation_box',
        'twp-table',
        'side',
        'high'
    );
}

function TWPTABLE_donation_box( $post ) {
 
   
  ?>
  <p>Any amount of donation is welcome to maintain this plugin! <a href="https://www.paypal.me/ivandolera" target="_blank">Donate Now!</a></p>
  
  
  <?php
}




/* Configuration Single Table Settings */
add_action( 'add_meta_boxes', 'TWPTABLE_configuration_metabox' );
function TWPTABLE_configuration_metabox() {
    add_meta_box( 
        'twp-configuration-metabox',
        __( 'Configuration', 'twp-table' ),
        'TWPTABLE_post_configuration',
        'twp-table',
        'normal',
        'high'
    );
}

function TWPTABLE_post_configuration( $post ) {
   wp_nonce_field( plugin_basename( __FILE__ ), 'twp_post_configuration_nonce' );
   $twp_display_by = get_post_meta( $post->ID, 'twp_display_by', true );
   $twp_is_pagination = get_post_meta( $post->ID, 'twp_is_pagination', true );
   
   $twp_default_font = get_post_meta( $post->ID, 'twp_default_font', true );
   $twp_pagination_position = get_post_meta( $post->ID, 'twp_pagination_position', true );
    $twp_default_font = get_post_meta( $post->ID, 'twp_default_font', true );
  
   
  ?>
  <table>
   <tr>
		<td><label for="twp_shortcode">Shortcode : </label></td>
		<td><strong>[twp-pricing-table id="<?php echo $post->ID;?>"]</strong></td>
	</tr>
	 <tr>
		<td><label for="twp_display_by"><strong>Load Default TWP Table Font Family :</strong> </label></td>
		<td><input type="checkbox" id="twp_default_font" name="twp_default_font" id="twp_default_font"  value="yes" <?php echo($twp_default_font == 'yes')?'checked="checked"':'';?>/></td>
	</tr>
    <tr>
		<td><label for="twp_display_by">Display one row by : </label></td>
		<td><input type="number" id="twp_display_by" name="twp_display_by" id="twp_display_by" placeholder="" value="<?php echo($twp_display_by)?$twp_display_by:'3';?>" class="wide"/></td>
	</tr>
    <tr>
		<td><label for="twp_title_text_color">Pagination :  </label></td>
		<td>
		   <select class="twp_is_pagination" name="twp_is_pagination">
		      <option value="no"  <?php echo($twp_is_pagination == 'no')?'selected':'';?>>No</option>
			  <option value="yes" <?php echo($twp_is_pagination == 'yes')?'selected':'';?> > Yes</option>
		   </select>
		</td>
	</tr>
	<tr>
		<td><label for="twp_title_text_color">Pagination Position:  </label></td>
		<td>
		   <select class="twp_pagination_position" name="twp_pagination_position">
		      <option value="left"  <?php echo($twp_pagination_position == 'left')?'selected':'';?>>Left</option>
			  <option value="center" <?php echo($twp_pagination_position == 'center')?'selected':'';?> >Center</option>
			  <option value="right" <?php echo($twp_pagination_position == 'right')?'selected':'';?> >Right</option>
		   </select>
		</td>
	</tr>
	
  
  </table>
  
  <?php
}



/* Items Single Table Column */
add_action( 'add_meta_boxes', 'TWPTABLE_column_metabox' );
function TWPTABLE_column_metabox() {
    add_meta_box( 
        'twp-column-metabox-item',
        __( 'Fields', 'twp-table' ),
        'TWPTABLE_post_column',
        'twp-table',
        'normal',
        'high'
    );
}

function TWPTABLE_post_column( $post ) {
   wp_nonce_field( plugin_basename( __FILE__ ), 'twp_post_column_nonce' );
  
  $twp_theme_background_color = get_post_meta( $post->ID, 'twp_theme_background_color', true );
  $twp_title_text_color = get_post_meta( $post->ID, 'twp_title_text_color', true );
  
  $twp_package_title = get_post_meta( $post->ID, 'twp_package_title', true );
 
  $twp_package_title_subheader = get_post_meta( $post->ID, 'twp_package_title_subheader', true );
  $twp_content_header = get_post_meta( $post->ID, 'twp_content_header', true );
  $twp_content_subheader = get_post_meta( $post->ID, 'twp_content_subheader', true );
  $twp_content_header_color = get_post_meta( $post->ID, 'twp_content_header_color', true );
  $twp_list_icon = get_post_meta( $post->ID, 'twp_list_icon', true );
  
  
  $iwp_item_list = get_post_meta( $post->ID, 'iwp_item_list', true );
  $twp_list_alignment = get_post_meta( $post->ID, 'twp_list_alignment', true );
 
  //var_dump($iwp_item_list);
   
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
   

  
  ?>
    <div class="iwp-field-wapper-row" id="iwp-field-wapper-row">
		<?php
		   if(isset($twp_package_title)) { 
		   
			 $n = 1;
			 for ($j=0;$j<count($twp_package_title);$j++){
		?>
			<table class="iwp-field-wapper ui-state-default" width="100%">
				<tr>
				   <td width="55%" valign="top">
					  <table class="iwp-field-item" width="100%">
						<tr>
							<td><label for="twp_theme_background_color">Theme Background Color : </label></td>
							<td><input type="text" name="twp_theme_background_color[]"  value="<?php echo($twp_theme_background_color[$j])?esc_html_e($twp_theme_background_color[$j]):'';?>" placeholder="" class="color_field large-text"/></td>
						</tr>
						<tr>
							<td><label for="twp_title_text_color">Title Text Color : </label></td>
							<td><input type="text" name="twp_title_text_color[]" value="<?php echo($twp_title_text_color[$j])?esc_html_e($twp_title_text_color[$j]):'';?>" placeholder="" class="color_field large-text"/></td>
						</tr>
						<tr>
							<td><label for="twp_package_title">Package Title: </label></td>
							<td><input type="text" name="twp_package_title[]" value="<?php echo($twp_package_title[$j])?esc_html_e($twp_package_title[$j]):'';?>" placeholder="" class="twp_package_title large-text" required /></td>
						</tr>
						
						<tr>
							<td><label for="twp_package_title_subheader">Package Title Subheader: </label></td>
							<td><input type="text" name="twp_package_title_subheader[]" value="<?php echo($twp_package_title_subheader[$j])?esc_html_e($twp_package_title_subheader[$j]):'';?>" placeholder="" class="twp_package_title_subheader large-text" required /></td>
						</tr>
						
						<tr>
							<td><label for="twp_content_header">Content Header: </label></td>
							<td><input type="text" name="twp_content_header[]" value="<?php echo($twp_content_header[$j])?esc_html_e($twp_content_header[$j]):'';?>" placeholder="Optional" class="twp_content_header large-text"/></td>
						</tr>
						<tr>
							<td><label for="twp_content_subheader">Content Subheader Header: </label></td>
							<td><input type="text" name="twp_content_subheader[]" value="<?php echo($twp_content_subheader[$j])?esc_html_e($twp_content_subheader[$j]):'';?>" placeholder="Optional" class="twp_content_subheader large-text"/></td>
						</tr>
						<tr>
							<td><label for="twp_content_header_color">Content Header Color: </label></td>
							<td><input type="text" name="twp_content_header_color[]" value="<?php echo($twp_content_header_color[$j])?esc_html_e($twp_content_header_color[$j]):'';?>" placeholder="" class=" twp_content_header_color color_field large-text"/></td>
						</tr>
						
						<tr>
							<td><label for="twp_list_icon">List Icon: </label></td>
							<td>
							<input  type="text" name="twp_list_icon[]" class="twp_list_icon" value="<?php echo($twp_list_icon[$j])?esc_url($twp_list_icon[$j]):'';?>" />
							<input  type="button" class="twp_upload_image_button button-primary" value="Insert Image" />
							</td>
						</tr>
					  </table>
				   </td>
				   <td valign="top" width="40%" style="padding-left:20px;">
						<table class="twp_input_fields_wrap" width="100%">
						<tr>
							<td><label for="twp_title_text_color">List Alignment:  </label>
							    
							    <select class="twp_list_alignment" name="twp_list_alignment[]">
								  <option value="left"  <?php echo($twp_list_alignment[$j] == 'left')?'selected':'';?>>Left</option>
								  <option value="center" <?php echo($twp_list_alignment[$j] == 'center')?'selected':'';?> >Center</option>
								  <option value="right" <?php echo($twp_list_alignment[$j] == 'right')?'selected':'';?> >Right</option>
							   </select>
							</td>
							<td>
							   &nbsp;
							</td>
						</tr>
						  
						  <tr>
							  <td  width="80%"><button class="twp_add_field_button button-primary" btn-list-item="<?php echo $n; ?>">Add List</button></td>
							  <td></td>
						  </tr>
						  
						  <?php if(isset($iwp_item_list[$j])) {
							  
								  
							$iwp_item_listing =  explode("[,]", $iwp_item_list[$j]);
								
							  foreach ($iwp_item_listing as $Itemlist) {
							  ?><tr>
									<td>
										<input type="text" name="iwp_item_list[<?php echo $n; ?>][]" value="<?php echo esc_html_e($Itemlist); ?>" class="iwp_item_list large-text">
									</td>
									<td><a href="#" class="twp_remove_field">Remove</a></td>
								</tr>
						  <?php } 
							}
						  ?>
							 
						</table>
				   </td>
				   <td valign="top" width="30%"> <a href="#" class="twp-del-btn">Delete Row</a>  <a href="#" class="twp-duplicate-btn">Duplicate</a></td>
			   </tr>
			</table>
			
		<?php 
		      $n++;
			 }
		
			}


		?>
		
		
	</div>
	
	
   <p><button class="twp_add_new_field button-primary">Add New Column</button></p>
  
    
    
  <?php
}

/* Admin CSS */
function TWPTABLE_admin_scripts() {
	
	/*Color Picker*/
	wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');
	/* media Uploader */
	wp_enqueue_media();

	wp_enqueue_script( 'twp-admin-scripts', plugins_url( 'js/twp-admin-scripts.js' , dirname(__FILE__) ) );
	wp_enqueue_script('media-uploader');
	
	
	/*Admin CSS*/
	wp_enqueue_style('twp-admin-css', plugins_url( 'css/admin.css' , dirname(__FILE__) ));

}

add_action('admin_enqueue_scripts', 'TWPTABLE_admin_scripts');





add_action( 'save_post', 'TWPTABLE_save' );
function TWPTABLE_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;


  if ( 'twp-table' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }
  
  /*Configuration*/
   if(isset($_POST["twp_display_by"])){	
	  $twp_display_by =  sanitize_text_field($_POST["twp_display_by"]);
	  update_post_meta( $post_id, 'twp_display_by', $twp_display_by );
  }
  
   if(isset($_POST["twp_is_pagination"])){	
	  $twp_is_pagination =  sanitize_text_field($_POST["twp_is_pagination"]);
	  update_post_meta( $post_id, 'twp_is_pagination', $twp_is_pagination );
  }
  
  	
   $twp_default_font =  isset($_POST["twp_default_font"])?sanitize_text_field($_POST["twp_default_font"]):'no';
   update_post_meta( $post_id, 'twp_default_font', $twp_default_font );
  
  
  if(isset($_POST["twp_pagination_position"])){	
	  $twp_pagination_position =  sanitize_text_field($_POST["twp_pagination_position"]);
	  update_post_meta( $post_id, 'twp_pagination_position', $twp_pagination_position );
  }
  
 
   
  /*Fields*/
  if(isset($_POST["twp_theme_background_color"]) && is_array($_POST["twp_theme_background_color"])){	
	 
	  $twp_theme_background_color = array();
	  foreach($_POST["twp_theme_background_color"] as $item){
		  
		   $twp_theme_background_color[] = sanitize_hex_color($item);
	  }
	  
	  $twp_theme_background_color = implode(",", $twp_theme_background_color);
	  update_post_meta( $post_id, 'twp_theme_background_color', $twp_theme_background_color );
	 
	  
  }
  
  
  if(isset($_POST["twp_title_text_color"]) && is_array($_POST["twp_title_text_color"])){	
	  
	  
	  $twp_title_text_color = array();
	  foreach($_POST["twp_title_text_color"] as $item){
		  
		   $twp_title_text_color[] = sanitize_hex_color($item);
	  }
	  
	  $twp_title_text_color = implode(",", $twp_title_text_color);
	  update_post_meta( $post_id, 'twp_title_text_color', $twp_title_text_color );
  }
  
  
   if(isset($_POST["twp_package_title"]) && is_array($_POST["twp_package_title"])){	

	  
	  $twp_package_title = array();
	  foreach($_POST["twp_package_title"] as $item){
		  
		   $twp_package_title[] = wp_kses($item, 
								  array( 
									'a' => array(
											'href' => array(),
											'target' => array(),
											'class' => array(),
											'title' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
									)
								 );
	  }
	  
	  $twp_package_title =  implode("{-}",$twp_package_title);
	  update_post_meta( $post_id, 'twp_package_title', $twp_package_title );
    }
	
  
   if(isset($_POST["twp_package_title_subheader"]) && is_array($_POST["twp_package_title_subheader"])){	
	  
	  $twp_package_title_subheader = array();
	  foreach($_POST["twp_package_title_subheader"] as $item){
		  
		   $twp_package_title_subheader[] = wp_kses($item, 
								  array( 
									'a' => array(
											'href' => array(),
											'target' => array(),
											'class' => array(),
											'title' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
									)
								 );
	  }
	  
	  
	  
	  $twp_package_title_subheader =  implode("{-}", $twp_package_title_subheader);
	  update_post_meta( $post_id, 'twp_package_title_subheader', $twp_package_title_subheader );
  }
  
   if(isset($_POST["twp_content_header"]) && is_array($_POST["twp_content_header"])){	
	  
	  $twp_content_header = array();
	  foreach($_POST["twp_content_header"] as $item){
		  
		   $twp_content_header[] = sanitize_text_field($item);
	  }
	  
	  $twp_content_header =  implode("{-}", $twp_content_header);
	  update_post_meta( $post_id, 'twp_content_header', $twp_content_header );
  }
  
   if(isset($_POST["twp_content_subheader"]) && is_array($_POST["twp_content_subheader"])){	
	  
	  $twp_content_subheader = array();
	  foreach($_POST["twp_content_subheader"] as $item){
		  
		   $twp_content_subheader[] = sanitize_text_field($item);
	  }
	  
	  $twp_content_subheader =  implode("{-}", $twp_content_subheader);
	  update_post_meta( $post_id, 'twp_content_subheader', $twp_content_subheader );
  }
  
   if(isset($_POST["twp_content_header_color"]) && is_array($_POST["twp_content_header_color"])){	
	 
     $twp_content_header_color = array();
	  foreach($_POST["twp_content_header_color"] as $item){
		  
		   $twp_content_header_color[] = sanitize_hex_color($item);
	  }


	 $twp_content_header_color =  implode(",", $twp_content_header_color);
	  update_post_meta( $post_id, 'twp_content_header_color', $twp_content_header_color );
  }
  
  if(isset($_POST["twp_list_icon"]) && is_array($_POST["twp_list_icon"])){	
  
      $twp_list_icon = array();
	  foreach($_POST["twp_list_icon"] as $item){
		  
		   $twp_list_icon[] = esc_url_raw($item);
	  }
  
	  $twp_list_icon =  implode("{-}", $twp_list_icon);
	  update_post_meta( $post_id, 'twp_list_icon', $twp_list_icon );
	  
  }
  
  
  if(isset($_POST["twp_list_alignment"]) && is_array($_POST["twp_list_alignment"])){	
  
      $twp_list_alignment = array();
	  foreach($_POST["twp_list_alignment"] as $item){
		  
		   $twp_list_alignment[] = sanitize_text_field($item);
	  }
  
	  $twp_list_alignment =  implode(",", $twp_list_alignment);
	  update_post_meta( $post_id, 'twp_list_alignment', $twp_list_alignment );
	  
  }
  
  
  
  if(isset($_POST["iwp_item_list"]) && is_array($_POST["iwp_item_list"])){	
	  $iwp_item_list = array();
	  foreach($_POST["iwp_item_list"] as $list){
		  
		  $iwp_item_list[] =  implode("[,]", $list);
	  }
	   $iwp_item_list  = implode("{-}",$iwp_item_list);
	   
		$iwp_item_list = 	wp_kses($iwp_item_list, 
				  array( 
					'a' => array(
							'href' => array(),
							'target' => array(),
							'class' => array(),
							'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
					)
				 );
								 
								 
	    update_post_meta( $post_id, 'iwp_item_list', $iwp_item_list);
	 
  }
  
}

?>