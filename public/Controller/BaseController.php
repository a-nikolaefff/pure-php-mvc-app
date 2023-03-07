<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\RendererInterface;

abstract class BaseController implements ControllerInterface
{
    protected RendererInterface $renderer;

    /**
     * @param RendererInterface $render
     */
    public function __construct(RendererInterface $render)
    {
        $this->renderer = $render;
    }
}