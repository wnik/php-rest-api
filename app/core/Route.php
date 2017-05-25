<?php

namespace App\Core;


class Route
{
    private $defaultPattern = '(\w+)';
    private $pattern;
    private $args;
    private $method;
    private $callback;

    public function __construct(string $pattern, array $args, string $method, \Closure $callback)
    {
        $this->args = $args;
        $this->method = $method;
        $this->callback = $callback;
        $this->pattern = $this->parsePattern($pattern);
    }

    public function parsePattern(string $pattern): string
    {
        $pattern = ltrim(rtrim($pattern, '/'), '/');

        if (preg_match_all('/{(\w+)}/', $pattern, $matches)) {
            foreach ($matches[1] as $arg) {
                if (!array_key_exists($arg, $this->args) || empty($this->args[$arg])) {
                    $this->args[$arg] = $this->defaultPattern;
                }
            }

            $toReplace = $matches[0];
            foreach ($toReplace as $repKey => $repValue) {
                $toReplace[$repKey] = '/' . $repValue . '/';
            }

            $replacement = array_values($this->args);

            $pattern = preg_replace($toReplace, $replacement, $pattern);

        }

        $positions = [];
        $pos = 0;

        while (($pos = strpos($pattern, '/', $pos)) !== false) {
            $positions[] = $pos;
            ++$pos;
        }

        foreach ($positions as $key => $position) {
            $position += $key;

            $pattern = substr_replace($pattern, '\\', $position, 0);
        }

        $pattern = '/^\/' . $pattern . '$/';

        return $pattern;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function __invoke()
    {

    }
}