<?php

namespace Tests\Parser;

use Fourxxi\Parser\CppReferenceRuWebsiteParser;
use Fourxxi\Parser\RefactoringGuruJsonParser;
use Fourxxi\Parser\RefactoringGuruWebsiteParser;
use Fourxxi\Parser\ParserFactory;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{
    public function testCreate()
    {
        self::assertInstanceOf(CppReferenceRuWebsiteParser::class, ParserFactory::create(ParserFactory::PARSER_CPP_REFERENCE_RU_HTML));
        self::assertInstanceOf(RefactoringGuruWebsiteParser::class, ParserFactory::create(ParserFactory::PARSER_REFACTORING_GURU_HTML));
        self::assertInstanceOf(RefactoringGuruJsonParser::class, ParserFactory::create(ParserFactory::PARSER_REFACTORING_GURU_JSON));
    }

    /**
     * @expectedException \Fourxxi\Exception\NotFoundParserException
     */
    public function testException()
    {
        ParserFactory::create('non existed sender name');
    }
}
