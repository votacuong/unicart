<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\HotReloader\HotReloader;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', static function (): void {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn ($buffer) => $buffer);
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     */
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        service('toolbar')->respond();
        // Hot Reload route - for framework use on the hot reloader.
        if (ENVIRONMENT === 'development') {
            service('routes')->get('__hot-reload', static function (): void {
                (new HotReloader())->run();
            });
        }
    }
});
Events::on('post_controller_constructor', function () {

    if (ENVIRONMENT !== 'testing') {
        // Clear any existing output buffers
        while (ob_get_level() > 0) {
            ob_end_flush();
        }
        // Start a new output buffer with a minification callback
        ob_start(function ($buffer) {
            $search = [
                '/\\n/', // Remove newlines
                '/\\>[^\\S ]+/s', // Strip whitespaces after tags, except space
                '/[^\\S ]+\\</s', // Strip whitespaces before tags, except space
                '/(\\s)+/s', // Shorten multiple whitespace sequences
                '/<!--(.|\\s)*?-->/' // Remove HTML comments
            ];
            $replace = [
                '',
                '>',
                '<',
                '\\1',
                ''
            ];
            return preg_replace($search, $replace, $buffer);
        });
    }
});