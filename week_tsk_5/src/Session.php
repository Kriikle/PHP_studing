<?php

namespace Core;

use App\Model\Auth;
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
        $auth = Auth::Create([
            'session' => $session,
            'user_id' => $userId
        ]);
        $auth->save();
    }

    public function getUser(): ?User
    {

        if (isset($_SESSION['isAuth'])) {

            if ($_SESSION['isAuth']) {
                $session = session_id();
                $auth = auth::where('session','like',$session)->first();

                if ($auth == NULL) {

                    return null;
                }
                $user_id = $auth->user_id;
                //var_dump(User::find($user_id)->first());
                return User::find($user_id);
            }
        } else {
            $_SESSION['isAuth'] = false;
        }

        return null;
    }

    public function logout(): void
    {
        $session = session_id();
        auth::where('session',$session)->delete();
        $_SESSION['isAuth'] = false;
    }
}