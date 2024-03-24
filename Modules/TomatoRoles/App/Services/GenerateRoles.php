<?php

namespace Modules\TomatoRoles\App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GenerateRoles
{
    use HandleStub;

    /**
     * @var string[]
     */
    private array $permissions;

    private string $stubPath;

    private string $tableName;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->permissions = [
            'admin.'.Str::replace('_','-', $tableName) .'.index',
            'admin.'.Str::replace('_','-', $tableName) .'.api',
            'admin.'.Str::replace('_','-', $tableName) .'.create',
            'admin.'.Str::replace('_','-', $tableName) .'.store',
            'admin.'.Str::replace('_','-', $tableName) .'.show',
            'admin.'.Str::replace('_','-', $tableName) .'.edit',
            'admin.'.Str::replace('_','-', $tableName) .'.update',
            'admin.'.Str::replace('_','-', $tableName) .'.destroy',
            'admin.'.Str::replace('_','-', $tableName) .'.export',
            'admin.'.Str::replace('_','-', $tableName) .'.bulk',
        ];

        $this->stubPath = __DIR__ . '/../../stubs/';
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        $this->generatePermissionsMigration();
        Artisan::call('migrate');
    }


    /**
     * @return void
     */
    private function generatePermissionsMigration(): void
    {
        $permissions = "";
        foreach ($this->permissions as $per) {
            $permissions .= '           "'.$per.'",' . "\n";
        }
        $this->generateStubs(
            $this->stubPath . "migration.stub",
            database_path("migrations/".date('Y_m_d_His')."_fill_permissions_for_".$this->tableName.".php"),
            [
                "name" => Str::camel(Str::replace('_', ' ', $this->tableName)),
                "permissions" => $permissions
            ],
            [
                database_path("migrations")
            ]
        );
    }
}
