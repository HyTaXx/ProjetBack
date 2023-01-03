<?php

class Album
{
    public function __construct(
        public string $album_name,
        public string $isprivate,
    )
    {
    }
}