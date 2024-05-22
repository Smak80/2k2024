<?php

namespace common;

abstract class a_content
{
    abstract function show_content();
    function __construct()
    {
        session_start();
    }
}