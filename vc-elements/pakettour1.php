<?php
/*
Element Description: VC Info Box
*/
// Element Class 
class model1 extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_package_mapping' ) );
        add_shortcode( 'cv_package', array( $this, 'vc_package_html' ) );
    }
     
    // Element Mapping
    public function vc_package_mapping() {
		$taxonomy = 'package_category';
$categories_array = array();
$categories = get_terms( array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
) );
$categories_array[] = 'All';
foreach( $categories as $category ){
    $categories_array[] = $category->name;
}
		


			// Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }   
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Paket Tour V-I', 'text-domain'),
                'base' => 'cv_package',
                'description' => __('Show Grid Tour Package', 'text-domain'), 
                'category' => __('Mataram Web Addon', 'text-domain'),   
                'icon' => plugin_dir_url( __FILE__ ).'../icons/post-carousel.png',            
                'params' => array(   
                         
                
					array(
                        "type" => "textfield",
                        "heading" => __( "Link More", "text-domain"),
                        "param_name" => "linkmore",
                        "value" => __( "https://namadomain.com", "text-domain"),
                        "description" => __( "Isi kemana cek paket selengkapnya", "text-domain" ),
                        "admin_label" => false,
                        
                    ),
					array(
					  "type" => "textfield",
					  "heading" => __("Jumlah paket yang akan ditampilkan", "js_composer"),
					  "param_name" => "posts_nr",
					  "description" => __("Silahkan isi dengan angka jumlah paket yang ingin ditampilkan", "js_composer"),
					),
                         			
					array(
						"type" => "dropdown",
						"heading" => __("Category", "Theme Text Domain") ,
						"param_name" => "package_category",
						"value" => $categories_array ,
						"admin_label" => false,
						"description" => __("Select Portfolio category to display.","Theme Text Domain")
					) ,

					array(
					   "type" => "dropdown",
						"heading" => __("Ukuran Kolom", "js_composer"),
						"param_name" => "size",
						"value" => array(
							"4 Kolom" => "3",
							"3 Kolom" => "4",
							"2 Kolom" => "6",
						) ,
						"description" => __("Set size for logo's container", "js_composer"),
					),
					
									array(
       "type" => "dropdown",
        "heading" => __( "Show Package Order", "js_composer" ),
        "param_name" => "order",
						"value" => array(
							"DESC (descending order)" => "DESC",
							"ASC (ascending order)" => "ASC"
						) ,
        "description" => __("Select thumbnail figure to be square or round.", "js_composer"),
    ),
		

					  array(
					  'type' => 'textfield',
					  'heading' => __( 'Image size', 'js_composer' ),
					  'param_name' => 'thumb_size',
					  'value' => 'full',
					  'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full", "square-thumb" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'js_composer' )
					),
					
					array(
       "type" => "dropdown",
        "heading" => __( "Thumbnail figure", "js_composer" ),
        "param_name" => "shape",
        "value" => array('square', 'round'),
        "description" => __("Select thumbnail figure to be square or round.", "js_composer"),
    ),
				
				
					array(
					  "type" => "dropdown",
					  "heading" => __("CSS Animation", "js_composer"),
					  "param_name" => "css_animation",
					  "admin_label" => false,
					  "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
					  "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
					),
					
					array(
					  "type" => "textfield",
					  "heading" => __("Extra class name", "js_composer"),
					  "param_name" => "extra_class",
					  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
					),
					
                        
                ),
            )
        );                                
        
    }    	
  // Element HTML
    public function vc_package_html( $atts ) {
         
        // Params extraction
        extract(shortcode_atts(array(
          'size' => '4',
          'posts_nr' => -1,
		  'linkmore' => '',
		  'order' => '',
		  'package_category' => '',
          'social_css' => '',
          'css_animation' => '',
		  'thumb_size' => 'full',
          'extra_class' => ''
        ), $atts));
		
         
        // Fill $html var with data
         $output = '';				
      //wp_reset_query();
        // Template        
        query_posts( array(
            'post_type'   => 'package',
            'post_status'   => array('publish'),
            'orderby'     => 'date',
			'order'     => $order,
			'size'     => $size,
			'linkmore'     => $linkmore,
			'category' => '',
			'css_animation' => $css_animation,
			'package_category'    => $package_category,
            'posts_per_page'  => $posts_nr,
        ));
if (have_posts()) :
          while(have_posts()) : the_post();

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
$lokasi = get_post_meta( get_the_ID(), 'lokasi', true );
$harga = get_post_meta( get_the_ID(), 'harga', true );
$durasi = get_post_meta( get_the_ID(), 'durasi', true );
$href = get_permalink( $post->ID );
$title = get_the_title($post->ID); 

$container = '<div  class="row">%1$s</div>';
$item      = 	    '<div class="col-md-'.$size.'">
						<div class="package-thumbnail-outer-wrapper">
							<div href="#"><img src="'.$featured_img_url.'" alt="'.$title.'" class="gambarpaket2"></div>
							<div class="package-ribbon-wrapper">
							<div class="package-type"><a href="#">Read More</a></div>
							<div class="clear"></div>
							<div class="package-type-gimmick"></div>
							<div class="clear"></div>
							</div>	
								
								
								<div class="data1"><i class="fa fa-tag" aria-hidden="true"></i> '.$harga.'</div>
								<div class="data2"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$durasi.'</div>

								<div class="package-title"><a href="'.$href.'">'.$title.'</a></div>
							
							
						</div>  
					</div>'; 





$items .= sprintf($item);
endwhile;

$output = sprintf( $container,$items);
 else :
ob_start();
get_template_part( 'content', 'none' );
return ob_get_clean();
endif;
wp_reset_query();
        return $output;         
    }
     
} // End Element Class  
// Element Class Init
new model1();
