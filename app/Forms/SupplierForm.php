<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Role;

class SupplierForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('perusahaan', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('pemilik', 'text', [
                'wrapper' => ['class' => 'form-group col-sm-6'],
                'attr' => ['required' => true]
            ])
            ->add('cp', 'text', [
                'wrapper' => ['class' => 'form-group col-sm-6'],
            ])
            ->add('tempo_kredit', 'number', [
                'label' => 'Tempo Kredit (hari)',
                'wrapper' => ['class' => 'form-group col-sm-4'],
            ]) 
            ->add('npwp', 'text', [
                'wrapper' => ['class' => 'form-group col-sm-4'],
            ]) 
            ->add('pkp', 'choice', [
                'choices' => ['1' => 'Iya', '0' => 'Tidak'],
                'label_attr' => ['class' => 'w-100'],
                'wrapper' => ['class' => 'form-group col-sm-4'],
                'expanded' => true,
                'multiple' => false
            ])
            ->add('alamat', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('kategori', 'select', [
			    'choices' => ['importir' => 'importir', 'dealer' => 'dealer'],
			    'empty_value' => ' ',
                'attr' => ['required' => true]
			]);
    }
}
