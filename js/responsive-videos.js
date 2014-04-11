( function( $ ) {

	$( '.hentry.format-video .entry-media embed, .hentry.format-video .entry-media iframe, .hentry.format-video .entry-media object, .video-wrapper embed, .video-wrapper iframe, .video-wrapper object' ).each( function() {

		$( this ).attr( 'data-ratio', this.height / this.width );

	} );

	function responsive_videos() {

		$( '.video-wrapper embed, .video-wrapper iframe, .video-wrapper object' ).each( function() {

			var video_ratio     = $( this ).attr( 'data-ratio' ),
			    video_wrapper   = $( this ).parent(),
			    container_width = video_wrapper.width();

			$( this )
				.removeAttr( 'height' )
				.removeAttr( 'width' )
				.width( container_width )
				.height( container_width * video_ratio );

		} );

		$( '.hentry.format-video .entry-media embed, .hentry.format-video .entry-media iframe, .hentry.format-video .entry-media object, .hentry.format-video > .video-wrapper embed, .hentry.format-video > .video-wrapper iframe, .hentry.format-video > .video-wrapper object, .portfolio-entry embed, .portfolio-entry iframe, .portfolio-entry object' ).each( function() {

			var video_ratio   = $( this ).attr( 'data-ratio' ),
			    video_wrapper = $( this ).parent();

			if( $( window ).width() < 768 ) {
				var container_width = video_wrapper.width() + 40; // $vspacing * 2
			} else if( $( window ).width() < 960 ) {
				var container_width = video_wrapper.width() + 80; // $vspacing-double * 2
			} else {
				var container_width = video_wrapper.width();
			}

			$( this )
				.removeAttr( 'height' )
				.removeAttr( 'width' )
				.width( container_width )
				.height( container_width * video_ratio );

		} );

	}

	responsive_videos();

	$( window ).load( responsive_videos ).resize( _.debounce( responsive_videos, 100 ) );
	$( document ).on( 'post-load', function() {

		$( '.hentry.format-video .entry-media embed, .hentry.format-video .entry-media iframe, .hentry.format-video .entry-media object, .video-wrapper embed, .video-wrapper iframe, .video-wrapper object' ).each( function() {

			$( this ).attr( 'data-ratio', this.height / this.width );

		} );

		responsive_videos();

	} );

} )( jQuery );
