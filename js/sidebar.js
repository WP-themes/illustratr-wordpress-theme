( function( $ ) {

	$( window ).load( function() {

		var widgets_area = $( '.widgets-area' );

		$( '#secondary' ).on( 'click', '.widgets-trigger', function( event ) {
			event.preventDefault();
			$( this ).toggleClass( 'active' );
			if( $( this ).hasClass( 'active' ) ) {
				$( '.widgets-wrapper' ).slideDown( 250 );
				// Trigger resize to make sure widgets fit prefectly.
				$( this ).trigger( 'resize' );
				// Masonry blocks
				widgets_area.imagesLoaded( function() {
					if ( $( 'body' ).hasClass( 'rtl' ) ) {
						widgets_area.masonry( {
							columnWidth: 1,
							itemSelector: '.widget',
							transitionDuration: 0,
							isRTL: true
						} );
					} else {
						widgets_area.masonry( {
							columnWidth: 1,
							itemSelector: '.widget',
							transitionDuration: 0
						} );
					}
					// Show the widgets
					widgets_area.children( '.widget' ).animate( {
						'opacity' : 1
					}, 250 );
				} );
			} else {
				$( '.widgets-wrapper' ).slideUp( 250 );
				// Make sure the widgets are hidden
				widgets_area.children( '.widget' ).animate( {
					'opacity' : 0
				}, 250 );
			}
		} );
		$( '#secondary' ).on( 'mouseenter mouseleave', '.widgets-trigger', function() {
			$( '#secondary' ).toggleClass( 'hover' );
		} );

		$( window ).resize( function () {

			// Force layout correction after 1500 milliseconds
			setTimeout( function () {
				widgets_area.masonry();
			}, 1500 );

		} );

	} );

} )( jQuery );
