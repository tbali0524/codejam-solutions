<?php

/**
 * php-cs-fixer configuration file.
 *
 * minimum version: ^3.14.0
 *
 * @see https://cs.symfony.com/doc/config.html
 */

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->name('*.php')
    ->ignoreVCSIgnored(true)
    ->exclude('.git/')
    ->exclude('.tools/')
    ->exclude('vendor/')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,              // includes @Symfony, @PER, @PSR12, @PSR2, @PSR1
        // override some @Symfony rules
        'blank_line_before_statement' => false,
        'concat_space' => ['spacing' => 'one'],
        'yoda_style' => false,
        // override some @PhpCsFixer rules
        'ordered_class_elements' => false, // excluded so test helper methods are near the test methods
    ])
    ->setCacheFile(__DIR__ . '/.tools/.php-cs-fixer.cache')
    ->setIndent("    ")
    ->setLineEnding("\n")
    ->setFinder($finder)
;
