<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function downloadPDF()
    {
        // Configure Dompdf according to your needs
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // Instantiate Dompdf with the options
        $dompdf = new Dompdf($options);

        // Load HTML content
        $html = view('pdf_view')->render(); // Ensure the 'pdf_view' blade template has the HTML content

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('analytics.pdf', ['Attachment' => 0]);
    }
}
