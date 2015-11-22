PHP MakePhpComment Module
==========================

PHP MakePhpComment Nov 2015

by Per Sundberg 
-



Introduction
------------
This is a module that uses the framework Anax-MVC Content CTextFilter
to format a textstring to a php-comment. 


Requirement
-----------

This library package requires PHP 5.3 or later.

Usage
-----
Install the ANAX-MVC from github on address:
git clone https://github.com/mosbth/Anax-MVC.git

Install the module php-makecomment to folder ANAX-MVC\3pp.

The php-makecomment is meant to be used with class autoloading. 
Therefore the Anax-MVC\app\config\autoloader.php needs to be updated with:
->addNameSpace('pesu', ANAX_INSTALL_PATH . '3pp/php-makecomment/pesu')

The file Anax-MVC\src\Content\CTextFilter.php needs to add after row 'shortcode' => 'shortCode',
with
'phpcomment' => 'phpcomment',  

The file Anax-MVC\src\Content\CTextFilter.php  needs to have function added.   
/**
* Format text according to comment.
*
* @param string $text the text that should be formatted.
*
* @return string as the formatted html-text.
*/
public function phpcomment($text)
{
   return \pesu\MakePhpComment::makephpcomment($text);
}


Add following to the ANAX-MVC/webroot/hello_view.php after $app->views->add('welcome/hello_world');
$app->router->add('', function() use ($app) {

    $content = $app->textFilter->doFilter('Function: Test php comment\n\n@param
     string $text xxxx\n\n@return string text xxxx','shortcode, phpcomment');

    $app->views->add('welcome/page', [
        'content' => $content,
    ]);
});
$app->router->handle();
 
To the view file Anax-MVC\app\view\welcome add a file page.tpl.php with content:
<article class="article1">
<?=$content?>
 <?php if(isset($byline)) : ?>
<footer class="byline">
<?=$byline?>
</footer>
<?php endif; ?>
 </article>
 
Bugs
----

To file bug reports please send email to:
<sundberg_p@yahoo.com>

Development and Testing
-----------------------
This module has been developed at Blekinge Tekniska Högskola at Karlskrona Sweden
and is a part of course DV14886 PHP MVC.

I tested the function with different strings in the hello_view.php 
Test 1 with empty string 
$content = $app->textFilter->doFilter('','shortcode, phpcomment');
Result:
/**
 * 
 */

Test 2 with one line string (no \n) 
$content = $app->textFilter->doFilter('Function: Test php comment','shortcode, phpcomment');
Result:
/**
 * Function: Test php comment 
 */

Test 3 with two line string (one \n)
$content = $app->textFilter->doFilter('Function: Test php comment\n','shortcode, phpcomment');
Result:
/**
 * Function: Test php comment 
 */

Test 4 with three line string (two \n)
$content = $app->textFilter->doFilter('Function: Test php comment\n\n','shortcode, phpcomment');
Result:
/**
 * Function: Test php comment 
 * 
 */

Test 5 with five line strings (four \n)  
$content = $app->textFilter->doFilter('Function: Test php comment\n\n@param
string $text xxxx\n\n@return string text xxxx','shortcode, phpcomment');

/**
 * Function: Test php comment 
 * 
 * @param string $text xxxx 
 * 
 * @return string text xxxx 
 */

Version History
---------------

PHP Markdown Module 1.0.0 (22 Nov 2015)


Copyright and License
---------------------
PHP MakePhpComment Module
Copyright (c) 2015 Per Sundberg  
