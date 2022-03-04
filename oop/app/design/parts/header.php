<html>
    <head>
        <title><?= $this->data['title'] ?></title>
        <meta name="description" content="<?= $this->data['meta_description']?>">
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css';?>">
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/admin.css';?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
<header>
    <div class="navbar">
        <a href="<?php echo $this->Url('') ?>"><i class="fa fa-fw fa-home"></i>Home page</a>
        <a href="<?php echo $this->Url('catalog') ?>">All ads</a>
    <?php  if($this->isUserLoged()):?>
        <a href="<?php echo $this->Url('/catalog/add') ?>">Add New</a>
        <a href="<?php echo $this->Url('/message/message') ?>"><i class="fa fa-fw fa-envelope"></i>Chat</a>
        <a class="notification" href="<?php echo $this->Url('message') ?>">
            <span>All messages</span>
            <span class="badge"><?php echo $this->data['count']?></span>
        </a>
        <a href="<?php echo $this->Url('/user/logout') ?>">Logout</a>
        <?php else: ?>
        <a href="<?php echo $this->Url('/user/login') ?>"><i class="fa fa-fw fa-user"></i>Login</a>
        <a href="<?php echo $this->Url('/user/register') ?>">Sign Up</a>
        <?php endif; ?>
        <?php if($this->isUserAdmin()): ?>
        <a href="<?php echo $this->Url('admin') ?>">Admin</a>
        <?php endif; ?>
    </div>
</header>

