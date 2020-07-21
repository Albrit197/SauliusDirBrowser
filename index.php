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
      $path = './' . $_GET["path"];
      $fileDir = scandir($path);
      echo('<h2 class: "header">Directory:'.str_replace('?path=','',$_SERVER['REQUEST_URI']) .'</h2>');
      echo('<table class="row">
         <th class="field">Type</th>
         <th class="field">Name</th>
         <th class="field">Action</th>');
    foreach ($fileDir as $content){
        if ($content != ".." and $content != ".") {
            print('<tr>');
            print('<td>' . (is_dir($path . $content) ? "Directory" : "File") . '</td>');
            print('<td>' . (is_dir($path . $content) 
                        ? '<a href="' . (isset($_GET['path']) 
                                ? $_SERVER['REQUEST_URL'] . $content . '/' 
                                : $_SERVER['REQUEST_URL'] . '?path=' . $content . '/') . '">' . $content . '</a>'
                        : $content) 
                . '</td>');
            print('<td></td>');
            print('</tr>');
        }
    }
    print("</table>");
     ?>
     </body>
</html>
     
        
