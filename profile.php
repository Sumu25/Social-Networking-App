<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");
echo "<h3>Your Profile</h3>";
$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if (isset($_POST['text']))
{
$text = sanitizeString($_POST['text']);
$text = preg_replace('/\s\s+/', ' ', $text);
if ($result->num_rows)
queryMysql("UPDATE profiles SET text='$text' where user='$user'");
else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
}
else
{
if ($result->num_rows)
{
$row = $result->fetch_array(MYSQLI_ASSOC);
$text = stripslashes($row['text']);
}
else $text = "";
}
$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
if (isset($_FILES['image']['name']))
{
$saveto = "$user.jpg";
move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
$typeok = TRUE;
switch($_FILES['image']['type'])
{
case "image/gif": $src = $saveto; break;
case "image/jpeg": $src = $saveto; break;
case "image/jpg": $src = $saveto; break;
case "image/png": $src = $saveto; break;
/*
//case "image/gif": $src = imagecreatefromgif($saveto); break;
//case "image/jpeg": Both regular and progressive jpegs
//case "image/jpeg": $src = imagecreatefromjpeg($saveto); break;
//case "image/png": $src = imagecreatefrompng($saveto); break;

default: $typeok = FALSE; break;
}
if ($typeok)
{
list($w, $h) = getimagesize($saveto);
$max = 100;
$tw = $w;
$th = $h;
if ($w > $h && $max < $w)
{
$th = $max / $w * $h;
$tw = $max;
}
elseif ($h > $w && $max < $h)
{
$tw = $max / $h * $w;
$th = $max;
}
elseif ($max < $w)
{
$tw = $th = $max;
}
//($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
//imageconvolution($tmp, array(array(-1, -1, -1),
//array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
//imagejpeg($tmp, $saveto);
//imagedestroy($tmp);
//imagedestroy($src);
*/
}
}
showProfile($user);
echo <<<_END
<html>
<head>
<style>
img
{
border :1px solid black;
margin-right :15px;
-moz-box-shadow :2px 2px 2px #888;
-webkit-box-shadow:2px 2px 2px #888;
box-shadow :2px 2px 2px #888;
height: 300px;
width: 200px;
margin-left: 10px;
}
div {
  text-align : auto;
}
</style>
</head>
<body>
<div>
<form data-ajax='false' method='post'
action='profile.php' enctype='multipart/form-data'>
<br />
<h3>Enter or edit your details and/or upload an image</h3>
<textarea name='text'>$text</textarea><br>
Image: <input type='file' style ="cursor:pointer" name='image' accept="image/png,image/gif,image/jpg,image/jpeg" size='14' ">
<input type='submit' style ="cursor:pointer" value='Save Profile'>
<p style ="color : white">
Only Upload JPG , PNG, GIF type of files
</p>
</form>
</div><br>
</body>
</html>
_END;
?>