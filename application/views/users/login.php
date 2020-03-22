<?php if ($this->session->flashdata('register_success')): ?>
  <div class="alert alert-success">
    <?php echo $this->session->flashdata('register_success'); ?>
  </div>
<?php endif; ?>
<br><br>

<?php echo form_open('users/login'); ?>
  <div class="form-signin" style="width:30%; margin:0 auto; text-align:center;">
    <h1 class="h3 mb-3 font-weight-normal" ><?= $title; ?></h1>
    <?php if ($this->session->flashdata('login_fail')): ?>
      <div class="alert alert-danger">
        <?php echo $this->session->flashdata('login_fail'); ?>
      </div>
    <?php endif; ?>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus><br>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </div>
</form>
