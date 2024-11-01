

/* Pagination Column Table*/
jQuery(document).ready(function(e) {
	
	jQuery('#twp-pagination a').live("click",function(e){ //user click on remove text
		e.preventDefault();
		//if (window.confirm("Are you sure to delete this?")) {
        //  alert('test'); 
		//	jQuery(this).closest('table').remove();
       // }
		var number = jQuery(this).attr('number');
		 jQuery(this).addClass('active');
		 jQuery('.twp-table-wrapper').css('display','none');
		 jQuery('#twp-table-wrapper-'+number).css('display','flex');
		 return false;
	})
})
