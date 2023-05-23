<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $questions = self::getQuestions();

        foreach ($questions as $questionData) {
            $question = new Question([
                'title' => $questionData['text']
            ]);
            $question->save();

            foreach ($questionData['answers'] as $answerText) {
                $answer = new Answer([
                    'title' => $answerText,
                    'question_id' => $question->id
                ]);
                $answer->save();

                if ($answerText === $questionData['correct_answer']) {
                    $question->correct_answer_id = $answer->id;
                    $question->save();
                }
            }
        }
    }

    public static function getQuestions() {
        return [
            [
                'text' => 'What is the capital of France?',
                'correct_answer' => 'Paris',
                'answers' => [
                    'Paris',
                    'Madrid',
                    'London',
                    'Berlin'
                ]
            ],
            [
                'text' => 'Who is the founder of Microsoft?',
                'correct_answer' => 'Bill Gates',
                'answers' => [
                    'Steve Jobs',
                    'Mark Zuckerberg',
                    'Larry Page',
                    'Bill Gates'
                ]
            ],
            [
                'text' => 'What is the largest country in the world by land area?',
                'correct_answer' => 'Russia',
                'answers' => [
                    'China',
                    'USA',
                    'India',
                    'Russia'
                ]
            ],
            [
                'text' => 'What is the smallest country in the world by land area?',
                'correct_answer' => 'Vatican City',
                'answers' => [
                    'San Marino',
                    'Nauru',
                    'Tuvalu',
                    'Vatican City'
                ]
            ],
            [
                'text' => 'What is the largest ocean in the world?',
                'correct_answer' => 'Pacific Ocean',
                'answers' => [
                    'Atlantic Ocean',
                    'Indian Ocean',
                    'Arctic Ocean',
                    'Pacific Ocean'
                ]
            ],
            [
                'text' => 'What is the currency of Japan?',
                'correct_answer' => 'Japanese yen',
                'answers' => [
                    'Japanese won',
                    'Japanese yen',
                    'Japanese dollar',
                    'Japanese ruble'
                ]
            ],
            [
                'text' => 'What is the largest mammal in the world?',
                'correct_answer' => 'Blue whale',
                'answers' => [
                    'Elephant',
                    'Giraffe',
                    'Blue whale',
                    'Hippopotamus'
                ]
            ],
            [
                'text' => 'What is the smallest planet in our solar system?',
                'correct_answer' => 'Mercury',
                'answers' => [
                    'Mars',
                    'Venus',
                    'Mercury',
                    'Pluto'
                ]
            ],
            [
                'text' => 'What is the largest planet in our solar system?',
                'correct_answer' => 'Jupiter',
                'answers' => [
                    'Saturn',
                    'Jupiter',
                    'Neptune',
                    'Uranus'
                ]
            ],
            [
                'text' => 'What is the highest mountain in the world?',
                'correct_answer' => 'Mount Everest',
                'answers' => [
                    'Kilimanjaro',
                    'Denali',
                    'Mount Everest',
                    'Mount Fuji'
                ]
            ],
            [
                'text' => 'What is the largest desert in the world?',
                'correct_answer' => 'Sahara',
                'answers' => [
                    'Mojave',
                    'Gobi',
                    'Sahara',
                    'Arabian'
                ]
            ],
            [
                'text' => 'Who wrote "To Kill a Mockingbird"?',
                'correct_answer' => 'Harper Lee',
                'answers' => [
                    'Maya Angelou',
                    'Toni Morrison',
                    'Harper Lee',
                    'Alice Walker'
                ]
            ],
            [
                'text' => 'What is the largest river in the world?',
                'correct_answer' => 'Amazon',
                'answers' => [
                    'Nile',
                    'Mississippi',
                    'Amazon',
                    'Yangtze'
                ]
            ],
            [
                'text' => 'What is the largest city in the world by population?',
                'correct_answer' => 'Tokyo',
                'answers' => [
                    'Mumbai',
                    'Beijing',
                    'Shanghai',
                    'Tokyo'
                ]
            ],
            [
                'text' => 'What is the largest lake in the world by surface area?',
                'correct_answer' => 'Caspian Sea',
                'answers' => [
                    'Superior',
                    'Victoria',
                    'Caspian Sea',
                    'Huron'
                ]
            ],
            [
                'text' => 'Who is the current president of the United States?',
                'correct_answer' => 'Joe Biden',
                'answers' => [
                    'Barack Obama',
                    'Donald Trump',
                    'Joe Biden',
                    'George W. Bush'
                ]
            ],
            [
                'text' => 'What is the largest island in the world by area?',
                'correct_answer' => 'Greenland',
                'answers' => [
                    'Borneo',
                    'Madagascar',
                    'Greenland',
                    'New Guinea'
                ]
            ],
            [
                'text' => 'What is the longest river in Europe?',
                'correct_answer' => 'Volga',
                'answers' => [
                    'Danube',
                    'Rhine',
                    'Volga',
                    'Po'
                ]
            ],
            [
                'text' => 'What is the hottest planet in our solar system?',
                'correct_answer' => 'Venus',
                'answers' => [
                    'Mercury',
                    'Mars',
                    'Venus',
                    'Jupiter'
                ]
            ],
            [
                'text' => 'Who directed the movie "Jaws"?',
                'correct_answer' => 'Steven Spielberg',
                'answers' => [
                    'George Lucas',
                    'Francis Ford Coppola',
                    'Steven Spielberg',
                    'Martin Scorsese'
                ]
            ],
            [
                'text' => 'What is the largest bird in the world by wingspan?',
                'correct_answer' => 'Wandering Albatross',
                'answers' => [
                    'Condor',
                    'Eagle',
                    'Wandering Albatross',
                    'Pelican'
                ]
            ],
            [
                'text' => 'What is the largest religion in the world by number of followers?',
                'correct_answer' => 'Christianity',
                'answers' => [
                    'Islam',
                    'Hinduism',
                    'Buddhism',
                    'Christianity'
                ]
            ],
            [
                'text' => 'What is the largest animal in the world by weight?',
                'correct_answer' => 'Blue whale',
                'answers' => [
                    'African elephant',
                    'White rhinoceros',
                    'Blue whale',
                    'Giraffe'
                ]
            ],
            [
                'text' => 'What is the smallest ocean in the world?',
                'correct_answer' => 'Arctic Ocean',
                'answers' => [
                    'Atlantic Ocean',
                    'Indian Ocean',
                    'Pacific Ocean',
                    'Arctic Ocean'
                ]
            ],
            [
                'text' => 'What is the largest stadium in the world by capacity?',
                'correct_answer' => 'Rungrado 1st of May Stadium',
                'answers' => [
                    'Camp Nou',
                    'Wembley Stadium',
                    'Maracana Stadium',
                    'Rungrado 1st of May Stadium'
                ]
            ],
            [
                'text' => 'What is the largest continent in the world by land area?',
                'correct_answer' => 'Asia',
                'answers' => [
                    'North America',
                    'South America',
                    'Europe',
                    'Asia'
                ]
            ],
            [
                'text' => 'What is the smallest country in the world by population?',
                'correct_answer' => 'Vatican City',
                'answers' => [
                    'San Marino',
                    'Nauru',
                    'Tuvalu',
                    'Vatican City'
                ]
            ],
            [
                'text' => 'What is the most spoken language in the world?',
                'correct_answer' => 'Mandarin Chinese',
                'answers' => [
                    'English',
                    'Spanish',
                    'Mandarin Chinese',
                    'Arabic'
                ]
            ],
            [
                'text' => 'What is the largest spider in the world by leg span?',
                'correct_answer' => 'Goliath birdeater',
                'answers' => [
                    'Huntsman spider',
                    'Black widow',
                    'Goliath birdeater',
                    'Tarantula'
                ]
            ],
            [
                'text' => 'What is the largest pyramid in the world?',
                'correct_answer' => 'Great Pyramid of Giza',
                'answers' => [
                    'Chichen Itza',
                    'Tikal',
                    'Great Pyramid of Giza',
                    'Teotihuacan'
                ]
            ],
            [
                'text' => 'What is the largest carnivorous dinosaur in the world?',
                'correct_answer' => 'Spinosaurus',
                'answers' => [
                    'Tyrannosaurus Rex',
                    'Allosaurus',
                    'Carcharodontosaurus',
                    'Spinosaurus'
                ]
            ],
            [
                'text' => 'What is the largest lake in Africa by surface area?',
                'correct_answer' => 'Lake Victoria',
                'answers' => [
                    'Lake Chad',
                    'Lake Tanganyika',
                    'Lake Malawi',
                    'Lake Victoria'
                ]
            ],
            [
                'text' => 'What is the highest waterfall in Africa?',
                'correct_answer' => 'Victoria Falls',
                'answers' => [
                    'Ouzoud Falls',
                    'Dettifoss',
                    'Sutherland Falls',
                    'Victoria Falls'
                ]
            ],
            [
                'text' => 'What is the largest tree in the world by volume?',
                'correct_answer' => 'General Sherman',
                'answers' => [
                    'Hyperion',
                    'Coast Redwood',
                    'General Sherman',
                    'Boole Tree'
                ]
            ],
            [
                'text' => 'What is the largest reef system in the world?',
                'correct_answer' => 'Great Barrier Reef',
                'answers' => [
                    'Belize Barrier Reef',
                    'Andros Barrier Reef',
                    'Palau Barrier Reef',
                    'Great Barrier Reef'
                ]
            ],
            [
                'text' => 'Who wrote "The Great Gatsby"?',
                'correct_answer' => 'F. Scott Fitzgerald',
                'answers' => [
                    'Ernest Hemingway',
                    'John Steinbeck',
                    'F. Scott Fitzgerald',
                    'William Faulkner'
                ]
            ],
            [
                'text' => 'What is the largest flower in the world?',
                'correct_answer' => 'Rafflesia arnoldii',
                'answers' => [
                    'Corpse flower',
                    'Lotus',
                    'Sunflower',
                    'Rafflesia arnoldii'
                ]
            ],
            [
                'text' => 'What is the largest lake in North America by volume?',
                'correct_answer' => 'Lake Superior',
                'answers' => [
                    'Great Slave Lake',
                    'Great Bear Lake',
                    'Lake Michigan',
                    'Lake Superior'
                ]
            ],
            [
                'text' => 'What is the largest canyon in the world?',
                'correct_answer' => 'Grand Canyon',
                'answers' => [
                    'Fish River Canyon',
                    'Yarlung Tsangpo Grand Canyon',
                    'Colca Canyon',
                    'Grand Canyon'
                ]
            ],
            [
                'text' => 'What is the fastest land animal in the world?',
                'correct_answer' => 'Cheetah',
                'answers' => [
                    'Lion',
                    'Leopard',
                    'Cheetah',
                    'Tiger'
                ]
            ],
            [
                'text' => 'What is the largest planet in the universe?',
                'correct_answer' => 'Jupiter',
                'answers' => [
                    'Saturn',
                    'Uranus',
                    'Neptune',
                    'Jupiter'
                ]
            ],
            [
                'text' => 'What is the largest waterfall in North America?',
                'correct_answer' => 'Niagara Falls',
                'answers' => [
                    'Yosemite Falls',
                    'Angel Falls',
                    'Iguazu Falls',
                    'Niagara Falls'
                ]
            ],
            [
                'text' => 'What is the largest country in South America by area?',
                'correct_answer' => 'Brazil',
                'answers' => [
                    'Argentina',
                    'Peru',
                    'Colombia',
                    'Brazil'
                ]
            ],
            [
                'text' => 'What is the largest cave in the world by volume?',
                'correct_answer' => 'Sơn Đoòng Cave',
                'answers' => [
                    'Mammoth Cave',
                    'Hang Son Doong',
                    'Cueva de los Cristales',
                    'Son Doong Cave'
                ]
            ],
        ];
    }
}
