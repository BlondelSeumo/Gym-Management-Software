<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NewVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitsigma:version {version}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to version the script';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
       $version = $this->argument('version');
       $folder = 'fitsigma'.$version;
       $path = '../versions/'.$folder;
       $local = '../dev/';

       $this->info('Creating Versions....');
       $this->info('Removing Old '.$folder.' folder to create the new');
       echo  exec('rm -rf '.$path.'/');

       $this->info('Creating the directory '.$folder.'/script');
       echo  exec('mkdir -p '.$path.'/script');

       $this->info('Copying files from '.$local.' '.$path.'/script');
       echo  exec('rsync -av --progress '.$local.' '.$path.'/script --exclude=".git" --exclude=".phpintel" --exclude=".env"');

       $this->info('Creating the directory '.$path.'/script');
       echo  exec('mkdir -p '.$path.'/script');

       $this->info('Removing installed');
       echo  exec('rm -rf '.$path.'/script/storage/installed');

       $this->info('Delete Storage Folder Files');
       echo  exec('rm -rf '.$path.'/script/public/storage'); 
       echo  exec('rm -rf '.$path.'/script/public/uploads/*'); 
       echo  exec('rm -rf '.$path.'/script/storage/framework/views/*'); 
       echo  exec('rm -rf '.$path.'/script/storage/framework/sessions/*'); 
       echo  exec('rm -rf '.$path.'/script/storage/logs/*'); 

       $this->info('Removing symlink');
       echo  exec('find '.$path.'/script/storage/app/public \! -name ".gitignore" -delete');


       $this->info('Copying .env.example to .env');
       echo  exec('cp '.$path.'/script/.env.example '.$path.'/script/.env');

       $this->info('removing old version.txt file');
       echo  exec('rm '.$path.'/script/public/version.txt');

       $this->info('Copying version to know the version to version.txt file');
       echo  exec('echo '.$version.'>> '.$path.'/script/public/version.txt');

       $this->info('Moving script/documentation to separate folder');
       echo  exec('mv '.$path.'/script/documentation '.$path.'/documentation/');
    
       // Zipping the folder 
       $this->info('Zipping the folder');
       echo  exec('cd ../versions; zip -r '.$folder.'.zip '.$folder.'/');
    }


}
