<?php inherits('layouts.master'); ?>

<?php startblock('title') ?>

<?php echo title().' || Amader Meghna || '.locale('views', 'meghna_personality'); ?>

<?php endblock() ?>

<?php startblock('meta_tags') ?>

<meta name="keywords" content="<?php echo $contents['keywords'].', '.$meghna['keywords']; ?>">
<meta name="description" content="<?php echo $contents['slogan']; ?>">

<?php endblock() ?>

<?php startblock('content') ?>

<section class="container my-3 py-3">
	<h1 class="text-info font-weight-bold mb-5"><i class="fas fa-book-reader pr-2"></i><?php echo locale('views', 'our_meghna'); ?></h1>
	<h4 class="my-3 font-weight-bold text-primary"><?php echo locale('views', 'meghna_personality'); ?></h4>

	<input class="searchBox form-control mb-4"  class="form-control" placeholder="<?php echo locale('views', 'search_something'); ?>">
	<div class="row content_paginator">
		<?php foreach ($personalities as $personality) { ?>
			<div class="result col-sm-4 mb-3">
				<div class="media">
					<?php echo image($personality['image_path'], $personality['name'], ['class'=>'rounded-circle mr-3', 'height'=>'100px', 'width' => '100px']); ?>
					<div class="media-body">
						<h5 class="mt-0 font-weight-bold"><?php echo $personality['name']; ?></h5>
						<i class="far fa-id-card pr-2"></i><?php echo $personality['designation']; ?>
						<span style="display: none;"><?php echo strip_tags($personality['details']); ?></span>
						<br><a class="btn btn-warning btn-sm" href="<?php echo route('members/show', ['id' => $personality['id']]); ?>"><i class="fas fa-external-link-alt pr-2"></i><?php echo locale('views', 'show_details'); ?></a>
					</div>
				</div>
				<hr>
			</div>
		<?php } ?>
	</div>
	<div id="pagingControls"></div>
	<!-- <div id="showingInfo" class="well my-3"></div> -->
</section>

<?php endblock() ?>