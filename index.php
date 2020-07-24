  
    <?php 
      session_start();
                                 
                        //Log_in/Log_out

      $message = '';
         if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {	
           if ($_POST['username'] == 'Wellboy' && $_POST['password'] == 'koja') {
              $_SESSION['logged_in'] = true;
              $_SESSION['username'] = 'Wellboy';
           } else {
              $message = 'Wrong username or password';
       }
    }
         
            if(isset($_GET['action']) and $_GET['action'] == 'logout'){
              session_start();
              unset($_SESSION['username']);
              unset($_SESSION['password']);
              unset($_SESSION['logged_in']);
              $message = '';
         if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {	
           if ($_POST['username'] == 'Wellboy' && $_POST['password'] == 'koja') {
              $_SESSION['logged_in'] = true;
              $_SESSION['username'] = 'Wellboy';
           } else {
              $message = 'Wrong username or password';
       }
    }
              
        }

                          //Create dir

        if(isset($_GET["create_dir"])){
         if($_GET["create_dir"] != ""){
           $NewDir = './' . $_GET["path"] . $_GET["create_dir"];
               if (!is_dir($NewDir)){
                 mkdir($NewDir, 0777, true);
                 echo "<meta http-equiv='refresh' content='0'>";
             }   
           }
         }

                          //Delete file

        if(isset($_POST['delete'])){
            $deleteFile = './'. $_GET["path"] . $_POST['delete'];
            $fileEdit = str_replace("&nbsp;", " ", htmlentities($deleteFile, null, 'utf-8'));
               if(is_file($fileEdit)){
                 if (file_exists($fileEdit)){
                     unlink($fileEdit);
                             echo'<script>window.location.reload()</script>';
               }
            }
         }
      ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File Browser</title>
</head>
<body>

                        <!-- Interface -->

   <?php
   if(!$_SESSION['logged_in'] == true){
      print('<div class="login">Please login</div>');
      print('<form class="row" action = "" method = "post">');
      print('<h4>' . $message . '</h4>');
      print('<input class="value slide" type = "text" name = "username" placeholder = "username = Wellboy" required autofocus></br>');
      print('<input class="value" type = "password" name = "password" placeholder = "password = koja" required>');
      print('<button class = "field" type = "submit" name = "login">Login</button>');
      print('</form>');
          die();
   }
        
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
            print('<td class="value">' . (is_dir($path . $content)? 
                  '<a href="' . (isset($_GET['path'])
                  ? $content . '/' 
                  : '?path=' . $content . '/') . '">' . $content . '</a>'
                     : $content) 
                        . '</td>');
            print('<td class="value">'. (is_dir($path . $content)? ''
                  : '<form style="display: inline-block" action="" method="post">
                        <input type="hidden" name="delete" value=' . str_replace(' ', '&nbsp;', $content) . '>
                        <input class="delete" type="submit" value="Delete"></form>'). "</td>");
            print('</tr>');
        }
    }
    print("</table>"); 
                                      
                                 //Go back button

    $link_back = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
    if (!empty($link_back)) {
       echo '<p class="margin"><a class="back" href="'. $link_back .'" title="Return to the previous page">&laquo; Go back</a></p>';
          } else {
             echo '<p class="back"><a class="field" href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
    }                
     ?>            
       <form  action="/SauliusBrowser" method="get"> 
          <div class="create">
            <input type="hidden" name="path" value="<?php print($_GET['path']) ?>" /> 
            <input class="input"  placeholder="Enter directory name" type="text" id="create_dir" name="create_dir">
            <button class="field" type="submit">Submit</button>
         </div>         
      </form>
      
       <div class="out"> click here to <a class="log_out" href = "index.php?action=logout"> logout.</div>
                      
     </body>
</html>
     
        
