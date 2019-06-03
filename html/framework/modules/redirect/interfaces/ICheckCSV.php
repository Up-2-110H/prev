<?php

namespace app\modules\redirect\interfaces;

interface ICheckCSV
{
    public function checkCSV(?string $csvPath);
}