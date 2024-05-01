<?php

namespace App\Services;

use App\Adapters\PdfAdapterInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfGeneratorService implements PdfAdapterInterface
{

    public function generateFromView(string $view, array $data = [])
    {
        return Pdf::loadView($view, $data)->stream('invoice.pdf');
    }
}
