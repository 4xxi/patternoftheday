<?php

namespace Fourxxi\Parser;

use Fourxxi\Exception\NotFoundParserException;

class ParserFactory
{
    const PARSER_CPP_REFERENCE_RU_HTML = 'cpp_reference_ru.html';
    const PARSER_REFACTORING_GURU_HTML = 'refactoring_guru.html';
    const PARSER_REFACTORING_GURU_JSON = 'refactoring_guru.json';

    /**
     * @param string $name
     *
     * @return CppReferenceRuWebsiteParser|RefactoringGuruJsonParser|RefactoringGuruWebsiteParser
     *
     * @throws NotFoundParserException
     */
    public static function create(string $name)
    {
        switch ($name) {
            case self::PARSER_CPP_REFERENCE_RU_HTML:
                return new CppReferenceRuWebsiteParser();
            case self::PARSER_REFACTORING_GURU_HTML:
                return new RefactoringGuruWebsiteParser();
            case self::PARSER_REFACTORING_GURU_JSON:
                return new RefactoringGuruJsonParser();
            default:
                throw new NotFoundParserException('Undefined parser passed: '.$name);
        }
    }
}
