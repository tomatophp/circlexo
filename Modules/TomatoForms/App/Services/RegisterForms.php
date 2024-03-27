<?php

namespace Modules\TomatoForms\App\Services;

use Modules\TomatoForms\App\Services\Contracts\Form;

class RegisterForms
{
    public array $forms = [];

    public function register(Form $form){
        $this->forms[] = $form;
    }

    public function getForms(): array
    {
        return $this->forms;
    }

    public function build(): void
    {
        foreach ($this->forms as $form){
            $checkIfFormExists = \Modules\TomatoForms\App\Models\Form::where('key', $form->key)->first();
            if(!$checkIfFormExists){
                $newForm = \Modules\TomatoForms\App\Models\Form::create($form->toArray());
                $newForm->fields()->createMany($form->inputs);
            }
        }
    }
}
