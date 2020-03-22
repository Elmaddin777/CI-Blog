<h2><?=$title?></h2>
<div class="post-body mt-5 mb-3">
  <?php if ($post->img == 'noimage.jpg'): ?>
    <img src="<?php echo base_url('assets/img/noimage.jpg') ?>"  width="100%" height="600px" alt="">
  <?php else: ?>
    <img src="<?php echo base_url('assets/img/'.$post->img) ?>" width="100%"  height="600px" alt="">
  <?php endif; ?>
  <br><br>
  <small class="post-date">Posted on: <?=$post->created_at; ?> in <strong><?=$post->cat_name?></strong>  </small>
  <?=$post->body?>
</div>

<?php if ($this->session->userdata('user_id') == $post->user_id): ?>
  <a class="btn btn-primary float-left mr-2" href="/posts/edit/<?php echo $post->slug;?>">Edit</a>

  <?php echo form_open('posts/delete/'.$post->id) ?>
    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
  </form>
  <br><br>
<?php endif ; ?>








<h3>Comments</h3>
<?php if ($this->session->flashdata('comment_success')): ?>
  <div class="alert alert-success">
    <?php echo $this->session->flashdata('comment_success'); ?>
  </div>
<?php endif; ?>
<br><br>
<div class="jumbotron">
  <div class="container">
  <?php if ($comments): ?>
    <?php foreach ($comments as $comment): ?>
      <?php echo $comment->comment_body; ?> by <strong><?php echo $comment->comment_name; ?></strong><br><br><hr>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No comments</p>
  <?php endif; ?>
</div>
</div>
<br><br>
<h3>Share Your Thoughts About this Post</h3>
<br><br>
<?php if ($this->session->flashdata('errors')): ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('errors'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('comment_fail')): ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('comment_fail'); ?>
  </div>
<?php endif; ?>


<?php echo form_open('comments/create'); ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="inputPassword4" name="name" placeholder="Name.." required>
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email.." required>
    </div>
  </div>
  <div class="form-group">
    <label for="comment">Comment</label>
    <textarea class="form-control" id="inputAddress" name="body" rows="4" placeholder="Comment.." required></textarea>
  </div>
  <input type="hidden" name="hidden_slug" value="<?php echo $post->slug; ?>">
  <button type="submit" class="btn btn-success btn-lg btn-block">Share</button>
</form>

<br><br>












