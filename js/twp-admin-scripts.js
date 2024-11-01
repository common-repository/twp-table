/*Generate Unique Id*/

function IDGenerator() {
   return Math.round(new Date().getTime() + (Math.random() * 100));
}

/*Sortable Table*/
 jQuery( function() {
    jQuery( "#iwp-field-wapper-row" ).sortable();
    jQuery( "#iwp-field-wapper-row" ).disableSelection();
 } );
  


/* Delete Column Table*/
jQuery(document).ready(function() {
	
	jQuery('.twp-del-btn').live("click",function(e){ //user click on remove text
		e.preventDefault();
		if (window.confirm("Are you sure to delete this?")) {
           
			jQuery(this).closest('table').remove();
        }
		
		 return false;
	})
});

/* Duplicate Table Column Table*/
//jQuery(document).ready(function() {
	
	jQuery('.twp-duplicate-btn').live("click",function(e){ //user click on remove text
		
		e.preventDefault(); 
		//alert('d');
		
		var unqueID = IDGenerator();
		//jQuery(this).closest('.twp_add_field_button').attr('btn-list-item',unqueID);
		//console.log(jQuery(this).closest('.twp_add_field_button').nameProp('btn-list-item','ddddd'));
		//alert(jQuery(this).closest('button').addClass('ddd'));
		//alert(jQuery(this).closest('table').clone().children(".twp_add_field_button").attr("btn-list-item"));
		
		var table = jQuery(this).closest('table').clone();
		table.find('.twp_add_field_button').attr('btn-list-item',unqueID);
		table.find('.iwp_item_list').attr('name','iwp_item_list['+unqueID+'][]');
		//console.log(table[0]['innerHTML']);
		// alert(jQuery(table).closest('.twp_add_field_button').prop('btn-list-item'));
		jQuery('.iwp-field-wapper-row').append(table);
        
		loadTWPColorPicker();
		 return false;
	});
//})




/* Multiple Listing Each List*/
loadTWPMultipleList();
function loadTWPMultipleList(){
	jQuery(document).ready(function() {
		
		 
		var max_fields      = 50; //maximum input boxes allowed
		var x = 1; //initlal text box count
		jQuery(".twp_add_field_button").live('click', function(e) { 
    	    
			var btnIitem = jQuery(this).attr('btn-list-item');
			
			//alert(btnIitem);
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; 
                 jQuery('<tr><td><input type="text" name="iwp_item_list['+btnIitem+'][]" class="large-text"/></td><td><a href="#" class="twp_remove_field">Remove</a></td></tr>').appendTo(jQuery(this).closest('table'));
				
			}
			
			return false;
		});
		
		jQuery('.twp_remove_field').live("click",function(e){ //user click on remove text
			e.preventDefault();
			jQuery(this).closest('tr').remove();
			x--;
			 return false;
		});
	});
}


/* Multiple Listing Each Rows*/

