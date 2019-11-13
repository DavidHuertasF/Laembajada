var section_position = new Array();

$(document).ready(function() {
	$('nav a').click(function(){
		$.scrollTo( this.hash, 400, { easing:'swing' });
		return false;
	});
$('#brand_id').click(function(){
		$.scrollTo("0px", 400, { easing:'swing' });
		return false;
	});

  $(window).scroll(function() {
	  int = $(window).scrollTop();
	  section_register();
	  $(".section").each(function(index) {
	  	if (int >= section_position[index]) {
		  	$('nav li').removeClass('active');
		  	$('.'+$(this).attr('id')).addClass('active');
		  	$('body, .xcolor').removeClass().addClass('color-'+$(this).attr('id'));
	  		}
	  	});
	  });

	  function section_register() {
	  	$(".section").each(function(index) {
	  		this_offset = $(this).offset();
	  
	  		if ($(this).attr('id')=='work') {
	  			section_position[index] = this_offset.top-150;
	  			} else {
	  			section_position[index] = this_offset.top - ($(window).height()*0.4);
	  			};
	  	});
	  
	  }
});