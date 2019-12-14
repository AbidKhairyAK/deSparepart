<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Komponen;
use App\Model\Kendaraan;

class BarangForm extends Form
{
    public function buildForm()
    {
        $m = $this->getModel();
        $this
            ->add('part_no', 'text', [
                'value' => $m ? $m->part_no : null,
            ])
            ->add('komponen_id', 'choice', [
                'label' => 'Komponen / Part',
                'choices' => $m ? [$m->komponen->id => $m->komponen->nama] : [],
                'wrapper' => ['class' => 'form-group col-sm-6'],
                'attr' => ['required' => true, 'class' => 'form-control select2'],
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('kendaraan_id', 'choice', [
                'label' => 'Untuk Kendaraan',
                'choices' => $m ? [$m->kendaraan->id => $m->kendaraan->merk] : ['1' => 'UMUM'],
                'wrapper' => ['class' => 'form-group col-sm-6'],
                'attr' => ['required' => true],
                'multiple' => false,
                'expanded' => false,
			])
            ->add('nama', 'text', [
                'label' => 'Nama Barang',
                'attr' => ['required' => true]
            ])
            ->add('merk', 'text', [
                'attr' => ['required' => true]
            ])
            ->add('stok', 'number', [
                'label' => 'Stok Sekarang',
                'attr' => ['required' => true],
                'wrapper' => ['class' => 'form-group col-sm-4'],
                'value' => $m ? $m->stok : 0,
            ])
            ->add('limit', 'number', [
                'attr' => ['required' => true],
                'wrapper' => ['class' => 'form-group col-sm-4'],
                'value' => $m ? $m->limit : 0,
            ])
            ->add('satuan_id', 'choice', [
                'label' => 'Satuan',
                'choices' => $m ? [$m->satuan->id => $m->satuan->nama] : [],
                'wrapper' => ['class' => 'form-group col-sm-4'],
                'attr' => ['required' => true],
                'empty_value' => ' ',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('harga_beli', 'text', [
                'label' => 'Harga Beli Standar Per-barang',
                'attr' => ['required' => true],
                'wrapper' => ['class' => 'form-group col-sm-6'],
            ])
            ->add('harga_jual', 'text', [
                'label' => 'Harga Jual Standar Per-barang',
                'attr' => ['required' => true],
                'wrapper' => ['class' => 'form-group col-sm-6'],
            ])
            ->add('keterangan', 'textarea', [
                'attr' => ['rows' => 4],
            ]);
    }
}
