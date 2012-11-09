<?php
namespace Ekibana\Model;

use PHPUnit_Framework_TestCase;
use Zend\Db\ResultSet\ResultSet;


class UserTableTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        \Zend\Mvc\Application::init(include 'config/application.config.php');
    }
    public function testFetchAllReturnsAllUsers()
    {
        $resultSet = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with()
            ->will($this->returnValue($resultSet));

        $userTable = new UserTable($mockTableGateway);

        $this->assertSame($resultSet, $userTable->fetchAll());
    }
    public function testCanRetrieveAnUserByItsId()
    {
        $user = new User();
        $user->exchangeArray(array('id'     => 123,
                                    'login' => 'login',
                                    'password'  => 'password'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $resultSet->initialize(array($user));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $albumTable = new UserTable($mockTableGateway);

        $this->assertSame($user, $albumTable->getUser(123));
    }
    public function testSaveUserWillInsertNewUserIfTheyDontAlreadyHaveAnId()
    {
        $userData = array('login' => 'test', 'password' => '123123qa');
        $user = new User();
        $user->exchangeArray($userData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('insert')
            ->with($userData);

        $userTable = new UserTable($mockTableGateway);
        $userTable->saveUser($user);
    }
    public function testSaveUserWillUpdateExistingAlbumsIfTheyAlreadyHaveAnId()
    {
        $userData = array('id' => 123, 'login' => 'testLogin', 'password' => '123123qa');
        $user = new User();
        $user->exchangeArray($userData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $resultSet->initialize(array($user));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('update')
            ->with(array('login' => 'testLogin', 'password' => '123123qa'),
            array('id' => 123));

        $albumTable = new UserTable($mockTableGateway);
        $albumTable->saveUser($user);
    }

    public function testExceptionIsThrownWhenGettingNonexistentUser()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $userTable = new UserTable($mockTableGateway);

        try
        {
            $userTable->getUser(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}
