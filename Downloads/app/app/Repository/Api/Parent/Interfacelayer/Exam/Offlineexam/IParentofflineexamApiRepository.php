<?php

namespace App\Repository\Api\Parent\Interfacelayer\Exam\Offlineexam;

interface IParentofflineexamApiRepository
{
    public function parentexamindex();

    public function parentgetexamlist();

    public function parentgetexamschedulebyexamuuid();

    public function parentgetallexamlistmonthwise();

    public function parentgetexammarlist();

    public function parentgetprogresscard();

}
