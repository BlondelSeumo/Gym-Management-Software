<?php

use Illuminate\Database\Seeder;
use App\Models\SoftwareUpdate;
use App\Models\Category;

class SoftwareUpdateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $softwareUpdates = [
            'Major functionality Updates' => [
                'We have done major changes to the core functionality. Here are the updates:-<br><ul><li>Customer height will now be in feet and inches. Earlier it was in cm.</li><li>Age of customer will be calculated automatically.</li><li>Discount will be calculated automatically when you add subscription for customer.</li><li>Track who generated the invoice.</li></ul>',
                '2016-07-23',
            ],
            'Renew Customer Subscriptions' => [
                'You can now renew your customer subscriptions directly from the subscription table. The major advantage of this feature is that you will not have to re-enter the customer details.',
                '2016-07-24',
            ],
            'New Enquiry Form' => [
                'We have completely revamped the enquiry form for your business. New enquiry form will allow you to manage every new&nbsp;follow up of a customer separately. You can also track who talked to your customer in &nbsp;previous visit.<br><br>New enquiry form allows you to register your customer directly from the enquiry table. You will not have the enter the customer data again to register.',
                '2016-07-26',
            ],
            'Faster payments' => [
                'You can now add payments more faster for your customers. You can now go to due payments or customer subscriptions table and add payment directly from there.',
                '2016-07-22'
            ],
            'Import old data' => [
                'We are excited to tell you that with this new feature you can upload your old clients data. It is a very simple process to upload the csv files. <b>Note:</b> Only csv files are supported. If you have excel files, than save it as csv file before import.<br><br>To upload goto <b>Manage -&gt; Customers</b> and click on <b>Import Customers</b>&nbsp;button.',
                '2016-08-04',
            ],
            'New Quick Links Menu' => [
                'We have created a quick links menu in top header with links which you may frequently use. Let us know if you need other links in that menu.',
                '2016-08-05',
            ],
            'Faster Customer Registration' => [
                'To improve your experience of registering the customer we have made few fields optional like height and weight.<br><br>This will make your customer registration process faster.',
                '2016-08-08',
            ],
            'Create users with limited permissions' => [
                'With this feature you can create new users with limited permissions to use the software. Click on User permissions under your profile icon dropdown to start.',
                '2016-08-10',
            ],
            'Email Promotions' => [
                'You can now send the email promotions/offers&nbsp;to your customers. Go to <b>Promotions -&gt; Email Promotion</b> in menu to try it now.',
                '2016-10-10',
            ],
            'Send Subscription Reminder' => [
                'We have introduced a new feature by which you can see the list of clients whose subscription is expiring in next 45 days on the dashboard. You can send email &amp; SMS&nbsp;reminder to these clients.<br><br><span>You can also do the same from the manage subscription section.</span>',
                '2017-05-30',
            ],
            'Added mobile and email field in invoice form' => [
                'We have added email and invoice fields in invoice generation form. By this, you will not have to re-enter the email again when sending the invoice via email.',
                '2017-06-10',
            ],
            '3 new features added' => [
                'We are here with set of new features for you<br><ul><li><b>Expense Management -&nbsp;</b>You can now add all your gym expenses in manage expenses section.</li><li><b>Task Management -&nbsp;</b>You can now add the tasks for you, set deadlines and get a reminder for the task. Check manage tasks section.</li><li><b>Expense vs Income Report -&nbsp;</b>We have added a new report section to analyze the income and expenses for your business. Check Balance reports in the Reports section.</li></ul>',
                '2017-09-01',
            ],
            'Manage Multiple Branches' => [
                'You can now manage multiple branches from a single admin. To change the current branch use top dropdown.',
                '2018-01-12',
            ],
        ];

        $category = Category::first();
        foreach($softwareUpdates as $softwareUpdate => $data) {
            SoftwareUpdate::create([
                'category_id' => $category->id,
                'title' => $softwareUpdate,
                'details' => $data[0],
                'date' => $data[1],
            ]);
        }
    }
}
