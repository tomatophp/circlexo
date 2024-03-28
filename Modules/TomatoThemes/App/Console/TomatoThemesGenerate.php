<?php

namespace Modules\TomatoThemes\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use Modules\TomatoThemes\App\Generator\GenerateTheme;

class TomatoThemesGenerate extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato:theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate a new theme for tomato-themes plugin';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $themeName = $this->ask('What is the name of the theme?');
        if(!$themeName){
            $this->error('Theme name is required');
            $themeName = $this->ask('What is the name of the theme?');
        }

        $themeDescription = $this->ask('What is the description of the theme?', 'No description');

        $generate = new GenerateTheme(
            themeName: $themeName,
            themeDescription: $themeDescription
        );
        $generate->generate();

        $this->info('Theme generated successfully');
    }
}
