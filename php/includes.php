<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  if ($handle = opendir('/path/to/files')) {

    while (false !== ($file = readdir($handle))) {
        if (filectime($file) < (time() - 86400)) {  // 86400 = 60*60*24
            unlink($file);
        }
    }
}