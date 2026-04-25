<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function generate()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $user->load('portfolios');

        $pdf = Pdf::loadView('pdf.cv-template', compact('user'));

        // You can set paper size here
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('CV-' . str_replace(' ', '_', $user->full_name) . '.pdf');
        // or $pdf->download(...) to force download immediately
    }
}
