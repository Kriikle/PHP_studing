<?php

namespace App\Controller;

use App\Model\User;
use Core\RedirectException;
use Core\Session;
use Core\View;

Abstract class AbstractController
{
    /** @var View */
    protected View $view;
    /** @var Session */
    protected Session $session;

    public function setView(View $view): void
    {
        $this->view = $view;
    }


    public function getUser(): ?User
    {
        $user = $this->session->getUser();
        if (!$user) {
            return null;
        }


        return $user;
    }


    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    /**
     * @throws RedirectException
     */
    public function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function preDispatch(): void
    {

    }
}