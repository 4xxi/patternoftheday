<?php

namespace Fourxxi\Parser;

use Psr\Log\InvalidArgumentException;

class SenderFactory
{
    const SENDER_CPP_REFERENCE_RU_HTML = 'cpp_reference_ru.html';
    const SENDER_REFACTORING_GURU_HTML = 'refactoring_guru.html';
    const SENDER_REFACTORING_GURU_JSON = 'refactoring_guru.json';

    public static function create(string $name)
    {
        switch ($name) {
            case self::SENDER_CPP_REFERENCE_RU_HTML:
                return new CppReferenceRuWebsiteParser();
            case self::SENDER_REFACTORING_GURU_JSON:
                return new RefactoringGuruJsonParser();
            case self::SENDER_REFACTORING_GURU_HTML:
                return new RefactoringGuruWebsiteParser();
            default:
                throw new InvalidArgumentException('Undefined parser passed: '.$name);
        }
    }
}
