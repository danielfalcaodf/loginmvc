<?php

namespace Source\Controllers;

use Source\Models\User;
use stdClass;

/**
 * [Description Web]
 */
class Web extends Controller
{
    /**
     * @param mixed $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
        if (!empty($_SESSION["user"])) {
            $this->router->redirect("app.home");
        }
    }
    /**
     * @return void
     */
    public function login(): void
    {
        $head = $this->seo->optimize(
            "Faça seu login para continuar | " . site("name"),
            site("desc"),
            $this->router->route("web.login"),
            routeImage("Login"),
        )->render();
        echo $this->view->render("theme/login", [
            "head" => $head
        ]);
    }
    /**
     * @return void
     */
    public function register(): void
    {

        $head = $this->seo->optimize(
            "Crie sua conta no " . site("name"),
            site("desc"),
            $this->router->route("web.register"),
            routeImage("Register"),
        )->render();
        $form_user =  new \stdClass();
        $form_user->first_name = "";
        $form_user->last_name = "";
        $form_user->email = "";
        echo $this->view->render("theme/register", [
            "head" => $head,
            "user" => $form_user
        ]);
    }
    /**
     * @return void
     */
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recupere Sua Senha |" . site("name"),
            site("desc"),
            $this->router->route("web.forget"),
            routeImage("Forget"),
        )->render();
        echo $this->view->render("theme/forget", [
            "head" => $head
        ]);
    }
    /**
     * @param mixed $data
     * 
     * @return void
     */
    public function reset($data): void
    {

        if (empty($_SESSION["forget"])) {
            flash("info", "Informe seu E-mail para receuperar a senha");
            $this->router->redirect("web.forget");
            # code...
        }
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data['forget'], FILTER_DEFAULT);
        $errForget = "Não foi possivel recuperar, tente novomente";
        if (!$email || !$forget) {
            flash("error", $errForget);
            $this->router->redirect("web.forget");
        }


        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();
        if (!$user) {
            flash("error", $errForget);
            $this->router->redirect("web.forget");
        }

        $head = $this->seo->optimize(
            "Cria a sua nova Senha |" . site("name"),
            site("desc"),
            $this->router->route("web.reset"),
            routeImage("Reset"),
        )->render();
        echo $this->view->render("theme/reset", [
            "head" => $head
        ]);
    }
    /**
     * @param mixed $data
     * 
     * @return void
     */
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
        $head = $this->seo->optimize(
            "ooooppss {$error} |" . site("name"),
            site("desc"),
            $this->router->route("web.error", ["errcode" => $error]),
            routeImage($error),
        )->render();
        echo $this->view->render("theme/error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}