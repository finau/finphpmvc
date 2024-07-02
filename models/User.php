<?php

include "models/EntityInterface.php";

/**
 * The user model class that handle database tasks
 * We implement the interface EntityInterface
 *
 * Note: the way we handle XSS, SQL Injection we pass the request variables to the database prepare statement
 *  to sanitize the data before use on database queries.
 */
class User implements EntityInterface {

    protected int $id;
    protected string $userName;
    protected string $email;
    protected string $password;
    protected string $birthDate;
    protected string $phoneNumber;
    protected string $url;

    private mysqli $database;

    public function __construct(mysqli $database) {
       $this->database = $database;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getUserName() : string {
        return $this->userName;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getPhoneNumber() : string {
        return $this->phoneNumber;
    }

    public function getBirthDate() : string {
        return $this->birthDate;
    }

    public function getUrl() : string {
        return $this->url;
    }

    public function setUserName(string $username) : void {
        $this->userName = $username;
    }

    public function setEmail(string $email) : void {
        $this->email = $email;
    }

    public function setPassword(string $password) : void {
        $this->password = $password;
    }

    public function setBirthDate(string $birthDate) : void {
        $this->birthDate = $birthDate;
    }


    public function setPhoneNumber(string $phoneNumber) : void {
        $this->phoneNumber = $phoneNumber;
    }

    public function setUrl(string $url) : void {
        $this->url = $url;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }


    public function getAll() : array {
        $query = $this->database->query('SELECT * FROM users');
        $users = [];
        while ($row = $query->fetch_assoc()) {
            $users[] = $this->prepareUser($row);
        }

        $query->free_result();
        return $users;
    }

    private function prepareUser($row) : User {
        $user = new $this($this->database);
        $user->setId($row['id']);
        $user->setUserName($row['user_name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setBirthDate($row['birth_date']);
        $user->setPhoneNumber($row['phone_number']);
        $user->setUrl($row['url']);

        return $user;
    }

    public function getById(int $id) : User {

        $stm = $this->database->prepare('SELECT * FROM users WHERE id = ?');
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();
        $row = $result->fetch_assoc();
        $stm->close();
        $result->free_result();

        return $this->prepareUser($row);
    }

    public function delete() : void {
        $stm = $this->database->prepare('DELETE FROM users WHERE id = ?');
        $stm->bind_param("i", $this->id);
        $stm->execute();
        $stm->close();
    }

    public function deleteById(int $id) : void {
        $stm = $this->database->prepare('DELETE FROM users WHERE id = ?');
        $stm->bind_param("i", $id);
        $stm->execute();
        $stm->close();
    }

    public function save() : void {
        $query = ' INSERT INTO users(user_name, email, password, birth_date, phone_number, url) VALUES(?, ?, ?, ?, ?, ?)';
        $stm = $this->database->prepare($query);
        $stm->bind_param('ssssss', $this->userName, $this->email, $this->password, $this->birthDate, $this->phoneNumber, $this->url);
        $stm->execute();
        $this->id = $stm->insert_id;
        $stm->close();
    }

}