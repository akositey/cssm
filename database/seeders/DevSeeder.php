<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\FeedbackAnswers;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        //test admin
        \App\Models\Office::create([
            'id' => 999999999,
            'parent_id' => null,
            'old_id' => null,
            'name' => 'Test Office',
            'abbr' => 'TEST'
        ]);
        $testServices = [[
            'office_id' => 999999999,
            'name' => 'Service # 1'
        ], [
            'office_id' => 999999999,
            'name' => 'Service # 2'
        ], [
            'office_id' => 999999999,
            'name' => 'Service # 3'
        ]];
        foreach ($testServices as $service) {
            \App\Models\Service::create($service);
        }

        $dummyFeedbackCount = 10000;
        $feedback = Feedback::factory()->count($dummyFeedbackCount)->create();
        $maxQuestions = Question::all()->count();
        foreach ($feedback as $f) {
            $mandatoryAnswers = [[
                'feedback_id' => $f->id,
                'question_id' => 1,
                'answer' => random_int(1, 5)
            ], [
                'feedback_id' => $f->id,
                'question_id' => 2,
                'answer' => random_int(1, 5)
            ], [
                'feedback_id' => $f->id,
                'question_id' => 3,
                'answer' => random_int(1, 5)
            ]];
            foreach ($mandatoryAnswers as $answer) {
                FeedbackAnswers::factory()->create($answer);
            }
            $answeredQuestions = [];
            for ($i = 0; $i < random_int(1, $maxQuestions); $i++) {
                $randomNumber = random_int(4, $maxQuestions);
                $exists = isset($answeredQuestions[$randomNumber]);
                if (!$exists) {
                    $answeredQuestions[$randomNumber] = $randomNumber;
                    FeedbackAnswers::factory()->create([
                        'feedback_id' => $f->id,
                        'question_id' => $randomNumber
                    ]);
                }
            }

        }

    }
}
