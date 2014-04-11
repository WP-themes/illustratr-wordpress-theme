/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-branding' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-branding' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title' ).css( {
					'color': to
				} );
			}
		} );
	} );
	// Background color.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			if ( '#24282d' === to ) {
				$( 'body' ).addClass( 'default-background' );
			} else {
				$( 'body' ).removeClass( 'default-background' );
			}
		} );
	} );
} )( jQuery );
