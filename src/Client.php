<?php

namespace TwoMedia\TelSearch;

use Config;
use Exception;
use Httpful\Request;

class Client
{
    /**
     * Base URL for API Requests
     * @var string
     */
    protected $uri = "http://tel.search.ch/api/?";

    /**
     * Can be firstname, lastname or phonenumber
     * @var array
     */
    protected $what;

    /**
     * street, zipcode or city
     * @var array
     */
    protected $where;

    /**
     * API key to identify user
     * @var string
     */
    protected $key;

    /**
     * Set key
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Set the "what" values
     * @param  array  $values Search for firstname, lastname or phonenumber
     * @return self
     */
    public function what(array $values)
    {
        $this->what = $values;
        return $this;
    }

    /**
     * Set "where" values
     * @param  array  $values Search for street, zipcode or city
     * @return self
     */
    public function where(array $values)
    {
        $this->where = $values;
        return $this;
    }

    /**
     * Send Request to API-Server
     * @return self
     */
    public function send()
    {
        if (is_null($this->what) && is_null($this->where)) {
            throw new Exception("No Searchparameter given");
        }

        $uri = $this->getUri();

        $response = Request::get($uri)->expectsXml()->send();

        return new Response($response);
    }

    /**
     * Build the final URI for the request
     * @return string
     */
    protected function getUri()
    {
        return "{$this->uri}{$this->buildParameters()}";
    }

    /**
     * Return "where" values
     * @return string
     */
    protected function getWhere()
    {
        if (!is_null($this->where)) {
            return implode($this->where, "+");
        }
    }

    /**
     * Return "what" values
     * @return string
     */
    protected function getWhat()
    {
        if (!is_null($this->what)) {
            return implode($this->what, "+");
        }
    }

    /**
     * Build the HTTP Query which is sent to the API Endpoint
     * @return string
     */
    protected function buildParameters()
    {
        $queryArray = [
            "was"   => $this->getWhat(),
            "wo"    => $this->getWhere(),
            "key"   => $this->key,
            "limit" => 10
        ];

        $query = http_build_query($queryArray);
        return urldecode($query);
    }
}
