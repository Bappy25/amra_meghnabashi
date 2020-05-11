<?php inherits('admin.app'); ?>

<?php startblock('title') ?>

<?php echo 'All Members || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">Admin Dashboard</div>
  <div class="card-body">
    <?php 
    $alerts = Base\Request::getFlash();
    if(!empty((array) $alerts)){
      foreach($alerts as $key=>$value){
        ?>
        <div class="alert alert-<?php echo $key; ?> alert-dismissible"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo $value; ?>
        </div>
        <?php                            
      }
    } 
    ?>
    <h5 class="text-center my-3 text-muted"><i class="fas fa-user-tag pr-2"></i>All Members</h5>
    <a class="btn btn-success btn-sm" href="<?php echo route('admin/members/create') ?>"><i class="fas fa-plus pr-2"></i>Add New Member</a>
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">#</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Designation</th>
          <th class="th-sm">Contact</th>
          <th class="th-sm">Created At</th>
          <th class="th-sm">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($members as $member) { ?>
          <tr>
            <td class="font-weight-bold"><?php echo $member['id']; ?></td>
            <td><?php echo $member['name']; ?></td>
            <td><?php echo $member['designation']; ?></td>
            <td><?php echo $member['contact']; ?></td>
            <td><?php echo date('F d (l), Y', strtotime($member['created_at'])); ?></td>
            <td>
              <form method="post" action="<?php echo route('admin/members/delete') ?>" onsubmit="return confirm('Do you really want to delete this member?');">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" value="<?php echo $member['id']; ?>" name="id">
                <a class="btn btn-primary btn-sm" href="<?php echo route('admin/members/show', ['id' => $member['id']]) ?>"><i class="fas fa-eye"></i></a>
                <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="th-sm">#</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Designation</th>
          <th class="th-sm">Contact</th>
          <th class="th-sm">Created At</th>
          <th class="th-sm">Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<?php endblock() ?>