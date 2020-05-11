<div class="green text-white py-2">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <nav class="nav">
          <span class="nav-link"><i class="fas fa-phone pr-2"></i><?php echo $contents['contact']; ?></span>
          <span class="nav-link"><i class="fas fa-envelope pr-2"></i><?php echo $contents['email']; ?></span>
        </nav>
      </div>
      <div class="col-6">
        <nav class="nav float-right">
          <a class="nav-link text-white" href="<?php echo $contents['facebook']; ?>"><i class="fab fa-facebook"></i></a>
          <a class="nav-link text-white" href="<?php echo $contents['twitter']; ?>"><i class="fab fa-twitter"></i></a>
          <a class="nav-link text-white" href="<?php echo $contents['youtube']; ?>"><i class="fab fa-youtube"></i></a>
        </nav>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark green darken-4">
  <div class="container py-2">
    <a class="navbar-brand font-weight-bold" href="<?php echo route('welcome'); ?>"><?php echo title(); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="basicExampleNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo route_is('members') ? 'active' : '' ; ?>">
          <a class="nav-link" href="<?php echo route('members'); ?>">Members<?php echo route_is('members') ? '<span class="sr-only">(current)</span>' : '' ; ?></a>
        </li>
        <li class="nav-item <?php echo route_is('projects') ? 'active' : '' ; ?>">
          <a class="nav-link" href="<?php echo route('projects'); ?>">Projects<?php echo route_is('projects') ? '<span class="sr-only">(current)</span>' : '' ; ?></a>
        </li>
        <li class="nav-item <?php echo route_is('news') ? 'active' : '' ; ?>">
          <a class="nav-link" href="<?php echo route('news'); ?>">News<?php echo route_is('news') ? '<span class="sr-only">(current)</span>' : '' ; ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>