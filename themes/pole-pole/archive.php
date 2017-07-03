<?php get_header(); ?>

<?php if (have_posts()) : ?>

<div id="archive">

<?php if(is_category(array(3,4,5))): ?>
<h2>WORKS</h2>
<div id="cat"><a href="<?php echo get_home_url(); ?>/?cat=3">All</a> / <a href="<?php echo get_home_url(); ?>/?cat=4">Solo</a> / <a href="<?php echo get_home_url(); ?>/?cat=5">Collaboration</a></div>
<?php
	$n = 0;
	// $last_y = '2001';
	while (have_posts()){
		the_post();
		$id = get_the_ID();
		$y = get_the_time('Y');
		$title_en = '';
		if(get_post_meta($id, 'title_en', true) != '') $title_en = '｜'.get_post_meta($id, 'title_en', true);
		// if($y != $last_y){
		// 	if($n != 0) $ul .= '</ul>';
		// 	// $ul .= '<h3>'.$y.'</h3><ul>';
		// }
		$ul .= '<li><a class="self" href="'.get_the_permalink().'">'.get_the_title().$title_en.'　('.$y.') '.'</a></li>';
		$last_y = $y;
		$n++;
	}
	$ul = '<div><ul>'.$ul.'</ul></div>';
	echo $ul;
?>

<?php elseif(is_category(array(2,6,7))): ?>
<?php
	$catName = '';
	if(is_category(2)) $catName = 'EXHIBITION / EVENT';
	if(is_category(6)) $catName = 'SOLO SHOW';
	//if(is_category(6)) $catName = 'WORKSHOP';
	if(is_category(7)) $catName = 'GROUP SHOW';
?>
<h2><?php echo $catName; ?></h2>
<div id="cat"><a href="<?php echo get_home_url(); ?>/?cat=2">All</a> / <a href="<?php echo get_home_url(); ?>/?cat=6">Solo Show</a> / <a href="<?php echo get_home_url(); ?>/?cat=7">Group Show</a> <!-- <a href="<?php echo get_home_url(); ?>/?cat=6">Workshop</a>--></div>
<?php
	$n = 0;
	$last_y = '2001';
	$divEn = '<div class="eng">';
	$divJa = '<div class="jap">';
	while (have_posts()){
		the_post();
		$id=get_the_ID();
		$y = get_the_time('Y');
		if($y != $last_y){
			if($n != 0){
				$divEn .= '</ul>';
				$divJa .= '</ul>';
			}
			$divEn .= '<h3>'.$y.'</h3><ul>';
			$divJa .= '<h3>'.$y.'</h3><ul>';
		}
		$ex_link = ' href="'.get_post_meta($id, 'ex_link', true).'" target="_blank"';
		if(get_post_meta($id, 'ex_is_page', true)) $ex_link = ' class="self" href="'.get_the_permalink().'"';
		$divEn .= '<li><a'.$ex_link.'>'.get_post_meta($id, 'ex_title_en', true).'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place_en', true).'</a>（'.get_post_meta($id, 'ex_area_en', true).'）</li>';
		$divJa .= '<li><a'.$ex_link.'>'.get_the_title().'</a> @<a href="'.get_post_meta($id, 'ex_place_link', true).'" target="_blank">'.get_post_meta($id, 'ex_place', true).'</a>（'.get_post_meta($id, 'ex_area', true).'）</li>';
		$last_y = $y;
		$n++;
	}
	$divEn .= '</ul></div>';
	$divJa .= '</ul></div>';
	echo $divJa.$divEn;
?>
<?php endif; //is_category() ?>

<?php else : //if(have_posts()) ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
</div><!-- #archive -->
<?php endif; //if(have_posts()) ?>


<?php get_footer(); ?>
