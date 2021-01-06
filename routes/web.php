<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {

    //region routes for merchant panel
    Route::group(
        ['namespace' => 'Merchant', 'as' => 'merchant.'], function () {

        Route::get("/", "MerchantsController@index");

        Route::get("/dashboard", "MerchantsController@dashboard");
        Route::get("/appointments", "MerchantsController@appointments");
        Route::get("/feedbacks", "MerchantsController@feedbacks");
        Route::get("/departments", "MerchantsController@departments");
        Route::get("/services", "MerchantsController@services");
        Route::get("/payments", "MerchantsController@payments");

        // Login resource controller
        Route::post('reset-password', ['as' => 'login.send-reset-link', 'uses' => 'MerchantsController@sendResetPasswordLink']);
        Route::get('reset/{token}', ['as' => 'login.reset-password', 'uses' => 'MerchantsController@resetPassword']);
        Route::post('update-password', ['as' => 'login.update-password', 'uses' => 'MerchantsController@updatePassword']);
        Route::resource('login', 'MerchantsController', ['only' => ['index', 'store']]);

        Route::get('lock-screen', ['uses' => 'LockScreenController@get', 'as' => 'lockscreen']);
        Route::get('keep-alive', ['uses' => 'LockScreenController@keepAlive', 'as' => 'keep-alive']);
        Route::post('lock-login', ['uses' => 'LockScreenController@post', 'as' => 'lockLogin']);
        Route::get('logout', ['uses' => 'LockScreenController@logout', 'as' => 'logout']);

    }
    );
    //endregion

    //region gym merchant admin routes
    Route::group(
        ['prefix' => 'gym-admin', 'middleware' => ['merchant.auth', 'revalidate'], 'namespace' => 'GymAdmin', 'as'=>'gym-admin.'], function () {

        // Admin Gym Dashboard Controlller

        // Mark read notifications
        Route::post('markRead', ['as' => 'dashboard.markRead', 'uses' => 'AdminGymDashboardController@markRead']);
        Route::resource('dashboard', 'AdminGymDashboardController', ['only' => ['index', 'markRead']]);

        // Gym Admin Logout Controller

        Route::resource('logout', 'GymAdminLogoutController', ['only' => ['index']]);

        // Gym Admin Base Controller

        Route::get('client/index', ['uses' => 'AdminGymClientsController@index', 'as' => 'client.index']);
        Route::get('client/create', ['uses' => 'AdminGymClientsController@create', 'as' => 'client.create']);
        Route::get('client/show/{ID}', ['uses' => 'AdminGymClientsController@show', 'as' => 'client.show']);
        Route::post('client/store', ['uses' => 'AdminGymClientsController@store', 'as' => 'client.store']);
        Route::post('client/update', ['uses' => 'AdminGymClientsController@update', 'as' => 'client.update']);
        Route::get('client/ajax_create', ['uses' => 'AdminGymClientsController@ajax_create', 'as' => 'client.ajax_create']);
        Route::get('client/remove/modal/{ID}', ['uses' => 'AdminGymClientsController@removeClient', 'as' => 'remove.modal']);
        Route::get('client/calendar/{ID}', ['uses' => 'AdminGymClientsController@calender', 'as' => 'client.calender']);
        Route::get('client/ajax/payments/{ID}', ['uses' => 'AdminGymClientsController@ajax_create_payments', 'as' => 'client.ajax-payments']);
        Route::post('client/save-webcam-image/{id}', ['as' => 'client.save-webcam-image', 'uses' => 'AdminGymClientsController@saveWebCamImage']);
        Route::get('client/remove/{ID}', ['uses' => 'AdminGymClientsController@destroy', 'as' => 'client.destroy']);
        Route::post('gymclient/uploadimage', ['as' => 'gymclient.uploadimage', 'uses' => 'AdminGymClientsController@uploadImage']);
        Route::get('register-enquiry/{ID}', ['uses' => 'AdminGymClientsController@registerEnquiry', 'as' => 'client.register-enquiry']);
        Route::get('client/import', ['uses' => 'AdminGymClientsController@import', 'as' => 'client.import']);
        Route::post('client/import', ['uses' => 'AdminGymClientsController@importUpload', 'as' => 'client.importUpload']);
        Route::get('client/import/match', ['uses' => 'AdminGymClientsController@match', 'as' => 'client.match']);
        Route::post('client/import/process', ['as' => 'client.importProcess', 'uses' => 'AdminGymClientsController@importProcess']);
        Route::post('client/import/checkStatus', ['as' => 'client.checkImportProgress', 'uses' => 'AdminGymClientsController@checkImportProgress']);
        Route::post('client/import/cancel', ['as' => 'client.cancelImport', 'uses' => 'AdminGymClientsController@cancelImport']);
        Route::get('client/import/failed_records', ['as' => 'client.failed_records', 'uses' => 'AdminGymClientsController@failedRecords']);
        Route::get('client/import/downloadFailedRecords', ['as' => 'client.downloadFailedRecords', 'uses' => 'AdminGymClientsController@downloadFailedRecords']);

        // Gym Enquiry Controller
        Route::get('enquiry/index', ['uses' => 'GymEnquiryController@index', 'as' => 'enquiry.index']);
        Route::get('enquiry/ajax/create', ['uses' => 'GymEnquiryController@ajaxCreate', 'as' => 'enquiry.create.ajax']);
        Route::get('enquiry/remove/modal/{ID}', ['uses' => 'GymEnquiryController@removeEnquiry', 'as' => 'enquiry.modal']);
        Route::get('enquiry/follow-modal/{ID}', ['uses' => 'GymEnquiryController@followModal', 'as' => 'enquiry.follow-modal']);
        Route::get('enquiry/view-follow-modal/{ID}', ['uses' => 'GymEnquiryController@viewFollowModal', 'as' => 'enquiry.view-follow-modal']);
        Route::post('enquiry/saveFollowUp', ['uses' => 'GymEnquiryController@saveFollowUp', 'as' => 'enquiry.saveFollowUp']);
        Route::resource('enquiry', 'GymEnquiryController');

        // Gym Setting
        Route::get('setting/mail', ['as' => 'setting.mail', 'uses' => 'GymAdminSettingController@mailPage']);
        Route::post('setting/store-mail-credentials', ['as' => 'setting.storeMailCredentials', 'uses' => 'GymAdminSettingController@storeMailCredentials']);
        Route::get('setting/file-upload', ['as' => 'setting.fileUpload', 'uses' => 'GymAdminSettingController@fileUploadPage']);
        Route::post('setting/store-file-upload-credentials', ['as' => 'setting.storeFileUploadCredentials', 'uses' => 'GymAdminSettingController@storeFileUploadCredentials']);
        Route::get('setting/others', ['as' => 'setting.others', 'uses' => 'GymAdminSettingController@othersPage']);
        Route::post('setting/store-others-setting-credentials', ['as' => 'setting.storeOtherSettingCredentials', 'uses' => 'GymAdminSettingController@storeOtherSettingCredentials']);
        Route::get('setting/footer', ['as' => 'setting.footer', 'uses' => 'GymAdminSettingController@footerPage']);
        Route::post('setting/store-footer-setting-credentials', ['as' => 'setting.storeFooterSettingCredentials', 'uses' => 'GymAdminSettingController@storeFooterSettingCredentials']);
        Route::post('gymsetting/image', ['as' => 'gymsetting.image', 'uses' => 'GymAdminSettingController@image']);
        Route::post('setting/front-image', ['as' => 'setting.frontImage', 'uses' => 'GymAdminSettingController@storeFrontImage']);
        Route::post('setting/customer-image', ['as' => 'setting.customerImage', 'uses' => 'GymAdminSettingController@storeCustomerImage']);

        Route::resource('setting', 'GymAdminSettingController');

        // Gym backup
        Route::get('backup/getbackup/{id}', ['uses' => 'GymAdminbackupController@getbackup', 'as' => 'backup.getbackup']);
        Route::resource('backup', 'GymAdminbackupController');

        // Software update
        Route::resource('upcoming', 'SoftwareUpdateController');

        // Gym Media Controller
        Route::get('media/ajax/create', ['uses' => 'GymMediaController@ajax_create', 'as' => 'media.ajax_create']);
        Route::resource('media', 'GymMediaController');

        // Gym membership resource
        Route::resource('membership', 'GymAdminMembershipController');

        // Gym Feedback Controller
        Route::get('feedback/', ['uses' => 'GymFeedbackController@index', 'as' => 'feedback.index']);
        Route::post('feedback/load/comments', ['uses' => 'GymFeedbackController@ajaxLoadComments', 'as' => 'feedback.load.comments']);
        Route::post('feedback/more/comments', ['uses' => 'GymFeedbackController@loadMoreComments', 'as' => 'feedback.more.comments']);
        Route::post('feedback/reply', ['uses' => 'GymFeedbackController@postReply', 'as' => 'feedback.reply.store']);

        Route::get('feedback/remove/modal/{ID}', ['uses' => 'GymFeedbackController@removeReply', 'as' => 'remove.reply']);
        Route::get('feedback/remove/reply/{ID}', ['uses' => 'GymFeedbackController@destroy', 'as' => 'feedback.destroy']);
        Route::post('feedback/edit/reply', ['uses' => 'GymFeedbackController@edit', 'as' => 'feedback.edit']);


        // Gym Offer Controller
        Route::get('offers/ajax/create', ['uses' => 'GymOfferMangeController@ajax_create', 'as' => 'offers.ajax_create']);
        Route::resource('offers', 'GymOfferMangeController');

        // Package resource
        Route::resource('package', 'GymAdminPackageController');

        // Gym Profile Controller
        Route::resource('profile', 'GymAdminProfileController');
        Route::post('gym/uploadimage', ['as' => 'gym.uploadimage', 'uses' => 'GymAdminProfileController@uploadImage']);

        // Gym Membership Payments
        Route::get('membership-payments/ajax-create', ['uses' => 'GymMembershipPaymentsController@ajax_create', 'as' => 'membership-payment.ajax-create']);

        Route::get('membership-payments/ajax-createdeleted', ['uses' => 'GymMembershipPaymentsController@ajax_create_deleted', 'as' => 'membership-payment.ajax-create-deleted']);
        Route::get('membership-payments/view-receipt/{id}', ['uses' => 'GymMembershipPaymentsController@viewReceipt', 'as' => 'membership-payment.view-receipt']);
        Route::get('membership-payments/email-receipt/{id}', ['uses' => 'GymMembershipPaymentsController@emailReceipt', 'as' => 'membership-payment.email-receipt']);
        Route::get('clientPurchases/{id}', ['as' => 'gympurchase.clientPurchases', 'uses' => 'GymMembershipPaymentsController@clientPurchases']);
        Route::get('clientPayment/{id}', ['as' => 'gympurchase.clientPayment', 'uses' => 'GymMembershipPaymentsController@clientPayment']);
        Route::get('clientEditPayment/{id}', ['as' => 'gympurchase.clientEditPayment', 'uses' => 'GymMembershipPaymentsController@clientEditPayment']);
        Route::get('clientEditPayment/{id}', ['as' => 'gympurchase.clientEditPayment', 'uses' => 'GymMembershipPaymentsController@clientEditPayment']);
        Route::get('remainingPayment/{id}', ['as' => 'gympurchase.remainingPayment', 'uses' => 'GymMembershipPaymentsController@remainingPayment']);
        Route::get('add-payment-modal/{id}', ['as' => 'membership-payments.add-payment-modal', 'uses' => 'GymMembershipPaymentsController@addPaymentModal']);
        Route::post('ajax-payment-store/{id}', ['as' => 'membership-payment.ajax-payment-store', 'uses' => 'GymMembershipPaymentsController@ajaxPaymentStore']);

        Route::resource('membership-payment', 'GymMembershipPaymentsController');

        // Invoice
        Route::get('create-invoice', ['uses' => 'GymInvoiceController@createInvoice', 'as' => 'gym-invoice.create-invoice']);
        Route::post('save-invoice', ['uses' => 'GymInvoiceController@saveInvoice', 'as' => 'gym-invoice.save-invoice']);
        Route::get('generate-invoice/{id}', ['uses' => 'GymInvoiceController@generateInvoice', 'as' => 'gym-invoice.generate-invoice']);
        Route::get('generate-payment-invoice/{id}', ['uses' => 'GymInvoiceController@generatePaymentInvoice', 'as' => 'gym-invoice.generate-payment-invoice']);
        Route::get('download-plan-invoice/{id}', ['uses' => 'GymInvoiceController@downloadInvoice', 'as' => 'gym-invoice.download-invoice']);
        Route::post('email-invoice', ['uses' => 'GymInvoiceController@emailInvoice', 'as' => 'gym-invoice.email-invoice']);
        Route::post('update-gstin', ['uses' => 'GymInvoiceController@updateGstNumber', 'as' => 'gym-invoice.update-gstin']);
        Route::resource('gym-invoice', 'GymInvoiceController');


        Route::get('target/ajax-create', ['uses' => 'GymTargetManageController@ajax_create', 'as' => 'target.ajax-create']);
        Route::resource('target', 'GymTargetManageController');

        Route::get('target-report/ajax-create/{ID}', ['uses' => 'GymTargetReportController@ajax_create', 'as' => 'target-report.ajax-create']);
        Route::resource('target-report', 'GymTargetReportController', ['only' => ['index', 'store']]);

        // GymClientReportController
        Route::get('client-report/ajax-create/{ID}/{SD}/{ED}', ['uses' => 'GymClientReportController@ajax_create', 'as' => 'client-report.ajax-create']);
        Route::resource('client-report', 'GymClientReportController', ['only' => ['index', 'store', 'show']]);

        // GymBookingReportController
        Route::get('booking-report/ajax-create/{ID}/{SD}/{ED}', ['uses' => 'GymBookingReportsController@ajax_create', 'as' => 'booking-report.ajax-create']);
        Route::resource('booking-report', 'GymBookingReportsController', ['only' => ['index', 'store']]);

        // GymFinanceReportController
        Route::get('finance-report/ajax-create/{ID}/{SD}/{ED}', ['uses' => 'GymFinanceReportController@ajax_create', 'as' => 'finance-report.ajax-create']);
        Route::resource('finance-report', 'GymFinanceReportController', ['only' => ['index', 'store']]);

        // GymAttendanceReportController
        Route::get('attendance-report/ajax-create/{ID}/{SD}/{ED}', ['uses' => 'GymAttendanceReportController@ajax_create', 'as' => 'attendance-report.ajax-create']);
        Route::get('attendance-report/ajax-create/attendance/{ID}/{SD}/{ED}/{ST}/{ET}', ['uses' => 'GymAttendanceReportController@ajax_create_attendance', 'as' => 'attendance-report.ajax-create-attendance']);
        Route::resource('attendance-report', 'GymAttendanceReportController', ['only' => ['index', 'store']]);

        // GymClientPurchaseController//payment reminder
        Route::get('client-purchase/reminder', ['uses' => 'GymClientPurchaseController@reminder', 'as' => 'client-purchase.paymentreminder']);
        Route::get('client-purchase/ajax-reminder', ['uses' => 'GymClientPurchaseController@ajax_reminder', 'as' => 'client-purchase.ajax-reminder']);
        Route::get('client-purchase/show-model/{id}', ['uses' => 'GymClientPurchaseController@showModel', 'as' => 'client-purchase.show-model']);
        Route::post('client-purchase/sendReminder', ['uses' => 'GymClientPurchaseController@sendReminder', 'as' => 'client-purchase.sendReminder']);
        Route::get('client-purchase/reminder-history', ['uses' => 'GymClientPurchaseController@reminderHistory', 'as' => 'client-purchase.reminder-history']);
        Route::get('client-purchase/ajax-reminder-history', ['uses' => 'GymClientPurchaseController@ajaxReminderHistory', 'as' => 'client-purchase.ajax-reminder-history']);
        Route::post('client-purchase/sendRenewReminder', ['uses' => 'GymClientPurchaseController@sendRenewReminder', 'as' => 'client-purchase.sendRenewReminder']);

        Route::get('client-purchase/ajax-create', ['uses' => 'GymClientPurchaseController@ajax_create', 'as' => 'client-purchase.ajax-create']);
        Route::get('client-purchase/ajax-create-deleted', ['uses' => 'GymClientPurchaseController@ajax_create_deleted', 'as' => 'client-purchase.ajax-create-deleted']);
        Route::post('client-purchase/amount', ['uses' => 'GymClientPurchaseController@getAmount', 'as' => 'client-purchase.get-amount']);
        Route::get('renew-subscription-modal/{id}', ['uses' => 'GymClientPurchaseController@renewSubscriptionModal', 'as' => 'client-purchase.renew-subscription-modal']);
        Route::post('renew-subscription-store/{id}', ['uses' => 'GymClientPurchaseController@renewSubscriptionStore', 'as' => 'client-purchase.renew-subscription-store']);
        Route::get('client-purchase/user-create/{id}', ['uses' => 'GymClientPurchaseController@userCreate', 'as' => 'client-purchase.user-create']);
        Route::get('show-subscription-reminder-modal/{id}', ['uses' => 'GymClientPurchaseController@subscriptionReminderModal', 'as' => 'client-purchase.show-subscription-reminder-modal']);
        Route::get('client-purchase/pending-subscription', ['uses' => 'GymClientPurchaseController@pendingSubscription', 'as' => 'client-purchase.pending-subscription']);
        Route::get('client-purchase/ajax-pending-subscription', ['uses' => 'GymClientPurchaseController@ajaxPendingSubscription', 'as' => 'client-purchase.ajax-pending-subscription']);
        Route::resource('client-purchase', "GymClientPurchaseController");


        // GymEnquiryReportController
        Route::get('enquiry-report/ajax-create/{ID}/{SD}/{ED}', ['uses' => 'GymEnquiryReportController@ajax_create', 'as' => 'enquiry-report.ajax-create']);
        Route::resource('enquiry-report', 'GymEnquiryReportController', ['only' => ['index', 'store']]);

        Route::get('custom-type/ajax-create', ['uses' => 'GymCustomPaymentTypeController@ajax_create', 'as' => 'custom-type.ajax-create']);
        Route::resource('custom-type', 'GymCustomPaymentTypeController');

        // Package resource
        Route::get('attendance/ajax/create', ['uses' => 'GymAdminAttendanceController@ajax_create', 'as' => 'attendance.ajax_create']);
        Route::get('attendance/ajax/create/{Id}', ['uses' => 'GymAdminAttendanceController@checkin', 'as' => 'attendance.checkin']);
        Route::post('attendance/markAttendance', ['uses' => 'GymAdminAttendanceController@markAttendance', 'as' => 'attendance.markAttendance']);
        Route::resource('attendance', 'GymAdminAttendanceController');

        // Buy gym ace plan
        Route::resource('buy-plan', 'GymMerchantPurchaseController');

        // GymPromotionController
        Route::get('promotion/ajax-create/promotions', ['uses' => 'GymPromotionController@ajax_create_promotions', 'as' => 'promotion.ajax-create-promotions']);
        Route::get('promotion/ajax-create/{FILTER}', ['uses' => 'GymPromotionController@ajax_create', 'as' => 'promotion.ajax-create']);
        Route::resource('promotion', 'GymPromotionController');

        Route::get('my-gym/remove/image/{ID}', ['uses' => 'MyGymController@destroyImage', 'as' => 'my-admin.remove.image']);
        Route::get('my-gym/set-main/image/{ID}', ['uses' => 'MyGymController@setMain', 'as' => 'my-admin.set-main.image']);
        Route::resource('my-gym', 'MyGymController');

        // Merchant Promotional Db
        Route::get('promotion-db/ajax-create', ['uses' => 'GymPromotionalDbController@ajax_create', 'as' => 'promotion-db.ajax-create']);
        Route::resource('promotion-db', 'GymPromotionalDbController');

        // Account setup
        Route::get('account-setup/profile', ['uses' => 'GymAccountSetupController@profile', 'as' => 'account-setup.profile']);
        Route::post('account-setup/profile', ['uses' => 'GymAccountSetupController@profileStore', 'as' => 'account-setup.profileStore']);

        Route::get('account-setup/membership', ['uses' => 'GymAccountSetupController@membership', 'as' => 'account-setup.membership']);
        Route::post('account-setup/membership', ['uses' => 'GymAccountSetupController@membershipStore', 'as' => 'account-setup.membershipStore']);

        Route::get('account-setup/client', ['uses' => 'GymAccountSetupController@client', 'as' => 'account-setup.client']);
        Route::post('account-setup/client', ['uses' => 'GymAccountSetupController@clientStore', 'as' => 'account-setup.clientStore']);

        Route::get('account-setup/subscription', ['uses' => 'GymAccountSetupController@subscription', 'as' => 'account-setup.subscription']);
        Route::post('account-setup/subscription', ['uses' => 'GymAccountSetupController@subscriptionStore', 'as' => 'account-setup.subscriptionStore']);

        Route::get('account-setup/payment', ['uses' => 'GymAccountSetupController@payment', 'as' => 'account-setup.payment']);
        Route::post('account-setup/payment', ['uses' => 'GymAccountSetupController@paymentStore', 'as' => 'account-setup.paymentStore']);
        Route::get('account-setup/complete', ['uses' => 'GymAccountSetupController@complete', 'as' => 'account-setup.complete']);

        // Accept terms & conditions
        Route::post('gym-admin/accept-terms', ['uses' => 'AdminGymDashboardController@acceptTerms', 'as' => 'accept-terms']);

        // Manage Users
        Route::get('users/ajax-create', ['uses' => 'GymAdminManageUsersController@ajaxCreate', 'as' => 'users.ajax-create']);
        Route::get('users/assign-role-modal/{id}', ['uses' => 'GymAdminManageUsersController@assignRoleModal', 'as' => 'users.assign-role-modal']);
        Route::post('users/assign-role-store/{id}', ['uses' => 'GymAdminManageUsersController@assignRoleStore', 'as' => 'users.assign-role-store']);
        Route::resource('users', 'GymAdminManageUsersController');


        // Manage Users
        Route::get('roles/ajax-create', ['uses' => 'GymAdminManageRolesController@ajaxCreate', 'as' => 'gymmerchantroles.ajax-create']);
        Route::get('roles/assign-permission/{id}', ['uses' => 'GymAdminManageRolesController@assignPermission', 'as' => 'gymmerchantroles.assign-permission']);
        Route::post('roles/assign-permission-store/{id}', ['uses' => 'GymAdminManageRolesController@assignPermissionStore', 'as' => 'gymmerchantroles.assign-permission-store']);
        Route::resource('gymmerchantroles', 'GymAdminManageRolesController');

        // Gym software Email promotion
        Route::get('email-promotion/preview-template/{id}', ['uses' => 'GymEmailPromotionController@previewTemplate', 'as' => 'email-promotion.preview-template']);
        Route::get('email-promotion/view-campaign/{id}', ['uses' => 'GymEmailPromotionController@viewCampaign', 'as' => 'email-promotion.view-campaign']);
        Route::get('email-promotion/edit-campaign/{id}', ['uses' => 'GymEmailPromotionController@editCampaign', 'as' => 'email-promotion.edit-campaign']);
        Route::get('email-promotion/ajax-promotions', ['uses' => 'GymEmailPromotionController@ajaxCreate', 'as' => 'email-promotion.ajax-promotions']);
        Route::post('email-promotion/send-promotion', ['uses' => 'GymEmailPromotionController@sendPromotion', 'as' => 'email-promotion.sendPromotion']);
        Route::resource('email-promotion', 'GymEmailPromotionController');


        // Generate I-card
        Route::get('client-list/{filter}', ['uses' => 'GymIdentityCardController@clientList', 'as' => 'i-card.clientList']);
        Route::post('email-qr-code', ['uses' => 'GymIdentityCardController@emailQrCode', 'as' => 'i-card.email-qr-code']);
        Route::resource('i-card', 'GymIdentityCardController');

        // Ace Tutorial
        Route::resource('tutorial', 'GymAdminTutorialController');

        Route::get('agreement', ['as' => "agreement", 'uses' => 'AgreementController@index']);


        //Gym Admin GymExpense Management Controller
        Route::get('remove-expense-modal/{ID}', ['uses' => 'GymAdminExpenseManagementController@removeExpense', 'as' => 'remove-expense-modal']);
        Route::get('get-expense', ['uses' => 'GymAdminExpenseManagementController@getExpense', 'as' => 'expense.get-expense']);
        Route::resource('expense', 'GymAdminExpenseManagementController');

        //Task Management Routes
        Route::get('task/loadmoretask', ['as' => 'task.loadmoretask', 'uses' => 'GymAdminTaskManagementController@loadMoreTask']);
        Route::resource('task', 'GymAdminTaskManagementController', ['except' => 'create', 'show']);

        //Balance Report Routes
        Route::resource('balance-report', 'GymBalanceReportController');

            //region Super Admin Routes
            Route::get('superadmin/get-data', ['as' => 'superadmin.getData', 'uses' => 'GymSuperAdminController@getData']);
            Route::get('superadmin/dashboard', ['as' => 'superadmin.dashboard', 'uses' => 'GymSuperAdminController@showDashboard']);
            Route::get('superadmin/branch/{id?}', ['as' => 'superadmin.branch', 'uses' => 'GymSuperAdminController@branchPage']);
            Route::post('superadmin/store-branch', ['as' => 'superadmin.storeBranchPage', 'uses' => 'GymSuperAdminController@storeBranchPage']);
            Route::get('superadmin/manager/{id?}', ['as' => 'superadmin.manager', 'uses' => 'GymSuperAdminController@managerPage']);
            Route::post('superadmin/store-manager', ['as' => 'superadmin.storeManagerPage', 'uses' => 'GymSuperAdminController@storeManagerPage']);
            Route::get('superadmin/role/{id?}', ['as' => 'superadmin.role', 'uses' => 'GymSuperAdminController@rolePage']);
            Route::post('superadmin/store-role', ['as' => 'superadmin.storeRolePage', 'uses' => 'GymSuperAdminController@storeRolePage']);
            Route::get('superadmin/permission/{id?}', ['as' => 'superadmin.permission', 'uses' => 'GymSuperAdminController@permissionPage']);
            Route::post('superadmin/store-permission', ['as' => 'superadmin.storePermissionPage', 'uses' => 'GymSuperAdminController@storePermissionPage']);
            Route::get('superadmin/complete', ['as' => 'superadmin.complete', 'uses' => 'GymSuperAdminController@completePage']);
            Route::post('superadmin/set-business-id/{id?}', ['as' => 'superadmin.setBusinessId', 'uses' => 'GymSuperAdminController@setBusinessId']);
            Route::post('superadmin/update-role-and-permission', ['as' => 'superadmin.updateRolesAndPermissionPage', 'uses' => 'GymSuperAdminController@updateRolesAndPermissionPage']);
            Route::get('superadmin/get-earning-chart-data', ['as' => 'superadmin.getEarningChartData', 'uses' => 'GymSuperAdminController@getEarningChartData']);
            Route::get('superadmin/get-client-chart-data', ['as' => 'superadmin.getClientChartData', 'uses' => 'GymSuperAdminController@getClientChartData']);
            Route::resource('superadmin', 'GymSuperAdminController');
            //endregion

            //region message routes
            Route::resource('message', 'GymAdminMessageController', ['except' => ['edit', 'destroy']]);
            //endregion
        }
        );
    //endregion

    Route::get('qr-check-in/{url}', ['uses' => 'GymQrCheckinController@qrCodeCheckIn', 'as' => 'gym-qr-check-in']);

    //region customer routes
    Route::group(
        ['namespace' => 'Customer'], function () {
            Route::post('customer/reset-password', ['as' => 'customer.send-reset-link', 'uses' => 'CustomerController@sendResetPasswordLink']);
            Route::get('customer/reset/{token}', ['as' => 'customer.reset-password', 'uses' => 'CustomerController@resetPassword']);
            Route::post('customer/update-password', ['as' => 'customer.update-password', 'uses' => 'CustomerController@updatePassword']);
            Route::post('customer/register-store', ['as' => 'customer.register-store', 'uses' => 'CustomerController@registerStore']);
            Route::get('customer/register', ['as' => 'customer.register','uses' => 'CustomerController@register']);
            Route::get('customer/{provider}/{id?}', ['as' => 'customer.social-login', 'uses' => 'CustomerController@redirectToProvider']);
            Route::get('customer/{provider}/callback', ['uses' => 'CustomerController@handleProviderCallback']);
            Route::resource('customer', 'CustomerController', ['only' => ['index', 'store']]);

            Route::group(
                ['prefix' => 'customer-app', 'as' => 'customer-app.', 'middleware' => ['customer.auth', 'revalidate']], function () {
                    Route::get('logout', ['as' => 'logout', 'uses' => 'CustomerController@customerLogout']);

                    //region dashboard routes
                    Route::post('markRead', ['as' => 'dashboard.markRead', 'uses' => 'CustomerDashboardController@markRead']);
                    Route::resource('dashboard', 'CustomerDashboardController', ['only' => ['index']]);
                    //endregion

                    //region profile routes
                    Route::post('profile/upload-webcam-image/{id?}', ['as' => 'profile.upload-webcam-image', 'uses' => 'CustomerProfileController@uploadWebcamImage']);
                    Route::post('profile/upload-image',['as' => 'profile.upload-image', 'uses' => 'CustomerProfileController@uploadImage']);
                    Route::resource('profile', 'CustomerProfileController', ['only' => ['index', 'store']]);
                    //endregion

                    //region subscriptions routes
                    Route::get('manage-subscription/get-membership', ['as' => 'manage-subscription.get-membership', 'uses' => 'CustomerManageSubscriptionController@getMembership']);
                    Route::get('manage-subscription/get-membership-amount', ['as' => 'manage-subscription.get-membership-amount', 'uses' => 'CustomerManageSubscriptionController@getMembershipAmount']);
                    Route::get('manage-subscription/get-data', ['as' => 'manage-subscription.get-data', 'uses' => 'CustomerManageSubscriptionController@getData']);
                    Route::resource('manage-subscription', 'CustomerManageSubscriptionController', ['except' => ['edit', 'update']]);
                    //endregion

                    //region payments routes
                    Route::get('payments/due-payments', ['as' => 'payments.due-payments', 'uses' => 'CustomerPaymentController@duePayments']);
                    Route::get('payments/get-due-payment-data', ['as' => 'payments.get-due-payment-data', 'uses' => 'CustomerPaymentController@getDuePaymentData']);
                    Route::get('payments/get-payment-data', ['as' => 'payments.get-payment-data', 'uses' => 'CustomerPaymentController@getPaymentData']);
                    Route::get('payments/download-invoice/{id}', ['as' => 'payments.download-invoice', 'uses' => 'CustomerPaymentController@downloadInvoice']);
                    Route::resource('payments', 'CustomerPaymentController', ['only' => ['index']]);
                    //endregion

                    //region attendance routes
                    Route::resource('attendance', 'CustomerAttendanceController', ['only' => ['index']]);
                    //endregion

                    //region message routes
                    Route::resource('message', 'CustomerMessageController', ['except' => ['edit', 'destroy']]);
                    //endregion
                }
            );
        }
    );
    //endregion
});
