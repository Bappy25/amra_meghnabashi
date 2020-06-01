<?php inherits('admin.app'); ?>

<?php startblock('title') ?>

<?php echo 'All Members || '.$member['name'].' || Edit Member || '.title(); ?>

<?php endblock() ?>

<?php startblock('content') ?>

<div class="card">
  <div class="card-header">Admin Dashboard</div>
  <div class="card-body">

    <h5 class="text-center my-3 text-muted"><i class="fas fa-edit pr-2"></i>Edit Member</h5>

    <form method="POST" action="<?php echo route('admin/members/update'); ?>" enctype="multipart/form-data"> 

      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

      <input type="hidden" name="id" value="<?php echo $member['id']; ?>">

      <div class="form-label-group my-3">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $member['name']; ?>" class="form-control" maxlength="50" minlength="2" required>
      </div>

      <div class="form-row">
        <div class="col-3">
          <label for="select_tag">Update Category Tag</label>
          <select class="form-control" id="select_tag">
            <option value="adviser"><?php echo locale('views', 'advisers'); ?></option>
            <option value="admin"><?php echo locale('views', 'admins'); ?></option>
            <option value="vip"><?php echo locale('views', 'vips'); ?></option>
            <option value="volunteer"><?php echo locale('views', 'volunteers'); ?></option>
            <option value="fighter"><?php echo locale('views', 'meghna_fighter'); ?></option>
            <option value="personality"><?php echo locale('views', 'personalities'); ?></option>
          </select>
        </div>
        <div class="col-9">
          <label for="tags">Update Tags</label>
          <textarea rows="1" name="tags" class="form-control" id="tags" required><?php echo $member['tags']; ?></textarea>
        </div>
        <div class="col-12">
          <small>Tags must be included to seperate <span class="red-text">adviser, admin, personality, vip and volunteer</span> category. Use comma to seperate tags!</small>
        </div>
      </div>

      <div class="form-label-group my-3">
        <label>Designation</label>
        <input type="text" name="designation" value="<?php echo $member['designation']; ?>" class="form-control">
      </div>

      <div class="input-group my-4">
        <div class="custom-file">
          <input type="hidden" name="image_path" value="<?php echo $member['image_path']; ?>">
          <input type="file" name="member_image" class="custom-file-input" id="member_image" aria-describedby="inputGroupFileAddon01">
          <label class="custom-file-label" for="member_image">Update Member Image (must be less than 1mb)</label>
        </div>
      </div>

      <div class="form-label-group my-3">
        <label>Details</label>
        <textarea name="details" class="editor"><?php echo $member['details']; ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary mr-5">Submit</button>
    </form>

  </div>
</div>

<a class="btn btn-primary btn-sm my-3" href="<?php echo route('admin/members/show', ['id' => $member['id']]) ?>"><i class="fas fa-arrow-left pr-2"></i>Go back</a>

<?php endblock() ?>