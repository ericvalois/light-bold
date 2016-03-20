<?php
	if( get_field("perf_use_google_font","option") && get_field("perf_google_font","option") ){
		/*
		* Inject font css
		*/
		add_action( 'perf_sm_styles', 'perf_google_font' );
	}

	function perf_google_font() {
		switch ( get_field("perf_google_font","option") ) {
		    case 'open-sans':
		        $font_familly = "font-family: 'Open Sans', sans-serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700");
		        break;
		    case 'josefin-slab':
		        $font_familly = "font-family: 'Josefin Slab', serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Josefin+Slab:400,400italic,700");
		        break;
		    case 'arvo':
		        $font_familly = "font-family: 'Arvo', serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Arvo:400,400italic,700");
		        break;
		    case 'lato':
		        $font_familly = "font-family: 'Lato', sans-serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Lato:400,400italic,700");
		        break;
		    case 'vollkorn':
		        $font_familly = "font-family: 'Vollkorn', serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Vollkorn:400,400italic,700");
		        break;
		    case 'abril-fatface':
		        $font_familly = "font-family: 'Abril Fatface', cursive;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Abril+Fatface");
		        break;
		    case 'ubuntu':
		        $font_familly = "font-family: 'Ubuntu', sans-serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700");
		        break;
		    case 'pt-sans-pt-serif':
		        $font_familly = "font-family: 'PT Sans', sans-serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic");
		        break;
		    case 'old-standard-tt':
		        $font_familly = "font-family: 'Old Standard TT', serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Old+Standard+TT");
		        break;
		    case 'droid-sans':
		        $font_familly = "font-family: 'Droid Sans', sans-serif;";
		        $font_face = file_get_contents("https://fonts.googleapis.com/css?family=Droid+Sans:400,700");
		        break;
		}
	?>	
		<?php echo $font_face; ?>

	    body,h1,h2,h3,h4,h5,h6{
	        <?php echo $font_familly; ?>
	    }
	<?php
	}
	