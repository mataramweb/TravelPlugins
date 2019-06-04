<?php get_header();?>
<div class="container box ">
<div class="col-md-8">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-item');?>>
<header class="blog-head">
<?php
// Must be inside a loop. 
if ( has_post_thumbnail() ) {
    the_post_thumbnail('single-package');
}
else {
    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
        . '/img/paket_no_image.jpg" />';
}?>
<table>
<tbody>
<tr>
<td width="319">
<b>Durasi. </b><span class="badge"><?php echo get_post_meta($post->ID, "durasi", true); ?></span>
</td>
<td style="text-align: right;" rowspan="2" width="319"><div class="btn-primary"><a href="<?php echo get_site_url(); ?>/booking"><strong>Booking</strong></a></div></td>
</tr>
<tr>
<td width="319">
<b>Include </b><span class="badge"> <?php echo get_post_meta($post->ID, "include", true); ?></span>
</td></td>
</tr>
</tbody>
</table>
</header>
<?php $terms = wp_get_post_terms( $post_id, $taxonomy, $args ); ?>
<div class="blog-content">
<div class="clear"></div>			
<table>			
<tbody>
<tr>
<td width="119">Harga All In One</td>
<td width="258"><i></i><?php echo get_post_meta($post->ID, "price", true); ?></td>
</tr>
<tr>
<td>Extra Time</td>
<td><i></i><?php echo get_post_meta($post->ID, "overtime", true); ?></td>
</tr>
<tr>
<td>Kapasitas</td>
<td><i></i><?php echo get_post_meta($post->ID, "capaticy", true); ?></td>
</tr>
<tr>
<td>Durasi</td>
<td><i></i><?php echo get_post_meta($post->ID, "duration", true); ?></td>
</tr>
</tbody>
</table>
<?php the_content();?>
<?php endif; ?>
<?php if( is_single() ) the_tags( '<div class="blog-tags">', '', '</div>' ); ?>
	</article>
		</div>
<div class="col-md-4">
		<?php if(is_dynamic_sidebar('sidebar-1')): ?>
					<aside class="main-sidebar right-sidebar">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside>				
			<?php endif ?>
		</div>
		</div><!-- .site-main untuk cal 8 -->
</div> <!-- /box white -->
<?php get_footer(); ?>
