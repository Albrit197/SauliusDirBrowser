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
            print('<td class="value">
            <button class="delete">Delete</button>
            </td>');
            print('</tr>');
        }
    }
    print("</table>");
    
     ?>
            <form  action="/SauliusBrowser" method="get"> 
               <div class="create">
                  <input class="input"  placeholder="Enter directory name" type="text" id="create_dir" name="create_dir">
                  <button class="field" type="submit">Submit</button>
              </div>
                
            </form>
    
     </body>
</html>
     
        
