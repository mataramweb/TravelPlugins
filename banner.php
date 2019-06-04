<?php
function vc_doo_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'title1' => 'title1',
		'title2' => 'title2',
		'title_font_color' => 'title_font_color',
		'title_font_size' => 'title_font_size',	 
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background' => 'background',
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'model' => 'model',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a href="'.$href['url'].'" class="grid" style="height:'.$height.';" href="" title="'.$href['title'].'">
<figures class="'.$model.'" style="height:'.$height.'; background-color:'.$background_overlay.'">        
'.wp_get_attachment_image($bg_image, "full" ).'
      <figcaption>                      
        <h2 style="color:'.$title_overlay_font_color.';font-size:'.$title_font_size.';">'.$title1.' <span>'.$title2.'</span></h2>
        <p class="description" style="color:'.$description_font_color.';font-size:'.$description_font_size.';">'.$content.'</p>
      </figcaption>
</figures">
</a>';
return $end_content;  
}  
add_shortcode( 'vc_doo_banner', 'vc_doo_banner_func');

add_action( 'vc_before_init', 'your_name_integrateWithVC' );
function your_name_integrateWithVC() {
vc_map( array(
	"base" => "vc_doo_banner",
	"name" => __( "Buat Banner 1", "doo-text-domain" ),
	"icon" => "dt_vc_ico_banner2",
    'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_doo_banner.css'),
	'category' => __('Mataram Web Addon', 'text-domain'), 
	'description' => __( 'Animated panel', "doo-text-domain" ),
    "params" => array(
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Icon", "doo-text-domain"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield", // it will bind a img choice in WP
            "heading" => __("Image size", "doo-text-domain"),
			"value" => __( "thumbnail", "doo-text-domain" ),
            "description" => __( "Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use \"thumbnail\" by default." ),					
            "param_name" => "image_size",
        ),		
        array(
            "type" => "textfield",
            "heading" => __("Height", "doo-text-domain"),
			"value" => __( "300px", "doo-text-domain" ),
            "description" => __( "Banner max height in px.", "doo-text-domain" ),			
            "param_name" => "height",
        ),	
		array(
            "type" => "dropdown",
            "heading" => __("Model", "doo-text-domain"),
			"value" => array(
							"Tanda effect" => "none",
							"Effect Bubba" => "effect-bubba",
							"Effect lily" => "effect-lily",
							"Effect Sadie" => "effect-sadie",
							"Effect Roxy" => "effect-roxy",
							"Effect Romeo" => "effect-romeo",
							"Effect Layla" => "effect-layla",
							"Effect Honey" => "effect-honey",
							"Effect Oscar" => "effect-oscar",
							"Effect Marley" => "effect-marley",
							"Effect Milo" => "effect-milo",
							"Effect Dexter" => "effect-dexter",
							"Effect Sarah" => "effect-sarah",
							"Effect zoe" => "effect-zoe",
							"Effect Chico" => "effect-chico",
						),
            "description" => __( "Banner Model.", "doo-text-domain" ),			
            "param_name" => "model",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title1", "doo-text-domain"),
			"value" => __( "Panel title", "doo-text-domain" ),
            "param_name" => "title1",
        ),
		array(
            "type" => "textfield", 
            "heading" => __("Title2", "doo-text-domain"),
			"value" => __( "Panel title2", "doo-text-domain" ),
            "param_name" => "title2",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "doo-text-domain"),
			"value" => __( "18px", "doo-text-domain" ),
            "param_name" => "title_font_size",
        ),
		


        array(
            "type" => "colorpicker",
            "heading" => __("Title font color", "doo-text-domain"),
            "param_name" => "title_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),			
        ),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "doo-text-domain"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "doo-text-domain"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "doo-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "doo-text-domain"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "doo-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "doo-text-domain"),
			"value" => __( "15px", "doo-text-domain" ),
            "param_name" => "description_font_size",
        ),		

        array(
            "type" => "colorpicker", 
            "heading" => __("Background", "doo-text-domain"),
			"value" => __( "#ffffff", "doo-text-domain" ),
            "param_name" => "background",
        ),
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "doo-text-domain"),
			"value" => __( "#ffffff", "doo-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "doo-text-domain"),
			"value" => __( "#", "doo-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}
 


/* image banner */

function vc_doo_image_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'header' => 'header',
	 	'title_font_size' => 'title_font_size',
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a class="service websites" style="height:'.$height.';" href="'.$href['url'].'" title="'.$href['title'].'">
                                
'.wp_get_attachment_image($bg_image, "full" ).'
                            
                                <span class="hover" style="background-color:'.$background_overlay.'">
                                    <span class="vcenter-parent">
                                        <span class="vcenter">
                                            <h2 style="color:'.$title_overlay_font_color.';font-size:'.$title_font_size.';">'.$header.'</h2>
                                            <p class="description" style="color:'.$description_font_color.';font-size:'.$description_font_size.';">'.$content.'</p>
                                        </span><!-- .vcenter -->
                                    </span><!-- .vcenter-parent -->
                                </span><!-- /.hover -->
                            </a>';
 
    return $end_content;  
}  
add_shortcode( 'vc_doo_img_banner', 'vc_doo_image_banner_func');