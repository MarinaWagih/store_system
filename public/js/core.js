$(function() {
	
	$('#print').click(function() {
      $("#printableContent").printThis();
	});
	
});
$(document).keydown(function(event) {
    if (event.ctrlKey==true && (event.which == '80')) { //ctrl + p
        event.preventDefault();
        printAssessment();
    }
})

function printAssessment() {
    $('#print').trigger('click');
}
$(document).ready(function () {
    if(autoPrint&&autoPrint!=false)
    {
        printAssessment();
    }
});