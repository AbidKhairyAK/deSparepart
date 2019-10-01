<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Model\Role;
use App\Model\Permission;

class HakAksesForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nama',
                'attr' => ['required' => true]
            ])
            ->add('permissions', 'choice', [
                'label' => "Kemampuan",
                'label_attr' => ['class' => 'control-label w-100'],
			    'choices' => Permission::pluck('name', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'custom-control custom-checkbox mb-2 d-inline-block', 'style' => 'width:18%'],
                    'attr' => ['class' => 'custom-control-input'],
                    'label_attr' => ['class' => 'custom-control-label'],
                ],
                'attr' => ['required' => true],
                'expanded' => true,
                'multiple' => true,
                'selected' => $this->getModel() ? $this->getModel()->permissions()->get()->pluck('id')->toArray() : false,
			]);
    }
}
