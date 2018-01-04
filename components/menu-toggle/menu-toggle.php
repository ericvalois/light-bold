<?php
    $main_nav_layout = get_field("perf_layouts","option");

    if( isset( $main_nav_layout['main_nav_layout'] ) && $main_nav_layout['main_nav_layout'] == 'top' ){
        $toggle_class = 'lg-hide';
    }else{
        $toggle_class = 'absolute z1 top-0 bottom-0 left-0 ml1 mr1';
    }
?>
<button id="main_nav_toggle" class="<?php echo $toggle_class; ?> bg-white border-none outline-0 pointer">
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 53 53" xml:space="preserve">
		<g>
			<path d="M2,13.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,13.5,2,13.5z"/>
			<path d="M2,28.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,28.5,2,28.5z"/>
			<path d="M2,43.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,43.5,2,43.5z"/>
		</g>
	</svg>
</button>