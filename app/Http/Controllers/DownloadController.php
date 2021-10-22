<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;

class DownloadController extends Controller
{
    public function letterPDF(Customer $customer) {
        $content = $customer->toHtml();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($content);
        $fileName = "Hesabat #{$customer->id}";
        $mpdf->SetTitle($fileName);
        $storagePath = storage_path("letters/$fileName.pdf");
        File::put($storagePath, $mpdf->Output());
        return response()->download(
            $storagePath,
            "$fileName.pdf"
        );
    }
}
