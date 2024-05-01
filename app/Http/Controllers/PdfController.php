<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Services\PdfGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function __construct(private readonly PdfGeneratorService $pdfGenerator)
    {
    }

    public function generate(Request $request)
    {
        $user = User::firstWhere('api_key', '=', $request->header('X-API-KEY'));
        $company = $user->company;

        $pdf = $this->pdfGenerator->generateFromView(
            "invoice-templates.template{$user->template_id}",
            array_merge($request->all(), [
                "company_logo" => public_path('storage/'.$company?->logo),
                "company_name" => $company?->name,
                "company_address" => $company?->address,
            ])
        );

        $pdfPath = 'invoices/' . uniqid() . '.pdf';
        Storage::put($pdfPath, $pdf);

        $invoice = new Invoice();
        $invoice->user_id = $user->id;
        $invoice->path = $pdfPath;
        $invoice->save();

        return response()->json(['message' => 'Invoice generated successfully', 'invoice_id' => $invoice->id]);
    }

    public function download(Invoice $invoice, Request $request)
    {
        if ($invoice->user->api_key !== $request->header('X-API-KEY')) {
            response()->json(['error' => 'Forbidden'], 403);
        }

        return Storage::download($invoice->path);
    }
}
