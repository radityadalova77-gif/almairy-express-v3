    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\PengirimanController;
    use App\Http\Controllers\TrackingController;
    use App\Http\Controllers\InvoiceController;
    use App\Http\Controllers\PelangganController;
    use App\Http\Controllers\LaporanController;
    use App\Http\Controllers\HargaController;

    /*
    |--------------------------------------------------------------------------
    | FRONTEND PUBLIC
    |--------------------------------------------------------------------------
    */

    Route::redirect('/', '/beranda');

    Route::get('/beranda', function () {
        return view('frontend.home');
    })->name('frontend.home');

    Route::get('/tentang', function () {
        return view('frontend.tentang');
    })->name('frontend.tentang');

    Route::get('/layanan', function () {
        return view('frontend.layanan');
    })->name('frontend.layanan');

    Route::get('/kontak', function () {
        return view('frontend.kontak');
    })->name('frontend.kontak');




    /*
    |--------------------------------------------------------------------------
    | TRACKING FRONTEND
    |--------------------------------------------------------------------------
    */

    Route::get('/tracking', function () {
        return view('frontend.tracking');
    })->name('frontend.tracking');


    Route::get('/tracking/{resi}', [TrackingController::class, 'show'])
        ->name('tracking.show');


    /*
    |--------------------------------------------------------------------------
    | TRACKING API
    |--------------------------------------------------------------------------
    */

    Route::get('/tracking/cari', [TrackingController::class, 'cari'])
        ->name('tracking.cari');


    /*
    |--------------------------------------------------------------------------
    | CLIENT DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/client-dashboard', [DashboardController::class, 'client'])
        ->name('client.dashboard');
    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | PROTECTED ADMIN AREA
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/admin/tracking', [TrackingController::class, 'index'])
            ->middleware('role:Admin,Operasional,Kepala Toko')
            ->name('tracking.index');

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Pengiriman
        |--------------------------------------------------------------------------
        */

        Route::get('/pengiriman', [PengirimanController::class, 'index'])
            ->name('pengiriman.index');

        Route::get('/pengiriman/riwayat-hapus', [PengirimanController::class, 'riwayatHapus'])
            ->name('pengiriman.riwayat-hapus');

        Route::get('/pengiriman/export', [PengirimanController::class, 'exportData'])
            ->name('pengiriman.export');

        Route::post('/pengiriman', [PengirimanController::class, 'store'])
            ->middleware('role:Admin,Operasional')
            ->name('pengiriman.store');

        Route::get('/pengiriman/{pengiriman}', [PengirimanController::class, 'show'])
            ->name('pengiriman.show');

        Route::get('/pengiriman/{pengiriman}/edit', [PengirimanController::class, 'edit'])
            ->middleware('role:Admin,Operasional')
            ->name('pengiriman.edit');

        Route::put('/pengiriman/{pengiriman}', [PengirimanController::class, 'update'])
            ->middleware('role:Admin,Operasional')
            ->name('pengiriman.update');

        Route::delete('/pengiriman/{pengiriman}', [PengirimanController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('pengiriman.destroy');

        Route::patch('/pengiriman/{pengiriman}/status', [PengirimanController::class, 'updateStatus'])
            ->middleware('role:Admin,Operasional')
            ->name('pengiriman.update-status');

        Route::post('/pengiriman/{id}/restore', [PengirimanController::class, 'restore'])
            ->middleware('role:Admin')
            ->name('pengiriman.restore');

        /*
        |--------------------------------------------------------------------------
        | Tracking
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/tracking/{pengiriman}/history',
            [TrackingController::class, 'tambahHistory']
        )->middleware('role:Admin,Operasional')
            ->name('tracking.tambah-history');

        Route::get(
            '/tracking/{pengiriman}/create',
            [TrackingController::class, 'create']
        )->middleware('role:Admin,Aperasional')
            ->name('tracking.create');

        Route::post(
            '/tracking/store',
            [TrackingController::class, 'store']
        )->middleware('role:Admin,Aperasional')
            ->name('tracking.store');

        /*
        |--------------------------------------------------------------------------
        | Invoice
        |--------------------------------------------------------------------------
        */

        Route::get('/invoice', [InvoiceController::class, 'index'])
            ->name('invoice.index');

        Route::post('/invoice', [InvoiceController::class, 'store'])
            ->middleware('role:Admin,Aperasional')
            ->name('invoice.store');

        Route::get('/invoice/export/{id}', [InvoiceController::class, 'export'])
            ->name('invoice.export');

        Route::post('/invoice/{id}/bayar', [InvoiceController::class, 'bayar'])
            ->middleware('role:Admin,Operasional')
            ->name('invoice.bayar');

        Route::post('/invoice/{id}/void', [InvoiceController::class, 'void'])
            ->middleware('role:Admin')
            ->name('invoice.void');

        Route::post('/invoice/{id}/reminder', [InvoiceController::class, 'reminder'])
            ->name('invoice.reminder');

        Route::get('/invoice/{id}/print', [InvoiceController::class, 'show'])
            ->name('invoice.print');

        Route::get('/invoice/{id}/pdf', [InvoiceController::class, 'pdf'])
            ->name('invoice.pdf');

        /*
        |--------------------------------------------------------------------------
        | Laporan
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->middleware('role:Admin,Kepala Toko')
            ->name('laporan.index');

        Route::get('/laporan/export', [LaporanController::class, 'export'])
            ->name('laporan.export');

        Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.pdf');

        /*
        |--------------------------------------------------------------------------
        | Pelanggan
        |--------------------------------------------------------------------------
        */

        Route::get('/pelanggan', [PelangganController::class, 'index'])
            ->name('pelanggan.index');

        Route::get('/pelanggan/create', [PelangganController::class, 'create'])
            ->name('pelanggan.create');

        Route::post('/pelanggan', [PelangganController::class, 'store'])
            ->middleware('role:Admin,Operasional')
            ->name('pelanggan.store');

        Route::get('/pelanggan/{pelanggan}', [PelangganController::class, 'show'])
            ->name('pelanggan.show');

        Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])
            ->middleware('role:Admin,Operasional')
            ->name('pelanggan.edit');

        Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])
            ->middleware('role:Admin,Operasional')
            ->name('pelanggan.update');

        Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('pelanggan.destroy');

        /*
        |--------------------------------------------------------------------------
        | Harga
        |--------------------------------------------------------------------------
        */

        Route::get('/harga', [HargaController::class, 'index'])
            ->middleware('role:Admin,Operasional,Kepala Toko')
            ->name('harga.index');

        Route::post('/harga', [HargaController::class, 'store'])
            ->middleware('role:Admin,Operasional')
            ->name('harga.store');

        Route::get('/harga/{harga}/edit', [HargaController::class, 'edit'])
            ->middleware('role:Admin,Operasional')
            ->name('harga.edit');

        Route::put('/harga/{harga}', [HargaController::class, 'update'])
            ->middleware('role:Admin,Operasional')
            ->name('harga.update');

        Route::delete('/harga/{harga}', [HargaController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('harga.destroy');
    });
