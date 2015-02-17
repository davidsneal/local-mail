$( document ).ready(function() {

	// excerpt clicked
	$('.mail-excerpt').click(function() {
		
		// remove selected class to last selected message
		$('.mail-excerpt').removeClass( "mail-excerpt-active" )
		
		// add selected class to current message
		$(this).addClass('mail-excerpt-active');
		
		// get message id from excerpt
		var messageid = $(this).data('messageid');
		
		$.get( '/email/' + messageid, function( email ) {
			$( ".content" ).html( email.body );
			$( ".mail-header" ).html( email.header );
		});
	});
});