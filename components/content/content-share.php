<?php
/**
 * Template part for displaying share.
 *
 * @package perfthemes
 */

?>

<h5 class="mb1 mt2 hide-print"><?php _e("Share this","perf"); ?></h5>

<div id="social_widget" class="clearfix mb2 hide-print">
	<div class="left table mb1 mr1">
		<a target="_blank" href="<?php echo urlencode('http://www.facebook.com/sharer.php?u=' . get_permalink() . '&t=' . get_the_title() ); ?>" class="table-cell social_share"><i class="fa fa-facebook"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="<?php echo urlencode('http://twitter.com/home?status=' . get_the_title() . '+' . get_permalink() ); ?>" class="table-cell social_share"><i class="fa fa-twitter"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="<?php echo urlencode('https://plus.google.com/share?url=' . get_permalink() ); ?>" class="table-cell social_share"><i class="fa fa-google-plus"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="<?php echo urlencode('https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() ); ?>" class="table-cell social_share"><i class="fa fa-linkedin"></i></a>
	</div>

	<div class="left table mr1">
		<a target="_blank" href="<?php echo urlencode('http://pinterest.com/pin/create/bookmarklet/?media=article&url=' . get_permalink() . '&is_video=false&description=' .  get_the_title() ); ?>" class="table-cell social_share"><i class="fa fa-pinterest"></i></a>
	</div>
</div>