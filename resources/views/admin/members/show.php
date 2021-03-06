<?php inherits('admin.app'); ?>

<?php startblock('title') ?>

<?php echo 'All Members & Persons || '.$member['name'].' || '.title(); ?>

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
    <h5 class="text-center my-3 text-muted"><i class="fas fa-user-tag pr-2"></i><?php echo $member['name']; ?></h5>
    <?php echo image($member['image_path'], $member['name'], ['class'=>'img-fluid img-thumbnail my-3', 'style'=>'width: 200px']); ?>
    <p><strong>Tags:</strong> <?php echo '#'.str_replace(",", ", #", $member['tags']); ?></p>
    <p><strong>Designation:</strong> <?php echo $member['designation']; ?></p>
    <p><strong>Created At:</strong> <?php echo date('F d (l), Y', strtotime($member['created_at'])); ?></p>
    <?php if($member['approved'] == 1){ echo $member['details']; ?>
    <a class="btn btn-warning btn-sm" href="<?php echo route('admin/members/edit', ['id' => $member['id']]) ?>"><i class="fas fa-edit pr-2"></i>Edit Person</a>
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#donation_modal"><i class="fas fa-plus pr-2"></i>Add Donation</button>
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">#</th>
          <th class="th-sm">Project Name</th>
          <th class="th-sm">Donation</th>
          <th class="th-sm">Donation Date</th>
          <th class="th-sm">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $total_donation = 0; foreach ($donations as $donation) { ?>
          <tr>
            <td class="font-weight-bold"><?php echo $donation['id']; ?></td>
            <td><?php echo $donation['project_name']; ?></td>
            <td><?php echo $donation['donation']; ?></td>
            <td><?php echo date('F d (l), Y', strtotime($donation['donation_date'])); ?></td>
            <td>
              <form method="post" action="<?php echo route('admin/members/donations/delete') ?>" onsubmit="return confirm('Do you really want to delete this donation?');">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" value="<?php echo $donation['id']; ?>" name="id">
                <input type="hidden" value="<?php echo $donation['member_id']; ?>" name="member_id">
                <a class="btn btn-primary btn-sm" href="<?php echo route('admin/projects/show', ['id' => $donation['project_id']]) ?>" title="View Project"><i class="fas fa-eye"></i></a>
                <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php $total_donation += $donation['donation']; } ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="th-sm">#</th>
          <th class="th-sm">Project Name</th>
          <th class="th-sm">Donation</th>
          <th class="th-sm">Donation Date</th>
          <th class="th-sm">Actions</th>
        </tr>
      </tfoot>
    </table>
    <h5 class="my-3">Total: <?php echo $total_donation; ?>/=</h5>
    <?php 
      } 
      else{ 
        $member_detail = '';
        $details_arr = json_decode($member['details'], true);
        foreach ($details_arr as $key => $value) {
          $member_detail .= '<p><strong>'.$key.':</strong> '.$value.'</p>';
        }
        echo $member_detail; 
    ?>
        <span class="badge badge-danger">Not Approved</span>
        <form method="post" action="<?php echo route('admin/members/approve') ?>" onsubmit="return confirm('Are you sure you want to approve requested volunteer?');">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input type="hidden" value="<?php echo $member['id']; ?>" name="id">
          <input type="hidden" value="<?php echo $member['name']; ?>" name="name">
          <input type="hidden" value="<?php echo $details_arr['email']; ?>" name="email">
          <input type="hidden" value="<?php echo $member_detail; ?>" name="details">
          <button class="btn btn-warning btn-sm" type="submit"><i class="fas fa-check pr-2"></i>Approve Volunteer</button>
        </form>
        <form method="post" action="<?php echo route('admin/members/delete') ?>" onsubmit="return confirm('Do you really want to delete requesting volunteer?');">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input type="hidden" value="<?php echo $member['id']; ?>" name="id">
          <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash pr-2"></i>Delete Volunteer</button>
        </form>
    <?php } ?>
  </div>
</div>

<a class="btn btn-primary btn-sm my-3" href="<?php echo route('admin/members/all') ?>"><i class="fas fa-arrow-left pr-2"></i>Go back</a>

<!-- Donation Modal -->
<div class="modal fade right" id="donation_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Add Donation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo route('admin/members/donations/add'); ?>"> 

          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

          <input type="hidden" name="member_id" value="<?php echo $member['id']; ?>">

          <div class="form-label-group my-3">
            <label>Select Project</label>
            <select name="project_id" class="browser-default custom-select mb-4">
              <?php foreach ($projects as $project) { ?>
              <option value="<?php echo $project['id'] ?>" selected><?php echo $project['name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-label-group my-3">
            <label>Donation Amount</label>
            <input type="number" name="donation" class="form-control" step="0.01" required>
          </div>

          <div class="form-label-group my-3">
            <label>Donation Date</label>
            <input type="date" name="donation_date" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary mr-5">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- #END# Donation Modal -->

<?php endblock() ?>