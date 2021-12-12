<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Controller;

use SitemapPlugin\Builder\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapController extends AbstractController
{
    private ChannelContextInterface $channelContext;

    public function __construct(
        ChannelContextInterface $channelContext,
        Reader $reader
    ) {
        $this->channelContext = $channelContext;

        parent::__construct($reader);
    }

    public function showAction(string $name): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode() ?? 'no_code', \sprintf('%s.xml', $name));

        return $this->createResponse($path);
    }
}
