<?php

use Illuminate\Database\Seeder;
use App\Models\Merchant;
use App\Models\Area;
use App\Models\Common;
use App\Models\MerchantBusiness;
use App\Models\BusinessBranch;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\GymSetting;
use App\Models\Currency;
use App\Models\GymMerchantRole;
use App\Models\GymMerchantRoleUser;
use App\Models\GymMerchantPermissionRole;
use App\Models\GymMerchantPermission;

class MerchantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'first_name' => 'Admin',
            'mobile' => '100',
            'email' => 'admin@froiden.com',
            'is_admin' => 1,
        ]);

        Common::create([
            'title' => 'Froiden',
            'address' => 'Malviya Nagar',
            'owner_incharge_name' => 'admin',
            'phone' => '100',
            'email' => 'admin@froiden.com',

        ]);

        $merchant = Merchant::where('email','=','admin@froiden.com')->first();
        $detail = Common::where('email','=','admin@froiden.com')->first();
        $category = Category::first();
        $currency = Currency::where('acronym', '=', 'USD')->first();
        $permissions = GymMerchantPermission::all();

        BusinessBranch::create([
            'detail_id' => $detail->id,
            'owner_incharge_name' => $detail->owner_incharge_name,
            'address' => $detail->address,
            'phone' => $detail->phone,
        ]);

        MerchantBusiness::create([
            'merchant_id' => $merchant->id,
            'detail_id' => $detail->id,
        ]);

        BusinessCategory::create([
            'category_id' => $category->id,
            'detail_id' => $detail->id,
        ]);

        GymSetting::create([
            'detail_id' => $detail->id,
            'currency_id' => $currency->id,
            'mail_driver' => 'mail',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'contact_mail' => 'abc@example.com',
        ]);

        GymMerchantRole::create([
            'detail_id' => $detail->id,
            'name' => 'Super Admin',
        ]);

        $roles = GymMerchantRole::first();

        GymMerchantRoleUser::create([
            'user_id' => $merchant->id,
            'role_id' => $roles->id,
        ]);

        foreach ($permissions as $permission) {
            GymMerchantPermissionRole::create([
                'permission_id' => $permission->id,
                'role_id' => $roles->id,
            ]);
        }
    }
}
