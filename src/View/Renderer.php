<?php

declare(strict_types=1);

namespace App\View;

/**
 * An object that, based on the given templates and parameters, can generate the HTML code of the pages
 */
final class Renderer implements RendererInterface
{
    /**
     * @var string "The absolute path for the templates root folder"
     */
    private string $templateFolderPath;
    /**
     * @var string "The path to the layout HTML file relative to the templates root folder"
     */
    private string $relativeLayoutFilePath;
    /**
     * @var string "HTML code of the page intended to be inserted into the layout"
     */
    private string $html;

    /**
     * @param string $templateFolderPath     The absolute path for the templates root folder
     * @param string $relativeLayoutFilePath The path to the layout HTML file relative to the templates root folder
     */
    public function __construct(
        string $templateFolderPath,
        string $relativeLayoutFilePath
    ) {
        $this->templateFolderPath = $templateFolderPath;
        $this->relativeLayoutFilePath = $relativeLayoutFilePath;
    }

    public function render(
        $relativeTemplateFilePath,
        array $params = []
    ): string {
        extract($params);
        ob_start();
        include $this->templateFolderPath . DIRECTORY_SEPARATOR
            . $relativeTemplateFilePath . '.phtml';
        $this->html = ob_get_clean();
        return $this->renderLayout($params);
    }

    /**
     * Internal method to render the general layout of the pages
     *
     * @param array $params The variables that are used in the template
     *
     * @return string Rendered HTML page
     */
    private function renderLayout(
        array $params
    ): string {
        extract($params);
        ob_start();
        include $this->templateFolderPath . DIRECTORY_SEPARATOR
            . $this->relativeLayoutFilePath . '.phtml';
        return ob_get_clean();
    }
}