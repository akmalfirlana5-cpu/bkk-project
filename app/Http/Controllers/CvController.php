<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CvController extends Controller
{
    public function generate()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $user->load(['portfolios', 'pklExperiences']);

        $pdf = Pdf::loadView('pdf.cv-template', compact('user'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('CV-' . str_replace(' ', '_', $user->full_name) . '.pdf');
    }

    /**
     * Tampilkan CV yang diupload alumni via signed URL (diakses oleh HRD/Dudi).
     * URL ditandatangani secara kriptografis & kedaluwarsa otomatis.
     */
    public function generateForUser(Request $request, User $user)
    {
        // Validasi signature URL — jika dipalsukan atau kedaluwarsa, tolak
        if (!$request->hasValidSignature()) {
            abort(403, 'Link tidak valid atau sudah kedaluwarsa.');
        }

        // Jika user belum upload CV
        if (empty($user->CVuser)) {
            abort(404, 'Kandidat ini belum mengupload CV.');
        }

        $filePath = storage_path('app/public/' . $user->CVuser);

        if (!file_exists($filePath)) {
            abort(404, 'File CV tidak ditemukan.');
        }

        $mimeType = mime_content_type($filePath);
        $fileName = 'CV-' . str_replace(' ', '_', $user->full_name) . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return response()->file($filePath, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }

    /**
     * Generate signed URL untuk dipakai oleh HRD di Kanban.
     * URL akan kedaluwarsa dalam 30 menit.
     */
    public static function signedCvUrl(User $user): string
    {
        return URL::temporarySignedRoute(
            'cv.view-user',
            now()->addMinutes(30),
            ['user' => $user->id]
        );
    }
}
