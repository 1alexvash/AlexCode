/* мобильное меню */
( function () {

	let $menu = jQuery( '.header-content' );
	let $openBtn = jQuery( '#header-buter' );
	let $closeBtn = jQuery( '#header-close' );

	function OpenMenu( event ) {
		event.preventDefault();
		$menu.addClass( 'active' );
	}

	function CloseMenu( event ) {
		event.preventDefault();
		$menu.removeClass( 'active' );
	}

	$openBtn.on( 'click', OpenMenu );
	$closeBtn.on( 'click', CloseMenu );
	
} )( jQuery );


/* открытие/закрытие формы поиска */
( function () {

	let $btn = jQuery( '#search-toggle' );
	let $body = jQuery( 'body' );

	function Toggle( event ) {
		$body.toggleClass( 'body-search-modal-active' );
		if ( $body.hasClass( 'body-search-modal-active' ) ) {
			jQuery( '#search-modal #searchform-control' ).focus();
		}
	}

	$btn.on( 'click', Toggle );

} )( jQuery );