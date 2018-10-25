<?php
include 'header.php';

if (isset($_GET['logged']) AND !empty($_GET['logged']))
{
    echo '<div class="warning" style="margin-bottom: 55px;">You are already log in.</div>';
}
if (isset($_GET['subscribe']) AND !empty($_GET['subscribe']))
{
    echo '<div class="warning" style="margin-bottom: 55px;">Please log out before.</div>';
}
if ($_GET['msg'] == 'camagru_success') {
  echo '<div class="success" style="margin-bottom: 55px;">Picture successfully uploaded</div>';
}
else if ($_GET['msg'] == 'like'){
  echo '<div class="success" style="margin-bottom: 55px;">Picture like</div>';
}
?>

<div id="myodal" class="modal" style="display: none;">
  <div class="modal-content">
    <div id="previous_comments"></div>
    <?php if($_SESSION['logged']) {?>
      <input type="text" placeholder="comment" id="comment_to_push">
      <button onclick="comment(document.getElementById('comment_to_push').value)" id="comment_button">send</button>
    <?php }?>
  </div>
</div>

<div class="container">
    <div class="container">
		<header class="main-header clearfix">
			<img class="logo" src="/img/icon/camera.svg">
			<h1 class="name">Camagru <span>news</span></h1>
		</header>
		<div class="content clearfix">

<?php

$data_path = "data";
if (is_dir($data_path) == FALSE)
    mkdir($data_path, 0777, true);
$data_contenu = glob($data_path . '/*');
array_multisort(array_map('filemtime', $data_contenu), SORT_NUMERIC, SORT_DESC, $data_contenu);

include './script/script_getlike.php';

foreach ($data_contenu as $key => $value)
{
    $dir_path = $value;
    $dir_contenu = glob($dir_path . '/*');
    array_multisort(array_map('filemtime', $dir_contenu), SORT_NUMERIC, SORT_DESC, $dir_contenu);
    $nbsquare = round(count($dir_contenu) / 3);
    $nblastsquarefaces = count($dir_contenu) % 3;

    foreach ($dir_contenu as $key => $value)
    {
        $current_cube = NULL;
        $nbface = basename($value);
        $nbface = substr($nbface, 1, 1);
        $nblike = getlike($value);
        if(file_exists($value.'/comment'))
        {
            $description = file_get_contents($value.'/comment');
        }
        else {
            $description = "No description.";
        }

        if ($handle = opendir($value))
        {
            while (false !== ($entry = readdir($handle)))
            {
                if ($entry != "." && $entry != "..")
                {
                    $current_cube[] = $entry;
                }
            }
            echo '
            <div class="cube-container">
            <div class="photo-cube">

              <img class="front"src="'.$value."/".$current_cube[0].'" alt="">
              <div class="back photo-desc">
                <h3>Earth from Space</h3>
                <p>'.$description.'</p>
                <a href="#" class="button" onclick="like(this)" id='.$value.'>Like - '.$nblike.'</a>
                <button name="comment" class="button" id='.$value.' onclick="display_modal(this)">Comment</button>
              </div>';

            if ($nbface == 3)
            {
                echo'
                    <img class="left" src="'.$value."/".$current_cube[1].'" alt="">
          					<img class="right" src="'.$value."/".$current_cube[2].'" alt="">
                		</div>
                		</div>';
            }
            elseif ($nbface == 2)
            {
                echo'
                    <img class="left" src="'.$value."/".$current_cube[1].'" alt="">
                		<img class="right" src="../img/cube/test.jpg" alt="">
                		</div>
                    </div>';
            }
            elseif ($nbface == 1)
            {
                echo'
                		<img class="left" src="../img/cube/test.jpg" alt="">
                		<img class="right" src="../img/cube/test.jpg" alt="">
                		</div>
                    </div>';
            }
            closedir($handle);
        }
    }
}

?>

        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
