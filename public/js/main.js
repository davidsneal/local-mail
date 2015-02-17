$( document ).ready(function() {
	
	var mailExcerpt = $('.mail-excerpt');

	// excerpt clicked
	mailExcerpt.click(function() {
		
		// remove selected class to last selected message
		mailExcerpt.removeClass( "mail-excerpt-active" );
		
		// add selected class to current message
		$(this).addClass('mail-excerpt-active');
		
		// get message id from excerpt
		var messageid = $(this).data('messageid');
		
		// get the email data in json format
		$.get( '/email/' + messageid, function( email ) {
			
			// replace body and header as needed
			$(".content").html(email.body);
			$(".mail-header").html(email.header);
		});
	});
});