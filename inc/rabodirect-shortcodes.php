<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 22/09/14
 * Time: 11:59 AM
 *
 * Shortcode Reference: http://codex.wordpress.org/Function_Reference/add_shortcode
 */

// ==========
// Components
// ==========

// Function to remove unwanted <p> tags
// Row
// ---

remove_shortcode('row');

add_shortcode('row', 'rabodirect_row');

function rabodirect_row($atts, $content) {

    $before = $after = "";

//    $wrapper = false;

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'wrapper'           => 'div'
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $new_content = do_shortcode($content);

//    if( $atts['wrapper'] !== 'false' ) {
//        $before = "<{$atts['wrapper']} id=\"{$atts['id']}\" class=\"page-section {$atts['class']}\">\n";
//        $after = "</{$atts['wrapper']}>\n";
//    }

//	$output = $before;

    return "<div class=\"row\">{$new_content}</div>\n";

//	$output .= $after;

//	return $output;

}// Page section
// ---

remove_shortcode('page-section');

add_shortcode('page-section', 'rabodirect_page_section');

function rabodirect_page_section($atts, $content) {

    $before = $after = "";

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'wrapper'           => 'div'
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    if( $atts['wrapper'] !== 'false' ) {
        $before = "<{$atts['wrapper']} id=\"{$atts['id']}\" class=\"page-section {$atts['class']}\">\n";
        $after = "</{$atts['wrapper']}>\n";
    }

    $output = $before . do_shortcode($content) . $after;

    return $output;

}

// Column
// ------

remove_shortcode('column');

add_shortcode('column', 'rabodirect_column');

function rabodirect_column($atts, $content) {
    $id = $class = $small = $medium = $large = $mobile = $tablet = $desktop = '';

    $defaults = array(
        'class'             => '',
        'id'                => false,
        'allow_shortcode'   => true,
        'desktop'           => false,
        'tablet'            => false,
        'mobile'            => '12',
        'small'             => '12',
        'medium'            => false,
        'large'             => false,
        'add_paragraphs'    => true

    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    // This will allow a shortcode within the shortcode
//	if( $atts['allow_shortcode'] ) {
//	}
    $new_content = do_shortcode($content);

    // Remove extra <p> tags
//	$content = shortcode_unautop($content);

    // Extract all attributes and enter as variables
    extract($atts);

    //***** THIS WILL ALLOW EITHER SCREEN SIZE OR DEVICE *****//
    //***** TO BE ENTERED INTO THE SHORTCODE *****//

    // Comparing if the small or mobile attribute has been called
    if( $small ) {
        $class .= ' small-' . $small;
    } else if ( $mobile ) {
        $class .= ' small-' . $mobile;
    }

    // Comparing if the medium or tablet attribute has been called

    if( $medium ) {
        $class .= ' medium-' . $medium;
    } else if ( $tablet ) {
        $class .= ' medium-' . $tablet;
    }

    // Comparing if the large or desktop attribute has been called
    $large = '';
    if( $large ) {
        $class .= ' large-' . $large;
    } else if ( $desktop ) {
        $class .= ' large-' . $desktop;
    }

    // Check if the user has opted out of automatically adding paragraphs
    // if not apply the wpautop method to the content
    if($atts['add_paragraphs'] !== 'false') {
        $new_content = wpautop($new_content);
    }


    return "<div{$id} class=\"columns {$class}\">{$new_content}</div>";

}

// Alert panel
// -----------

// Example shortcode

// Simple Usage
// [alert-panel id="google-chrome-panel" icon="icons-google-chrome-logo"]Plus, now our secure website is also supported by Google Chrome[/alert-panel]

// Complex usage:
// [alert-panel class="error" id="email-error" allow_shortcode="false" background-color="#b00" text-color="#fff"]Please enter a valid email address[/alert-panel]

remove_shortcode('alert-panel');

add_shortcode('alert-panel', 'rabodirect_alert_panel');

function rabodirect_alert_panel( $atts, $content='' ) {

    // Define defaults in an array

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'icon'              => false,
        'allow_shortcode'   => true,
        'background-color'  => false,
        'text-color'        => false,
    );

    // Merge attributes from shortcode with defaults
    // Using WordPress' shortcode_atts() method
    $atts = shortcode_atts( $defaults, $atts );

    // Auto wrap content paragraphs
    $content = wpautop($content);

    // Use input values to manipulate content
    // Here, we can check if 'allow_shortcode' has been set to true
    // and if so, run the do_shortcode method on the content
    if( $atts['allow_shortcode'] ) {
        $content = do_shortcode($content);
    }

    // Add icon
    if( $atts['icon'] ) {
        $content = "<i class=\"icon {$atts['icon']}\"></i>{$content}\n";
    }

    // Use cosmetic values to manually style the element
    $style = '';
    if( $atts['background-color'] ) {
        $style .= 'background-color: ' . $atts['background-color'] . ';';
    }
    if( $atts['text-color'] ) {
        $style .= 'color: ' . $atts['text-color'] . ';';
    }


    // Output is returned as an HTML string
    return "<div class=\"row\"><div id=\"{$atts['id']}\" class=\"alert-panel {$atts['class']}\"
	style=\"{$style}\">{$content}</div></div>\n";
}

