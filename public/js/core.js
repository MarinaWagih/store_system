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
});

function printAssessment() {
    //alert("Print the little page");
    window.print();
}