<div <?php post_class('blog-index-item'); ?>>
<div class="blog-index-item-i">
  <?php 
  if(has_post_thumbnail()){
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id(  ), "large" );
    $proportion = 100;
    if($image_data && isset($image_data[1]) && isset($image_data[2]) && $image_data[1] > 0 && $image_data[2] > 0){
      $width = $image_data[1];
      $height = $image_data[2];
      $proportion = round($height / $width * 100);
    }
    ?>
    <div class="index-item-media-w"><a href="<?php the_permalink(); ?>" class="index-item-media" style="background-image: url('<?php the_post_thumbnail_url("large"); ?>'); padding-bottom: <?php echo esc_attr($proportion).'%'; ?>"></a></div>
    <?php
  }
  ?>
  <div class="index-item-content">
    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <div class="blog-index-item-meta">
      <div class="blog-index-author-name"><span>By: </span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta( 'display_name' ); ?></a></div>
      <div class="blog-index-date-posted"><?php echo get_the_date(); ?></div>
    </div>
    <div class="blog-index-item-content"><?php echo osetin_excerpt(30, true); ?></div>
  </div>
</div>
</div>