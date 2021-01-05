<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Service;
use Carbon\Carbon;

class ReportData
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
     * @param Question $question
     * @param Service  $service
     */
    public function __construct(Question $question, Service $service)
    {
        $this->question = $question;
        $this->service = $service;
    }

    /**
     * @param string $office
     * @param string $monthFrom
     * @param string $monthTo
     * @return mixed
     */
    public function get(string $office, string $monthFrom, string $monthTo = null): array
    {
        $stats = [
            'services' => [],
            'total' => []
        ];

        $mandatoryQuestions = $this->question->where('is_required', 1);
        $mandatoryQuestionIds = $mandatoryQuestions->pluck('id')->toArray();

        $services = $this->service->where('office_id', $office)->with(['feedback' => function ($query) use ($monthFrom, $monthTo) {
            $monthTo = $monthTo ?? $monthFrom;
            $query->where('created_at', '>=', Carbon::parse($monthFrom)->format('Y-m-d 00:00:00'));
            $query->where('created_at', '<=', Carbon::parse($monthTo)->format('Y-m-t 23:59:59'));
        }])->get();
        $totalClients = 0;
        $totalGoodScore = 0;
        $goodRatings = [];
        // dd($services);
        foreach ($services as $service) {

            $clientFeedback = $service->feedback;
            if ($clientFeedback->count()) {

                $ctrAnswers = 0;
                $ctrGoodScore = 0;
                $tallyPerQuestion = [];
                // $tallyPerRating = array_fill_keys([1, 2, 3, 4, 5], 0);

                # num of clients
                $ctrClients = $clientFeedback->count();
                $totalClients += $ctrClients;
                // dd($clientFeedback->count(), $totalClients);

                # fill tallyPerQuestion with empty data
                foreach ($mandatoryQuestionIds as $qId) {
                    for ($i = 1; $i <= 5; $i++) {
                        $tallyPerQuestion[$qId][$i] = 0;
                    }
                }

                # count stuff during loop
                foreach ($clientFeedback as $feedback) {

                    foreach ($feedback->answers as $answer) {
                        if (in_array($answer->question_id, $mandatoryQuestionIds)) {
                            $ctrAnswers++;
                            $tallyPerQuestion[$answer->question_id][$answer->answer]++;
                            // $tallyPerRating[$answer->answer]++;
                        }
                        if (in_array($answer->answer, [4, 5])) {
                            $ctrGoodScore++;
                        }
                    }
                }

                # % of VS & O Ratings
                $goodRatingPercentage = $ctrAnswers ? number_format(($ctrGoodScore / $ctrAnswers) * 100, 2) : 0;

                # average percent per rating
                $totalRatingPercentages = [];
                $sumPerRating = array_fill_keys([1, 2, 3, 4, 5], 0);
                foreach ($tallyPerQuestion as $qId => $rating) {
                    foreach ($rating as $rate => $count) {
                        $sumPerRating[$rate] += $count;
                    }
                }
                foreach ($sumPerRating as $rate => $count) {
                    $average = $count / count($mandatoryQuestionIds);
                    $totalRatingPercentages[$rate] = number_format(($average / $ctrClients) * 100, 2);
                }

                # questions - rating
                $questions = [];
                foreach ($mandatoryQuestions->get() as $q) {
                    $questions[] = [
                        'question' => $q->question,
                        'ratings' => $tallyPerQuestion[$q->id]
                    ];
                }

                # comments
                $positiveComments = [];
                $negativeComments = [];
                $ignoredComments = [];
                $untranscribedComments = [];
                foreach ($clientFeedback as $feedback) {
                    if (!is_null($feedback->positive_comments) && $feedback->positive_comments !== '--none--') {
                        $positiveComments[] = [
                            'id' => $feedback->id,
                            'comment' => $feedback->positive_comments
                        ];
                    }
                    if (!is_null($feedback->negative_comments) && $feedback->negative_comments !== '--none--') {
                        $negativeComments[] = [
                            'id' => $feedback->id,
                            'comment' => $feedback->negative_comments
                        ];
                    }
                    if ($feedback->positive_comments === '--none--' || $feedback->negative_comments === '--none--') {
                        $ignoredComments[] = [
                            'id' => $feedback->id,
                            'comment' => '-- ignored comment/suggestion --'
                        ];
                    }
                    if ($feedback->comments_image_path && is_null($feedback->positive_comments) && is_null($feedback->negative_comments)) {
                        $untranscribedComments[] = [
                            'id' => $feedback->id,
                            'comment' => '-- untranscribed comment/suggestion --'
                        ];
                    }
                }

                $maxRows = count($positiveComments) > count($negativeComments) ? count($positiveComments) : count($negativeComments);

                $stats['services'][] = [
                    'name' => $service->name,
                    'clients' => $ctrClients,
                    'goodRatingPercentage' => $goodRatingPercentage,
                    'totalRatingPercentages' => $totalRatingPercentages,
                    'questions' => $questions,
                    'comments' => [
                        'positive' => $positiveComments,
                        'negative' => $negativeComments,
                        'ignored' => $ignoredComments,
                        'untranscribed' => $untranscribedComments,
                        'maxRows' => $maxRows
                    ]
                ];
                $totalGoodScore += $ctrGoodScore;
                $goodRatings[] = $goodRatingPercentage;
                // dd($stats);
            }
        }

        # totals
        $totalGoodRatingPercentage = count($goodRatings) ? number_format(count($goodRatings) ? array_sum($goodRatings) / count($goodRatings) : 0, 2): 0;
        $stats['total'] = [
            'clients' => $totalClients,
            'goodRatingPercentage' => $totalGoodRatingPercentage
        ];

        return $stats;
    }
}
