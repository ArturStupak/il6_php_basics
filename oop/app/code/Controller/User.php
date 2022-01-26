<?php
 namespace Controller;
 use \Helper\FormHelper;
class User
{
    public function show($id){
        echo 'Catalog controller ID '.$id;
    }

    public function login()
    {
        $form = new FormHelper( '*', 'POST');
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);$form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '******'
        ]);$form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'login'
        ]);

        echo $form -> getForm();
    }

    public function register()
    {
        $form = new FormHelper( '*', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas'
        ]);$form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);$form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '******'
        ]);$form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => '******2'
        ]);$form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);

        echo $form -> getForm();
    }
}