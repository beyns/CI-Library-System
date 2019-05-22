<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<?php $this->load->view('template/include_head.php') ?>
	
</head>
<body>

<main class="app-main">
        <div class="wrapper">
          <div id="notfound-state" class="empty-state">
            <div class="empty-state-container">
              <div class="state-figure">
                <img class="img-fluid" src="assets/images/illustration/img-7.svg" alt="" style="max-width: 300px">
              </div>
              <h3 class="state-header"> Library System</h3>
              <p class="state-description lead text-muted"> Use the button below to add your awesomething, aperiam ex veniam suscipit porro ab saepe nobis odio. </p>
              <div class="state-action">
                <a href="<?php echo base_url('auth/signup') ?>" class="btn btn-primary">Login</a>
              </div>
         
            </div>
          </div> 
        </div>
      </main>
<?php $this->load->view('template/include_footer.php') ?>

</body>
</html>