<?php

namespace App\Imports\Onlineassessmenttemplate;

use App\Models\Admin\Exam\Onlineassessment\Assessmenttemplate;
use App\Models\Admin\Exam\Onlineassessment\Assessmenttemplatelist;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OnlineassessmenttImport implements ToModel, WithHeadingRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::info($row);

        $assessmenttemplateid = Assessmenttemplate::create([
            'lesson' => $row['lesson'],
            'classmaster_id' => 1,
            'board' => 1,
            'subject_id' => 1,
            'user_id' => 1,
            'created_by' => 'admin',
        ])->id;

        return new Assessmenttemplatelist([
            'assessmenttemplate_id' => $assessmenttemplateid,
            'question' => $row['question'],
            'option_one' => $row['answer_1'],
            'option_two' => $row['answer_2'],
            'option_three' => $row['answer_3'],
            'option_four' => $row['answer_4'],
            'answer' => $row['correct_answer'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.lesson' => Rule::unique('assessmenttemplates', 'lesson'),
        ];
    }

}
