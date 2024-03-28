<?php

namespace Modules\TomatoEcommerce\App\Console;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use Modules\TomatoProducts\App\Services\Permission;

class TomatoEcommerceInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-ecommerce:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

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
        $this->info('Publish Vendor Assets');

        //Main Permissions
        $permissions = [
            "admin",
            "admin.lang",
            "admin.profile.edit",
            "admin.profile.update",
            "admin.profile.password",
            "admin.verification.notice",
            "admin.verification.verify",
            "admin.password.confirm",
            "admin.password.confirm.post",
            "admin.password.update",
            "admin.logout",
            "admin.upload",
            "admin.cities.api",
            "admin.countries.api",
            "admin.accounts.index",
            "admin.accounts.api",
            "admin.products.api",
            "admin.areas.api",
            "admin.currencies.api",
            "admin.languages.api",
            "admin.orders.api",
            "admin.orders.index",
            "admin.orders.show",
            "admin.orders.print",
            "admin.types.api",
            "admin.categories.api",
            "admin.companies.api",
            "admin.branches.api",
            "admin.branches.api",
            "admin.orders.product",
            "admin.orders.user"
        ];
        //Create Ecommece Rules
        $roles = [
            [
                "name" => "social",
                "guard_name" => "web",
                "permissions" => array_merge([
                    "admin.products.import",
                    "admin.products.import.store",
                    "admin.products.clone",
                    "admin.products.toggle",
                    "admin.products.options.index",
                    "admin.products.options.mix",
                    "admin.products.options.create",
                    "admin.products.options.store",
                    "admin.products.options.edit",
                    "admin.products.options.delete",
                    "admin.products.category.index",
                    "admin.products.category.create",
                    "admin.products.category.store",
                    "admin.products.category.edit",
                    "admin.products.category.delete",
                    "admin.products.tags.index",
                    "admin.products.tags.create",
                    "admin.products.tags.store",
                    "admin.products.tags.edit",
                    "admin.products.tags.delete",
                    "admin.products.brands.index",
                    "admin.products.brands.create",
                    "admin.products.brands.store",
                    "admin.products.brands.edit",
                    "admin.products.brands.delete",
                    "admin.products.units.index",
                    "admin.products.units.create",
                    "admin.products.units.store",
                    "admin.products.units.edit",
                    "admin.products.units.delete",
                    "admin.products.actions.media",
                    "admin.products.actions.options",
                    "admin.products.actions.alerts",
                    "admin.products.actions.seo",
                    "admin.products.actions.shipping",
                    "admin.products.actions.prices",
                    "admin.products.index",
                    "admin.products.api",
                    "admin.products.create",
                    "admin.products.store",
                    "admin.products.show",
                    "admin.products.edit",
                    "admin.products.update",
                    "admin.products.destroy",
                    "admin.products.export",
                    "admin.products.bulk",
                    "admin.services.index",
                    "admin.services.api",
                    "admin.services.create",
                    "admin.services.store",
                    "admin.services.show",
                    "admin.services.edit",
                    "admin.services.update",
                    "admin.services.destroy",
                    "admin.services.export",
                    "admin.services.bulk",
                    "admin.portfolios.index",
                    "admin.portfolios.api",
                    "admin.portfolios.create",
                    "admin.portfolios.store",
                    "admin.portfolios.show",
                    "admin.portfolios.edit",
                    "admin.portfolios.update",
                    "admin.portfolios.destroy",
                    "admin.portfolios.export",
                    "admin.portfolios.bulk",
                    "admin.testimonials.index",
                    "admin.testimonials.api",
                    "admin.testimonials.create",
                    "admin.testimonials.store",
                    "admin.testimonials.show",
                    "admin.testimonials.edit",
                    "admin.testimonials.update",
                    "admin.testimonials.destroy",
                    "admin.testimonials.export",
                    "admin.testimonials.bulk",
                    "admin.posts.index",
                    "admin.posts.api",
                    "admin.posts.create",
                    "admin.posts.store",
                    "admin.posts.show",
                    "admin.posts.edit",
                    "admin.posts.update",
                    "admin.posts.destroy",
                    "admin.posts.export",
                    "admin.posts.bulk",
                    "admin.ccomments.index",
                    "admin.ccomments.api",
                    "admin.ccomments.create",
                    "admin.ccomments.store",
                    "admin.ccomments.show",
                    "admin.ccomments.edit",
                    "admin.ccomments.update",
                    "admin.ccomments.destroy",
                    "admin.ccomments.export",
                    "admin.ccomments.bulk",
                    "admin.photos.index",
                    "admin.photos.api",
                    "admin.photos.create",
                    "admin.photos.store",
                    "admin.photos.show",
                    "admin.photos.edit",
                    "admin.photos.update",
                    "admin.photos.destroy",
                    "admin.photos.export",
                    "admin.photos.bulk",
                    "admin.skills.index",
                    "admin.skills.api",
                    "admin.skills.create",
                    "admin.skills.store",
                    "admin.skills.show",
                    "admin.skills.edit",
                    "admin.skills.update",
                    "admin.skills.destroy",
                    "admin.skills.export",
                    "admin.skills.bulk",
                    "admin.pages.index",
                    "admin.pages.api",
                    "admin.pages.create",
                    "admin.pages.store",
                    "admin.pages.show",
                    "admin.pages.edit",
                    "admin.pages.update",
                    "admin.pages.destroy",
                    "admin.pages.export",
                    "admin.pages.bulk",
                    "admin.coupons.index",
                    "admin.coupons.api",
                    "admin.coupons.create",
                    "admin.coupons.store",
                    "admin.coupons.show",
                    "admin.coupons.edit",
                    "admin.coupons.update",
                    "admin.coupons.destroy",
                    "admin.coupons.export",
                    "admin.coupons.bulk",
                    "admin.gift-cards.index",
                    "admin.gift-cards.api",
                    "admin.gift-cards.create",
                    "admin.gift-cards.store",
                    "admin.gift-cards.show",
                    "admin.gift-cards.edit",
                    "admin.gift-cards.update",
                    "admin.gift-cards.destroy",
                    "admin.gift-cards.export",
                    "admin.gift-cards.bulk",
                    "admin.referral-codes.index",
                    "admin.referral-codes.api",
                    "admin.referral-codes.create",
                    "admin.referral-codes.store",
                    "admin.referral-codes.show",
                    "admin.referral-codes.edit",
                    "admin.referral-codes.update",
                    "admin.referral-codes.destroy",
                    "admin.referral-codes.export",
                    "admin.referral-codes.bulk",
                    "admin.features.index",
                    "admin.features.api",
                    "admin.features.create",
                    "admin.features.store",
                    "admin.features.show",
                    "admin.features.edit",
                    "admin.features.update",
                    "admin.features.destroy",
                    "admin.features.export",
                    "admin.features.bulk",
                    "admin.pages.builder",
                    "admin.pages.sections",
                    "admin.pages.remove",
                    "admin.pages.meta",
                    "admin.pages.clear",
                    "admin.pages.meta.store",
                    "admin.tickets.index",
                    "admin.tickets.api",
                    "admin.tickets.create",
                    "admin.tickets.store",
                    "admin.tickets.show",
                    "admin.tickets.edit",
                    "admin.tickets.update",
                    "admin.tickets.destroy",
                    "admin.tickets.export",
                    "admin.tickets.bulk",
                    "admin.questions.index",
                    "admin.questions.api",
                    "admin.questions.create",
                    "admin.questions.store",
                    "admin.questions.show",
                    "admin.questions.edit",
                    "admin.questions.update",
                    "admin.questions.destroy",
                    "admin.questions.export",
                    "admin.questions.bulk",
                    "admin.menus.index",
                    "admin.menus.api",
                    "admin.menus.create",
                    "admin.menus.store",
                    "admin.menus.show",
                    "admin.menus.edit",
                    "admin.menus.update",
                    "admin.menus.destroy",
                    "admin.menus.export",
                    "admin.menus.bulk",
                    "admin.menus.item",
                    "admin.menus.item.all",
                    "admin.menus.item.destroy",
                    "admin.menus.item.pages",
                    "admin.menus.item.update",
                    "admin.settings.index",
                ], $permissions)
            ],
            [
                "name" => "sales",
                "guard_name" => "web",
                "permissions" => array_merge([
                    "admin.products.index",
                    "admin.products.show",
                    "admin.orders.create",
                    "admin.orders.store",
                    "admin.orders.edit",
                    "admin.orders.update",
                    "admin.orders.approve",
                    "admin.orders.print",
                    "admin.inventories.export",
                    "admin.inventories.index",
                    "admin.inventories.api",
                    "admin.inventories.report",
                    "admin.inventories.report.data",
                    "admin.inventories.report.print",
                ], $permissions)
            ],
            [
                "name" => "pos",
                "guard_name" => "web",
                "permissions" => array_merge([
                    "admin.pos.index",
                    "admin.pos.account",
                    "admin.pos.account.store",
                    "admin.pos.cart.index",
                    "admin.pos.cart.clear",
                    "admin.pos.cart.options",
                    "admin.pos.cart.update",
                    "admin.pos.inventory",
                    "admin.pos.inventory.store",
                    "admin.inventories.export",
                    "admin.pos.inventory.create",
                    "admin.pos.orders.index",
                    "admin.pos.orders.show",
                    "admin.pos.orders.print",
                    "admin.pos.place",
                    "admin.pos.settings",
                    "admin.pos.settings.update",
                    "admin.products.index",
                    "admin.products.show",
                    "admin.orders.create",
                    "admin.orders.store",
                    "admin.orders.edit",
                    "admin.orders.update",
                    "admin.inventories.index",
                    "admin.inventories.api",
                    "admin.inventories.report",
                    "admin.inventories.report.data",
                    "admin.inventories.report.print",
                ], $permissions)
            ],
            [
                "name" => "inventory",
                "guard_name" => "web",
                "permissions" => array_merge([
                    "admin.inventories.index",
                    "admin.inventories.api",
                    "admin.inventories.create",
                    "admin.inventories.history",
                    "admin.inventories.store",
                    "admin.inventories.show",
                    "admin.inventories.edit",
                    "admin.inventories.update",
                    "admin.inventories.destroy",
                    "admin.inventories.export",
                    "admin.inventories.bulk",
                    "admin.inventories.print",
                    "admin.inventories.status",
                    "admin.inventories.barcodes",
                    "admin.inventories.barcodes.print",
                    "admin.inventories.report",
                    "admin.inventories.report.data",
                    "admin.inventories.report.print",
                    "admin.inventories.import",
                    "admin.inventories.import.store",
                    "admin.inventories.report.approve.item",
                    "admin.inventories.approve",
                    "admin.inventories.print.show",
                    "admin.refunds.index",
                    "admin.refunds.api",
                    "admin.refunds.create",
                    "admin.refunds.store",
                    "admin.refunds.show",
                    "admin.refunds.edit",
                    "admin.refunds.update",
                    "admin.refunds.destroy",
                    "admin.refunds.export",
                    "admin.refunds.bulk",
                    "admin.refunds.status",
                    "admin.refunds.approve",
                    "admin.refunds.orders",
                ], $permissions)
            ],
            [
                "name" => "operation",
                "guard_name" => "web",
                "permissions" => array_merge([
                    "admin.orders.edit",
                    "admin.orders.update",
                    "admin.orders.status",
                    "admin.orders.print",
                    "admin.orders.ship",
                    "admin.orders.shipping",
                    "admin.refunds.index",
                    "admin.refunds.api",
                    "admin.refunds.create",
                    "admin.refunds.store",
                    "admin.refunds.show",
                    "admin.refunds.edit",
                    "admin.refunds.update",
                    "admin.refunds.destroy",
                    "admin.refunds.export",
                    "admin.refunds.bulk",
                    "admin.refunds.status",
                    "admin.refunds.approve",
                    "admin.refunds.orders",
                    "admin.shipping-prices.index",
                    "admin.shipping-prices.api",
                    "admin.shipping-prices.create",
                    "admin.shipping-prices.store",
                    "admin.shipping-prices.show",
                    "admin.shipping-prices.edit",
                    "admin.shipping-prices.update",
                    "admin.shipping-prices.destroy",
                    "admin.shipping-prices.export",
                    "admin.shipping-prices.bulk",
                    "admin.shipping-vendors.index",
                    "admin.shipping-vendors.api",
                    "admin.shipping-vendors.create",
                    "admin.shipping-vendors.store",
                    "admin.shipping-vendors.show",
                    "admin.shipping-vendors.edit",
                    "admin.shipping-vendors.update",
                    "admin.shipping-vendors.destroy",
                    "admin.shipping-vendors.export",
                    "admin.shipping-vendors.bulk",
                    "admin.deliveries.index",
                    "admin.deliveries.api",
                    "admin.deliveries.create",
                    "admin.deliveries.store",
                    "admin.deliveries.show",
                    "admin.deliveries.edit",
                    "admin.deliveries.update",
                    "admin.deliveries.destroy",
                    "admin.deliveries.export",
                    "admin.deliveries.bulk",
                ], $permissions)

            ]
        ];

        foreach ($roles as $role){
            $checkExists = Role::where('name', $role['name'])->first();
            if(!$checkExists){
                $newRole = Role::create([
                    "name" => $role['name'],
                    "guard_name" => "web"
                ]);
                if($newRole){
                    $this->info("Install ". $newRole->name . " Role");
                    foreach ($role['permissions'] as $permission){
                        $checkIfPermissionExists = \Spatie\Permission\Models\Permission::where('name', $permission)->first();
                        if(!$checkIfPermissionExists){
                            \Spatie\Permission\Models\Permission::create(['name' => $permission, 'guard_name' => 'web']);
                        }
                        $newRole->givePermissionTo($permission);
                    }
                }
            }
            else {
                $this->info("Install ". $checkExists->name . " Role");
                foreach ($role['permissions'] as $permission){
                    $checkIfPermissionExists = \Spatie\Permission\Models\Permission::where('name', $permission)->first();
                    if(!$checkIfPermissionExists){
                        \Spatie\Permission\Models\Permission::create(['name' => $permission, 'guard_name' => 'web']);
                    }
                    $checkExists->givePermissionTo($permission);
                }
            }
        }
        $permissions = \Spatie\Permission\Models\Permission::all();
        foreach ($permissions as $permission){
            $getAdminRoles = Role::where('name', 'admin')->first();
            if($getAdminRoles){
                $getAdminRoles->givePermissionTo($permission->name);
            }
        }
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('Tomato Ecommerce installed successfully.');
    }
}