// Button
// ------

remove_shortcode('button');

add_shortcode('button', 'rabodirect_button');

function rabodirect_button( $atts, $content ) {

    // Define defaults in an array

    $defaults = array(
        'class'             => '',
        'colour'            => 'grey',
        'color'             => false,
        'id'                => '',
        'allow_shortcode'   => true,
        'url'               => '#',
        'center'            => false,
        'backgroundcolour'  => false,
        'backgroundcolor'  => false,
        'textcolour'        => false,
        'textcolor'        => false,
        'newtab'            => false,
        'tracking'          => false,

    );

    // Merge attributes from shortcode with defaults
    // Using WordPress' shortcode_atts() method
    $atts = shortcode_atts( $defaults, $atts );

    if ( $atts['color'] ) {
        $atts['colour'] = $atts['color']  ;
    } else $atts['color'] = $atts['colour'];
    if ( $atts['backgroundcolor'] ) {
        $atts['backgroundcolour'] = $atts['backgroundcolor']  ;
    }
    if ( $atts['textcolor'] ) {
        $atts['backgroundcolour'] = $atts['backgroundcolor']  ;
    }
    $target = '';
    if ( $atts['newtab'] ) {
        $target = '_blank';
    }
    $tracking = '';
    if ( $atts['tracking'] ) {
        $tracking = "onclick=\"trackOutboundLink('".$atts['url']."'); return false;\"";

    }

//    // Auto wrap content paragraphs
//    $content = wpautop($content);

    // Use input values to manipulate content
    // Here, we can check if 'allow_shortcode' has been set to true
    // and if so, run the do_shortcode method on the content
    if( $atts['allow_shortcode'] ) {
        $content = do_shortcode($content);
    }

    // Merge colors and classes together
    $class = $atts['class'] .' '.  $atts['colour'];

    $middle = '';
    // Center the button within the space
    if ( $atts['center'] ) {
        $middle .= 'margin: 0 auto;';
    }

    $color = '';
    // Use cosmetic values to manually style the element
    if( $atts['backgroundcolour'] ) {
        $color .= 'background: ' . $atts['backgroundcolour'] . ';';
    }

    $text = '';
    if( $atts['textcolour'] ) {
        $text .= 'color: ' . $atts['textcolour'] . ';';
    }

    $astyle = $text . $middle . $color;

    // Output is returned as an HTML string
    $output = "<div id=\"{$atts['id']}\" class=\"rabo-button {$class} {$color}\">\n<p>\n";
    $output .= "<a href=\"{$atts['url']}\" {$tracking} target=\"$target\" style=\"{$astyle}\">{$content}</a>\n";
    $output .= "</p>\n</div>\n";

    return $output;
}


// Horizontal Line
// ----------

remove_shortcode('divider');

add_shortcode('divider', 'rabodirect_divider');

function rabodirect_divider($atts) {

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'gradient'          => true,
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    if ( $atts['gradient'] ) {
        $atts['class'] .= 'divider';
        return "<div id=\"{$atts['id']}\" class=\"{$atts['class']}\"></div>";
    } else {
        // Set the rate as a string in the 'data-rate' attribute
        return "<hr id=\"{$atts['id']}\" class=\"{$atts['class']}\">";
    }

}


// Disclaimer
// ----------

remove_shortcode('disclaimer');

add_shortcode('disclaimer', 'rabodirect_disclaimer');

