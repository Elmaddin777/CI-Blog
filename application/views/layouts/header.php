<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">ciBlog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
    
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if($this->uri->segment(1) == ''){ echo 'active'; } ?>">
          <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) == 'about'){ echo 'active'; } ?>">
          <a class="nav-link"  href="<?php echo base_url(); ?>about">About</a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) == 'posts'){ echo 'active'; } ?>">
          <a class="nav-link"  href="<?php echo base_url(); ?>posts">Blog</a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) == 'categories'){ echo 'active'; } ?>">
          <a class="nav-link"  href="<?php echo base_url(); ?>categories">Category</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto">
      <?php if ($this->session->userdata('logged_in')): ?>
          <li class="nav-item <?php if($this->uri->segment(1) == 'posts' && $this->uri->segment(2) == 'create'){ echo 'active'; } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>posts/create">Create Post</a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(1) == 'categories' && $this->uri->segment(2) == 'create'){ echo 'active'; } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>categories/create">Create Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
          </li>
          <?php else: ?>
            <li class="nav-item <?php if($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'register'){ echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'login'){ echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
            </li>
        <?php endif; ?>
      </ul>
      
     <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form> 
    </div>
  </nav>
  <div class="container mt-4">
    
    
    