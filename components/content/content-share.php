<?php
/**
 * Template part for displaying share.
 *
 * @package perfthemes
 */

?>
<?php
	$perf_on_page_share_disabled = get_field('perf_on_page_share_disabled', $post->ID);
	$perf_disable_social_share = get_field("perf_disable_social_share","option");
	
	if( !$perf_disable_social_share && !$perf_on_page_share_disabled  ):
?>

	<h5 class="mb1 mt2 hide-prin"><?php _e("Share this","lightbold"); ?></h5>

	<div id="social_widget" class="clearfix mb2 hide-print">
		<div class="left table mb1 mr1">
			<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php echo get_the_title(); ?>" class="table-cell social_share"><svg class="fa fa-facebook"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-facebook"></use></svg></a>
		</div>

		<div class="left table mb1 mr1">
			<a target="_blank" href="http://twitter.com/home?status=<?php echo get_the_title(); ?>+<?php echo get_permalink(); ?>" class="table-cell social_share"><svg class="fa fa-twitter"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-twitter"></use></svg></a>
		</div>

		<div class="left table mb1 mr1">
			<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="table-cell social_share"><svg class="fa fa-google-plus"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-google-plus"></use></svg></a>
		</div>

		<div class="left table mb1 mr1">
			<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" class="table-cell social_share"><svg class="fa fa-linkedin"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-linkedin"></use></svg></a>
		</div>

		<div class="left table mr1">
			<a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=article&url=<?php echo get_permalink(); ?>&is_video=false&description=<?php echo get_the_title(); ?>" class="table-cell social_share"><svg class="fa fa-pinterest"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-pinterest"></use></svg></a>
		</div>
	</div>

<?php endif; ?>
