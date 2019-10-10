<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Role;

class SupplierForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nama', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('toko', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('alamat', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('kategori', 'select', [
			    'choices' => ['bengkel' => 'Bengkel', 'toko' => 'Toko', 'umum' => 'Umum'],
			    'empty_value' => ' ',
                'attr' => ['required' => true]
			]);
    }
}
