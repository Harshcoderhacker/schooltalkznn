<?php

namespace App\Repository\Api\Parent\Interfacelayer\Exam\Onlineexam;

interface IParentonlineexamApiRepository
{
    public function parenttodayonlineexam();

    public function parentgetassessmentcountsubjectwise();

    public function parentgetallassessmentsubjectwise();

    public function parentgetonlineassessment();

    public function parentgetonlineassessmentquestions();

    public function parentmarksanswer();

    public function parentsubmitonlineassessment();

    public function parentonlineassessmentanswers();
}
