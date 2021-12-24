( function( $ ) {


	$.fn.WPCustomizeTerms = function() {
		return this.each( function( index, control ) {
			jQuery( control ).on( 'change', '.inside input:checkbox', function () {
				let value = [];
				jQuery( control ).find( '.inside input:checkbox:checked' ).each( function ( index, checkbox ) {
					value.push( jQuery( checkbox ).val() );
				} );
				wp.customize.value( jQuery( control ).find( 'input' ).attr( 'id' ).replace( /customize-control-/i, '' ) ).set( value.join( ',' ) );
			} );
		} );


	};


} )( jQuery );