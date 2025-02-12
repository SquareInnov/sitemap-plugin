<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Model;

use PhpSpec\ObjectBehavior;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use SitemapPlugin\Model\Sitemap;
use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Model\UrlInterface;

final class SitemapSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(Sitemap::class);
    }

    function it_implements_sitemap_interface(): void
    {
        $this->shouldImplement(SitemapInterface::class);
    }

    function it_has_sitemap_urls(): void
    {
        $this->setUrls([]);
        $this->getUrls()->shouldReturn([]);
    }

    function it_adds_url(UrlInterface $sitemapUrl): void
    {
        $this->addUrl($sitemapUrl);
        $this->getUrls()->shouldReturn([$sitemapUrl]);
    }

    function it_removes_url(
        UrlInterface $sitemapUrl,
        UrlInterface $productUrl,
        UrlInterface $staticUrl,
    ): void {
        $this->addUrl($sitemapUrl);
        $this->addUrl($staticUrl);
        $this->addUrl($productUrl);
        $this->removeUrl($sitemapUrl);

        $this->getUrls()->shouldReturn([1 => $staticUrl, 2 => $productUrl]);
    }

    function it_has_localization(): void
    {
        $this->setLocalization('http://sylius.org/sitemap1.xml');
        $this->getLocalization()->shouldReturn('http://sylius.org/sitemap1.xml');
    }

    function it_has_last_modification_date(\DateTime $now): void
    {
        $this->setLastModification($now);
        $this->getLastModification()->shouldReturn($now);
    }

    function it_throws_sitemap_url_not_found_exception_if_cannot_find_url_to_remove(
        UrlInterface $productUrl,
        UrlInterface $staticUrl,
    ): void {
        $this->addUrl($productUrl);

        $staticUrl->getLocation()->willReturn('http://sylius.org');

        $this->shouldThrow(SitemapUrlNotFoundException::class)->during('removeUrl', [$staticUrl]);
    }
}
