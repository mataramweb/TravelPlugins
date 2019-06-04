<?php
/**
 * The template for displaying all single posts.
 *
 * @package Bootstrap to WordPress
 */

get_header(); ?>
<div class="breadcrumbs-box">
<div class="container">
<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
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
<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
<div id="package-media-wrapper gdl-image ">		
<div class="thumnail-sigle-package" style="background:url('<?php echo $featured_img_url; ?>');"> </div>
</div>	
	

<header class="blog-head">

<div class="package-content-wrapper">
<div class="package-info-wrapper">

<div class="package-info"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_post_meta($post->ID, "durasi", true); ?></div>
<div class="package-info"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo get_post_meta($post->ID, "lokasi", true); ?></div>
<div class="package-info"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo get_post_meta($post->ID, "harga", true); ?></div>
<a class="package-book-now-button gdl-button" href="<?php echo get_site_url(); ?>/booking"><strong>Booking</strong></a>
</div>
</div>
</header>
<?php the_content(); ?>
				   <?php edit_post_link(); ?>
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
			
			<!-- SIDEBAR
			================================================== -->

		<?php if ( is_active_sidebar( 'single-package' ) ) : ?>
		<div class="col-sm-4">
    <?php dynamic_sidebar( 'single-package' ); ?>
	</div>
<?php endif; ?>
	
</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php get_footer(); ?>
