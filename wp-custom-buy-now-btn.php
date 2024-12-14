<?php

// custom buy now button 
add_action('woocommerce_after_shop_loop_item', 'add_buy_now_button_after_cart', 15);

function add_buy_now_button_after_cart() {
    global $product;

    if ($product->is_purchasable()) {
        $product_id = $product->get_id();
        $buy_now_url = add_query_arg(
            array(
                'add-to-cart' => $product_id,
                'quantity' => 1,
            ),
            wc_get_checkout_url()
        );

        echo '<a href="' . esc_url($buy_now_url) . '" 
               class="button buy-now-button" 
               style="margin-top: 5px; display: inline-block; background-color: #28a745; color: #fff; border-radius: 5px; text-align: center; padding: 5px 10px; text-decoration: none;">
               Buy Now
             </a>';
    }
}

// custom buy now button css - for placement under the "add to cart" button
add_action('wp_enqueue_scripts', 'enqueue_custom_css');

function enqueue_custom_css() {
    // Attach your inline CSS to an existing stylesheet, like 'woocommerce-general-css'
    $custom_css = "
        .button.buy-now-button {
		  margin-top: 60px !important;
		  border: none !important;
		}
		.button.buy-now-button:hover {
		  background: black !important;
		}

		.loop-add-to-cart {
		  margin-top: -95px;
		}
    ";

    wp_add_inline_style('woocommerce-general', $custom_css);
}

