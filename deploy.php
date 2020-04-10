<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:choboellobo/example.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);

set('default_stage', 'prod');
// Hosts

host('185.66.41.114')
    ->stage('prod')
    ->user('eduarOQ0E')
    ->set('branch', 'master')
    ->set('deploy_path', '/web');
    
// Tasks

task('task:update', function() {
   

    try {
        writeln('<info>Deploying...</info>');
        $deployPath = get('deploy_path');
        cd($deployPath);
        run('git pull origin master', ['timeout' => null, 'tty' => true]);
        writeln('<info>Deployment is done.</info>');
    } catch (\Deployer\Exception\RuntimeException $e) {
         writeln($e);   
    }
})->desc("tarea");




// desc('Deploy your project');
// task('deploy', [
//     'deploy:info',
//     'deploy:prepare',
//     'deploy:lock',
//     'deploy:release',
//     'deploy:update_code',
//     'deploy:shared',
//     'deploy:writable',
//     'deploy:vendors',
//     'deploy:clear_paths',
//     'deploy:symlink',
//     'deploy:unlock',
//     'cleanup',
//     'success'
// ]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

