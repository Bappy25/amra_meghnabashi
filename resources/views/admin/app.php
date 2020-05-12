<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<head>

  <meta charset="UTF-8">
  <meta name="description" content="CodeCube Framework">
  <meta name="keywords" content="PHP,HTML,CSS,XML,JavaScript">
  <meta name="author" content="Mahadi Hasan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon-->
  <?php echo icon('img/favicon.png'); ?>

  <title><?php startblock('title') ?><?php endblock() ?></title>

  <!-- Font Awesome -->
  <?php echo style('plugins/fontawesome/css/all.min.css'); ?>
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <?php echo style('css/bootstrap.min.css'); ?>
  <!-- Datatable CSS -->
  <?php echo style('plugins/mdbootstrap/css/addons/datatables.min.css'); ?>
  <!-- Material Design Bootstrap -->
  <?php echo style('css/mdb.min.css'); ?>
  <!-- Your custom styles (optional) -->
  <?php echo style('css/style.css'); ?>

</head>
<!-- #ENDS# Header -->

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand font-weight-bold" href="<?php echo route('welcome'); ?>"><?php echo title(); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php $auth = new Base\Authenticable; if($auth->check()){ ?>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo route_is('admin/web') ? 'active' : '' ?>">
              <a class="nav-link" href="<?php echo route('admin/web/all'); ?>">Web Content</a>
            </li>
            <li class="nav-item <?php echo route_is('admin/users') ? 'active' : '' ?>">
              <a class="nav-link" href="<?php echo route('admin/users/all'); ?>">Users</a>
            </li>
            <li class="nav-item <?php echo route_is('admin/projects') ? 'active' : '' ?>">
              <a class="nav-link" href="<?php echo route('admin/projects/all'); ?>">Projects</a>
            </li>
            <li class="nav-item <?php echo route_is('admin/members') ? 'active' : '' ?>">
              <a class="nav-link" href="<?php echo route('admin/members/all'); ?>">Members</a>
            </li>
            <li class="nav-item <?php echo route_is('admin/news') ? 'active' : '' ?>">
              <a class="nav-link" href="<?php echo route('admin/news/all'); ?>">News</a>
            </li>
          </ul>
          <span class="navbar-text">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="signout();"><i class="fas fa-sign-out-alt pr-2"></i>Sign Out</a>
                <form id="signout-form" action="<?php echo route('admin/signout') ?>" method="POST" style="display: none;">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
              </li>
              <script type="text/javascript">
                  // Function for logging out
                  function signout(){
                    if ( confirm("Are you sure you want to sign out?") == true ){
                      document.getElementById("signout-form").submit();
                    }
                  }
                </script>
              </span>
            <?php } else { ?>
              <ul class="navbar-nav mr-auto"></ul>
              <span class="navbar-text">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link <?php echo route_is('admin/signin') ? 'active' : ''; ?>" href="<?php echo route('admin/signin'); ?>"><i class="fas fa-sign-in-alt pr-2"></i>Sign In</a>
                  </li>
                </ul>
              </span>
            <?php } ?>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="mx-5 my-5">
          <?php startblock('content') ?>
          <?php endblock() ?>
        </div>
      </div>

      <!-- jQuery -->
      <?php echo script('js/jquery.min.js'); ?>
      <!-- Bootstrap tooltips -->
      <?php echo script('js/popper.min.js'); ?>
      <!-- Bootstrap core JavaScript -->
      <?php echo script('js/bootstrap.min.js'); ?>
      <!-- Datatables JavaScript -->
      <?php echo script('plugins/mdbootstrap/js/addons/datatables.min.js'); ?>
      <!-- MDB core JavaScript -->
      <?php echo script('js/mdb.min.js'); ?>
      <!-- Custom JavaScript -->
      <?php echo script('js/script.js'); ?>
      <!-- Custom Script -->
      <script type="text/javascript">
        $(document).ready(function () {

          // Initialize datatable
          $('#dtBasicExample').DataTable();
          $('.dataTables_length').addClass('bs-select');
        });
      </script>

    </body>

    </html>
