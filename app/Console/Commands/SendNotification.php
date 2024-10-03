<?php

namespace App\Console\Commands;

use App\Jobs\EnviarRecordatoriosJob;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia Correos electronicos cuando se acerca la fecha de vencimiento de la documentacion entragada';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        EnviarRecordatoriosJob::dispatch();
        $this->info('Job ejecutado exitosamente.');   
     }
}
