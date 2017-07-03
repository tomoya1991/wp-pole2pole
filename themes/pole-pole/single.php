<?php get_header(); ?>

<div id="single" class="contents">
<?php $slug_name = ''; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if(in_category('2')): $id=get_the_ID(); ?>
<h2><?php the_title(); ?><?php if(get_post_meta($id, 'title_en', true) != '') echo '｜'.get_post_meta($id, 'title_en', true); ?></h2>

<div id="video">
<?php
	if(get_post_meta($id, 'work_video', true) != ''){
		echo get_post_meta($id, 'work_video', true);
	} else {
		the_post_thumbnail('medium');
	}
?>
</div>
<div id="outline">
<p class="jap">
<?php echo get_post_meta($id, 'work_text', true); ?>
</p>
<p class="eng">
<?php echo get_post_meta($id, 'work_text_en', true); ?>
</p>
</div>
<hr>
<br>

<div id="images">
<?php the_content(); ?>
</div>

<?php $slug_name = $post->post_name; ?>

<?php elseif(in_category('3')): ?>
<h2><span class="jap"><?php the_title(); ?></span><span class="eng"><?php echo get_post_meta($id, 'ex_title_en', true); ?></span></h2>
<div id="images">
<?php the_content(); ?>
</div>
<hr>
<div id="outline">
<?php if ( has_post_thumbnail() )  the_post_thumbnail('thumbnail'); ?>
<p class="jap">
<?php
	$title_ja = get_the_title();
	$title_en = get_post_meta($id, 'ex_title_en', true);
	$link = get_post_meta($id, 'ex_link', true);
	if(get_post_meta($id, 'ex_link', true) !='') {
		$title_ja = '<a href="'.$link.'">'.$title_ja.'</a>';
		$title_en = '<a href="'.$link.'">'.$title_en.'</a>';
	}
?>
「<?php echo $title_ja ?>」<br>
会場：<a href="<?php echo get_post_meta($id, 'ex_place_link', true); ?>" target="_blank"><?php echo get_post_meta($id, 'ex_place', true); ?></a>（<?php echo get_post_meta($id, 'ex_area', true); ?>）<br>
会期：<?php echo get_post_meta($id, 'ex_date', true); ?>
</p>
<p class="eng">
Title: <?php echo $title_en; ?><br>
Venue: <a href="<?php echo get_post_meta($id, 'ex_place_link', true); ?>" target="_blank"><?php echo get_post_meta($id, 'ex_place_en', true); ?></a>（<?php echo get_post_meta($id, 'ex_area_en', true); ?>）<br>
Date: <?php echo get_post_meta($id, 'ex_date_en', true); ?>
</p>
</div>

<?php endif; //category 2 ?>
</div><!-- #single -->
<?php endwhile; else: ?>
<?php endif; ?>

<?php if(in_category('2')): ?>
<hr>
<?php $the_query = new WP_Query('tag='.$slug_name); if($the_query->have_posts()): ?>
<div id="single_archive">
<h3>Related Exhibitions</h3>
<?php
	$newsJa = '<ul class="jap">';
	$newsEn = '<ul class="eng">';
	while ($the_query->have_posts()){
		$the_query->the_post();
		$id = get_the_ID();
		$ex_link = ' href="'.get_post_meta($id, 'ex_link', true).'" target="_blank"';
		if(get_post_meta($id, 'ex_is_page', true)) $ex_link = ' href="'.get_the_permalink().'"';
		$newsJa .= '<li>'.get_the_time('Y').'｜<a'.$ex_link.'>'.get_the_title().'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place', true).'</a>（'.get_post_meta($id, 'ex_area', true).'）</li>';
		$newsEn .= '<li>'.get_the_time('Y').' | <a'.$ex_link.'>'.get_post_meta($id, 'ex_title_en', true).'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place_en', true).'</a>（'.get_post_meta($id, 'ex_area_en', true).'）</li>';
	}
	wp_reset_postdata();
	$newsJa .= '</ul>';
	$newsEn .= '</ul>';
	echo $newsJa.$newsEn;
?>
</div>
<?php endif; endif; ?>

<?php get_footer(); ?>