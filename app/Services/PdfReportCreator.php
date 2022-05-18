<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Office;
use App\Models\Question;
use App\Models\Service;
use App\Models\SignatorySettings;
use Illuminate\Support\Facades\Auth;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Exceptions\Node\Exception;

final class PdfReportCreator
{
    public function execute($office, $monthFrom, $monthTo)
    {
        $data = $this->getTemplateData($office, $monthFrom, $monthTo);
        $content = view('report', $data)->render();
        $filePath = $this->getFilePath($office, $monthFrom, $monthTo);
        $browser = $this->getBrowser();

        try {
            $page = $browser->newPage();
            $this->setPageStyle($page, $content, $filePath);
            $browser->close();

            return $filePath;
        } catch (Exception $exception) {
            // Handle the exception...
            dd($exception);
        }
    }

    private function getTemplateData($office, $monthFrom, $monthTo): array
    {
        $stats = $this->getStats($office, $monthFrom, $monthTo);
        $signatory = $this->getSignatory();

        return [
            'stats' => $stats,
            'office' => Office::find($office)->name,
            'month' => [
                'from' => $monthFrom,
                'to' => $monthTo ?: null
            ],
            'preparer' => [
                'name' => Auth::user()->name,
                'position' => Auth::user()->position
            ],
            'reviewer' => [
                'name' => $signatory->reviewer_name,
                'position' => $signatory->reviewer_position
            ],
            'noter' => [
                'name' => $signatory->noter_name,
                'position' => $signatory->noter_position
            ]
        ];
    }

    private function getStats($office, $monthFrom, $monthTo)
    {
        $stats = [
            'services' => [],
            'total' => []
        ];

        if ($office && $monthFrom) {
            $reportStats = new ReportData(new Question(), new Service());
            $stats = $reportStats->get($office, $monthFrom, $monthTo);
        }
        return $stats;
    }

    private function getSignatory()
    {
        $signatory = SignatorySettings::first();
        if (!$signatory) {
            $signatory = [
                'reviewer' => [
                    'name' => '--NOT SET--',
                    'position' => '--NOT SET--'
                ],
                'noter' => [
                    'name' => '--NOT SET--',
                    'position' => '--NOT SET--'
                ]
            ];
        }
        return $signatory;
    }

    private function getBrowser()
    {
        $puppeteer = new Puppeteer([
            'executable_path' => env('NODE_BIN', '/usr/bin/node'),
            'log_node_console' => true,
            'log_browser_console' => true
        ]);

        return $puppeteer->launch();
    }

    private function setPageStyle($page, string $content, string $filePath): void
    {
        $page->goto('data:text/html,' . $content, [
            'waitUntil' => 'networkidle2'
        ]);
        $page->addStyleTag([
            'path' => public_path('css/app.css')
        ]);
        $page->addStyleTag([
            'path' => public_path('css/print.css')
        ]);
        $page->tryCatch->pdf([
            'path' => $filePath,
            'format' => 'Letter',
            'printBackground' => true,
            'landscape' => true,
            'margin' => [
                'top' => 50,
                'right' => 50,
                'bottom' => 50,
                'left' => 70]
        ]);
    }

    private function getFilePath($office, $monthFrom, $monthTo): string
    {
        $filename = Office::find($office)->abbr . '-' . $monthFrom . ($monthTo ? '-' . $monthTo : '') . '.pdf';
        return storage_path('/app/reports/' . $filename);
    }
}
