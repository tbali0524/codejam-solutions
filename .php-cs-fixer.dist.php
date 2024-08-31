<?php

/**
 * php-cs-fixer configuration file.
 *
 * minimum version: ^3.63
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
    ->setRules([                            // rulesets: https://cs.symfony.com/doc/ruleSets/index.html
        '@PHP83Migration' => true,
        '@PHP80Migration:risky' => true,    // this also needs: ->setRiskyAllowed(true)
        '@PhpCsFixer' => true,              // includes @Symfony, @PER-CS2.0, @PSR12, @PSR2, @PSR1
        '@PhpCsFixer:risky' => true,        // includes @Symfony:risky, @PER-CS2.0:risky, @PSR12:risky

        // override some @PHPxxMigration rules
        'assign_null_coalescing_to_coalesce_equal' => false, // override @PHP81Migration, ??= requires php v7.4

        // override some @PHP80Migration:risky rules
        'random_api_migration' => false,    // override '@PHP80Migration:risky, random_int() might be slower
        'use_arrow_functions' => false,     // override '@PHP80Migration:risky, => fn() requires php v7.4
        'modernize_strpos' => false,        // override '@PHP80Migration:risky, str_contains() requires php v8.0

        // override some @Symfony rules
        'binary_operator_spaces' => ['operators' => ['=' => null, '=>' => null]],
        'blank_line_before_statement' => false,
        'concat_space' => ['spacing' => 'one'],
        'no_spaces_around_offset' => false, // override for puzzle/cg/hard/hard_dont_panic_ep2.php
        'phpdoc_to_comment' => false,
        'trim_array_spaces' => false,
        'yoda_style' => false,

        // override some @PhpCsFixer rules
        'explicit_string_variable' => false,
        'ordered_class_elements' => false,
        'single_line_empty_body' => false,

        // override some @Symfony:risky rules
        'is_null' => false,
        'logical_operators' => false,
        'modernize_types_casting' => false,
        'native_constant_invocation' => false,
        'native_function_invocation' => false,
        'no_trailing_whitespace_in_string' => false,
        'psr_autoloading' => false,
        'self_accessor' => false,
        'string_length_to_empty' => false,

        // override some @PhpCsFixer:risky rules
        'comment_to_phpdoc' => false,
        'strict_comparison' => false,
        'strict_param' => false,
    ])
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/.tools/.php-cs-fixer.cache')
    ->setIndent("    ")
    ->setLineEnding("\n")
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setFinder($finder)
;
