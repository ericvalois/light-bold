<div class="site-logo lg-mt0">
	<?php if( get_field("perf_log_sm","option") || get_field("perf_log_lg","option") ): ?>
		<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none"></a>
	<?php else: ?>
		<a id="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none dark-color small-p block bold">
			<?php echo get_bloginfo("name"); ?><br>
			<span class="desc regular sm-show"><?php echo get_bloginfo("description"); ?></span>
		</a>
	<?php endif; ?>
</div>
