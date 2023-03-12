<?php

declare(strict_types=1);

namespace App\View;

interface RendererInterface
{
    /**
     * Render HTML page as a string
     *
     * @param       $relativeTemplateFilePath "The path to the template HTML file relative to the templates root folder"
     * @param array $params                   The variables that are used in the template
     *
     * @return string Rendered HTML page
     */
    public function render($relativeTemplateFilePath, array $params = []): string;
}