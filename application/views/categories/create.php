<h2><?= $title ?></h2>
<?php if (validation_errors()): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>  
  </div>
<?php endif; ?>
<?php echo form_open_multipart('categories/create'); ?>
  
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" name="name" class="form-control"  placeholder="Category name" required>
  </div>
  
   <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr>