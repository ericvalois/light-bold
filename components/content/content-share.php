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

	<h5 class="mb1 mt2 hide-prin"><?php _e("Share this","light-bold"); ?></h5>

	<div id="social_widget" class="clearfix mb2 hide-print">
		<div class="left mb1 mr1">
			<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php echo urlencode( get_the_title() ); ?>" class="flex flex-center social_share align-middle"><svg class="mx-auto fa fa-facebook"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-facebook"></use></svg></a>
		</div>

		<div class="left mb1 mr1">
			<a target="_blank" href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>+<?php echo get_permalink(); ?>" class="flex flex-center  social_share"><svg class="mx-auto fa fa-twitter"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-twitter"></use></svg></a>
		</div>

		<div class="left mb1 mr1">
			<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="flex flex-center  social_share"><svg class="mx-auto fa fa-google-plus"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-google-plus"></use></svg></a>
		</div>

		<div class="left mb1 mr1">
			<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo urlencode( get_the_title() ); ?>" class="flex flex-center  social_share"><svg class="mx-auto fa fa-linkedin"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-linkedin"></use></svg></a>
		</div>

		<div class="left mr1">
			<a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=article&url=<?php echo get_permalink(); ?>&is_video=false&description=<?php echo urlencode( get_the_title() ); ?>" class="flex flex-center  social_share"><svg class="mx-auto fa fa-pinterest"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-pinterest"></use></svg></a>
		</div>
	</div>

<?php endif; ?>
