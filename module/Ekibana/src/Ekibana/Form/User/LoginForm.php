<?php
// module/Ekibana/src/Ekibana/Form/User/LoginForm.php:
namespace Ekibana\Form\User;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');
        $this->setAttribute('class', 'form-inline');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'input-small',
                'placeholder' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'input-small',
                'placeholder' => 'Password'
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Log In',
                'id' => 'submitbutton',
                'class' => 'btn',
            ),
        ));
        $this->add(array(
            'name' => 'signup',
            'attributes' => array(
                'type'  => 'button',
                'id' => 'signup',
                'class' => 'btn btn-primary',
            ),
            'options' => array(
                'label' => 'Sign Up',
            ),
        ));
    }
}