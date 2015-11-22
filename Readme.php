<?php

#Add the following code to the autoloader.php
->addNameSpace('pesu', ANAX_INSTALL_PATH . '3pp/php-makecomment/pesu')

#Add following to  CTextFilter.php needs to add after row 'shortcode' => 'shortCode',
'phpcomment' => 'phpcomment',

#Add following function to CTextFilter.php.
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

#Add following to the hello_view.php after line $app->views->add('welcome/hello_world');
$app->router->add('', function() use ($app) {

    $content = $app->textFilter->doFilter('Function: Test php comment\n\n@param
     string $text xxxx\n\n@return string text xxxx','shortcode, phpcomment');

    $app->views->add('welcome/page', [
        'content' => $content,
    ]);
});
$app->router->handle();

#Add the following file page.tpl.php
<article class="article1">
<?=$content?>
 <?php if(isset($byline)) : ?>
<footer class="byline">
<?=$byline?>
</footer>
<?php endif; ?>
 </article>
