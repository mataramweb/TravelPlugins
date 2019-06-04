<?php get_header(); ?>
<div class="breadcrumbs-box">
<div class="container">
<header class="entry-header">
		<?php the_archive_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->
</div>
</div>

<br>
<div class="container">


	<ul class="row blog-post">
		<?php while ( have_posts() ) { the_post();	?>

		<div class="col-md-4">
	
		<div class="thumbnail2 box-shadow">

			<?php the_post_thumbnail('medium-thumb'); ?>


				<div class="card-body">
					<div class="judul-utama"><h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3></div>
						
							<div class="row">
							
			<hr>
							
								<div class="col-md-6 col-xs-6 no-padding">
								
									<div class="attribut-meta left"><span class="icon-price-tag"></span> 
                
                </span><?php $harga = get_post_meta( get_the_ID(), 'harga', true );
// Check if the custom field has a value.
if ( ! empty( $harga ) ) {
    echo $harga;
}?></div>
								</div>
								<div class="col-md-6 col-xs-6 no-padding">
									<div class="attribut-meta left"><span class="icon-clock4"></span> <?php $durasi = get_post_meta( get_the_ID(), 'durasi', true );
// Check if the custom field has a value.
if ( ! empty( $durasi ) ) {
    echo $durasi;
}?></div>
								</div>
							</div>
				</div>
			</div>
		</div>
	<?php }?>			
	</ul>



</div>
<?php get_footer();?>