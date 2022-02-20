<html>
    <head>
        <title><?= $this->data['title'] ?></title>
        <meta name="description" content="<?= $this->data['meta_description']?>">
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css';?>">
    </head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="<?php echo $this->Url('') ?>">Home page</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url('catalog') ?>">All ads</a>
                </li>
                <?php  if($this->isUserLoged()):?>
                <li>
                    <a href="<?php echo $this->Url('/catalog/add') ?>">Add New</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url('/user/logout') ?>">Logout</a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo $this->Url('/user/login') ?>">Login</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url('/user/register') ?>">Sign Up</a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="search">

            </div>
        </nav>
    </header>

