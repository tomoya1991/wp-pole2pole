<?php get_header(); ?>

<?php $the_query = new WP_Query('cat=2'); if($the_query->have_posts()): ?>
<?php
	while ($the_query->have_posts()){
		$the_query->the_post();
		$id = get_the_ID();
		if(get_post_meta($id, 'ex_close_date', true) != '' && date_i18n('Y-m-d H:i:s') < get_post_meta($id, 'ex_close_date', true)){
			$newsJa .= '<li><a href="'.get_post_meta($id, 'ex_link', true).'" target="_blank">'.get_the_title().'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place', true).'</a>（'.get_post_meta($id, 'ex_area', true).'）｜'.get_post_meta($id, 'ex_date', true).'</li>';
			$newsEn .= '<li><a href="'.get_post_meta($id, 'ex_link', true).'" target="_blank">'.get_post_meta($id, 'ex_title_en', true).'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place_en', true).'</a>（'.get_post_meta($id, 'ex_area_en', true).'）｜'.get_post_meta($id, 'ex_date_en', true).'</li>';
		}
	}
	wp_reset_postdata();
	if($newsJa != ''){
		$newsJa = '<ul class="jap">'.$newsJa.'</ul>';
		$newsEn = '<ul class="eng">'.$newsEn.'</ul>';
		$upcom = '<div id="news"><h2>UP COMING / CURRENT EXHIBITION</h2>'.$newsJa.$newsEn.'</div><hr>';
		echo $upcom;
	}
?>
<?php endif; ?>

<?php $the_query = new WP_Query('cat=2'); if($the_query->have_posts()): ?>
<div id="works">
<h2>WORKS</h2>
<?php while (have_posts()) : the_post(); $id=get_the_ID(); ?>
<?php if(get_post_meta($id, 'work_is_top', true)): ?>
<a href="<?php the_permalink(); ?>" class="work_wrapper">
<div class="work">
<?php if ( has_post_thumbnail() )  the_post_thumbnail('medium'); ?>
<h3><?php the_title(); ?><?php if(get_post_meta($id, 'title_en', true) != '') echo '｜'.get_post_meta($id, 'title_en', true); ?> <span class="year"><?php the_time('Y'); ?></span></h3>
</div>
</a>
<?php endif; ?>
<?php endwhile; ?>
</div><!-- #works -->
<?php else : ?>
<?php wp_reset_postdata(); ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>

<?php get_footer(); ?>
