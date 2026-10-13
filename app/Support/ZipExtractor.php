<?php

namespace App\Support;

use RuntimeException;
use ZipArchive;

/**
 * Extracts a zip archive into a directory.
 *
 * Replaces madnest/madzipper, which has no stable release for Laravel 13 and was only ever used
 * for `make($zip)->extractTo($dir)`. Entries that would land outside $directory (zip-slip, e.g.
 * "../../x") are skipped rather than written.
 */
class ZipExtractor
{
    public static function extract(string $zipPath, string $directory): void
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {
            throw new RuntimeException("Unable to open zip archive: {$zipPath}");
        }

        try {
            if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
                throw new RuntimeException("Unable to create directory: {$directory}");
            }

            $root = rtrim(realpath($directory), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name = str_replace('\\', '/', (string) $zip->getNameIndex($i));

                if ($name === '' || str_starts_with($name, '/') || in_array('..', explode('/', $name), true)) {
                    continue;
                }

                $target = $root . $name;

                if (str_ends_with($name, '/')) {
                    if (!is_dir($target)) {
                        mkdir($target, 0755, true);
                    }
                    continue;
                }

                if (!is_dir(dirname($target))) {
                    mkdir(dirname($target), 0755, true);
                }

                $stream = $zip->getStream($zip->getNameIndex($i));
                if ($stream === false) {
                    continue;
                }

                file_put_contents($target, stream_get_contents($stream));
                fclose($stream);
            }
        } finally {
            $zip->close();
        }
    }
}
