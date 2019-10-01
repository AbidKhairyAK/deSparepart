<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Role;

class PenggunaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('username', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('email', 'email', [
                'attr' => ['required' => true]
            ])
            ->add('password', 'password', [
            	'wrapper' => ['class' => 'form-group col-sm-6'],
                'value' => null,
            ])
            ->add('password_confirmation', 'password', [
            	'label' => 'Ulangi Password',
            	'wrapper' => ['class' => 'form-group col-sm-6'],
            ])
            ->add('role_id', 'select', [
            	'label' => 'Role',
			    'choices' => Role::pluck('name', 'id')->toArray(),
			    'empty_value' => ' ',
                'attr' => ['required' => true]
			]);
    }
}
