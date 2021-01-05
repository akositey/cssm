<?php
namespace App\Services;

use App\Models\Office;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class DashboardData
{
    /**
     * @var mixed
     */
    private $question;
    /**
     * @var mixed
     */
    private $service;

    /**
     * @param Office $office
     */
    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    /**
     * @param  string  $office
     * @param  string  $month
     * @return mixed
     */
    public function getStatsThisMonth(string $month): array
    {
        $chartData = [
            'labels' => [],
            'data' => []
        ];

        $feedback = $this->office->feedback()->with('answers')->filter(['month' => $month])
            ->get();

        $lastDate = new CarbonImmutable($month);
        $lastDate->endOfMonth();

        $chartDataByDay = array_fill(1, +$lastDate->format('t'), 0);
        foreach ($feedback as $feed) {
            $chartDataByDay[$feed->created_at->format('j')] += 1;
        }

        $chartData['labels'] = (array_keys($chartDataByDay));
        $chartData['data'] = (array_values($chartDataByDay));

        return $chartData;
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
        foreach ($feedback->pluck('created_at') as $date) {
            $chartDataByMonth[$date->format('Y-m')] += 1;
        }
        ksort($chartDataByMonth);
        $chartData['labels'] = array_keys($chartDataByMonth);
        $chartData['data'] = array_values($chartDataByMonth);
        return $chartData;

    }
}
