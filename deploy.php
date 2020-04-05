<?php

namespace Deployer;

require 'recipe/wordpress.php';

set('default_stage', 'production');
set('branch', 'master');
set('writable_mode', 'chmod');
set('repository', 'git@bitbucket.org:user/onblue.git');
set('git_tty', true);
set('allow_anonymous_stats', false);
set('deploy_path', '/home/user/web/onblue.pl/public_html');

task('prepare_htaccess', function () {
    run('cd ' . get('release_path') . ' && cp .htaccess.prod .htaccess');
});
after('deploy:symlink', 'prepare_htaccess');

task('build', function () {
    run('cd docroot && composer install');
})->local();
after('deploy:update_code', 'build');

task('upload', function () {
    upload(__DIR__ . "/docroot/vendor/", '{{release_path}}/vendor');
});
after('build', 'upload');

host('onblue.pl')
    ->user('user')
    ->stage('production');


