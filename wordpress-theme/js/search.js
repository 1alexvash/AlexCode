( function () {


	let $control = jQuery( '#search-modal #searchform-control' );
	let $result = jQuery( '#search-modal #search-list' );
	let timestamp = 0;

	$control.attr( 'autocomplete', 'off' );

	function HighlightWords( line, need ) {
		need.trim().replace( /[ ]+/g, ' ' ).split( ' ' ).map( function ( word ) {
			var regex = new RegExp( '(' + word + ')', 'gi' );
			line = line.replace( regex, "<span class=\"bg-search\">$1</span>" );
		} );
		return line;
	}


	function RequestHandler() {
		console.log( 'request' );
		jQuery.ajax( {
			url: SearchParams.ajaxurl,
			method: 'POST',
			data: {
				action: 'alex_search',
				keyword: $control.val(),
			},
			success: function ( respond ) {
				$result.removeClass( 'hide' );
				if ( typeof( respond.data ) != 'undefined' && respond.data.length ) {
					$result.html( respond.data );
				}
			}
		} );
	}


	function DelayHandler( label ) {
		setTimeout( function () {
			if ( timestamp >= label ) {
				if ( $control.val().length >= 3 ) {
					RequestHandler();
				} else {
					$result.empty();
				}
			}
		}, 250 );
	}


	function GetResult() {
		console.log( $control );
		console.log( $control.val() );
		if ( $control.val().length >= 3 ) {
			timestamp = Date.now();
			DelayHandler( timestamp );
		} else {
			$result.empty();
			$result.addClass( 'hide' );
		}
	}


	jQuery( document ).on( 'keyup', '#search-modal #searchform-control', GetResult );
	jQuery( document ).on( 'click', '#search-modal #searchform-control', GetResult );


} )();


	