<?php $locations = get_field("perf_contact_locations"); ?>
<?php if( is_array( $locations ) && count( $locations > 0) ): ?>
	<?php foreach( $locations as $location ): ?>
		<section class="featured break-word table col-12">
			<div class="<?php if( $location['image_place'] ){ echo 'md-col-12 lg-col-6 lg-table-cell'; } ?> align-top dark-bg px2 sm-px3 md-px4 py3 md-py4 ">

				<h5 class="entry-title separator mb3 mt0 upper white-color regular"><?php echo $location['title']; ?></a></h5>

				<div class="clearfix">
					<div class=" sm-col sm-col-6">
						<h3 class="white-color mt0"><?php echo $location['sub_title']; ?></h3>
					</div>

					<div class=" sm-col sm-col-6">

						<?php $contact_infos = $location['contact_infos']; ?>

						<?php if( is_array($contact_infos) && count($contact_infos) > 0 ): ?>
							<?php foreach( $contact_infos as $infos ): ?>

								<div class="table sm-col-12 address_contact white-color mt0">
									<div class="table-cell width30">
										<?php echo $infos['icon']; ?>
									</div>

									<div class="table-cell small-p">
										<p class="mb0"><?php echo $infos['contact_content']; ?></p>
									</div>
								</div>
      
							<?php endforeach; ?>
						<?php endif; ?>

					</div>

				</div>
				<?php //echo '<pre>'; print_r($location); echo '</pre>'; ?>
			</div>

			<?php if( $location['image_place'] ): ?>
				<div class="col-12 md-col-6 lg-table-cell bg-cover bg-center center lazyload" data-sizes="auto"
					data-bgset="<?php echo $location['image_place']['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
					<?php echo $location['image_place']['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
					<?php echo $location['image_place']['sizes']['perfthemes-hero-sm']; ?>">
				</div>
			<?php endif; ?>
		</section>
	<?php endforeach; ?>
<?php endif; ?>