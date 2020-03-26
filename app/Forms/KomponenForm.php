<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class KomponenForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nama', 'text', [
                'label' => 'Nama Komponen',
                'attr'  => ['required' => true],
            ])
            ->add('kode', 'text', [
                'label' => 'Kode',
                'attr'  => ['required' => true],
            ])
            ->add('tipe', 'choice', [
                'choices'        => ['umum' => 'Umum', 'mobil' => 'Mobil', 'motor' => 'Motor', 'sepeda' => 'Sepeda'],
                'label_attr'     => ['class' => 'w-100'],
                'attr'           => ['required' => true],
                'choice_options' => [
                    'label_attr' => ['class' => 'pr-3'],
                ],
                'multiple'       => false,
                'expanded'       => true,
            ])
            ->add('bagian', 'text', [
                'attr' => ['required' => true],
            ]);
    }
}
