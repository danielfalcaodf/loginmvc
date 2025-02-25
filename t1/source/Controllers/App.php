<?php

namespace Source\Controllers;

use Source\Models\User;

/**
 * [Description App]
 */
/**
 * App
 */
class App extends Controller
{
    /** @var User */
    protected $user;
    public function __construct($router)
    {

        parent::__construct($router);
        if (empty($_SESSION['user']) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION['user']);
            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }
    /**
     * @return void
     */
    public function home(): void
    {

        $head = $this->seo->optimize(
            "Bem-vindo(a) {$this->user->first_name} | " . site("name"),
            site("desc"),
            $this->router->route("app.home"),
            routeImage("Conta de {$this->user->first_name}"),
        )->render();
        echo $this->view->render("theme/dashboard", [
            "head" => $head,
            "user" => $this->user
        ]);
    }
    /**
     * @return void
     */
    public function logoff(): void
    {
        unset($_SESSION['user']);
        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect('web.login');
    }
}