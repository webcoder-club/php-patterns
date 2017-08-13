<?php

class Search
{
    private $text;
    private $word;

    function __construct($text, $word)
    {
        $this->text = $text;
        $this->word = $word;
    }

    function searchWordInText()
    {
        return $this->text;
    }

    function getWord()
    {
        return $this->word;
    }
}

class SearchAdapter
{
    private $aSearch;

    function __construct(Search $aSearch)
    {
        $this->aSearch = $aSearch;
    }

    function searchWordInText()
    {
        return 'Эти слова '.$this->aSearch->getWord().' найдены в тексте '.$this->aSearch->searchWordInText();
    }
}

$search = new Search("текст", "слова");
$searchAdapter = new SearchAdapter($search);
echo $searchAdapter->searchWordInText();