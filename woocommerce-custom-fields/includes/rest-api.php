<?php

// Add custom fields to REST API response
add_filter( 'woocommerce_rest_prepare_product_object', 'woocomerce_adding_custom_fields_to_rest_apis', 10, 3 );
// This filter hook is used to modify the response of the WooCommerce REST API
// Define the function to add custom fields to the REST API response

function woocomerce_adding_custom_fields_to_rest_apis( $response, $object, $request ) {

    // Get the product ID from the object
    $product_id = $object->get_id();

    // Add a new key to the response data called 'custom_fields'
    $response->data['custom_fields'] = array(
        // Get the value of the '_length_fields' and others  meta field and add it to the array
        '_length_fields' => get_post_meta( $product_id, '_length_fields', true ),
        '_width_fields' => get_post_meta( $product_id, '_width_fields', true ),
        '_height_fields' => get_post_meta( $product_id, '_height_fields', true ),
    );

    // Return the response
    return $response;
}


// Update custom fields via REST API

// This filter hook is used to modify the request data of the WooCommerce REST API
add_filter( 'woocommerce_rest_api_get_product_meta', 'woocommerce_updated_custom_fields_via_rest_apis', 10, 3 );

// Define the function to update custom fields via the REST API
function woocommerce_updated_custom_fields_via_rest_apis( $response, $object, $request ) {
    // Get the product ID from the object
    $product_id = $object->get_id();
    
    // Check if the request data contains a 'custom_fields' key
    if ( isset( $request['custom_fields'] ) ) {

        // Get the custom fields data from the request
        $custom_fields = $request['custom_fields'];

        // Check if the '_length_fields' and others feilds key is set in the custom fields data
        if ( isset( $custom_fields['_length_fields'] ) ) {
            update_post_meta( $product_id, '_length_fields', esc_attr( $custom_fields['_length_fields'] ) );
        }
        if ( isset( $custom_fields['_width_fields'] ) ) {
            update_post_meta( $product_id, '_width_fields', esc_attr( $custom_fields['_width_fields'] ) );
        }
        if ( isset( $custom_fields['_height_fields'] ) ) {
            update_post_meta( $product_id, '_height_fields', esc_attr( $custom_fields['_height_fields'] ) );
        }
    }
    
    // Return the response
    return $response;
}