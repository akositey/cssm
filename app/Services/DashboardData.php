<?php
namespace App\Services;

use App\Models\Office;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class DashboardData
{
    /**
     * @var \App\Models\Office
     */
    private $office;

    /**
     * @param Office $office
     */
    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    /**
     * @param string $month
     * @return mixed
     */
    public function getStatsThisMonth(string $month): array
    {

        $feedback = $this->office->feedback()->with('answers')->filter(['month' => $month])
            ->get();

        $lastDate = new CarbonImmutable($month);
        $lastDate->endOfMonth();

        $chartDataByDate = $transcriptionTotalByDate = $transcriptionDoneByDate = array_fill(1, +$lastDate->format('t'), 0);
        foreach ($feedback as $feed) {
            /** @var \App\Models\Feedback $feed */
            $currentDay = $feed->created_at->format('j');
            ++$chartDataByDate[$currentDay];
            $transcriptionTotalByDate[$currentDay] += (int)$feed->hasCommentImage();
            $transcriptionDoneByDate[$currentDay] += (int)$feed->commentImageHasBeenTranscribed();
        }

        return [
            'labels' => array_keys($chartDataByDate),
            'datasets' => [
                [
                    'label' => "Number of Feedback",
                    'data' => array_values($chartDataByDate)
                ],
                [
                    'label' => "with Additional Comments",
                    'data' => array_values($transcriptionTotalByDate)
                ],
                [
                    'label' => "Transcribed Comments",
                    'data' => array_values($transcriptionDoneByDate)
                ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function getStatsThisPastYear()
    {
        $chartData = [
            'labels' => [],
            'data' => []
        ];
        // dd($this->office);
        # stats within the past year
        $pastYear = Carbon::now()->subYear()->format('Y-m');
        $feedback = $this->office->feedback()->get()->filter(function ($feed) use ($pastYear) {
            return $feed->created_at->format('Y-m') >= $pastYear;
        });
        // dd($feedback->pluck('created_at'));
        $chartDataByMonth = [];
        $now = Carbon::now()->addMonth();
        for ($i = 0; $i <= 12; $i++) {
            $chartDataByMonth[$now->subMonth()->format('Y-m')] = 0;
        }
        // dd($now->format('Y-m'), $chartDataByMonth);
        $transcriptionTotalByMonth = $transcriptionDoneByMonth = $chartDataByMonth;
        foreach ($feedback as $feed) {
            $monthYear = $feed->created_at->format('Y-m');
            try {
                ++$chartDataByMonth[$monthYear];
            } catch (\Throwable $th) {
                //throw $th;
            }
            try {
                $transcriptionTotalByMonth[$monthYear] += (int)$feed->hasCommentImage();
            } catch (\Throwable $th) {
                //throw $th;
            }
            try {
                $transcriptionDoneByMonth[$monthYear] += (int)$feed->commentImageHasBeenTranscribed();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        ksort($chartDataByMonth);
        ksort($transcriptionTotalByMonth);
        ksort($transcriptionDoneByMonth);


        return [
            'labels' => array_keys($chartDataByMonth),
            'datasets' => [
                [
                    'label' => "Number of Feedback",
                    'data' => array_values($chartDataByMonth)
                ],
                [
                    'label' => "with Additional Comments",
                    'data' => array_values($transcriptionTotalByMonth)
                ],
                [
                    'label' => "Transcribed Comments",
                    'data' => array_values($transcriptionDoneByMonth)
                ],
            ]
        ];

    }
}
