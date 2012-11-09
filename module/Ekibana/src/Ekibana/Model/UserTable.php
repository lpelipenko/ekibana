<?php
// module/Album/src/Album/Mode/AlbumTable.php

namespace Ekibana\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
    protected $tableGateway;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getUser($id)
    {
        $row = $this->tableGateway->select(array('id' => (int)$id))->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'login'     => $user->login,
            'password'  => $user->password,
        );

        $id = (int)$user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            return $this->tableGateway->update($data, array('id' => $id));
        }
    }

}
