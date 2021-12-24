( function () {
	
	function Get( key ) {
		let viewed = [];
		if ( null == window.localStorage.getItem( key ) ) {
			window.localStorage.setItem( key, JSON.stringify( viewed ) );
		} else {
			viewed = JSON.parse( window.localStorage.getItem( key ) );
		}
		return viewed;
	}


	function Send( key, callback ) {
		jQuery.ajax( {
			type: 'POST',
			url: BlogpostParam.ajaxurl,
			data: {
				action: key,
				nonce: BlogpostParam.nonce,
				post: BlogpostParam.post,
			},
			success: function ( answer ) {
				if ( 'undefined' != typeof answer.success && answer.success && answer.data ) {
					if ( callback ) {
						callback( answer.data );
					}
				} else {
					console.log( answer );
				}
			},
			error: function ( answer ) {
				console.log( answer );
			},
		} );
	}

	function SetLike( event ) {
		event.preventDefault();
		if ( ! Get( 'like' ).includes( BlogpostParam.post ) && ! Get( 'dislike' ).includes( BlogpostParam.post ) ) {
			Send( 'like', function ( value ) {
				let like = Get( 'like' );
				like.push( BlogpostParam.post );
				window.localStorage.setItem( 'like', JSON.stringify( like ) );
				jQuery( '#like' ).unbind( 'click', 'SetLike' ).addClass( 'active' ).find( '.value' ).text( parseInt( value ) );
				jQuery( '#dislike' ).unbind( 'click', 'SetDislike' ).attr( 'disabled', 'disabled' );
			} );
		} else {
			console.log( 'already click' );
		}
	}

	function SetDislike( event ) {
		event.preventDefault();
		if ( ! Get( 'dislike' ).includes( BlogpostParam.post ) && ! Get( 'like' ).includes( BlogpostParam.post ) ) {
			Send( 'dislike', function ( value ) {
				let dislike = Get( 'dislike' );
				dislike.push( BlogpostParam.post );
				window.localStorage.setItem( 'dislike', JSON.stringify( dislike ) );
				jQuery( '#like' ).unbind( 'click', 'SetLike' ).attr( 'disabled', 'disabled' );;
				jQuery( '#dislike' ).unbind( 'click', 'SetDislike' ).addClass( 'active' ).find( '.value' ).text( parseInt( value ) );
			} );
		} else {
			console.log( 'already like' );
		}
	}

	function SetViewed() {
		setTimeout( function () {
			Send( 'viewed', function () {
				let viewed = Get( 'viewed' );
				viewed.push( BlogpostParam.post );
				window.localStorage.setItem( 'viewed', JSON.stringify( viewed ) );
			} );
		}, 5000 );
	}

	function ShareToggle() {
		jQuery( '.ssbp-bar-list' ).toggleClass( 'active' );
	}

	function Init() {
		let $shareList = jQuery( '.ssbp-bar-list' );
		let $shareToggle = jQuery( '#share-toggle' );
		let $like = jQuery( '#like' );
		let $dislike = jQuery( '#dislike' );
		if ( typeof BlogpostParam != 'undefined' ) {
			if ( ! Get( 'viewed' ).includes( BlogpostParam.post ) ) {
				SetViewed();
			} else {
				console.log( 'already viewed' );
			}
		}
		if ( Get( 'like' ).includes( BlogpostParam.post ) ) {
			$like.addClass( 'active' ).attr( 'disabled', 'disabled' );
			$dislike.attr( 'disabled', 'disabled' );
		} else {
			if ( Get( 'dislike' ).includes( BlogpostParam.post ) ) {
				$like.attr( 'disabled', 'disabled' );
				$dislike.addClass( 'active' ).attr( 'disabled', 'disabled' );
			} else {
				$like.on( 'click', SetLike );
				$dislike.on( 'click', SetDislike );	
			}
		}
		if ( $shareList.length ) {
			$shareToggle.removeClass( 'hide' );
			$shareToggle.on( 'click', ShareToggle );
		}
	}

	jQuery( document ).ready( Init );	
	
} )();