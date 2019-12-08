<?php
/**
 * Template Name: Home
 *
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="os-container">
    <?php the_content(); ?>
</div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>