<?php

namespace Modules\TomatoTranslations\App\Exports;

use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\TomatoTranslations\App\Models\Translation;
use Maatwebsite\Excel\Concerns\FromCollection;

class TranslationsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Translation::all();
    }

    public function headings(): array
    {
        $loadLocals = [];
        $jsonFolder = File::files(lang_path());
        foreach ($jsonFolder as $key => $value) {
            $loadLocals[] = str_replace('.json', '', $value->getFilename());
        }

        return array_merge(["id", "key"], $loadLocals);
    }
}
