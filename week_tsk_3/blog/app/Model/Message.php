<?php

namespace App\Model;

use Core\Db;

class Message extends AbstractModel
{
    private int  $id;
    private int $idUser;
    private string $Date_created;
    private string $name;
    private string $text;

    /**
     * @param int $idUser
     * @param string $name
     * @param string $text
     */
    public function __construct(int $idUser, string $name, string $text)
    {
        $this->idUser = $idUser;
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }


    public function update(): void
    {
        $updateQuery = "UPDATE `message` SET `name` = ?, `text` = ? WHERE `Message`.`Message_id` = $this->id";
        $db = Db::getInstance();
        $db->executeQuery($updateQuery,$this->name,$this->text);
    }

    public function save(): void
    {
        $insertQuery = 'INSERT INTO `Message` (`user_id`, `name`, `text`) VALUES (?,?,?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$this->idUser,$this->name,$this->text);
        $this->setId($db->lastInsertId());
    }

    public function getAll()
    {
        $selectQuery = 'Select * from blog';
        $db = Db::getInstance();
        $result = $db->executeSelectQuery($selectQuery);
        print_r($result);
    }

    public function getOne()
    {
        // TODO: Implement getOne() method.
    }
}