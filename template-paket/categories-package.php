<?php get_header(); ?>
<?php $args = array( 'posts_per_page' => 10, 'post_type' => 'package', 'post_status' => 'publish' ); ?>
<?php $get_category_posts = get_posts( $args ); ?>
<?php foreach ( $get_category_posts as $post ) : setup_postdata( $post ); ?>
<div class="breadcrumbs-box">
<div class="container">
<header class="entry-header">
<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
</header><!-- .entry-header -->
</div>
</div>
<div class="class1">
    <div class="class2">
      <div class="class3">

        <?php print_r( get_post_meta( get_the_ID() ) ); // Just for demo purposes ?>

        <?php // $url = esc_url( get_post_meta( get_the_ID(), 'video_oembed', true ) ); ?>
        <?php // $embed = wp_oembed_get( $url ); ?>

        <div class="class4">
          <iframe id="class_frame" width="560" height="315" src="https://www.youtube.com/watch" allowfullscreen frameborder="0"></iframe>
        </div>
      </div>
      <div class="class6">
        <h1><?php the_title(); ?></h1>
        <p><?php the_content(); ?></p>
      </div>
    </div>
  </div>

<?php endforeach; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>