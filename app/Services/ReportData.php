<?php
namespace App\Services;

use App\Models\Question;
use App\Models\Service;

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
     * @param  string  $office
     * @param  string  $month
     * @return mixed
     */
    public function get(string $office, string $month): array
    {
        $stats = [
            'services' => [],
            'total' => []
        ];

        $mandatoryQuestions = $this->question->where('is_required', 1);
        $mandatoryQuestionIds = $mandatoryQuestions->pluck('id')->toArray();

        $services = $this->service->where('office_id', $office)->where('created_at', 'like', $month . "%")->with('feedback')->get();

        $totalClients = 0;
        $totalGoodScore = 0;
        $goodRatings = [];

        foreach ($services as $service) {

            $allFeedback = $service->feedback;

            if ($allFeedback->count()) {
                $ctrAnswers = 0;
                $ctrGoodScore = 0;
                $tallyPerQuestion = [];
                // $tallyPerRating = array_fill_keys([1, 2, 3, 4, 5], 0);

                # num of clients
                $ctrClients = $allFeedback->count();
                $totalClients += $ctrClients;

                # fill tallyPerQuestion with empty data
                foreach ($mandatoryQuestionIds as $qId) {
                    for ($i = 1; $i <= 5; $i++) {
                        $tallyPerQuestion[$qId][$i] = 0;
                    }
                }

                # count stuff during loop
                foreach ($allFeedback as $feedback) {

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
                $goodRatingPercentage = number_format(($ctrGoodScore / $ctrAnswers) * 100, 2);

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
                $untranscribedComments = [];
                foreach ($allFeedback as $feedback) {
                    if (!is_null($feedback->positive_comments)) {
                        $positiveComments[] = [
                            'id' => $feedback->id,
                            'comment' => $feedback->positive_comments
                        ];
                    }
                    if (!is_null($feedback->negative_comments)) {
                        $negativeComments[] = [
                            'id' => $feedback->id,
                            'comment' => $feedback->negative_comments
                        ];
                    }
                    if ($feedback->comments_image_path && is_null($feedback->positive_comments) && is_null($feedback->negative_comments)) {
                        $untranscribedComments[] = [
                            'id' => $feedback->id,
                            'comment' => '-- untranscribed comment/suggestion --'
                        ];
                    }
                }

                $stats['services'][] = [
                    'service' => $service->name,
                    'clients' => $ctrClients,
                    'goodRatingPercentage' => $goodRatingPercentage,
                    'totalRatingPercentages' => $totalRatingPercentages,
                    'questions' => $questions,
                    'comments' => [
                        'positive' => $positiveComments,
                        'negative' => $negativeComments,
                        'untranscribed' => $untranscribedComments
                    ]
                ];
                $totalGoodScore += $ctrGoodScore;
                $goodRatings[] = $goodRatingPercentage;
                // dd($stats);
            }

        }

        # totals
        $totalGoodRatingPercentage = number_format(array_sum($goodRatings) / count($goodRatings), 2);
        $stats['total'] = [
            'clients' => $totalClients,
            'goodRatingPercentage' => $totalGoodRatingPercentage
        ];

        return $stats;

    }
}
