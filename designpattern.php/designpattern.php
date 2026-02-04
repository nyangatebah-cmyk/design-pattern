<?php
// Target interface
interface ReportGenerator {
    public function generate(string $content): void;
}

// Adaptee 1: DomPdf
class DomPdfService {
    public function renderPdf(string $html): void {
        echo "Generating PDF with DomPdf: $html\n";
    }
}

// Adaptee 2: TCPdf
class TcpPdfService {
    public function outputPdf(string $html): void {
        echo "Generating PDF with TCPdf: $html\n";
    }
}

// Adapter for DomPdf
class DomPdfAdapter implements ReportGenerator {
    private DomPdfService $domPdf;

    public function __construct(DomPdfService $domPdf) {
        $this->domPdf = $domPdf;
    }

    public function generate(string $content): void {
        $this->domPdf->renderPdf($content);
    }
}

// Adapter for TCPdf
class TcpPdfAdapter implements ReportGenerator {
    private TcpPdfService $tcpPdf;

    public function __construct(TcpPdfService $tcpPdf) {
        $this->tcpPdf = $tcpPdf;
    }

    public function generate(string $content): void {
        $this->tcpPdf->outputPdf($content);
    }
}

// Client code
function createReport(ReportGenerator $generator, string $content) {
    $generator->generate($content);
}

createReport(new DomPdfAdapter(new DomPdfService()), "Report with DomPdf");
createReport(new TcpPdfAdapter(new TcpPdfService()), "Report with TCPdf");