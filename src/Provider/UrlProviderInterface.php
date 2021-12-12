<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Sylius\Component\Core\Model\ChannelInterface;

interface UrlProviderInterface
{
    public function generate(ChannelInterface $channel): array;

    public function getName(): string;
}
