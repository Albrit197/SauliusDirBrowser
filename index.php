<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File Browser</title>
</head>
<body>
    <?php 
            // FILE BROWSER
      $path = './' . $_GET["path"];
      $fileDir = scandir($path);
      echo('<table class="row">
         <th class="field">Type</th>
         <th class="field">Name</th>
         <th class="field">Action</th>');
      foreach ($fileDir as $content){
        if ($content != ".." and $content != ".") {
            print('<tr>');
            print('<td class="value">' . (is_dir($path . $content) ? "Directory" : "File") . '</td>');
            print('<td class="value">' . (is_dir($path . $content) 
                        ? '<a href="' . (isset($_GET['path']) 
                                ? $_SERVER['REQUEST_URL'] . $content . '/' 
                                : $_SERVER['REQUEST_URL'] . '?path=' . $content . '/') . '">' . $content . '</a>'
                        : $content) 
                        . '</td>');
                        // DETELE FILE
            print('<td class="value">'. (is_dir($path . $content)? ''
                  : '<form style="display: inline-block" action="" method="post">
                        <input type="hidden" name="delete" value=' . str_replace(' ', '&nbsp;', $content) . '>
                        <input type="submit" value="Delete"></form>'). "</td>");
            print('</tr>');
        }
    }
    print("</table>");
        if(isset($_POST['delete'])){
          $deleteFile = './' . $_GET["path"] . $_POST['delete'];
          $deleteFileEscaped = str_replace("&nbsp;", " ", htmlentities($deleteFile, null, 'utf-8'));
          if(is_file($deleteFileEscaped)){
              if (file_exists($deleteFileEscaped)) {
                  unlink($deleteFileEscaped);
              }
          }
      }
    
     ?>
                       <!-- CREATE DIRECTORY -->
       <form  action="/SauliusBrowser" method="get"> 
          <div class="create">
            <input type="hidden" name="path" value="<?php print($_GET['path']) ?>" /> 
            <input class="input"  placeholder="Enter directory name" type="text" id="create_dir" name="create_dir">
            <button class="field" type="submit">Submit</button>
         </div>         
      </form>
      <?php

      if(isset($_GET["create_dir"])){
        if($_GET["create_dir"] != ""){
           $NewDir = './' . $_GET["path"] . $_GET["create_dir"];
              if (!is_dir($NewDir)){
                mkdir($NewDir, 0777, true);
            }  
            echo ('<script>window.onload = function() {
                if(!window.location.hash) {
                    window.location = window.location + "#loaded";
                    window.location.reload();
                 }
            }</script>');
            
        }
    }
      ?>
    
     </body>
</html>
     
        
