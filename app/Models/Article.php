<?php

namespace App\Models;

class Article
{
    protected static $template = true;

    protected $title;
    protected $seo_title;
    protected $created_at;

    public function __construct($title, $seoTitle)
    {
        $this->setTitle($title);
        $this->setSeoTitle($seoTitle);

        $this->created_at = date('Y-m-d H:i:s');
    }

    /**
     * This static method change state of $template var
     * If the var is "false", string template will be present as original string
     * @param boolean $use
     * @return void
     */
    public static function useTemplate(bool $use = null)
    {
        static::$template = $use ?? !static::$template;
    }

    /**
     * If key pass, we will search it in $replacements
     * and if key exists, we will return value.
     * Unless key pass, we will return $replacements array.
     * @param string $key
     * @return mixed
     */
    public function getReplacements(string $key = null)
    {
        $replacements = [
            '{title}'  => $this->getTitle(),
            '{date}'   => $this->getCreatedAt()
        ];

        return $key ? ($replacements[$key] ?? $key) : $replacements;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSeoTitle($title)
    {
        $this->seo_title = $title;
    }

    public function getTitle()
    {
        return static::$template ? $this->useStringTemplate($this->title) : $this->title;
    }

    public function getSeoTitle()
    {
        return static::$template ? $this->useStringTemplate($this->seo_title) : $this->seo_title;
    }

    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        return date($format, strtotime($this->created_at));
    }

    protected function applyReplacement(array $matches)
    {
        $matched = $matches[0];

        return str_replace($matched, $this->getReplacements($matched), $matched);
    }

    protected function useStringTemplate(string $template)
    {
        return preg_replace_callback('/\{[a-z].+\}/', [$this, 'applyReplacement'], $template);
    }
}