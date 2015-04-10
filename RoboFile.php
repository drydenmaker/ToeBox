<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    //use Robo\Task\FileSystem\CleanDir;
    //use loadTasks;
    
    function hello($world)
    {
        $this->say("Hello, $world");
    }
    /**
     * 
     */
    function build()
    {
        if (!file_exists('dist'))
        {
            $this->say("make dist dir");
            $this->taskFileSystemStack()
                ->mkdir('dist')
                ->mkdir('dist/theme')
                ->mkdir('dist/plugin')
            ->run();
        }
        
        if (!file_exists('tmp'))
        {
            $this->say("make tmp dir");
            $this->taskFileSystemStack()
                ->mkdir('tmp')
            ->run();
        }
        
        $this->say("Cleaning up build files");
        $this->taskCleanDir('dist')->run();        
        $this->taskCleanDir('tmp')->run();
        
        $this->say("Copy to dist/theme up build files");
        $this->taskCopyDir(['theme' => 'dist/theme'])->run();
        
        $this->say("Process Less files");
        $this->taskLess([
            'theme/less/bootstrap/bootstrap.less' => 'bootstrap.css',
            'theme/less/bootstrap/theme.less' => 'bootstrap-theme.css'
        ])
        ->compiler('less')
        ->run();
    }
}