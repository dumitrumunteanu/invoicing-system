<?php

namespace App\Adapters;

interface PdfAdapterInterface
{
    public function generateFromView(string $view, array $data);
}
