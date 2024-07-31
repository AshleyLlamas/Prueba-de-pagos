<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

Route::resource('invoices', InvoiceController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.invoices');
