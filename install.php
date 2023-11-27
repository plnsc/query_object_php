#!/usr/bin/env php
<?php
# you may don't use this directly use command 'make install' instead

$options = getopt('o:', ['output_file:']);
$output_file = $options['o'] ?? 'composer-setup.php';

$composer_url = 'https://getcomposer.org/installer';
$composer_file_hash = 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02';

copy($composer_url, $output_file);

if (hash_file('sha384', $output_file) === $composer_file_hash) {
    echo 'Installer verified';
} else {
    echo 'Installer corrupt';
    unlink($output_file);
}

echo PHP_EOL;
