<?php
/*
Element Description: VC Info Box
*/
// Element Class 
class HotelBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_hotel_mapping' ) );
        add_shortcode( 'cv_hotel', array( $this, 'vc_hotel_html' ) );
    }
     
    // Element Mapping
    public function vc_hotel_mapping() {		

$taxonomy = 'lokasi_hotel';
$categories_array = array();
$categories = get_terms( array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
) );
$categories_array[] = 'All';
foreach( $categories as $category ){
    $categories_array[] = $category->name;
}


$taxonomy = 'bintang_hotel';
$categories_array = array();
$categories = get_terms( array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
) );
$categories_array[] = 'All';
foreach( $categories as $category ){
    $categories_array[] = $category->name;
}
   
// Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Hotel', 'text-domain'),
                'base' => 'cv_hotel',
                'description' => __('Nampilin Hotel', 'text-domain'), 
                'category' => __('Mataram Web Addon', 'text-domain'),   
                'icon' => '',            
                'params' => array(  

					
					array(
						"type" => "dropdown",
						"heading" => __("Lokasi Hotel", "Theme Text Domain") ,
						"param_name" => "lokasi_hotel",
						"value" => $categories_array ,
						"description" => __("Pilih  Lokasi Hotel yang ingin ditampilkan", "Theme Text Domain")
					) ,
					
					array(
						"type" => "dropdown",
						"heading" => __("Lokasi Hotel", "Theme Text Domain") ,
						"param_name" => "lokasi_hotel",
						"value" => $categories_array ,
						"description" => __("Pilih  Lokasi Hotel yang ingin ditampilkan", "Theme Text Domain")
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
						"heading" => __("Order", "js_composer") ,
						"param_name" => "hotel_order",
						"value" => array(
							"DESC (descending order)" => "DESC",
							"ASC (ascending order)" => "ASC"
						) ,
						"description" => __("Nampilin Transport DESC or ASC order", "js_composer")
					) ,
					array(
					  "type" => "textfield",
					  "heading" => __("Jumlah paket yang akan ditampilkan", "js_composer"),
					  "param_name" => "posts_nr",
					  "description" => __("Silahkan isi dengan angka jumlah paket yang ingin ditampilkan", "js_composer"),
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
					
                        
                ),
            )
        );                                
        
    }     
  // Element HTML

    public function vc_hotel_html( $atts ) {
  
          // Params extraction
        extract(shortcode_atts(array(
          'size' => '4',
          'posts_nr' => -1,
          'shape' => 'square',
		  'lokasi_hotel' => '',
		  'bintang_hotel' => '',
          'social_css' => '',
		  'hotel_order' => '',
          'css_animation' => '',
		  'thumb_size' => 'full',
          'extra_class' => ''

        ), $atts));
			       
        // Fill $html var with data
         $output = '';				
      //wp_reset_query();

        // Template        
         // Template        
        query_posts( array(
            'post_type'   => 'hotel',
            'post_status'   => array('publish'),
			'order' => $hotel_order,
			'lokasi_hotel'   => $lokasi_hotel,	
			'bintang_hotel'   => $bintang_hotel,				
			'category_name'    => '',
            'posts_per_page'  => $posts_nr,
        ));
		
		
		
if (have_posts()) :
          while(have_posts()) : the_post();


	
$category = get_the_terms( $post->ID, 'bintang_hotel' );     
foreach ( $category as $bintanghotel){;
echo  $fdsfsad->name;
	} 



	





$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
$href = get_permalink( $post->ID );
$title = get_the_title($post->ID);


if ( ! empty( $linkmore ) ) {
   $ambillink = '<center><a class="button" href="'.$linkmore.'" target="_blank" title="">Read More</a></center><br>';	
}
if ( ! empty( $harga)) {
	$harga = '<div class="package-ribbon-wrapper">
							<div class="package-type2" style="background-color:'.$background_color.';">'.$harga.'</div>
							<div class="clear"></div>
							<div class="package-type-gimmick"></div>
							<div class="clear"></div>
			</div>	';
}		

 if(!empty($background_color)) {
          $background_color = sprintf('style="background-color:'.$background_color.' !important;"', $background_color);
        } 
		



	

 $container = '<div  class="row">%1$s '.$ambillink.'</div>';
 $item = 	      '<div class="col-md-'.$size.'">
						<div class="thumbnail7 box-shadow">
							<div href="#"><img src="'.$featured_img_url.'" alt="#" class="gambarpaket2">
							
							'.$harga.'
							
							
							</div>

									<div class="deskrip1">
											<div class="judul-utama"><h4><a href="'.$href.'">'.$title.'</a></h4></div>
												<div class="attribut-paket">						
														<div class="col-md-6 col-xs-6">
														'.$bintanghotel->name.'
														</div>
														<div class="col-md-6 col-xs-6">
														'.$lokasihotel->name.'
														</div>
												</div>
								
							</div>
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
new HotelBox();
