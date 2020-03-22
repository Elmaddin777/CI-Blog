<h2 class="mb-4"><?=$title?></h2>
	<?php if ($this->session->flashdata('login_success')): ?>
		<div class="alert alert-success" role="alert">
			<?php echo  $this->session->flashdata('login_success'); ?>  
		</div>
	<?php endif; ?>
  <?php if ($this->session->flashdata('insert_success')): ?>
    <div class="alert alert-success" role="alert">
      <?php echo  $this->session->flashdata('insert_success'); ?>  
    </div>
  <?php endif; ?>
	<?php if ($this->session->flashdata('update_success')): ?>
    <div class="alert alert-success" role="alert">
      <?php echo  $this->session->flashdata('update_success'); ?>  
    </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('delete_success')): ?>
    <div class="alert alert-success" role="alert">
      <?php echo  $this->session->flashdata('delete_success'); ?>  
    </div>
  <?php endif; ?>
	<?php if ($this->session->flashdata('update_fail')): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo  $this->session->flashdata('update_fail'); ?>  
    </div>
  <?php endif; ?>
	<?php if ($this->session->flashdata('no_posts')): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo  $this->session->flashdata('no_posts'); ?>  
			<a href="<?php echo base_url('categories') ?>">go back</a>
    </div>
  <?php endif; ?>
	

		<?php foreach($posts as $post): ?>
		
			<div class="row mb-5">
			
				<div class="col-md-4">
					<?php if ($post->img == 'noimage.jpg'): ?>
						<img src="<?php echo base_url('assets/img/noimage.jpg') ?>" width="100%" height="283px" alt="">
					<?php else: ?>
						<img src="<?php echo base_url('assets/img/'.$post->img) ?>" width="100%" height="283px" alt="">
					<?php endif; ?>
					
				</div>
				<div class="col-md-8">
				  <div class="mb-3">
				    <h3><?=$post->title; ?></h3>
				    <small class="post-date">Posted on: <?=$post->created_at; ?> in <strong><?=$post->cat_name?></strong></small> <br>
				    <?php echo word_limiter($post->body, 60); ?><br><br>
				    <a class="btn btn-primary" href="<?php echo base_url('posts/').$post->slug;   ?>">Read More</a><br><br>
				  </div>
				</div>
				
			</div>
			
		<?php endforeach; ?>
		
		<div class="pagination-links">
				<?php echo $this->pagination->create_links(); ?>
		</div>
	








