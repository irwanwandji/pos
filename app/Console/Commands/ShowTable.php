<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:record {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show data table from database';

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
     * @return int
     */
    public function handle()
    {
        /*
            namespace model berdasar argumen {model},
            $this->argument() digunakan untuk mengambil nilai dari argumen {model}
            pada property $signature
        */
        $model = '\App\Models\\'.$this->argument('model');

        // jika namespace class model tersedia
        if (class_exists($model)){
            // Ambil semua data pada model
            $table = $model::all();
            // $product = \App\Models\Product::all();

            // mengambil semua nama field tabel dari salah satu record data
            $fields = array_keys($table[0]->getAttributes());

            // memasukan seluruh data ke dalam array
            $table_data_row = $table->toArray();

            // membuat tampilan tabel pada console berdasar nama fields dan seluruh data
            $this->table($fields, $table_data_row);
        // jika namespace class model tidak tersedia
        } else {
            // menampilkan error pada console
            $this->error('Model '. $this->argument('model'). ' does not exist');
        }
    }
}
