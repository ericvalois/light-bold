<div class="site-logo">
	<?php if( perf_get_field("perf_log_sm","option") || perf_get_field("perf_log_lg","option") ): ?>
		<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none mx-auto">
			<picture>
				<source srcset="<?php echo perf_get_field("perf_log_sm","option"); ?>" media="(max-width: 1200px)">
				<source srcset="<?php echo perf_get_field("perf_log_md","option"); ?>" media="(min-width: 1200px) and (max-width: 1650px)">
				<source srcset="<?php echo perf_get_field("perf_log_lg","option"); ?>" media="(min-width: 1650px)">
 				<img class="block mx-auto" src="<?php echo perf_get_field("perf_log_sm","option"); ?>" alt="MDN">
			</picture>
		</a>
	<?php else: ?>
		<a id="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none dark-color small-p block bold">
			<?php echo get_bloginfo("name"); ?><br>
			<span class="desc regular sm-show"><?php echo get_bloginfo("description"); ?></span>
		</a>
	<?php endif; ?>
</div>
