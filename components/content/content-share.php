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
		<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&t=<?php echo get_the_title(); ?>" class="table-cell social_share"><i class="fa fa-facebook"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="http://twitter.com/home?status=<?php echo get_the_title(); ?>+<?php echo get_permalink(); ?>" class="table-cell social_share"><i class="fa fa-twitter"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="table-cell social_share"><i class="fa fa-google-plus"></i></a>
	</div>

	<div class="left table mb1 mr1">
		<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" class="table-cell social_share"><i class="fa fa-linkedin"></i></a>
	</div>

	<div class="left table mr1">
		<a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=article&url=<?php echo get_permalink(); ?>&is_video=false&description=<?php echo get_the_title(); ?>" class="table-cell social_share"><i class="fa fa-pinterest"></i></a>
	</div>
</div>
