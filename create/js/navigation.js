jQuery(document).ready(function($) {
	var body, masthead, menuTogglePrimary, siteNavigationPrimary, siteHeaderMenuPrimary;

	function initMainNavigation( container ) {
		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		// For default page menu
		container.find( '.page_item_has_children > a' ).after( dropdownToggle );
        container.find( '.current_page_ancestor > button' ).addClass( 'toggled-on' );
        container.find( '.current_page_ancestor > .sub-menu' ).addClass( 'toggled-on' );
        container.find( '.page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	//initMainNavigation( $( '.main-navigation' ) );


	//For Primary Menu
	menuTogglePrimary       = $( '#menu-toggle-primary' ); // button id
	siteHeaderMenuPrimary   = $( '#primary-menu-wrapper' ); // wrapper id
	siteNavigationPrimary   = $( '#site-navigation' ); // nav id
	initMainNavigation( siteNavigationPrimary );

	// Enable menuTogglePrimary.
	( function() {

		// Return early if menuTogglePrimary is missing.
		if ( ! menuTogglePrimary.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuTogglePrimary.add( siteNavigationPrimary ).attr( 'aria-expanded', 'false' );

		menuTogglePrimary.on( 'click', function() {
			$( this ).add( siteHeaderMenuPrimary ).toggleClass( 'toggled-on' );

			$( 'body' ).toggleClass( 'primary-menu-open' );

			$( 'body' ).removeClass( 'secondary-menu-open' );

			// jscs:disable
			$( this ).add( siteNavigationPrimary ).attr( 'aria-expanded', $( this ).add( siteNavigationPrimary ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigationPrimary.length || ! siteNavigationPrimary.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.catch-box', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigationPrimary.find( '.menu-item-has-children > a' ).on( 'touchstart.catch-box', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigationPrimary.find( '.menu-item-has-children > a' ).unbind( 'touchstart.catch-box' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.catch-box', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigationPrimary.find( 'a' ).on( 'focus.catch-box blur.catch-box', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();
	//Primary Menu End

});
