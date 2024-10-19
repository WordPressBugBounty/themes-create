/**
 * Theme Customizer custom scripts
 * Control of show/hide events on feature slider type selection
 */
(function($) {

    /*
     * For Feature Slider on featured_slider_type click event
     */
    $('#accordion-panel-create_featured_slider .accordion-section-title').on( "click", function() {
        var value = $("#customize-control-featured_slider_type label select").val();

        if (value == 'demo-featured-slider') {
            $('#customize-control-featured_slide_number').hide();
        } else {
            $('#customize-control-featured_slide_number').show();
        }
        
        if( value == 'featured-page-slider' ) {
            $('[id*=customize-control-featured_slider_page]').show();
        }
        else {
            $('[id*=customize-control-featured_slider_page]').hide();
        }
    });

    $("#customize-control-featured_slider_type label select").on( "change", function() {
        var value = $(this).val();

        if (value == 'demo-featured-slider') {
            $('#customize-control-featured_slide_number').hide();
        } else {
            $('#customize-control-featured_slide_number').show();
        }

        if( value == 'featured-page-slider' ) {
            $('[id*=customize-control-featured_slider_page]').show();
        }
        else {
            $('[id*=customize-control-featured_slider_page]').hide();
        }
    });
})(jQuery);

( function( api ) {
    wp.customize( 'reset_all_settings', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: create_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );
} )( wp.customize );
