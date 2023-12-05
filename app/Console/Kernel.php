<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        //otomatis hapus peminjaman yang belum disetujui selama 1 minggu
        $schedule->call(function(){
            $peminjaman = DB::table('peminjaman')->whereDate('tanggal_peminjaman', '<=' ,date('Y-m-d', time()-7*24*60*60));
            $buku = DB::table('books')->where('id',$peminjaman->value('book_id'));
            $peminjaman->delete();
            $buku->increment('jumlah_tersedia');
        })->daily();


        //hapus peminjaman jika stok buku yang dipinjam habis
        $schedule->call(function(){
            $buku = DB::table('books')->where('stok',0);
            $id_buku = $buku->where('stok',0)->value('id');
            foreach($id_buku as $i){
                DB::table('peminjaman')->where('book_id', $i)->delete();
            }
        })->daily();
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
