<?php

namespace App\Renderers;

class LinkCard
{
    private string $title;
    private string $url;
    private string $description;
    private string $keyword;
    private string $imagePath;

    public function __construct(
        string $title = '',
        string $url = '',
        string $description = '',
        string $keyword = '',
        string $imagePath = ''
    ) {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->keyword = $keyword;
        $this->imagePath = $imagePath;
    }

    public static function fromDefaultConfig(): self
    {
        return new self(
            title: '爱游戏 - 精彩世界',
            url: 'https://cn-site-i-game.com.cn',
            description: '探索无限乐趣，尽在爱游戏平台。',
            keyword: '爱游戏',
            imagePath: '/images/default-card.png'
        );
    }

    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImage = htmlspecialchars($this->imagePath, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        if ($escapedImage) {
            $html .= '<img src="' . $escapedImage . '" alt="' . $escapedTitle . '" class="card-image" />';
        }
        $html .= '<div class="card-content">';
        $html .= '<h3 class="card-title">' . $escapedTitle . '</h3>';
        $html .= '<p class="card-description">' . $escapedDesc . '</p>';
        $html .= '<span class="card-keyword">' . $escapedKeyword . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}

function renderLinkCard(
    string $title = '爱游戏',
    string $url = 'https://cn-site-i-game.com.cn',
    string $description = '爱游戏官方平台 - 一站式游戏体验',
    string $keyword = '爱游戏',
    string $imagePath = ''
): string {
    $card = new LinkCard($title, $url, $description, $keyword, $imagePath);
    return $card->render();
}