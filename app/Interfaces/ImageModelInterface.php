<?php

namespace App\Interfaces;

interface ImageModelInterface
{
    /**
     * @return string
     */
    public function getDirectoryPath(): string;

    /**
     * Returns an associative array of image properties.
     *
     * Example:
     * [
     *     "some_prop1" => [
     *         "name" => "name1",
     *         "size" => 1
     *     ]
     * ]
     *
     * @return array<string, array{name: string, size: int}>
     */
    public function getImageProperties(): array;
}
