<?php

namespace Modules\TomatoTranslations\App\Views;

use Illuminate\View\Component;
use ProtoneMedia\Splade\Components\Form;
use ProtoneMedia\Splade\Components\Form\InteractsWithFormElement;

class Translation extends Component
{
    use InteractsWithFormElement;

    public function __construct(
        public string $name = '',
        public string $vModel = '',
        public string $type = 'text',
        public string $label = '',
        public string $placeholder = '',
        public string $validationKey = '',
        public bool $showErrors = true,
        public string $prepend = '',
        public string $append = '',
        public string $help = '',
        public bool $alwaysEnablePrepend = false,
        public bool $alwaysEnableAppend = false,
        public bool $textarea = false,
        public bool $rich = false,
    )
    {
        if($this->textarea){
            $this->type = 'textarea';
        }
        if($this->rich){
            $this->type = 'rich';
        }
        Form::allowAttribute($name);
    }

    public function isHidden(): bool
    {
        return $this->type === 'hidden';
    }

    public function render()
    {
        return view('tomato-translations::components.translation');
    }
}
