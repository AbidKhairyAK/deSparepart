<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class JabatanForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nama', 'text', [
                'label' => 'Nama Jabatan',
                'attr' => ['required' => true]
            ])
            ->add('deskripsi', 'text');
    }
}
