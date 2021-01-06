<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\GymMerchantPermission;

class GymPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gym_merchant_role_users')->delete();
        DB::table('gym_merchant_role_permissions')->delete();
        DB::table('gym_merchant_roles')->delete();
        DB::table('gym_merchant_permissions')->delete();

        $permissions = [
            "view_dashboard",
            "view_customers",
            "add_customers",
            "edit_customers",
            "delete_customers",
            "view_customer_attendance",
            "view_targets",
            "add_target",
            "edit_target",
            "delete_target",
            "view_subscriptions",
            "add_subscriptions",
            "edit_subscriptions",
            "delete_subscriptions",
            "view_membership",
            "add_membership",
            "edit_membership",
            "delete_membership",
            "add_attendance",
            "view_enquiry",
            "add_enquiry",
            "edit_enquiry",
            "delete_enquiry",
            "view_payments",
            "add_payment",
            "edit_payment",
            "delete_payment",
            "view_due_payments",
            "view_invoice",
            "create_invoice",
            "delete_invoice",
            "view_target_report",
            "view_client_report",
            "view_finance_report",
            "view_attendance_report",
            "view_enquiry_report",
            "view_software_updates",
            "buy_sms_credits",
            "view_previous_promotions",
            "send_promotions",
            "update_profile",
            "update_settings",
            "manage_permissions",
            "download_backup",
            "balance_report",
            "expense",
            "task",
            "my_gym",
            "message",
        ];

        foreach($permissions as $perm):
            $displayName = ucwords(str_replace('_', ' ', $perm));
            $insert = [
                "name" => $perm,
                "display_name" => $displayName,
                "for" => 'gyms'
            ];
            GymMerchantPermission::create($insert);
        endforeach;

    }
}