jQuery(document).ready(function() {
	var max_fields      = 50; //maximum input boxes allowed
	var wrapper   		= jQuery(".iwp-field-wapper-row"); //Fields wrapper
	//var wrapper2   		= jQuery(".twp_input_fields_wrap tr"); //Fields wrapper

	var x = 1; //initlal text box count

	jQuery(".twp_add_new_field").live('click', function(e) { 
	
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			
		   var unqueID = IDGenerator();
			var table = '';
			
			table += '<table class="iwp-field-wapper" width="100%">';
			table += '<tr>';
			   table+= '<td width="55%" valign="top">';
				  table += '<table class="iwp-field-item" width="100%">';
					table += '<tr>';
						table += '<td><label for="twp_theme_background_color">Theme Background Color : </label></td>';
						table += '<td><input type="text" name="twp_theme_background_color[]"  value="#fff" placeholder="" class="color_field large-text"/></td>';
					table += '</tr>';
					table += '<tr>';
						table += '<td><label for="twp_title_text_color">Title Text Color : </label></td>';
						table += '<td><input type="text" name="twp_title_text_color[]" value="#000" placeholder="" class="color_field large-text"/></td>';
					table += '</tr>';
					table += '<tr>';
						table += '<td><label for="twp_package_title">Package Title: </label></td>';
						table += '<td><input type="text" name="twp_package_title[]" placeholder="" class="twp_package_title large-text" required /></td>';
					table += '</tr>';
					
					table += '<tr>';
						table += '<td><label for="twp_package_title_subheader">Package Title Subheader: </label></td>';
						table += '<td><input type="text" name="twp_package_title_subheader[]" placeholder="" class="twp_package_title_subheader large-text" required /></td>';
					table += '</tr>';
					
					table += '<tr>';
						table += '<td><label for="twp_content_header">Content Header: </label></td>';
						table += '<td><input type="text" name="twp_content_header[]" placeholder="Optional" class="twp_content_header large-text"/></td>';
					table += '</tr>';
					
					table += '<tr>';
						table += '<td><label for="twp_content_subheader">Content Subheader Header: </label></td>';
						table += '<td><input type="text" name="twp_content_subheader[]" placeholder="Optional" class="twp_content_subheader large-text"/></td>';
					table += '</tr>';
					
					table += '<tr>';
						table += '<td><label for="twp_content_header_color">Content Header Color: </label></td>';
						table += '<td><input type="text" name="twp_content_header_color[]" value="#000"  placeholder="" class=" twp_content_header_color color_field large-text"/></td>';
					table += '</tr>';
					
					table += '<tr>';
						table += '<td><label for="twp_list_icon">List Icon: </label></td>';
						table += '<td>';
						table += '<input  type="text" name="twp_list_icon[]" class="twp_list_icon" value="" />';
						table += '<input  type="button" class="twp_upload_image_button button-primary" value="Insert Image" />';
						table += '</td>';
					table += '</tr>';
				  table += '</table>';
			   table += '</td>';
			   table += '<td valign="top" width="40%" style="padding-left:20px;">';
					table += '<table class="twp_input_fields_wrap" width="100%">';
					
						table += '<tr>';
							table += '<td><label for="twp_title_text_color">List Alignment:  </label>';
							   table += ' <select class="twp_list_alignment" name="twp_list_alignment[]">';
								 table += '<option value="left" >Left</option>';
								 table += '<option value="center">Center</option>';
								 table += '<option value="right">Right</option>';
							   table += '</select>';
							table += '</td>';
							table += '<td>';
							   table += '&nbsp;';
							table += '</td>';
						table += '</tr>';
					  
					  table += '<tr>';
						  table += '<td  width="80%"><button class="twp_add_field_button button-primary" btn-list-item="'+unqueID+'">Add List</button></td>';
						  table += '<td>&nbsp;</td>';
					 table += ' </tr>';
					  /*table += '<tr>';
						  table += '<td><input type="text" name="iwp_item_list['+x+'][]" class="iwp_item_list large-text"></td>';
						  table += '<td><a href="#" class="twp_remove_field">Remove</a></td>';
					 table += ' </tr>';*/
					table += '</table>';
			   table += '</td>';
			   table += '<td valign="top" width="30%"> <a href="#" class="twp-del-btn">Delete Row</a></td>';
		   table += '</tr>';
		table += '</table>';
		
			//console.log(table);
			jQuery(wrapper).append(table); //add input box
			 //jQuery(table).appendTo('.iwp-field-wapper-row');
			
			
		}
		
		
		loadTWPColorPicker();
		//loadTWPUploadMedia();
		//loadTWPMultipleList();
		//jQuery(this).trigger("loadTWPMultipleList");
	});
	
	jQuery(wrapper).on("click","remove-iwp-field-wapper-row", function(e){ //user click on remove text
		e.preventDefault();
		jQuery(this).closest('table').remove();
		//$(this).parent('td').remove();

		x--;
	});
})






/* Color Picker */
loadTWPColorPicker();
function loadTWPColorPicker(){
	 jQuery(document).ready(function(jQuery){
		jQuery('.color_field').each(function(){
			jQuery(this).wpColorPicker();
		});
	});
}


/*Upload Media*/
loadTWPUploadMedia();
function loadTWPUploadMedia(){
	jQuery(document).ready(function(jQuery){
	  var mediaUploader;
	  
	  //jQuery('.twp_upload_image_button').click(function(e) {
		  
	   var twp_upload_image_button      = jQuery(".twp_upload_image_button"); //Add button ID	  
	   jQuery(twp_upload_image_button).live("click",function(e){ //user click on 
	   //jQuery('.iwp-field-item').find('.twp_upload_image_button').live("click",function(e){
  	     var $twp_list_icon = jQuery(this).parents('td').find('.twp_list_icon');
	   
		var bntClass =  jQuery(this);
		e.preventDefault();
		  if (mediaUploader) {
		  mediaUploader.open();
		  return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
		  title: 'Choose Image',
		  button: {
		  text: 'Choose Image'
		}, multiple: false });
		mediaUploader.on('select', function(e) {
		  var attachment = mediaUploader.state().get('selection').first().toJSON();
		 
 		  //jQuery(bntClass).prev('input').val(attachment.url);
		  //console.log(jQuery(bntClass).prev('input').val(attachment.url));
		  $twp_list_icon.val(attachment.url);
		  
		// alert( $twp_list_icon.addClass('yrdy'));
		// alert( $twp_list_icon.val()=attachment.url);
		 
		 //jQuery(bntClass).prev().attr("data-image_id",'gg');
		//jQuery(this).html(attachment.url);
		  //jQuery(this).siblingAbove('input').css('border','1px solid red;');
		  //console.log(bntClass);
		  //alert(attachment.url);
		  
		   //return false;
		  
		});
		mediaUploader.open();
		
		
		
	  });
	  
	});
}