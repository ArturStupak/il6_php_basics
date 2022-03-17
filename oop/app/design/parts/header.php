<html>
    <head>
        <title><?= $this->data['title'] ?></title>
        <meta name="description" content="<?= $this->data['meta_description']?>">
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css';?>">
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/admin.css';?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
<body>
<header>
    <div class="navbar">
        <a href="<?php echo $this->Url('') ?>"><i class="fa fa-fw fa-home"></i>Home page</a>
        <a href="<?php echo $this->Url('catalog') ?>">All ads</a>
    <?php  if($this->isUserLoged()):?>
        <a href="<?php echo $this->Url('/catalog/add') ?>">Add New</a>
        <a class="notification" href="<?php echo $this->Url('message') ?>">
            <span><i class="fa fa-fw fa-envelope"></i>All messages</span>
            <span class="badge"><?php echo $this->data['count']?></span>
        </a>
        <a href="<?php echo $this->Url('catalog/showFavoriteAds') ?>">Favorites</a>
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

