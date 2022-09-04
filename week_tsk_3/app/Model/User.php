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
    private string $email;


    public function __construct(
        string $email,
        string $login,
        string $password,
        string $city,
        int $id = -1
    ) {
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
        $this->city = $city;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
        $insertQuery = 'INSERT INTO `users` (`email`,`login`, `password`, `city`) VALUES (?,?,?,?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$this->email,$this->login,self::setPasswordSha($this->password),$this->city);
        $this->id = ($db->lastInsertId());
    }

    public function update(): void
    {
        $updateQuery = "UPDATE `users` SET `login` = ?, `password` = ?, `city` = ? WHERE `users`.`User_id` = $this->id";
        $db = Db::getInstance();
        $db->executeQuery($updateQuery,$this->login,self::setPasswordSha($this->password),$this->city);
    }

    public function setPasswordSha(string $password): string
    {
        return password_hash($password,PASSWORD_DEFAULT );
    }

    public static function getAll()
    {
        $selectQuery = 'Select * from users';
        $db = Db::getInstance();
        $result = $db->executeSelectQuery($selectQuery);
        print_r($result);
    }

    public function getOne()
    {

    }
    public static function getById(int $id): ?User
    {
        $db = Db::getInstance();
        $data = $db->executeSelectQuery(
            "SELECT * fROM `users` WHERE `user_id` = '$id'",
            true
        );

        if (!$data) {

            return null;
        }

        $user = new self($data['email'],$data['login'],$data['password'],$data['city']);
        $user->id = $data['user_id'];
        $user->dateCreated = $data['date_created'];

        return $user;
    }

    public static function getByEmail(string $email): ?User
    {
        $db = Db::getInstance();
        $data = $db->executeSelectQuery(
            "SELECT * fROM `users` WHERE `email` like '$email'",
            true
        );

        if (!$data) {

            return null;
        }
        //var_dump($data);
        $user = new self($data['email'],$data['login'],$data['password'],$data['city']);
        $user->id = $data['user_id'];
        $user->dateCreated = $data['date_created'];

        return $user;
    }
}