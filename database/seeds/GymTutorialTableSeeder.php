<?php

use Illuminate\Database\Seeder;
use App\Models\GymTutorial;

class GymTutorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tutorials = [
            '#1 Account Setup' => [
                'This tutorial explains the account setup process when you login for the first time.',
                '<iframe width="853" height="480" src="https://www.youtube.com/embed/4OjF5aSMX9k" frameborder="0" allowfullscreen></iframe>',
            ],
            '#2 Update Profile & Settings' => [
                'Learn how to update your profile information, business logo and address.',
                '<iframe width="853" height="480" src="https://www.youtube.com/embed/3vggzSXOOQA" frameborder="0" allowfullscreen></iframe>',
            ],
            '#3 Manage Memberships' => [
                'Learn how to add new membership, update the existing membership or delete it.',
                '<iframe width="853" height="480" src="https://www.youtube.com/embed/2oBYA4ulxi8" frameborder="0" allowfullscreen></iframe>',
            ],
            '#4 Manage Customers' => [
                'This tutorial shows you how to add customers.',
                '<iframe width="853" height="480" src="https://www.youtube.com/embed/diRB9Xpi_o4" frameborder="0" allowfullscreen></iframe>',
            ],
            '#5 Import Old Customers' => [
                'Learn how to import old customers data in the ace gym software app.',
                '<iframe width="853" height="480" src="https://www.youtube.com/embed/DNmc3lp5snw" frameborder="0" allowfullscreen></iframe>',
            ],
        ];

        foreach ($tutorials as $tutorial => $data) {
            GymTutorial::create([
                'title' => $tutorial,
                'description' => $data[0],
                'iframe_code' => $data[1],
            ]);
        }
    }
}
