<?php

// Display Fields in admin panel
add_action( 'woocommerce_product_options_general_product_data', 'woocommerce_add_custom_general_fields' );
function woocommerce_add_custom_general_fields() {

    // Make the $woocommerce and $post variables available
    global $woocommerce, $post;
  
    // Output HTML to create a container for our custom fields
    echo '<div class="options_group"><p class="form-field custom_field_type"><label for="custom_field_type">'.__( 'Custom Field Type', 'woocommerce' ).'</label></p>';
    
    // Create a text input field for length
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_length_fields', 
            'label'       => __( 'Length', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Additional Length description.', 'woocommerce' ) 
        )
    );
    // Create a text input field for Width 
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_width_fields', 
            'label'       => __( 'Width', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Additional Width description.', 'woocommerce' ) 
        )
    );
    // Create a text input field for Height 
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_height_fields', 
            'label'       => __( 'Height', 'woocommerce' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Additional Height description.', 'woocommerce' ) 
        )
    );
    echo '</div>';
}

// Saving the 3 Fields
add_action( 'woocommerce_process_product_meta', 'woocommerce_add_custom_general_fields_saving' );
// Creating the function to save the custom fields
function woocommerce_add_custom_general_fields_saving( $post_id ){

    // Get the value of the length field from the $_POST array
    $woocommerce_text_field = $_POST['_length_fields'];
    // If the length field is not empty, update the product meta data
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_length_fields', esc_attr( $woocommerce_text_field ) );
    
    $woocommerce_text_field = $_POST['_width_fields'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_width_fields', esc_attr( $woocommerce_text_field ) );

     $woocommerce_text_field = $_POST['_height_fields'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_height_fields', esc_attr( $woocommerce_text_field ) );
}

// Adding an action hook to display the custom fields on the product page

add_action('woocommerce_single_product_summary', 'product_meta_feilds_preveiewing',7);
function product_meta_feilds_preveiewing(){

    // Check if the product has custom fields
    if ( get_post_meta( get_the_ID(), '_length_fields', true ) or get_post_meta( get_the_ID(), '_width_fields', true ) or get_post_meta( get_the_ID(), '_height_fields', true )) :
        echo "<p>";

        // Display the length fields 
        if ( get_post_meta( get_the_ID(), '_length_fields', true ) ) :
            echo "<p><b>Length: </b>";
            echo get_post_meta( get_the_ID(), '_length_fields', true );
        endif; 
        // end of fields 

        if ( get_post_meta( get_the_ID(), '_width_fields', true ) ) :
            echo "<br><b>Width : </b>";
            echo get_post_meta( get_the_ID(), '_width_fields', true );
        endif; 
        if ( get_post_meta( get_the_ID(), '_height_fields', true ) ) :
            echo "<br><b>Height : </b>";
            echo get_post_meta( get_the_ID(), '_height_fields', true );
        endif; 
        echo "</p>";
    endif; 
 }



