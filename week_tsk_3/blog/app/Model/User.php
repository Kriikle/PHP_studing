<?php

namespace App\Model;

use Core\Db;

class User extends AbstractModel
{
    private int $id;
    private string $login;
    private string $password;
    private string $dateCreated;
    private string $city;

    public function __construct(
        string $login,
        string $password,
        string $city,
        int $id = -1
    ) {
        $this->login = $login;
        $this->password = $password;
        $this->dateCreated = date(time());
        $this->city = $city;
        $this->id = -1;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     */
    public function setDateCreated(string $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function save(): void
    {
        $insertQuery = 'INSERT INTO `users` (`Login`, `Pasword`, `City`) VALUES (?,?,?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$this->login,$this->password,$this->city);
        $this->setId($db->lastInsertId());
    }

    public function update(): void
    {
        $updateQuery = "UPDATE `users` SET `Login` = ?, `Pasword` = ?, `City` = ? WHERE `users`.`User_id` = $this->id";
        $db = Db::getInstance();
        $db->executeQuery($updateQuery,$this->login,$this->password,$this->city);
    }

}