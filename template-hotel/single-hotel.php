<?php get_header();?>

<div class="breadcrumbs-box">
<div class="container">
<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
	</header><!-- .entry-header -->
</div>
</div>

	<!-- BLOG CONTENT
	================================================== -->
<section class="box white">	

			<div class="container">
			<div class="row">
			<div class="col-sm-8">


<?php while ( have_posts() ) : the_post(); ?>


<div id="package-media-wrapper gdl-image">		
<?php
// Must be inside a loop.
 
if ( has_post_thumbnail() ) {
    the_post_thumbnail('single-package');
}
else {
    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
        . '/img/paket_no_image.jpg" />';
}
?>

</div>	

<header class="blog-head">

<div class="package-content-wrapper">
<div class="package-info-wrapper">


<div class="package-info"><span class="icon-location22"></span><?php echo get_post_meta($post->ID, "lokasi", true); ?></div>
<div class="package-info"><span class="icon-star-full"></span><?php echo get_post_meta($post->ID, "bintang", true); ?></div>
<a class="package-book-now-button gdl-button" href="<?php echo get_site_url(); ?>/booking"><strong>Booking</strong></a>
</div>
</div>
</header>
	

	
				   <?php the_content();?>
				   <?php edit_post_link();?>
			<?php endwhile;?>

			</div><!-- #content -->
			
			<!-- SIDEBAR
			================================================== -->
		
				<?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
					<div class="col-sm-4">
    <?php dynamic_sidebar( 'custom-side-bar' ); ?>
	</div>
<?php endif;?>
<div><!-- .row -->
	</div><!-- .container -->
</section>
<?php get_footer(); ?>
