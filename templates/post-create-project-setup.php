<?php
$project_path = getcwd();
$templates_path = $project_path . '/templates/';
$project_path_trimmed = explode('/', $project_path);
$default_project_name = $project_path_trimmed[count($project_path_trimmed) - 1];
$default_webroot = 'web';

echo "Setting up your drupal project!\n";

/*
 * Collect some information
 */
echo "What is the name of your project [$default_project_name] :";
$default_project_name = preg_replace("/\s+|_+/", '-', rtrim(fgets(STDIN))) ?: $default_project_name;
echo "project name: " . $default_project_name . "\n";

echo "What is webroot of your project [$default_webroot] :";
$default_webroot = preg_replace("/\s+|_+/", '-', rtrim(fgets(STDIN))) ?: $default_webroot;
echo "project webroot: " . $default_webroot . "\n";

/*
 * Copy template files
 */
echo "Copying template files...\n";
//copy($templates_path . 'template.gitlab-ci.yml', $project_path . '/.gitlab-ci.yml');
//copy($templates_path . 'templates/template.composer.json', $project_path . '/composer.json');
copy($templates_path . 'template.lando.yml', $project_path . '/lando.yml');
copy($templates_path . 'lagoonize/template.env', $project_path . '/.env');
copy($templates_path . 'lagoonize/template.lagoon.yml', $project_path . '/.lagoon.yml');
copy($templates_path . 'lagoonize/lagoon/cli.dockerfile', $project_path . '/lagoon/cli.dockerfile');

/*
 * Replace tokens in template files
 */
replace_string_in_file($project_path . '/lando.yml', '[PROJECTNAME]', $default_project_name);
replace_string_in_file($project_path . '/lando.yml', '[WEBROOT]', $default_webroot);
replace_string_in_file($project_path . '/lagoon/cli.dockerfile', '[WEBROOT]', $default_webroot);
replace_string_in_file($project_path . '/lagoon/nginx.dockerfile', '[WEBROOT]', $default_webroot);
replace_string_in_file($project_path . '/.env', '[PROJECTNAME]', $default_project_name);


echo "Finishing the project setup!\nRemember to update the .gitlab-ci.yml variables for deploy jobs\n";


function replace_string_in_file($filename, $string_to_replace, $replace_with){
    $content = file_get_contents($filename);
    $content_chunks = explode($string_to_replace, $content);
    $content = implode($replace_with, $content_chunks);
    file_put_contents($filename, $content);
}