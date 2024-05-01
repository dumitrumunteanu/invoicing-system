<?php

namespace App\Http\Controllers;

use App\Services\PdfGeneratorService;

class PdfPreviewController  extends Controller
{
    public function __construct(private readonly PdfGeneratorService $pdfGeneratorService)
    {

    }
    public function __invoke(int $id)
    {
        $user = request()->user();

        return $this->pdfGeneratorService->generateFromView("invoice-templates.template$id", [
            "company_logo" => public_path('storage/'.$user->company?->logo),
            "company_name" => $user->company?->name,
            "company_address" => $user->company?->address,
            "table_headers" => ["Column 1", "Column 2", "Column 3"],
            "table_rows" => [
                ["Item 1", "Property 1", "Price 1"],
                ["Item 2", "Property 2", "Price 2"],
            ],
            "total" => "$1234.00"
        ]);
    }
}
