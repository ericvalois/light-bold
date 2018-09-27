<div class="site-logo inline-flex flex-center">
	<?php if( get_field("perf_log_sm","option") || get_field("perf_log_lg","option") ): ?>
    <?php 
        $mobile = get_field("perf_log_sm","option");
        $mobile_retina = get_field("perf_log_sm_retina","option");
        $desktop = get_field("perf_log_lg","option");
        $desktop_retina = get_field("perf_log_lg_retina","option");
    ?>
		<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none mx-auto">
			<picture>
				<source srcset="<?php echo esc_url( $mobile ); ?>
                                <?php
                                    if( $mobile_retina ){
                                        echo ", " . esc_url( $mobile_retina ) . " 2x"; 
                                    }
                                ?>" 
                        media="(max-width: 1199px)">
				<source srcset="<?php echo esc_url( $desktop ); ?>
                                <?php
                                    if( $desktop_retina ){
                                        echo ", " . esc_url( $desktop_retina ) . " 2x"; 
                                    }
                                ?> 
                                " 
                        media="(min-width: 1200px)">
 				<img class="block mx-auto" src="<?php echo esc_url( $desktop ); ?>" alt="Logo">
			</picture>
		</a>
	<?php else: ?>
		<a id="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none dark-color small-p block bold">
			<?php echo get_bloginfo("name"); ?><br>
			<span class="desc regular sm-show"><?php echo esc_html( get_bloginfo("description") ); ?></span>
		</a>
	<?php endif; ?>
</div>
