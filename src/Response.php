<?php

namespace TwoMedia\TelSearch;

class Response
{
    /**
     * @var SimpleXMLElement
     */
    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Parse Response and return entries
     * @return array
     */
    public function entries()
    {
        $results = [];

        foreach ($this->response->body->entry as $entry) {
            $results[] = $entry->children('tel', true);
        }

        return $results;
    }
}
