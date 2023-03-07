<?php

declare(strict_types=1);

namespace App\View;

/**
 * An object that, based on the given templates and parameters, can generate the HTML code of the pages
 */
final class Renderer implements RendererInterface
{
    /**
     * @var array<string> The absolute path for the templates root folder as an array
     */
    private array $templateFolderPathParts;

    /**
     * @param string $templateFolderPath The absolute path for the templates root folder
     */
    public function __construct(string $templateFolderPath)
    {
        $this->templateFolderPathParts = explode(
            DIRECTORY_SEPARATOR,
            $templateFolderPath
        );
    }


    public function render($relativeFilePath, array $params = []): string
    {
        $absoluteFilePathParts = $this->templateFolderPathParts;
        $absoluteFilePathParts[] = $relativeFilePath;
        $absoluteFilePath = implode(DIRECTORY_SEPARATOR, $absoluteFilePathParts)
            . '.phtml';
        return $this->renderLayout($absoluteFilePath, $params);
    }

    /**
     * Internal method needed to avoid accidentally overriding variables in the main render method
     *
     * @param string $absoluteFilePath
     * @param array  $params The variables that are used in the template
     *
     * @return string Rendered HTML page
     */
    private function renderLayout(
        string $absoluteFilePath,
        array $params
    ): string {
        extract($params);
        ob_start();
        include $absoluteFilePath;
        return ob_get_clean();
    }
}