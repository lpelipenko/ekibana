<?php
// module/Ekibana/src/Ekibana/Model/UserTest.php:
namespace Ekibana\Model;

use PHPUnit_Framework_TestCase;

class UserTest extends PHPUnit_Framework_TestCase
{
    // Are all of the Album’s properties initially set to NULL?
    public function testUserInitialState()
    {
        $user = new User();
        $this->assertNull($user->id, '"id" should initially be null');
        $this->assertNull($user->login, '"login" should initially be null');
        $this->assertNull($user->password, '"password" should initially be null');
    }

    //Will the Album’s properties be set correctly when we call exchangeArray()?
    public function  testExchangeArraySetsPropertiesCorrectly()
    {
        $user = new User();
        $data = array('id'       => 2,
                      'login'    => 'testLogin',
                      'password' => 'password');
        $user->exchangeArray($data);

        $this->assertSame($data['id'], $user->id, '"id" was not set correctly');
        $this->assertSame($data['login'], $user->login, '"login" was not set correctly');
        $this->assertSame($data['password'], $user->password, '"login" was not set correctly');
    }
     //Will a default value of NULL be used for properties whose keys are not present in the $data array?
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $user = new User();
        $user->exchangeArray(array('id'       => 1,
                                   'login'    => 'login',
                                   'password' => 'password'));
        $user->exchangeArray(array());
        $this->assertNull($user->id, '"id" should have defaulted to null');
        $this->assertNull($user->login, '"login" should have defaulted to null');
        $this->assertNull($user->password, '"password" should have defaulted to null');
    }

    protected function setUp()
    {
        \Zend\Mvc\Application::init(include './config/application.config.php');
    }
}
