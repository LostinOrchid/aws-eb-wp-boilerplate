<?php
function wp( $sub_command ) {
    global $wp_cli_path;
    $realpath = realpath($wp_cli_path);

    $command = "php \"$realpath\" $sub_command";

    echo "Running Command: $command...";

    return exec($command) . "\n";
}

function declare_globals() {
    $GLOBALS['tmp_dir'] = './tmp';
    $GLOBALS['wp_cli_path'] = $GLOBALS['tmp_dir'] . "/wp";
    $GLOBALS['wp_app_root'] = './wp';
}

function ensure_wp_cli() {
    global $tmp_dir, $wp_cli_path;
    // Create tmp directory if exists
    if(! is_dir($tmp_dir)) {
        echo "Creating $tmp_dir Directory...\n";
        mkdir($tmp_dir);
    }

    // Download wordpress cli
    if(! @file_exists( $wp_cli_path )) {
        $url = 'https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar';
        echo "Getting contents from $url...\n";
        $wp_cli_resource = file_get_contents( $url );
        echo "Putting contents from $url to $wp_cli_path...\n";
        file_put_contents( $wp_cli_path, $wp_cli_resource );
    }
}

function download_wp() {
    global $wp_app_root;

    $wp_json = json_decode( file_get_contents('wp.json') );
    $version = $wp_json->version;
    $realpath = realpath( $wp_app_root );

    echo wp("core download --path=\"$realpath\" --skip-content --version=\"$version\" ");
}

function run() {
    declare_globals();
    ensure_wp_cli();
    download_wp();
}

run();
