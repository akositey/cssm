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
     */
    public function run()
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

        $feedback = Feedback::factory()->count(5000)->create();
        $maxQuestions = Question::all()->count();
        foreach ($feedback as $f) {
            $mandatoryAnswers = [[
                'feedback_id' => $f->id,
                'question_id' => 1,
                'answer' => rand(1, 5)
            ], [
                'feedback_id' => $f->id,
                'question_id' => 2,
                'answer' => rand(1, 5)
            ], [
                'feedback_id' => $f->id,
                'question_id' => 3,
                'answer' => rand(1, 5)
            ]];
            foreach ($mandatoryAnswers as $answer) {
                FeedbackAnswers::factory()->create($answer);
            }
            $answeredQuestions = [];
            for ($i = 0; $i < rand(1, $maxQuestions); $i++) {
                $randomNumber = rand(4, $maxQuestions);
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
