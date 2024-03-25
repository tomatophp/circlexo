<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use function Pest\Laravel\swap;

class Button extends Component
{
    public array $primaryClass = ['bg-main-600 hover:bg-main-400', 'text-gray-800', 'border', 'border-gray-700'];
    public array $secondaryClass = ['bg-second-600 hover:bg-second-400', 'text-white' , 'border', 'border-gray-700'];
    public array $theadClass = ['bg-thead-600 hover:bg-thead-400', 'text-white' , 'border', 'border-gray-700'];
    public array $successClass = ['bg-success-600', 'text-white'];
    public array $dangerClass = ['bg-danger-600', 'text-white'];
    public array $warningClass = ['bg-warning-600', 'text-white'];
    public array $infoClass = ['bg-info-600', 'text-white'];
    public array $lightClass = ['bg-gary-200', 'text-black'];
    public array $darkClass = ['bg-gray-800', 'text-white'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'button',
        public string $label = '',
        public string $size = 'md',
        public array $styleClass = ['rounded-md', 'shadow-md', 'font-bold'],
        public string $icon = '',
        public string $iconPosition = 'left',
        public string $href = '',
        public ?string $method = "GET",
        public ?bool $modal = false,
        public string $target = '_self',
        public ?bool $primary = false,
        public ?bool $secondary = false,
        public ?bool $success = false,
        public ?bool $danger = false,
        public ?bool $warning = false,
        public ?bool $info = false,
        public ?bool $light = false,
        public ?bool $thead = false,
        public ?bool $dark = false,
        public ?bool $outline = false,
    )
    {
        if($this->href){
            $this->type = 'link';
        }

        switch ($this->size){
            case 'sm':
                $this->styleClass = array_merge($this->styleClass, ['text-sm', 'px-4', 'py-2']);
                break;
            case 'md':
                $this->styleClass = array_merge($this->styleClass, ['text-md', 'px-6', 'py-4']);
                break;
            case 'lg':
                $this->styleClass = array_merge($this->styleClass, ['text-md md:text-lg', 'px-6 md:px-8', 'py-3 md:py-4']);
                break;
            case 'xl':
                $this->styleClass = array_merge($this->styleClass, ['text-2xl', 'px-16', 'py-4']);
                break;
            default:
                $this->styleClass = array_merge($this->styleClass, ['text-md', 'px-16', 'py-8']);
        }

        if($this->primary){
            $this->styleClass = array_merge($this->primaryClass, $this->styleClass);
        }
        else if ($this->secondary) {
            $this->styleClass = array_merge($this->secondaryClass, $this->styleClass);
        }
        else if ($this->success) {
            $this->styleClass = array_merge($this->successClass, $this->styleClass);
        }
        else if ($this->danger) {
            $this->styleClass = array_merge($this->dangerClass, $this->styleClass);
        }
        else if ($this->warning) {
            $this->styleClass = array_merge($this->warningClass, $this->styleClass);
        }
        else if ($this->info) {
            $this->styleClass = array_merge($this->infoClass, $this->styleClass);
        }
        else if ($this->light) {
            $this->styleClass = array_merge($this->lightClass, $this->styleClass);
        }
        else if ($this->dark) {
            $this->styleClass = array_merge($this->darkClass, $this->styleClass);
        }
        else if ($this->thead) {
            $this->styleClass = array_merge($this->darkClass, $this->styleClass);
        }
        else {
            $this->styleClass = array_merge($this->primaryClass, $this->styleClass);
        }

        if ($this->outline) {
            $this->styleClass = array_merge(['border', 'border-solid'], $this->styleClass);
        }

    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.button');
    }
}
