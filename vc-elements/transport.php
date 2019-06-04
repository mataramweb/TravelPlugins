<?php
/*
Element Description: VC Info Box
*/
// Element Class 
class TransportBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_transport_mapping' ) );
        add_shortcode( 'cv_transport', array( $this, 'vc_transport_html' ) );
    }
     
    // Element Mapping
    public function vc_transport_mapping() {
$taxonomy = 'kategori_transport';
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
                'name' => __('Transport', 'text-domain'),
                'base' => 'cv_transport',
                'description' => __('Nampilin Transport', 'text-domain'), 
                'category' => __('Mataram Web Addon', 'text-domain'),   
                'icon' => plugin_dir_url( __FILE__ ).'../icons/post-carousel.png',            
                'params' => array(   
				
					array(
						"type" => "dropdown",
						"heading" => __("Category","Theme Text Domain") ,
						"param_name" => "package_category",
						"value" => $categories_array ,
						"description" => __("Select Portfolio category to display.", "Theme Text Domain")
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
						"param_name" => "transport_order",
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
                        "type" => "textfield",
                        "heading" => __( "Link More", "text-domain"),
                        "param_name" => "linkmore",
                        "value" => __( "https://namadomain.com", "text-domain"),
                        "description" => __( "Isi kemana cek paket selengkapnya", "text-domain" ),
                        "admin_label" => false,
                        
                    ),
    
                ),
            )
        );                                
        
    }     		
  // Element HTML
    public function vc_transport_html( $atts ) {
         
        // Params extraction
        extract(shortcode_atts(array(
          'size' => 4,
          'posts_nr' =>6,
          'shape' => 'square',
		  'linkmore' => '',
		  'judul' => 'judul',
		  'deskripsi' => 'deskripsi',
		  'agr_portfolio_category' => '',
          'social_css' => '',
		  'transport_order' => '',
          'css_animation' => '',
		  'thumb_size' => 'full',
          'extra_class' => ''

        ), $atts));
		         
        // Fill $html var with data
         $output = '';
				
      //wp_reset_query();

        // Template        
        query_posts( array(
            'post_type'   => 'transport',
            'size'		  => $size,
            'post_status'   => array('publish'),
			'order' => $transport_order,
			'category'         => '',
			'linkmore'     => $linkmore,
			'category_name'    => '',
            'posts_per_page'  => $posts_nr,
        ));

if (have_posts()) :
          while(have_posts()) : the_post();


$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
$price = get_post_meta( get_the_ID(), 'price', true );
$include = get_post_meta( get_the_ID(), 'include', true );
$capaticy = get_post_meta( get_the_ID(), 'capaticy', true );
$duration = get_post_meta( get_the_ID(), 'duration', true );
$overtime = get_post_meta( get_the_ID(), 'overtime', true );



$href = get_permalink( $post->ID );
$title = get_the_title($post->ID); 

if ( ! empty( $linkmore ) ) {
   $ambillink = '<center><a class="button" href="'.$linkmore.'" target="_blank" title="">Read More</a></center><br>';	
}
if ( ! empty( $price)) {
	$price = '<div class="package-ribbon-wrapper">
							<div class="package-type" style="background-color:'.$background_color.';"><a href="#">IDR '.$price.'</a></div>
							<div class="clear"></div>
							<div class="package-type-gimmick"></div>
							<div class="clear"></div>
			</div>	';
}		

 if(!empty($background_color)) {
          $background_color = sprintf('style="background-color:'.$background_color.' !important;"', $background_color);
        }

 $container = '<div  class="row">%1$s '.$ambillink.'</div>';
 $item = 	      '<div class="col-md-'.$size.' '.$css_animation.'">
						<div class="thumbnail2 box-shadow">
										
										<a href="'.$href.'">
										<div class="itemgambar">
										<h4 class="col-md-12 col-xs-12 judulpaket">'.$title.'</h4>
										<img src="'.$featured_img_url.'" alt="pepsi" width="540" height="548">
									  	
										<div class="item-overlay top"></div>
										
										</div></a>
										'.$price.'
									<div class="deskrip1">
										
											<div class="col-md-12 col-xs-12 lokasi"><div style="font-size:small;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Include : '.$include.'</div></div>
											<div class="col-md-12 col-xs-12 lokasi"><div style="font-size:small;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Kapasitas : '.$capaticy.'</div></div>
											<div class="col-md-12 col-xs-12 lokasi"><div style="font-size:small;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Durasi : '.$duration.'</div></div>	
											<div class="col-md-12 col-xs-12 lokasi"><div style="font-size:small;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Extra : IDR. '.$overtime.'</div></div>
											<div class="col-md-12 col-xs-12 lokasi"><div style="font-size:small; text-align:center;"><a href="#"><div class="button"><i class="fa fa-whatsapp" aria-hidden="true"></i> BOOK NOW</div></a></div></div>											
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
new TransportBox();
