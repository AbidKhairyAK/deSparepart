<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class KendaraanForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('merk', 'text', [
                'label' => 'Merk Kendaraan',
                'attr'  => ['required' => true],
            ])
            ->add('kode', 'text', [
                'label' => 'Kode',
                'attr'  => ['required' => true],
            ])
            ->add('tipe', 'choice', [
                'choices'        => ['sepeda' => 'Sepeda', 'mobil' => 'Mobil', 'motor' => 'Motor', 'lainnya' => 'Lainnya'],
                'label_attr'     => ['class' => 'w-100'],
                'attr'           => ['required' => true],
                'choice_options' => [
                    'label_attr' => ['class' => 'pr-3'],
                ],
                'multiple'       => false,
                'expanded'       => true,
            ])
            ->add('pabrikan', 'text', [
                'attr' => ['required' => true],
            ]);
    }
}
