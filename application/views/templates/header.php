<html>
    <head>
        <title>CodeIgniter Practical</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
    <body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CI-Practical</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo site_url('news'); ?>">Home</a></li>
      <li><a href="<?php echo site_url('news/create'); ?>">Add News</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
            <?php
            if ($this->session->userdata('is_logged_in')) {
                ?>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('email') ?></a></li>
                <li><a href="<?php echo site_url('user/logout'); ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <?php
            } else {
                ?>    
                <li><a href="<?php echo site_url('user/register'); ?>"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                <li><a href="<?php echo site_url('user/login'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php } ?>          
    </ul>
  </div>
</nav>
