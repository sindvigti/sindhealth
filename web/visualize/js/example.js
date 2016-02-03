// Run the script on DOM ready:
$(function(){
 $('table.listing').visualize({type: 'pie', height: '300px', width: '420px'});
	$('table.listing').visualize({type: 'bar', width: '420px'});
	$('table.listing').visualize({type: 'area', width: '420px'});
	$('table.listing').visualize({type: 'line', width: '420px'});
});
