(function ($) {
    "use strict";

    $(document).ready(function() {
        $('.reset_variations').click(function(){
            $(".wcva_attribute_radio").prop('checked', false);
            $("form.variations_form").find('.variations select').val('');
            $("input[name=variation_id]").val('');
            var $product = $(this).closest( '.product' );

            var $shop_single_image    = $product.find( 'div.product-images .woocommerce-main-image' );
            var productimage =  $shop_single_image.attr('data-o_src');
            var imagetitle   =  $shop_single_image.attr('data-o_title');
            var imagehref   =  $shop_single_image.attr('data-o_href');
            $shop_single_image.attr('src', productimage);
            $shop_single_image.attr('title', imagetitle);
            $shop_single_image.attr('href', imagehref);

            var $shop_thumb_image = $product.find( '.ms-thumb:eq(0)');
            var thumbimage   =  $shop_thumb_image.attr('data-o_src');
            $shop_thumb_image.attr('src', thumbimage);

            $('.single_variation_wrap').hide();
            $(this).hide();
            $(this).trigger( 'reset_image' );
            var all_set = false;
            if ( all_set ) {
                if ( $(this).css('visibility') == 'hidden' )
                    $(this).css('visibility','visible').hide().fadeIn();
            } else {
                $(this).css('visibility','hidden');
            }

            var $sku = $product.find('.product_meta .sku'),
                $weight = $product.find('.woocommerce-tabs .product_weight'),
                $dimensions = $product.find('.woocommerce-tabs .product_dimensions');

            if ( $sku.attr( 'data-o_sku' ) )
                $sku.text( $sku.attr( 'data-o_sku' ) );

            if ( $weight.attr( 'data-o_weight' ) )
                $weight.text( $weight.attr( 'data-o_weight' ) );

            if ( $dimensions.attr( 'data-o_dimensions' ) )
                $dimensions.text( $dimensions.attr( 'data-o_dimensions' ) );
        });

        $('form.variations_form').on( 'change', '.variations input:radio', function( event ) {
            var $main_form = $(this).closest('form.variations_form');
            $("input[name=variation_id]").val('').change();
            $(this).trigger( 'validate_variations', [ '', false ] );
        } );

        $('form.variations_form').on( 'validate_variations', function( event, exclude, focus ) {
            var if_variable_set             = false;
            var is_selected                 = false;
            var format            = {};
            var $main_form                 = $(this);
            var $reset_variations          = $main_form.find('.reset_variations');

            $main_form.find('.variations input:radio:checked').each( function() {
                if ( $(this).val().length == 0 ) {
                    if_variable_set = false;
                } else {
                    is_selected = true;
                    if_variable_set = true;
                }

                if ( exclude && $(this).attr('name') == exclude ) {
                    if_variable_set = false;
                    format[$(this).attr('name')] = '';
                } else {
                    var value = $(this).val().replace(/&/g, '&');
                    value = $(this).val().replace(/"/g, '"');
                    value = $(this).val().replace(/'/g, "'");
                    value = $(this).val().replace(/</g, '<');
                    value = $(this).val().replace(/>/g, '>');

                    if_variable_set = true;

                    format[ $(this).attr('name') ] = value;
                }
            });

            var pid                    = parseInt( $main_form.attr( 'data-product_id' ) );
            var all_variations         = window[ "product_variations_" + pid ];
            var available_matches      = get_variation_match( all_variations, format );
            var $product              = $(this).closest( '.product' );
            var $shop_single_image    = $product.find( 'div.product-images .woocommerce-main-image' );
            var productimage =  $shop_single_image.attr('data-o_src');
            var imagetitle   =  $shop_single_image.attr('data-o_title');
            var imagehref    =  $shop_single_image.attr('data-o_href');

            var $shop_thumb_image = $product.find( '.ms-thumb:eq(0)');
            var thumbimage   =  $shop_thumb_image.attr('data-o_src');

            if ( if_variable_set ) {
                var variation = available_matches.pop();
                if ( variation ) {
                    if ( ! exclude ) {
                        $main_form.find('.single_variation_wrap').slideDown('200');
                    }
                    $main_form
                        .find('input[name=variation_id]')
                        .val( variation.variation_id )
                        .change();

                    $main_form.trigger( 'found_variation', [ variation ] );
                } else {
                    if ( ! exclude ) {
                        $main_form.find('.single_variation_wrap').slideUp('200');
                    }
                }
            } else {
                $main_form.trigger( 'update_variation_values', [ available_matches ] );
                if ( ! focus )
                    if ( ! exclude ) {
                        $main_form.find('.single_variation_wrap').slideUp('200');
                    }
            }

            if ( is_selected ) {
                if ( $reset_variations.css('visibility') == 'hidden' )
                    $reset_variations.css('visibility','visible').hide().fadeIn();
            } else {
                $reset_variations.css('visibility','hidden').hide();
            }
        } );

        $('form.variations_form').on( 'found_variation', function( event, variation ) {
            var $main_form = $(this);

            var $product              = $(this).closest( '.product' );

            var $image_slider = $product.find('.product-image-slider');
            var product_image_slider = $image_slider.data('imageSlider');

            if (product_image_slider != null && typeof product_image_slider.api.view != 'undefined') {
                product_image_slider.api.gotoSlide(0);
            }

            var $shop_single_image    = $product.find( 'div.product-images .woocommerce-main-image' );
            var productimage           =  $shop_single_image.attr('data-o_src');
            var imagetitle             =  $shop_single_image.attr('data-o_title');
            var imagehref              =  $shop_single_image.attr('data-o_href');

            var $shop_thumb_image = $product.find( '.ms-thumb:eq(0)');
            var thumbimage   =  $shop_thumb_image.attr('data-o_src');

            var variation_image = variation.image_src;
            var variation_link = variation.image_link;
            var variation_title = variation.image_title;
            var variation_thumb = variation.image_thumb;

            $main_form.find('.variations_button').show();
            $main_form.find('.single_variation').html( variation.price_html + variation.availability_html );

            if ( ! productimage ) {
                productimage = ( ! $shop_single_image.attr('src') ) ? '' : $shop_single_image.attr('src');
                $shop_single_image.attr('data-o_src', productimage );
            }

            if ( ! imagehref ) {
                imagehref = ( ! $shop_single_image.attr('href') ) ? '' : $shop_single_image.attr('href');
                $shop_single_image.attr('data-o_href', imagehref );
            }

            if ( ! imagetitle ) {
                imagetitle = ( ! $shop_single_image.attr('title') ) ? '' : $shop_single_image.attr('title');
                $shop_single_image.attr('data-o_title', imagetitle );
            }

            if ( ! thumbimage ) {
                thumbimage = ( ! $shop_thumb_image.attr('src') ) ? '' : $shop_thumb_image.attr('src');
                $shop_thumb_image.attr('data-o_src', thumbimage );
            }

            if ( variation_image && variation_image.length > 1 ) {
                $shop_single_image.attr( 'src', variation_image )
                $shop_single_image.attr( 'alt', variation_title )
                $shop_single_image.attr( 'title', variation_title );
                $shop_single_image.attr( 'href', variation_link );
                $shop_thumb_image.attr( 'src', variation_thumb );
            } else {
                $shop_single_image.attr( 'src', productimage )
                $shop_single_image.attr( 'alt', imagetitle )
                $shop_single_image.attr( 'title', imagetitle );
                $shop_single_image.attr( 'href', imagehref );
                $shop_thumb_image.attr( 'src', thumbimage );
            }
            var elevateZoom = $shop_single_image.data('elevateZoom');
            if (typeof elevateZoom != 'undefined') {
                elevateZoom.swaptheimage($shop_single_image.attr( 'src' ), $shop_single_image.attr( 'src' ));
            }

            var $single_variation_wrap = $main_form.find('.single_variation_wrap');

            var $sku = $product.find('.product_meta .sku'),
                $weight = $product.find('.woocommerce-tabs .product_weight'),
                $dimensions = $product.find('.woocommerce-tabs .product_dimensions');

            if ( ! $sku.attr( 'data-o_sku' ) )
                $sku.attr( 'data-o_sku', $sku.text() );

            if ( ! $weight.attr( 'data-o_weight' ) )
                $weight.attr( 'data-o_weight', $weight.text() );

            if ( ! $dimensions.attr( 'data-o_dimensions' ) )
                $dimensions.attr( 'data-o_dimensions', $dimensions.text() );

            if ( variation.sku )
                $sku.text( variation.sku );
            else
                $sku.text( $sku.attr( 'data-o_sku' ) );

            if ( variation.weight ) {
                $weight.text( variation.weight );
            } else {
                $weight.text( $weight.attr( 'data-o_weight' ) );
            }

            if ( variation.dimensions ) {
                $dimensions.text( variation.dimensions );
            } else {
                $dimensions.text( $dimensions.attr( 'data-o_dimensions' ) );
            }

            $single_variation_wrap.find('.quantity').show();

            if ( ! variation.is_in_stock && ! variation.backorders_allowed ) {
                $main_form.find('.variations_button').hide();
            }

            if ( variation.min_qty )
                $single_variation_wrap.find('input[name=quantity]').attr( 'data-min', variation.min_qty ).val( variation.min_qty );
            else
                $single_variation_wrap.find('input[name=quantity]').removeAttr('data-min');

            if ( variation.max_qty )
                $single_variation_wrap.find('input[name=quantity]').attr('data-max', variation.max_qty);
            else
                $single_variation_wrap.find('input[name=quantity]').removeAttr('data-max');

            if ( variation.is_sold_individually == 'yes' ) {
                $single_variation_wrap.find('input[name=quantity]').val('1');
                $single_variation_wrap.find('.quantity').hide();
            }

            $single_variation_wrap.slideDown('200').trigger( 'show_variation', [ variation ] );
        } );

        $('form.variations_form .variations input:radio').change();

        /*
         * find matching variation
         */
        function get_variation_match( product_variations, format ) {
            var matching = [];

            for (var i = 0; i < product_variations.length; i++) {
                var variation    = product_variations[i];
                var variation_id = variation.variation_id;
                var attrs1       = variation.attributes;
                var attrs2       = format;

                if ( validate_variations( attrs1, attrs2 ) ) {
                    matching.push(variation);
                }
            }
            return matching;
        }

        var loop=0;

        function validate_variations( attrs1, attrs2 ) {
            var match = true;
            for ( var attr_name in attrs1 ) {
                var attribute1="";
                var attribute2="";
                if(loop>1)
                {
                    attribute1 = String(attrs1[ attr_name ]).toLowerCase();
                    attribute2 = String(attrs2[ attr_name ]).toLowerCase();
                }
                else
                {
                    attribute1 = attrs1[ attr_name ];
                    attribute2 = attrs2[ attr_name ];
                    loop++;
                }

                if ( attribute1 !== undefined && attribute2 !== undefined && attribute1.length != 0 && attribute2.length != 0 && attribute1 != attribute2 ) {
                    match = false;
                }
            }
            return match;
        }

        $('form.variations_form').on( 'change', '.variations select', function( event ) {
            var id =  $(this).attr('id');
            $("input[name='attribute_"+id+"'][value='"+this.value+"']").attr("checked","checked");
            $("input[name=variation_id]").val('').change();
            $(this).trigger( 'validate_variations', [ '', false ] );
        } );

        $('form.variations_form').on( 'reset_image', function( event ) {
            var $product        = $(this).closest( '.product' );
            var $product_img    = $product.find( 'div.product-images .woocommerce-main-image' );
            var o_src           = $product_img.attr('data-o_src');
            var o_title         = $product_img.attr('data-o_title');
            var o_href          = $product_img.attr('data-o_href');
            var $thumb_img      = $product.find( '.ms-thumb:eq(0)' );
            var o_thumb_src     = $thumb_img.attr('data-o_src');

            if ( o_src && o_title ) {
                $product_img
                    .attr( 'src', o_src )
                    .attr( 'alt', o_title )
                    .attr( 'title', o_title )
                    .attr( 'href', o_href );

                var elevateZoom = $product_img.data('elevateZoom');
                if (typeof elevateZoom != 'undefined') {
                    elevateZoom.swaptheimage($product_img.attr( 'src' ), $product_img.attr( 'src' ));
                }
            }
            if (o_thumb_src) {
                $thumb_img.attr( 'src', o_thumb_src );
            }
        } );
    });
}(jQuery));
