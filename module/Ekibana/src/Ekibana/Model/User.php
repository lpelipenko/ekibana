<?php
// module/Ekibana/src/Ekibana/Model/User.php:
namespace Ekibana\Model;

class User
{
    public $id;
    public $login;
    public $password;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->login = (isset($data['login'])) ? $data['login'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
    }
}
