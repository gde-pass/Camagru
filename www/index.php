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
?>

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
                						<a href="#" class="button" id='.$value.'>Like</a>
                                        <a href="#" class="button" id='.$value.'>Comment</a>
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
                						<a href="#" class="button" id='.$value.'>Like</a>
                                        <a href="#" class="button" id='.$value.'>Comment</a>
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
                						<a href="#" class="button" id='.$value.'>Like</a>
                                        <a href="#" class="button" id='.$value.'>Comment</a>
                					</div>
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
