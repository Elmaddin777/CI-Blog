<h2>Create Post</h2> 

<?php if (validation_errors()): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>  
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('post_fail')): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $this->session->flashdata('post_fail'); ?>
  </div>
<?php endif; ?>

<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" name="title" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="cat">
      <?php foreach ($categories as $cat): ?>
        <option value="<?php echo $cat->cat_id; ?>" ><?php echo $cat->cat_name; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="img">Image</label><br>
    <input type="file" name="img" value="" size="20">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Body</label>
    <textarea id="editor1" class="form-control" name="body" rows="5" required></textarea>
  </div>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr>










