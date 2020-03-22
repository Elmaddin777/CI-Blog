<h2>Edit Post</h2> 

<?php if ($this->session->flashdata('update_fail')): ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('update_fail'); ?>
  </div>
<?php endif; ?>
  
<?php echo form_open_multipart('posts/edit/'.$post->slug) ?>
  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" value="<?php echo $post->title; ?>" name="title" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="cat">
      <?php foreach ($categories as $cat): ?>
        <option value="<?php echo $cat->cat_id; ?>" <?php if($cat->cat_id == $post->category_id) echo 'selected' ?> > <?php echo $cat->cat_name; ?> </option>
      <?php endforeach; ?>
    </select>
  </div>
  Image: <br>
  <?php if ($post->img == 'noimage.jpg'): ?>
    <img src="<?php echo base_url('assets/img/noimage.jpg') ?>"  width="20%" alt="">
  <?php else: ?>
    <img src="<?php echo base_url('assets/img/'.$post->img) ?>" width="20%" alt="">
  <?php endif; ?><br><br>
  <div class="form-group">
    <input type="file" name="img" value="" size="20">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Body</label>
    <textarea id="editor1" class="form-control" name="body" rows="5" required><?php echo $post->body; ?></textarea>
  </div>

   <button type="submit" class="btn btn-primary">Update</button>
</form>
<hr>










