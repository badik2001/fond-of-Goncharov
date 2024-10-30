<?php  get_header();  ?>

		<div class="h1-wrp">
			<div class="h1"><?= $main_cat[0]->name ?></div>
		</div>

		<div class="container-fluid">
			<div class="row align-items-start">			

			<?php			

				$main_cat_id = $main_cat[0]->id;

				$categories = $wpdb->get_results("
					SELECT `wp_terms`.`term_id` AS `id`, `wp_terms`.`slug`, `wp_terms`.`name`, `wp_term_taxonomy`.`parent`
					FROM `wp_terms`, `wp_term_taxonomy`
					WHERE `wp_term_taxonomy`.`term_id` = `wp_terms`.`term_id` AND `wp_term_taxonomy`.`parent` = $main_cat_id"
				);

				foreach ($categories as $category => $item) {
				
			?>

				<a href="<?= get_category_link( $item->id ) ?>" class="a col-3 cat-card cat-<?= $item->id ?>">
					<div class="proportion-saver square">				
						<div class="img-wrp">
							<h3 class="h3 cat-card-title"><?= $item->name ?></h3>
							<div class="proportion-saver rectangle">
								<div class="img-wrp">
									
								</div>
							</div>							
						</div>
					</div>	
				</a>

			<?php } ?>

			</div>
		</div>

<?php  get_footer();  ?>