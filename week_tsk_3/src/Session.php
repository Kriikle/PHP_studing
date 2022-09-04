<?php

namespace Core;

use App\Model\User;

class Session
{
    public function init($lifeTime = 86400): void
    {
        session_start([
            'cookie_lifetime' => $lifeTime,
        ]);
    }

    public function authUser(string $session,int $userId): void
    {
        $_SESSION['isAuth'] = true;
        $insertQuery = 'INSERT INTO `auth` ( `session`, `user_id`) VALUES (?, ?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$session,$userId);
    }

    public function getUser(): ?User
    {

        if (isset($_SESSION['isAuth'])) {

            if ($_SESSION['isAuth']) {
                $session = session_id();
                $db = Db::getInstance();
                $selectQuery = "SELECT user_id FROM `auth` WHERE `session` like '$session';";
                $data = $db->executeSelectQuery($selectQuery, true);

                if (!$data) {

                    return null;
                }
                $user_id = $data['user_id'];

                return User::getById($user_id);
            }
        } else {
            $_SESSION['isAuth'] = false;
        }

        return null;
    }

    public function logout(): void
    {
        $session = session_id();
        $db = Db::getInstance();
        $db->executeQuery("DELETE FROM auth WHERE `auth`.`session` like ?",$session);
        $_SESSION['isAuth'] = false;
    }
}