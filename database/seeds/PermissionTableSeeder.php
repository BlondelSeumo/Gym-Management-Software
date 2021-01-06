<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Admin;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        $permissions = [
            "view_admin_dashboard",
            "view_dashboard",

            "view_states",
            "add_states",
            "edit_states",
            "delete_states",

            "view_cities",
            "add_cities",
            "edit_cities",
            "delete_cities",

            "view_areas",
            "add_areas",
            "edit_areas",
            "delete_areas",

            "view_categories",
            "add_categories",
            "edit_categories",
            "delete_categories",

            "view_gyms",
            "add_gyms",
            "edit_gyms",
            "delete_gyms",

            "view_salons",
            "add_salons",
            "edit_salons",
            "delete_salons",

            "create_rate_card_salons",

            "view_appointments",
            "add_appointments",
            "edit_appointments",

            "view_salons_offer",
            "add_salons_offer",
            "edit_salons_offer",
            "delete_salons_offer",

            "view_department",
            "add_department",
            "edit_department",
            "delete_department",

            "view_services",
            "add_services",
            "edit_services",
            "delete_services",

            "view_users",
            "add_users",
            "edit_users",
            "delete_users",

            "view_merchants",
            "add_merchants",
            "edit_merchants",
            "delete_merchants",

            "view_user_payments",

            "view_merchant_payments",
            "add_merchant_payments",
            "edit_merchant_payments",
            "delete_merchant_payments",

            "view_business_requests",
            "edit_business_requests",
            "delete_business_requests",

            "view_new_listing_suggestions",
            "edit_new_listing_suggestions",
            "delete_new_listing_suggestions",

            "view_edit_suggestions",
            "edit_edit_suggestions",
            "delete_edit_suggestions",

            "view_shutdown_reports",
            "edit_shutdown_reports",
            "delete_shutdown_reports",

            "view_bug_reports",
            "edit_bug_reports",
            "delete_bug_reports",

            "view_reviews",
            "add_reviews",
            "edit_reviews",
            "delete_reviews",

            "view_report_reviews",
            "edit_report_reviews",
            "delete_report_reviews",

            "view_review_comments",
            "edit_review_comments",
            "delete_review_comments",

            "view_report_review_comments",
            "edit_report_review_comments",
            "delete_report_review_comments",

            "view_recharges",
            "add_recharges",
            "edit_recharges",
            "delete_recharges",

            "view_tip_of_the_day",
            "add_tip_of_the_day",
            "edit_tip_of_the_day",
            "delete_tip_of_the_day",

            "view_inbox",
            "mark_as_read_inbox",
            "delete_inbox",

            "view_slider",
            "add_slider",
            "delete_slider",

            "view_static_pages",
            "add_static_pages",
            "edit_static_pages",
            "delete_static_pages",

            "view_search_keywords",
            "add_search_keywords",
            "delete_search_keywords",

            "send_sms_report",

            "view_monthly_visits",

            "view_mobile_database",
            "add_mobile_database",
            "edit_mobile_database",
            "delete_mobile_database",

            "send_promotion",

            "manage_roles_permissions",

            "view_business_branches",
            "add_business_branches",
            "edit_business_branches",
            "delete_business_branches",

            "edit_profile",
            "view_event_reminders",

            "view_subcategories",
            "add_subcategories",
            "edit_subcategories",
            "delete_subcategories",

            "view_salonvoucher",
            "add_salonvoucher",
            "edit_salonvoucher",
            "delete_salonvoucher",

            "view_softwareupdate",
            "add_softwareupdate",
            "edit_softwareupdate",
            "delete_softwareupdate",

            "take_backup",
            "view_gympromotion",
            "view_gymtarget",

            "view_gyms_offer",
            "delete_gyms_offer",
            "edit_gyms_offer",
            "add_gyms_offer",

            "view_gyms_onlinebooking",
            "add_gyms_onlinebooking",
            "edit_gyms_onlinebooking",
            "delete_gyms_onlinebooking",

            "view_gyms_membership",
            "add_gyms_membership",
            "edit_gyms_membership",
            "delete_gyms_membership",

            "view_gyms_promotion",
            "add_gyms_promotion",
            "edit_gyms_promotion",
            "delete_gyms_promotion",

            "send_notification",

            "view_demo_request",
            "edit_demo_request",

            "view_ace_dashboard",

        ];

        foreach($permissions as $perm):
            $displayName = ucwords(str_replace('_',' ',$perm));
            $insert = [
                "name" => $perm,
                "display_name" => $displayName
            ];
            Permission::create($insert);
        endforeach;

//        $admin = new Role;
//        $admin->name = 'Super Admin';
//        $admin->save();
//
//        $user = Admin::where('email','=','admin@froiden.com')->first();
//
//        $user->attachRole( $admin );
//
//        $permission = Permission::all();
//        $permi = [];
//        foreach ($permission as $perms) {
//            array_push($permi, $perms->id);
//        }
//
//        foreach ($permi as $perm) {
//            DB::table('permission_role')->insert([
//                'permission_id' => $perm,
//                'role_id' => $admin->id,
//            ]);
//        }


    }
}
