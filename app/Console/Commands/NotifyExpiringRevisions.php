<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ExpiringRevisions;
use Notification;

class NotifyExpiringRevisions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      $revisions_count = \App\Mantenimiento::ofMonth()->pending()->count();
      $users = \App\User::where('role_id', 1)->get();
      Notification::send( $users, new ExpiringRevisions( $revisions_count ) );
    }
}
