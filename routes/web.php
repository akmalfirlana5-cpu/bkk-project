<?php

use App\Livewire\Faq;
use App\Livewire\Login;
use App\Livewire\Contact;
use App\Livewire\Homepage;
use App\Livewire\Profil\VisiMisi;
use App\Livewire\Vacancy\Vacancy;
use App\Livewire\Profil\WorkProgram;
use App\Livewire\Profil\ActivityFlow;
use Illuminate\Support\Facades\Route;
use App\Livewire\User\FillTracerStudy;
use App\Livewire\Vacancy\VacancyDetail;
use App\Livewire\Information\TracerStudy;
use App\Livewire\Information\Announcement;
use App\Http\Controllers\ProfileController;
use App\Livewire\Profil\SupportingDocuments;
use App\Livewire\Profil\OrganizationStructure;
use App\Livewire\Information\AnnouncementDetail;
use App\Livewire\User\ApplicationHistory\ApplicationHistory;
use App\Livewire\User\Profile\PersonalData;

Route::get('/', Homepage::class)->name('beranda');
Route::get('/faq', Faq::class)->name('faq');
Route::get('/kontak', Contact::class)->name('kontak');

// ProfilRoute
Route::get('/visi-misi', VisiMisi::class)->name('visi-misi')->prefix('profil');
Route::get('/struktur-organisasi', OrganizationStructure::class)->name('struktur-organisasi')->prefix('profil');
Route::get('/program-kerja', WorkProgram::class)->name('program-kerja')->prefix('profil');
Route::get('/alur-kegiatan', ActivityFlow::class)->name('alur-kegiatan')->prefix('profil');
Route::get('/dokumen-pendukung', SupportingDocuments::class)->name('dokumen-pendukung')->prefix('profil');

// Informasi dan berita route
Route::get('/pengumuman', Announcement::class)->name('pengumuman');
Route::get('/pengumuman/detail/{id}', AnnouncementDetail::class)->name('pengumuman-detail');
Route::get('/tracer-study', TracerStudy::class)->name('tracer-study');

// Lowongan
Route::get('/lowongan', Vacancy::class)->name('lowongan');
Route::get('/lowongan/detail/{id}', VacancyDetail::class)->name('lowongan-detail');

// Route User Login

use App\Livewire\User\SuccessTracerStudy;

Route::middleware('auth.modal')->group(function () {
    Route::get('/isi-tracer-study', FillTracerStudy::class)->middleware('auth.modal')->name('isi-tracer-study')->prefix('user');
    Route::get('/tracer-study-sukses', SuccessTracerStudy::class)->middleware('auth.modal')->name('tracer-study-sukses')->prefix('user');
    Route::get('/data-pribadi', PersonalData::class)->middleware('auth.modal')->name('data-pribadi')->prefix('user');
    Route::get('/riwayat-lamaran', ApplicationHistory::class)->middleware('auth.modal')->name('riwayat-lamaran')->prefix('user');
}); 
