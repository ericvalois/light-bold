<div class="site-logo mt1 lg-mt0">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<picture>
		   <source media="(min-width: 1200px)" srcset="<?php echo get_field("perf_log_lg","option"); ?>">
		   <source media="(min-width: 768px)" srcset="<?php echo get_field("perf_log_md","option"); ?>">
		   <source srcset="<?php echo get_field("perf_log_sm","option"); ?>">
		   <img src="<?php echo get_field("perf_log_lg","option"); ?>" alt="Logo <?php bloginfo( 'name' ); ?>">
		</picture>
	</a>
</div>