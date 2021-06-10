<?php

namespace App\Console\Commands;

use App\Membresia;
use Illuminate\Console\Command;

use DB;

class MembresiasMora extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membresias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambiar estado de membresia';

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

        $now = new \DateTime();
        $date = $now->format('y-m-d');

        $totalMembresias = DB::table('membresias')
                ->where('fecha_fin', '<', $date)
                ->where('id_estado', 1)
                ->get();

                foreach ($totalMembresias as $totalMembresia)
                {

                       $Membresia = Membresia::find($totalMembresia->id);
                       $Membresia->id_estado_membresia = 2;
                       $Membresia->save();
                }

        return 'ok';

        }
}
