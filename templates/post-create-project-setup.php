<?php
$project_path = getcwd();

echo "Starting the project setup!\n";
echo "Copying template files...\n";
copy($project_path . '/template/template.gitlab-ci.yml', $project_path . '/.gitlab-ci.yml');
copy($project_path . '/template/template.composer.json', $project_path . '/composer.json');

echo "Finishing the project setup!\n";