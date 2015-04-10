@ECHO off
SET cwd=%cd%
SET ROBO_HOME=%cwd%\vendor\codegyre\robo\robo
php %ROBO_HOME% %* 