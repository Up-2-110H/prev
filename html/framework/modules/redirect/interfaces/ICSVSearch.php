<?php

namespace app\modules\redirect\interfaces;

interface ICSVSearch
{
    public function search(string $str, int $col): array;
}