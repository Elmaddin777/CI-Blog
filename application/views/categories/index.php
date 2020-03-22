<h2 class="mb-4"><?=$title?></h2>
<?php if ($this->session->flashdata('cat_success')): ?>
  <div class="alert alert-success" role="alert">
    <?php echo  $this->session->flashdata('cat_success'); ?>  
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('cat_fail')): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo  $this->session->flashdata('cat_fail'); ?>  
  </div>
<?php endif; ?>
<ul class="list-group list-group-flush">
  <?php foreach ($cats as $cat): ?>
    <li class="list-group-item">
      <a href="categories/<?php echo $cat->cat_slug; ?>">
        <?php echo $cat->cat_name ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>