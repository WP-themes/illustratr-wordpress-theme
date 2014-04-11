/**
 * transform.js
 *
 * Detect CSS3 Transform support in browsers.
 */
var supports = ( function() {
	var div = document.createElement( 'div' ),
	    vendors = 'Khtml Ms O Moz Webkit'.split( ' ' ),
	    len = vendors.length;

	return function( prop ) {
		if ( prop in div.style ) {
			return true;
		}

		prop = prop.replace( /^[a-z]/, function( val ) {
			return val.toUpperCase();
		} );

		while ( len-- ) {
			if ( vendors[len] + prop in div.style ) {
				return true;
			}
		}
		return false;
	};
} ) ();

if ( supports( 'transform' ) ) {
	// Add a css-transform class to the html element
	document.documentElement.className += ' css-transform';
}