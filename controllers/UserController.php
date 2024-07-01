<?php

include 'models/User.php';
class UserController {

    protected mysqli $database;
    protected array $config;

    protected array $request;
    public function __construct(array $request, mysqli $db, array $config) {
        $this->database = $db;
        $this->config = $config;
        $this->request = $request;
    }

    public function process() : void {

        if (isset($this->request['action'])) {
            switch($this->request['action']) {
                case 'list':
                    $data = $this->getUsers();
                    $template_file = 'views/user.html.php';
                    $this->render($template_file, $data);
                    break;
                case 'delete':
                    $this->deleteUser($this->request['id']);
                    break;
                case 'add':
                    $this->addUser();
                    break;
                case 'add_form':
                    $template_file = 'views/user_form.html.php';
                    $this->render($template_file);
                    break;
            }
        } else {
            $data = $this->getUsers();
            $template_file = 'views/user.html.php';
            $this->render($template_file, $data);
        }
    }

    protected function deleteUser($id) : void {
        $user = new User($this->database);
        $user->deleteById($id);
    }

    protected function render(string $templateFile, array $data = []) : void {
        include $templateFile;
    }

    protected function addUser() : User {

        $user = new User($this->database);

        $user->setUserName('fkaufusi');
        $user->setUrl('https://www.google.com');
        $user->setEmail('fkaufusi@gmail.com');
        $user->setPhoneNumber('04382772');
        $user->setBirthDate('1951-09-21');
        $user->setPassword('testpassword');
        $user->save();

        return $user;
    }

    protected function getUsers() : array {
        $user = new User($this->database);
        return $user->getAll();
    }
}