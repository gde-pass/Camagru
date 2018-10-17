<?php
session_start();

if ($_SESSION['logged'] == FALSE) {
    header('Location: ../form/form_login.php?logged=no');
    exit(0);
}

include '../header.php';
include '../config/database.php';

switch ($_GET['msg'])
{
    case 'uploaded':
        echo '<div class="success" style="margin-bottom: 55px;">Picture successfully uploaded</div>';
        break;

    case 'invalid_extension':
        echo '<div class="error" style="margin-bottom: 55px;">You tried to upload a invalid extension, please use png, jpeg, jpg or gif</div>';
        break;

    case 'unknow_error':
        echo '<div class="error" style="margin-bottom: 55px;">Something wrong happenned</div>';
        break;

    case 'to_heavy':
        echo '<div class="error" style="margin-bottom: 55px;">Your picture is to heavy, please upload a picture under 2Mo</div>';
        break;

    case 'empty':
        echo '<div class="error" style="margin-bottom: 55px;">You sent nothing !</div>';
        break;

    case 'to_mutch':
        echo '<div class="error" style="margin-bottom: 55px;">You sent more than 3 pictures !</div>';
        break;
}

$dir_path = "../data/" . $_SESSION['nickname'];
if (is_dir($dir_path) == FALSE)
{
    mkdir($dir_path, 0777, true);
}
$dir_contenu = glob($dir_path . '/*');
array_multisort(array_map('filemtime', $dir_contenu), SORT_NUMERIC, SORT_DESC, $dir_contenu);
$nbsquare = round(count($dir_contenu) / 3);
$nblastsquarefaces = count($dir_contenu) % 3;

?>

<section class="profile">
  <header class="header">
    <div class="details">
      <img src="data:image/png;base64,<?= $_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic">
      <h1 class="heading"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>
      <div class="nickname">
        <p><?php echo $_SESSION['nickname']; ?></p>
      </div>
      <form method="post" enctype="multipart/form-data" action="../script/upload_img.php">
       <div>
         <label for="file">Sélectionner le fichier à envoyer</label>
         <input type="file" id="file" name="img[]" multiple accept=".jpg, .jpeg, .png, .gif">
       </div>
         <button>Envoyer</button>
       </div>
      </form>
    </div>
  </header>
</section>


<div class="container">
    <div class="container">
		<header class="main-header clearfix">
			<img class="logo" src="/img/icon/camera.svg">
			<h1 class="name">My <span>Gallery</span></h1>
		</header>
        <div class="content clearfix">
<?php

foreach ($dir_contenu as $key => $value)
{
    $current_cube = NULL;
    $nbface = basename($value);
    $nbface = substr($nbface, 1, 1);
    if ($handle = opendir($value))
    {
        while (false !== ($entry = readdir($handle)))
        {
            if ($entry != "." && $entry != "..")
            {
                $current_cube[] = $entry;
            }
        }
        if ($nbface == 3)
        {
            echo'
            			<div class="cube-container">
            				<div class="photo-cube">

            					<img class="front"src="'.$value."/".$current_cube[0].'" alt="">
            					<div class="back photo-desc">
            					  <h3>Earth from Space</h3>
            					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            						<a href="#" class="button" onclick="like(this)" id='.$value.'>Like</a>
                        <a href="#" class="button" onclick="comment(this)" id='.$value.'>Comment</a>
            					</div>
            					<img class="left" src="'.$value."/".$current_cube[1].'" alt="">
            					<img class="right" src="'.$value."/".$current_cube[2].'" alt="">

            				</div>
            			</div>';
        }
        elseif ($nbface == 2)
        {
            echo'
            			<div class="cube-container">
            				<div class="photo-cube">

            					<img class="front"src="'.$value."/".$current_cube[0].'" alt="">
            					<div class="back photo-desc">
            					  <h3>Earth from Space</h3>
            					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            						<a href="#" class="button" onclick="like(this)" id='.$value.'>Like</a>
                        <a href="#" class="button" onclick="comment(this)" id='.$value.'>Comment</a>
            					</div>
            					<img class="left" src="'.$value."/".$current_cube[1].'" alt="">
            					<img class="right" src="../img/cube/test.jpg" alt="">


            			</div>
                    </div>';
        }
        elseif ($nbface == 1)
        {
            echo'
            			<div class="cube-container">
            				<div class="photo-cube">

            					<img class="front"src="'.$value."/".$current_cube[0].'" alt="">
            					<div class="back photo-desc">
            					  <h3>Earth from Space</h3>
            					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            						<a href="#" class="button" onclick="like(this)" id='.$value.'>Like</a>
                        <a href="#" class="button" onclick="comment(this)" id='.$value.'>Comment</a>
            					</div>
            					<img class="left" src="../img/cube/test.jpg" alt="">
            					<img class="right" src="../img/cube/test.jpg" alt="">


            			</div>
                    </div>';
        }
        closedir($handle);
    }
}
?>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>
