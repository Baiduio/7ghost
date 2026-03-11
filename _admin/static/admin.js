$(function(){
	var isCollapsed = false;
	$("#collapsible").height($("#nav").height()).click(function() {
		if (isCollapsed) {
			$("#nav").css('width','140px');
			$("#nav .dashboard").css('width','133px');
		} else {
			$("#nav").css('width','10px');
			$("#nav .dashboard").css('width','0px');
		}
		isCollapsed = !isCollapsed;
		return false;
	});
	
	$('.actions span').css('display','none');
	$('.actions').parent().mouseenter(function(){
		$(this).find('.actions span').css('display','inline');
	}).mouseleave(function() {
		$(this).find('.actions span').css('display','none');
	});
});