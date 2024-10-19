(function($) {
	$(document).ready(function() {

		/*
		 * Masonry
		 */

		//Masonry blocks
		$blocks = $(".create-masonry #main");

		$blocks.imagesLoaded(function(){
			$blocks.masonry({
				"columnWidth": ".create-masonry .hentry",
				"itemSelector": ".hentry",
				"percentPosition": true
			});

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$(".hentry").fadeIn();
			$blocks.find( '.hentry' ).animate( {
				'opacity' : 1
			} );

		});

		$(document).ready( function() { setTimeout( function() { $blocks.masonry(); }, 500); });

		$(window).on( 'resize', function () {
			$blocks.masonry();
		});

		// When Jetpack Infinite scroll posts have loaded
		$( document.body ).on( 'post-load', function () {

			var $container = $('.create-masonry #main');
			$container.masonry( 'reloadItems' );

			$blocks.imagesLoaded(function(){
				$blocks.masonry({
					"columnWidth": ".create-masonry .hentry",
					"itemSelector": ".hentry",
					"percentPosition": true
				});

				// Fade blocks in after images are ready (prevents jumping and re-rendering)
				$(".hentry").fadeIn();
				$blocks.find( '.hentry' ).animate( {
					'opacity' : 1
				} );

			});

			$container.masonry( 'reloadItems' );

			$(document).ready( function() { setTimeout( function() { $blocks.masonry(); }, 500); });

		});

		/*
		 * Comment placeholders
		 * (Localized via wp_localize_script in functions file)
		 */
		$( '#author' ).attr( 'placeholder','Your Name' );
		$( '#email' ).attr( 'placeholder','E-mail' );
		$( '#url' ).attr( 'placeholder','Website' );
		$( '#comment' ).attr( 'placeholder','Your Comment' );
	});
})(jQuery);
