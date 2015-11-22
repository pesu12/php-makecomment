<?php
#
# MakePhpComment  -  A text-to-HTML conversion tool for web writer
#
# PHP Make Comment
# Copyright (c) 2015 Per Sundberg
#
namespace pesu;

class MakePhpComment {

  /**
   * The function to make a comment from indata. Indata can contain
   * several lines that are separated by \n.
   *
   * @param string $text the text that should be formatted as a comment.
   *
   * @return string as the formatted html-text.
   */
  public static function makephpcomment($text) {
    //First row in Comment
    $output= "/**</BR>";

    //If Comment Consists of more than one lines
    if(strstr($text, '\n')) {
      $i=substr_count($text,'\n');

      //If Comment Consists of two lines (one \n)
      if($i==1) {
        $pos = strpos($text,'\n');
        $row=substr($text, 0, $pos);
        $output.= "&nbsp;* ".$row." </BR>";

        $nextrow=substr($text, strlen($row)+2);
        $output.= "&nbsp;* ".$nextrow." </BR>";
      }

      //If Comment Consists of more than two lines (more than two \n)
      if($i>1) {
        $pos = strpos($text,'\n');
        $firstrow=substr($text, 0, $pos);
        $output.= "&nbsp;* ".$firstrow." </BR>";

        $nextparse=substr($text, strlen($firstrow)+2, strlen($text));

        for ($x = 0; $x <= $i-2; $x++) {
          $pos = strpos($nextparse,'\n');
          $row=substr($nextparse, 0, $pos);
          $output.= "&nbsp;* ".$row." </BR>";
          $nextparse=substr($nextparse, strlen($row)+2);
        }
        $output.= "&nbsp;* ".$nextparse." </BR>";
      }
    }
    //If Comment Consists of one lin
    else {
      $output.= "&nbsp;* ".$text." </BR>";
    }
    //last row in Comment
    $output.= "&nbsp;*/";
    return $output;
  }

  public function __construct() {
  }
}
