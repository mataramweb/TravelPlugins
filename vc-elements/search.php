<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcInfoBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
        add_shortcode( 'vc_searchbox', array( $this, 'vc_infobox_html' ) );
    }
     
    // Element Mapping
    public function vc_infobox_mapping() {
         
   
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Search Pacakges', 'text-domain'),
                'base' => 'vc_searchbox',
                'description' => __('Search Pacakges', 'text-domain'), 
                'category' => __('Mataram Web Addon', 'text-domain'),   
                'icon' => plugin_dir_url( __FILE__ ).'../icons/post-carousel.png',           
                'params' => array(   
                                   
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    public function vc_infobox_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                ), 
                $atts
            )
        );	
?>
<div class="pencarianwrap">
<form role="search" method="get" id="pencarian" action="<?php bloginfo('siteurl'); ?>">

 <div class="col-md-4">
    <input type="text" value="" name="s" id="s" placeholder="Search Pacakges...">
	<input type="hidden" name="post_type" value="package" />
	</div>
	 <div class="col-md-3">
<div class="form-group">
	<?php
  
  $categories = get_categories('taxonomy=package_category');
  
  $select = "<select name='package_category' id='package_category' class='postform'>n";
  $select.= "<option value='0'>Kategori</option>n";
  
  foreach($categories as $category){
    if($category->count > 0){
        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
    }
  }
  
  $select.= "</select>";
  
  echo $select;
?>
</div>
</div>
 <div class="col-md-3">
	<?php
  
  $categories = get_categories('taxonomy=package_type');
  
  $select = "<select name='package_type' id='package_type' class='postform'>n";
  $select.= "<option value='0'>Tour Type</option>n";
  
  foreach($categories as $category){
    if($category->count > 0){
        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
    }
  }
  
  $select.= "</select>";
  
  echo $select;
?>
</div>
<div class="col-md-2">
<input type="submit" id="searchsubmit" value="Search" />
</div>
</form>
</div>
<?php	       
// Fill $html var with data
$html = '<div class="vc-infobox-wrap"></div>';      
return $html;
}    
} // End Element Class
 
// Element Class Init
new vcInfoBox();