function rabodirect_disclaimer($atts, $content='') {

    $defaults = array(
        'class'             => '',
        'tc'                => true,
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $tc = '';
    if ( $atts['tc'] ) {
        $tc .= "<p>*Terms and conditions</p>";
    }


    return "<div class=\"row\"><div id=\"terms\" class=\"{$atts['class']} medium-12 columns\">{$tc}<p>{$content}</p></div></div>";

}

// Link
// ----

remove_shortcode('link');

add_shortcode('link', 'rabodirect_link');

function rabodirect_link($atts, $content='') {

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'newtab'            => false,
        'title'             => '',
        'url'               => '#',
        'tracking'          => false,

    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $target = '';
    if ( $atts['newtab'] ) {
        $target = '_blank';
    }

    $tracking = '';
    if ( $atts['tracking'] ) {
        $tracking = "onclick=\"trackOutboundLink('".$atts['url']."'); return false;\"";

    }

    return "<a href=\"{$atts['url']}\" {$tracking} id=\"{$atts['id']}\" class=\"link {$atts['class']}\"
    target='{$target}'>{$content}</a>";

}

// Interest Rate
// -------------

remove_shortcode('interest-rate');

add_shortcode('interest-rate', 'rabodirect_interest_rate');

function rabodirect_interest_rate($atts) {

    $output = '';

    $defaults = array(
        'class'             => '',
        'id'                => '',
        'rate'              => '',
        'advanced'          => true,
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    if( $atts['advanced'] ) {
        $atts['class'] .= ' advanced';
    }


    // Set the rate as a string in the 'data-rate' attribute
    $output .= "<span class=\"callout interest-rate loading {$atts['class']}\" data-rate=\"{$atts['rate']}\"></span>";

    return $output;

}

remove_shortcode('interest-icon');

add_shortcode('interest-icon', 'rabodirect_interest_icon');

function rabodirect_interest_icon($atts) {

    $defaults = array(
        'class'         => '',
        'id'            => '',
    );

    $atts = shortcode_atts( $defaults, $atts );

    return "<a class=\"interest-website-logo {$atts['class']}\" id=\"{$atts['id']}\" href=\"http://interest.co.nz\" target=\"_blank\">interest.co .nz</a>\n";
}


// Spacing
// -------------

remove_shortcode('space');

add_shortcode('space', 'rabodirect_space');

function rabodirect_space($atts) {

    $defaults = array(
        'size'      => '',
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $size = "height: {$atts['size']}px; display: block;";

    // Set the rate as a string in the 'data-rate' attribute
    return "<span style=\"{$size}\"></span>";

}

remove_shortcode('three-tier');

add_shortcode('three-tier', 'rabodirect_three_tier');

function rabodirect_three_tier($atts, $content) {

    $defaults = array(
        'title'         => '',

    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );
    $new_content = do_shortcode($content);

    $html = '';
    $html .= "<div class=\"main\">\n";
    $html .= "<div id=\"three-tier\">\n";
    $html .= "<div class=\"wrapper\">\n";
    $html .= "<div class=\"callout callout-product-comparison\">\n";
    $html .= "<div id=\"product-comparison\" class=\"product-comparison row\">\n";
    $html .= "<h1>{$atts['title']}</h1>\n";
    $html .= "{$new_content}</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    return $html;
}

remove_shortcode('product');

add_shortcode('product', 'rabodirect_product');

function rabodirect_product($atts, $content='') {

    $defaults = array(
        'align'         => '',
        'class'         => '',

    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );
    $new_content = do_shortcode($content);

    extract($atts);


    $html = '';

    $html .= "<div class=\"{$align} product columns large-4\">\n";
    $html .= "{$new_content}</div>\n";
    return $html;
}


remove_shortcode('footnote');

add_shortcode('footnote', 'rabodirect_footnote');

function rabodirect_footnote($atts, $content='') {

    $defaults = array(
        'title'         => '',
        'text-align'    => '',
        'class'         => '',
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );
    $new_content = do_shortcode($content);

    $text = $atts['text-align'];
    $text = "text-align: $text;";

    $html = '';
    $html .= "<div class=\"comparison-footnote row\">\n";
    $html .= "<div class=\"medium-12 columns {$atts['class']}\"><p style=\"{$text}\">{$new_content}</p></div>\n";
    $html .= "</div>\n";
    return $html;
}


remove_shortcode('five-tier');

add_shortcode('five-tier', 'rabodirect_five_tier');

function rabodirect_five_tier($atts, $content= '') {

    $defaults = array(
        'title'         => '',

    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );
    $new_content = do_shortcode($content);

    $html = '';
    $html .= "<div class=\"main row\">\n";
    $html .= "<div id=\"five-tier\">\n";
    $html .= "<div class=\"wrapper\">\n";
    $html .= "<div class=\"callout callout-bank-comparison\">\n";
    $html .= "<h1>{$atts['title']}</h1>\n";
    $html .= "{$new_content}<div class=\"bank-comparison compare-oncall\">\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    return $html;
}

remove_shortcode('bank-product');

add_shortcode('bank-product', 'rabodirect_bank_product');

function rabodirect_bank_product($atts, $content= '') {

    $defaults = array(
        'bank'          => '',
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    extract($atts);
    $new_content = do_shortcode($content);

    $html = '';
    $html .= "<div class=\"{$bank} bank\">\n";
    $html .= "<h2>{$bank}</h2>\n";
    $html .= "{$new_content}</div>\n";
    return $html;
}

remove_shortcode('conditions');

add_shortcode('conditions', 'rabodirect_conditions');

function rabodirect_conditions($atts, $content= '') {

    $defaults = array(
        'class'          => '',
        'id'             => '',
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $html = '';
    $html .= "<p class=\"{$atts['class']} conditions\" id=\"{$atts['id']}\">\n";
    $html .= "{$content}</p>\n";
    return $html;
}


//span the information across the whole page
remove_shortcode('full-width');

add_shortcode('full-width', 'rabodirect_full_width');

function rabodirect_full_width($atts, $content='') {

    $defaults = array(
        'color'             => '#fff',
        'class'             => '',
    );

    // Merge attributes from shortcode with defaults
    $atts = shortcode_atts( $defaults, $atts );

    $new_content = do_shortcode($content);

    $color = $atts['color'];
    $color = "style=\"background: $color;\"\n";

    $html = '';
    $html .= "<div class=\"container navigation\" {$color}\">\n";
    $html .= "<div class=\"centered {$atts['class']}\">\n";
    $html .= "{$new_content}</div>\n";
    $html .= "</div>\n";
    return $html;
}

remove_shortcode('comparison');

add_shortcode('comparison', 'rabodirect_comparison');

function rabodirect_comparison($atts) {

    $current_post = null;

    $defaults = array(
        'post'              => false,
        'type'              => 'post'
    );

    $atts = shortcode_atts( $defaults, $atts );

    $current_post_id = $atts['post'];

    // Check if IS an integer
    if ( is_numeric($current_post_id ) ) {
        $current_post = get_post($current_post_id);
    }
    // If it's a string, get by "page title"
    else if( is_string($current_post_id) ) {

        $post_by_title = get_page_by_title($current_post_id, OBJECT, $atts['type']);

//            var_dump($post_by_title);
        // If post exists, set current post to retrieved post
        if( $post_by_title !== null ) {
            $current_post = $post_by_title;
        }
        // Otherwise,
        else if( WP_DEBUG ) {
            // If debug is on (i.e. testing env), show a helpful error
            return "There is no post with this title";
        }
        else {
            return false;
        }
    }
    else if( WP_DEBUG ) {
        // If debug is on (i.e. testing env), show a helpful error
        return "Please enter a valid title or post ID";
    }
    else {
        return false;
    }

//    print_r($current_post);


    // Current post has survived!
    // Get the content out of the post Object
    $content = $current_post->post_content;
    // Apply any shortcodes inside the post content
//    $new_content = do_shortcode($content);

    return do_shortcode( $content );

//    echo $current_post_id;

//        $page_title = get_page_by_title( $current_post_id );
//    print_r($page_title);
//    if( $current_post = get_page_by_title( $current_post_id ) ) {
//    }
}


//  $current_post_ID = $atts['post'];
//    if( $current_post_ID ) {
//        // If it's an interger or a string that looks like an interger
//        // Use the get post method to get the post
//
//        // If it's a string use the get_page_by_title to
//        // If that title exsists, current_post  = get_page_by_ title
//
//        // If neither exist, check WP_DEBUG, and if it is on, then flash error messgage,
//        // If not, fail quietly
//        if( $current_post = get_post( $current_post_ID ) ) {
//            $content = $current_post->post_content;
//            $new_content = do_shortcode($content);
//            echo do_shortcode( $new_content );
//        }
//
//    }



//}



// ========
// Sections
// ========