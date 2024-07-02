<?php

include 'models/User.php';

/**
 * User controller class that handle user CRUD request
 */
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
        $baseData = [
            'user_name' => '',
            'password' => '',
            'email' => '',
            'birth_date' => '',
            'phone_number' => '',
            'url' => ''
        ];

        if (isset($this->request['action'])) {
            switch($this->request['action']) {
                case 'list':
                    $data = $this->getUsers();
                    $template_file = 'views/user.html.php';
                    $this->render($template_file, $data);
                    break;
                case 'del':
                    $this->deleteUser($this->request['id']);
                    $data['status'] = "success";
                    $data['message'] = "User has been deleted successfully";

                    $data = $this->getUsers();
                    $template_file = 'views/user.html.php';
                    $this->render($template_file, $data);
                    break;
                case 'add':
                    if (isset($this->request['user_name'])) {
                        $data = array_intersect_key($this->request, $baseData);

                        if ($this->validate($data)) {
                            $data = $baseData;
                            $user = $this->addUser();
                            $data['status'] = "success";
                            $data['message'] = "User {$user->getUserName()} has been added successfully";
                        }
                    }

                    $template_file = 'views/user_form.html.php';
                    $this->render($template_file, $data);
                    break;
                case 'add-form':
                    $template_file = 'views/user_form.html.php';
                    $this->render($template_file, $baseData);
                    break;
                case 'view':
                    $user = new User($this->database);
                    $data = [$user->getById($this->request['id'])];
                    $template_file = 'views/user.json.php';
                    $this->render($template_file, $data);
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

        $user->setUserName($this->request['user_name']);
        $user->setUrl($this->request['url']);
        $user->setEmail($this->request['email']);
        $user->setPhoneNumber($this->request['phone_number']);
        $user->setBirthDate($this->request['birth_date']);
        $user->setPassword($this->request['password']);
        $user->save();

        return $user;
    }

    protected function getUsers() : array {
        $user = new User($this->database);
        return $user->getAll();
    }


    protected function validate(&$data) : bool {
        if (!$this->isValidUsername($this->request['user_name'])) {
            $data['status'] = "error";
            $data['message'] = "Please enter valid user name";
            return false;
        }

        if (!$this->isPasswordValid($this->request['password'])) {
            $data['status'] = "error";
            $data['message'] = "Please enter valid password";
            return false;
        }

        if (!$this->isValidEmail($this->request['email'])) {
            $data['status'] = "error";
            $data['message'] = "Please enter valid email";
            return false;
        }

        if (!$this->isValidPhone($this->request['phone_number'])) {
            $data['status'] = "error";
            $data['message'] = "Please enter valid phone number";
            return false;
        }

        if (!$this->isValidUrl($this->request['url'])){
            $data['status'] = "error";
            $data['message'] = "Please enter valid URL";
            return false;
        }

        return true;
    }

    protected function isValidUrl($url) : bool {
        // check different url format
        $rule =  "/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$/";
        if (preg_match($rule, $url)) {
            return true;
        }
        return false;
    }

    protected function isValidPhone($phonenumber) : bool {
        // number only, at least 10 characters
        $rule = "/^([0-9]).{9}$/";
        if (preg_match($rule, $phonenumber)) {
            return true;
        }
        return false;
    }

    protected function isPasswordValid($password) : bool {
       //8 characters minimum, at least 1 lowercase, 1 uppercase and 1 special sign.
       $rule = "/^(?=.*[a-z])(?=.*[#$@!%&*?])(?=.*[A-Z]).{8,}$/";
       if (preg_match($rule, $password)) {
           return true;
       }
       return false;
    }

    protected function isValidUsername($username) : bool {
       //letters only
       $rule = "/^[A-z]+$/";
       if (preg_match($rule, $username)) {
           return true;
       }
       return false;
    }

    protected function isValidEmail($email) : bool {
       //valid email format
       $rule = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
       if (preg_match($rule, $email)) {
           return true;
       }
       return false;
    }
}