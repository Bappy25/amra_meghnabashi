<?php inherits('layouts.master'); ?>

<?php startblock('title') ?>

<?php echo 'News || '.$news['title'].' || '.title(); ?>

<meta name="keywords" content="<?php echo $contents['keywords'].', '.$news['tags']; ?>">
<meta name="description" content="<?php echo $contents['slogan']; ?>">
<meta name="author" content="<?php echo $news['user_name']; ?>">

<meta property="og:title" content="<?php echo $news['title'] ?>">
<meta property="og:description" content="<?php echo strip_tags(substr($news['details'], 0, 50)); ?>...">
<meta property="og:image" content="<?php echo $news['image_path'] ?>">
<meta property="og:url" content="<?php echo route('news/show', ['id' => $news['id']]); ?>">

<?php endblock() ?>

<?php startblock('content') ?>

<section class="container my-3 py-3">
	<h1 class="green-text font-weight-bold mb-5"><i class="fas fa-newspaper pr-2"></i><?php echo locale('views', 'news'); ?></h1>
	<h4 class="my-3 font-weight-bold dark-grey-text"><?php echo $news['title'] ?></h4>
	<hr>
	<p class="text-muted">
		<i class="fas fa-user pr-2"></i><?php echo $news['user_name']; ?>&nbsp;
		<i class="fas fa-calendar-day pr-2"></i><?php echo date('F d (l), Y', strtotime($news['created_at'])); ?>
	</p>
	<div id="social_share" class="my-3"></div>

    <div class="card mb-4 wow fadeIn">
    	<img src="<?php echo $news['image_path'] ?>" class="img-fluid" alt="<?php echo $news['title'] ?>">
    </div>

	<p><?php echo $news['details']; ?></p>
	<a class="btn btn-danger btn-sm my-3" href="<?php echo route('news') ?>"><i class="fas fa-arrow-left pr-2"></i><?php echo locale('views', 'go_back'); ?></a>
	
</section>

<?php endblock() ?>