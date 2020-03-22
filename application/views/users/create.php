<h2><?= $title; ?></h2>

<?php if ($this->session->flashdata('register_errors')): ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('register_errors'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('register_fail')): ?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata('register_fail'); ?>
  </div>
<?php endif; ?>

<?php echo form_open('users/register') ?>

  <div class="form-row">
    <div class="form-group col-md-7">
      <label for="inputAddress">Fullname</label>
      <input type="text" class="form-control" id="inputAddress" name="fullname" placeholder="fullname.." required>
    </div>
    <div class="form-group col-md-5">
      <label for="inputPassword4">Username</label>
      <input type="text" class="form-control" id="inputPassword4" name="username"  placeholder="username.." required>
    </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="inputCity">Email</label>
      <input type="email" class="form-control" name="email" id="inputCity" placeholder="email.." required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" name="zip" id="inputZip" placeholder="zip..">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Password</label>
      <input type="password" class="form-control" id="inputEmail4" name="password" placeholder="password.." required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password_2"  placeholder="confirm password.." required>
    </div>
  </div>

  <button type="submit" class="btn btn-success">Sign in</button>
</form>