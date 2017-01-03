<?php $locations = get_field("perf_contact_locations"); ?>
<?php if( is_array( $locations ) && count( $locations > 0) ): ?>
	<?php $cpt = 1; foreach( $locations as $location ): ?>
		<section class="break-word table col-12">

			<?php
				if( $cpt % 2 == 0 ){
					include( get_template_directory() . '/components/content-contact/img-location.php');
				}
			?>

			<div class="<?php if( $location['image_place'] ){ echo 'md-col-12 lg-col-7 lg-table-cell'; } ?> align-top dark-bg px2 sm-px3 py3 featured">

				<h5 class="entry-title separator mb3 mt0 upper white-color regular md-ml2"><?php echo $location['title']; ?></h5>

				<div class="clearfix">
					<div class=" sm-col sm-col-5">
						<h3 class="white-color mt0 mb2 md-ml2"><?php echo $location['sub_title']; ?></h3>
					</div>

					<div class="sm-col sm-col-7">

						<?php $contact_infos = $location['contact_infos']; ?>

						<?php if( is_array($contact_infos) && count($contact_infos) > 0 ): ?>
							<?php foreach( $contact_infos as $infos ): ?>

								<div class="table sm-col-12 address_contact white-color mt0 mb1">
									<div class="table-cell width40 main-color contact_icons">
										<svg class="fa <?php echo $infos['icon']; ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo $infos['icon']; ?>"></use></svg>
									</div>

									<div class="table-cell small-p align-middle">
										<p class="mb0"><?php echo $infos['contact_content']; ?></p>
									</div>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>

					</div>

				</div>
				<?php //echo '<pre>'; print_r($location); echo '</pre>'; ?>
			</div>

			<?php
				if( $cpt % 2 != 0 ){
					include( get_template_directory() . '/components/content-contact/img-location.php');
				}
			?>
		</section>
	<?php $cpt++; endforeach; ?>
<?php endif; ?>
