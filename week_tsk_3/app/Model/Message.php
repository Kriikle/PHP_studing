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
    private ?string $image;

    /**
     * @param int $idUser
     * @param string $name
     * @param string $text
     */
    public function __construct(int $idUser, string $name, string $text, ?string $image = NULL)
    {
        $this->idUser = $idUser;
        $this->name = $name;
        $this->text = $text;
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->Date_created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
        $insertQuery = 'INSERT INTO `Message` (`user_id`, `name`, `text`, `image`) VALUES (?,?,?,?);';
        $db = Db::getInstance();
        $db->executeQuery($insertQuery,$this->idUser,$this->name,$this->text,$this->image);
        $this->setId($db->lastInsertId());
    }

    public static function getAll(): ?array
    {
        $selectQuery = 'Select * from message';
        $db = Db::getInstance();
        $data = $db->executeSelectQuery($selectQuery);
        $messages = [];

        if ($data == null){

            return null;
        }

        foreach ($data as $elem) {
            $message = new self($elem['user_id'], $elem['name'], $elem['text'],$elem['image']);
            $message->Date_created = $elem['date_created'];
            $message->id = $elem['message_id'];
            $messages[] = $message;
        }

        return $messages;
    }

    public static function deleteMsg(int $id)
    {
        $db = Db::getInstance();
        $db->executeQuery("DELETE FROM message WHERE `message_id` like ?",$id);
    }

    public function getOne()
    {
        // TODO: Implement getOne() method.
    }
}