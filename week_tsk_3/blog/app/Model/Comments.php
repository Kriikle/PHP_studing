<?php

namespace App\Model;

use Core\Db;

class Comments extends AbstractModel
{
    public function update()
    {
        $insertQuery = 'INSERT INTO `users` (`Login`, `Pasword`, `City`) VALUES (?,?,?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$this->login,$this->password,$this->city);
        $this->setId($db->lastInsertId());
    }

    public function save()
    {
        // TODO: Implement save() method.
    }
}