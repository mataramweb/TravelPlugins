<?php
function __construct() {
        add_action( 'init', array( $this, 'vc_tabelharga_maping' ) );
        add_shortcode( 'vc_tabelharga', array( $this, 'vc_tabelharga_html' ) );
    }
	?>
<?php

class WPBakeryShortCode_pricing_table extends WPBakeryShortCode {

    /*
     * This methods returns HTML code for frontend representation of your shortcode.
     * You can use your own html markup.
     *
     * @param $atts - shortcode attributes
     * @param @content - shortcode content
     *
     * @access protected
     *
     * @return string
     */

    protected function content($atts, $content = null) {

        extract(shortcode_atts(array(
          'title' => '',
          'price' =>  '',
          'features' => '',
          'button' => '',
          'button_url' => '',
          'css_animation' => '',
          'extra_class' => '',
          'css' => '',
          'price_css' => '',
          'button_css' => '',
          'text_color' => '',
          'best' => ''

        ), $atts));

        if(!empty($best)) {
          $best = ' best-choice';
        }

        $extra_class = $this->getExtraClass($extra_class);
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ').$this->getCSSAnimation($css_animation).$extra_class.$best, $this->settings['base']);

        $output = '';

        if(!empty($text_color)) {
          $text_color = sprintf('style="color:%s !important;"', $text_color);
        }

        // Template

        $container = '<div %3$s class="pricing-table %1$s">%2$s</div>';
        $title_html = '<h3 class="text-center uppercase">%s</h3>';
        $price_html ='<div class="text-center dark-blue font-2x angka %1$s"><div class="bundar"><div class="angkabundar">%2$s</div></div></div>';
        $features_html = '<div class="table-features"><ul class="clean-list">%1$s</ul></div>';
        $feature_item_html = '<li> <span class="icon-check"></span> %1$s</li>';
        $button_html = '<p class="tombol-pesan"><a %4$s href="%1$s" class="button-md dark-blue text-white soft-corners %2$s"><span class="icon-whatsapp"></span> %3$s </a></p><p></p>';
        $feature_items_html = '';

        
        // Output

        if(!empty($title)) {
          $title = sprintf($title_html, $title);          
        }


        if(!empty($features)) {
          $features = explode(',', $features);
          $features = array_filter($features);

          foreach ($features as $key => $value) {

            if($value[0] == '-') {
              $icon = '<span class="icon-check"></span>';
              $value = $icon.substr($value, 1);
            } elseif ($value[0] == '+') {
              $icon = '<i class="icon-455"></i>';
              $value = $icon.substr($value, 1);
            }

            $feature_items_html .= sprintf($feature_item_html, $value);
          }

          $features = sprintf($features_html, $feature_items_html);

          if(!empty($price)) {
            $price = sprintf($price_html, vc_shortcode_custom_css_class($price_css, ' '), $price);
          }

          if(!empty($button)) {
            $button = sprintf($button_html, $button_url, vc_shortcode_custom_css_class($button_css, ' '), $button, $text_color);
          }
          
          $output = sprintf($container, $css_class, $title.$price.$features.$button, $text_color);
        }

        return $output;
    }
}

vc_map( array(
  "name" => __("Pricing table", "js_composer"),
  "base" => "pricing_table",
  "is_container" => false,
  "icon" => "",
  "show_settings_on_create" => true,
  "category" => __('Content', 'js_composer'),
  "description" => __('Pricing table', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Pricing table title", "js_composer"),
      "param_name" => "title",
      "description" => __("Provide a title for pricing table", "js_composer"),
    ),
    array(
      "type" => "textfield",
      "heading" => __("Provide the price", "js_composer"),
      "param_name" => "price",
      "description" => __("The price will appear on the top", "js_composer"),
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "js_composer"),
      "param_name" => "best",
      "value" => array(__("Best option", "js_composer") => "best")
    ), 
    array(
      "type" => "exploded_textarea",
      "heading" => __("Provide provide features", "js_composer"),
      "param_name" => "features",
      "description" => __("Provide names for each feature. Divide with linebreaks (Enter).", "js_composer"),
    ),
     array(
      "type" => "textfield",
      "heading" => __("Button value", "js_composer"),
      "param_name" => "button",
      "description" => __("Provide a string for button value", "js_composer"),
    ),
     array(
      "type" => "textfield",
      "heading" => __("Button url", "js_composer"),
      "param_name" => "button_url",
      "description" => __("Provide URL for button", "js_composer"),
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Custom text color", "js_composer"),
      "param_name" => "text_color",
      "description" => __("Select text color for all pricing table content", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("CSS Animation", "js_composer"),
      "param_name" => "css_animation",
      "admin_label" => true,
      "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
      "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "extra_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
    ),
    array(
        "type" => "css_editor",
        "heading" => __('Css', "js_composer"),
        "param_name" => "css",
        // "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
        "group" => __('Design options', 'js_composer')
      ),
    array(
        "type" => "css_editor",
        "heading" => __('Css', "js_composer"),
        "param_name" => "price_css",
        // "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
        "group" => __('Price CSS', 'js_composer')
      ),
    array(
        "type" => "css_editor",
        "heading" => __('Css', "js_composer"),
        "param_name" => "button_css",
        // "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
        "group" => __('Button CSS', 'js_composer')
      )
  )
) );