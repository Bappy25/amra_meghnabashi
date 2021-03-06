<?php inherits('layouts.master'); ?>

<?php startblock('title') ?>

<?php echo title().' || '.locale('views', 'our_members').' || '.$member['name']; ?>

<?php endblock() ?>

<?php startblock('meta_tags') ?>
    
  <meta name="keywords" content="<?php echo $contents['keywords']; ?>">
  <meta name="description" content="<?php echo $contents['slogan']; ?>">

<?php endblock() ?>

<?php startblock('content') ?>

<section class="container my-3 py-3">
	<h1 class="text-info font-weight-bold mb-5"><i class="fas fa-users pr-2"></i><?php echo locale('views', 'our_members'); ?></h1>
	<h4 class="my-3 font-weight-bold"><?php echo $member['name']; ?></h4>
	<hr>
    <a href="<?php echo APP_URL.'/'.$member['image_path']; ?>" target="_blank">
      <?php echo image($member['image_path'], $member['name'], ['class'=>'img-fluid img-thumbnail my-3', 'style'=>'width: 300px']); ?>
    </a>
    <p class="font-weight-bold"><i class="far fa-id-card pr-2"></i><?php echo $member['designation']; ?></p>
    <?php echo $member['details']; ?>
	
</section>

<?php endblock() ?>