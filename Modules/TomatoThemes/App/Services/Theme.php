<?php

namespace Modules\TomatoThemes\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\TomatoForms\App\Models\Form;
use Modules\TomatoThemes\App\Services\Abstract\Section;

class Theme
{
    public array $sections = [];

    public function registerSection(Section $section): void
    {
        $this->sections[] = $section->toCollection();
    }

    public function find(string $key){
        return collect($this->sections)->where('key', $key)->first();
    }

    public function getSections(): Collection
    {
        return collect($this->sections);
    }

    public function loadSections(): void
    {
        $sectionPaths = config('tomato-themes.section_paths');
        foreach ($sectionPaths as $path){
            if(File::exists(base_path($path))){
                $files = File::allFiles(base_path($path));
                foreach ($files as $file){
                    $exploadFile = explode("\n",$file->getContents());
                    foreach ($exploadFile as $line){
                        if(Str::contains($line, 'namespace')){
                            $namespace = Str::of($line)->replace('namespace', '')->replace(';', '')->trim()->toString();
                            break;
                        }
                    }
                    $class = $namespace . "\\".$file->getBasename('.php');
                    $this->registerSection(new $class);
                }
            }
            else {
                throw new \Exception("Section Path {$path} Not Found");
            }
        }

    }

    public function build(): void
    {
        foreach ($this->sections as $section) {
            $checkIfSectionExists = \Modules\TomatoThemes\App\Models\Section::where('key', $section->key)->first();
            if(!$checkIfSectionExists){
                $form = Form::where('key', $section->form)->first();
                $section->form_id($form->id);
                \Modules\TomatoThemes\App\Models\Section::create($section->toArray());
            }
        }
    }
}
