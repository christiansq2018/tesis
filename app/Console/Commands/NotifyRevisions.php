<?php

namespace App\Console\Commands;

use App\Notifications\MonthRevisions;
use Illuminate\Console\Command;
use Notification;

class NotifyRevisions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:revisions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica a los usuarios la cantidad de mantenimientos agendados para el mes actual';

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
      Notification::send( $users, new MonthRevisions( $revisions_count ) );
    }
}
