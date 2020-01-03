<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Jabatan;

class KaryawanForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('jabatan_id', 'select', [
                'label' => 'Jabatan',
                'choices' => Jabatan::pluck('nama', 'id')->toArray(),
                'empty_value' => ' ',
                'attr' => ['required' => true]
            ])
            ->add('nama', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('gaji', 'text', [
                'attr' => ['required' => false, 'id' => 'gaji']
            ])
            ->add('email', 'email', [
                'attr' => ['required' => false]
            ])
            ->add('alamat', 'text', [
                'attr' => ['required' => false]
            ])
            ->add('phone', 'text', [
                'label' => 'Nomor Telefon',
                'attr' => ['required' => false]
            ]);
    }
}
