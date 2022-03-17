<?php
declare(strict_types=1);


namespace Core;
use Helper\Url;
use Model\Messages;
use Model\User;

class AbstractController
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['title'] = 'autopliusas';
        $this->data['meta_description'] = '';
        if($this->isUserLoged()){
            $this->data['count'] = Messages::getUnreadMessageCount();
        }
    }


    protected function render(string $template): void
    {
        include_once PROJECT_ROOT_DIR. '/app/design/parts/header.php';
        include_once PROJECT_ROOT_DIR. '/app/design/' . $template. '.php';
        include_once PROJECT_ROOT_DIR. '/app/design/parts/footer.php';

    }

    protected function renderAdmin(string $template): void
    {
        include_once PROJECT_ROOT_DIR. '/app/design/admin/parts/header.php';
        include_once PROJECT_ROOT_DIR. '/app/design/admin/' . $template. '.php';
        include_once PROJECT_ROOT_DIR. '/app/design/admin/parts/footer.php';
    }

    protected function isUserLoged(): bool
    {
        return isset($_SESSION['user_id']);
    }

    protected function isUserAdmin(): bool
    {
        if($this->isUserLoged()) {
            $user = new User();
            $user->load($_SESSION['user_id']);
            if ($user->getRoleId() == 1) {
                return true;
            }

        }
        return false;
    }


    public function url(string $path, string $param = null): string
    {
        return Url::link($path, $param);
    }


}