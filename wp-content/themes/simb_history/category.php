<?php get_header(); ?>
	
<?php

	// Получаем данные о запрошенном объекте
	$queried_obj = get_queried_object();	

	$childrens_cats = get_term_children($queried_obj->term_id, 'category');

	$data_arr = [];

	// Получаем инфу о подкатегориях текущей категории
	foreach ($childrens_cats as $key => $value) {
		$data_arr[$key] = get_term($value, 'category');
	}

	//Получаем инфу о записях(постах) если у категории они есть
	$args = ["category" => $queried_obj->term_id, "numberposts" => 100, "order" => "ASC",];

	$currrent_cat_posts = get_posts($args);
 	
	$posts_count = count($currrent_cat_posts);
 	$cats_count = count($childrens_cats);

 	// echo '<pre>';
 	// var_dump($currrent_cat_posts);
 	// echo '</pre>';

?>	

<!-- Страница в разработке <?= date("d.m.Y") ?> -->

<div class="h1-wrp">
	<div class="h1"><?= $queried_obj->name ?></div>
</div>


		
		<?php
			//Если есть подкатегории и нет записей			
			if($cats_count > 0  && $posts_count == 0){
		?>
<!-- template 1 -->
			<div class="container-fluid">
				<div id="<?=  $cats_count > 4 ? "cat_silder" : "" ?>" class="row <?=  $cats_count < 4 ? "justify-content-center" : "" ?>">

					<?php foreach($data_arr as $key => $value){ ?>

							<div class="col-3 cat-<?= $value->term_id ?>">
								<a href="<?= get_category_link( $value->term_id ) ?>" class="a exhibit-card">

									<h3 class="h3 exhibit-card-title"><?= $value->name ?></h3>
									<div class="proportion-saver square">
										<div class="img-wrp">
											<img src="" alt="" class="img" loading="lazy">
										</div>
									</div>				

								</a>
							</div>		

					<?php } ?>

				</div>
			</div>

		<?php } ?>


		<?php
			//Если есть посты и нет категорий
			if($cats_count == 0 && $posts_count > 0){
		?>
<!-- template 2 -->
			<div class="container-fluid">
				<div id="<?=  $posts_count > 4 ? "post_silder" : "" ?>" class="row">

					<?php foreach($currrent_cat_posts as $key => $value){ ?>

						<div class="col-3 ">
							<div class="exhibit-card">

								
								<!-- <div class="proportion-saver square">
									<div class="img-wrp"> -->
										<img src="<?= get_the_post_thumbnail_url( $value->ID, 'large' ); ?>" alt="" class="img" loading="lazy">
									<!-- </div>
								</div> -->
								<h3 class="h3 exhibit-card-title"><?= $value->post_title ?></h3>
								<p class="p post-content"><?= $value->post_content ?></p>			

							</div>
						</div>		

					<?php } ?>

				</div>
			</div>

		<?php } ?>


		<?php
			//Если есть категории и посты
			if($cats_count > 0 && $posts_count > 0){ ?>
<!-- template 3 -->
			<div class="container-fluid">
				
					<div id="<?=  $cats_count > 4 ? "cat_silder" : "" ?>" class="row <?=  $cats_count < 4 ? "justify-content-center" : "" ?>">				

						<?php foreach($data_arr as $key => $value){ ?>

								<div class="col-3 cat-<?= $value->term_id ?>">
									<a href="<?= get_category_link( $value->term_id ) ?>" class="a exhibit-card">

										<h3 class="h3 exhibit-card-title"><?= $value->name ?></h3>
										<div class="proportion-saver square">
											<div class="img-wrp">
												<!--<img src="" alt="" class="img" loading="lazy">-->
											</div>
										</div>				

									</a>
								</div>		

						<?php } ?>

					</div>				
			
<br>
				
					<!-- <div  id="<?=  $posts_count > 4 ? "post_silder" : "" ?>" class="row">				 -->

						<?php foreach($currrent_cat_posts as $key => $value){ ?>

								<!-- <div class="col-3">
									<a href="" class="a exhibit-card">
										
										<div class="proportion-saver square">
											<div class="img-wrp">
												<img src="" alt="" class="img">
											</div>
										</div>
										<h3 class="h3 exhibit-card-title"><?= $value->post_title ?></h3>
										<p class="p"><?= $value->post_content ?></p>	

									</a>
								</div>	 	

						<?php } ?>
					<!-- </div>				 -->
			

			</div>	

		<?php } ?>

<?php get_footer(); ?>