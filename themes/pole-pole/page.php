<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<div class="entry">
<?php the_content(''); ?>
</div>
</div><!-- /post -->

<?php endwhile; endif; ?>
</div><!-- /content -->


<?php get_footer(); ?>