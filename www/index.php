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

			<div class="cube-container">
				<div class="photo-cube">

					<img class="front"src="img/Demo/1.jpeg" alt="">
					<div class="back photo-desc">
					  <h3>Earth from Space</h3>
					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
						<a href="#" class="button">Like</a>
                        <a href="#" class="button">Comment</a>
					</div>
					<img class="left" src="img/Demo/2.jpeg" alt="">
					<img class="right" src="img/Demo/3.jpeg" alt="">

				</div>
			</div>

			<div class="cube-container">
				<div class="photo-cube">

					<img class="front" src="img/Demo/4.jpeg" alt="">
					<div class="back photo-desc">
					  <h3>Space Images</h3>
					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        <a href="#" class="button">Like</a>
                        <a href="#" class="button">Comment</a>
					</div>
					<img class="left" src="img/Demo/5.jpg" alt="">
					<img class="right" src="img/Demo/6.jpeg" alt="">

				</div>
			</div>

			<div class="cube-container">
				<div class="photo-cube">

					<img class="front" src="img/Demo/7.png" alt="">
					<div class="back photo-desc">
					  <h3>The Milky Way</h3>
					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        <a href="#" class="button">Like</a>
                        <a href="#" class="button">Comment</a>
					</div>
					<img class="left" src="img/Demo/8.jpeg" alt="">
					<img class="right" src="img/Demo/9.jpg" alt="">

				</div>
			</div>

            <div class="cube-container">
				<div class="photo-cube">

                    <img class="front" src="img/Demo/8.jpeg" alt="">
					<div class="back photo-desc">
					  <h3>The Milky Way</h3>
					  <p>Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        <a href="#" class="button">Like</a>
                        <a href="#" class="button">Comment</a>
					</div>
					<img class="left" src="img/Demo/7.png" alt="">
					<img class="right" src="img/Demo/9.jpg" alt="">

				</div>
			</div>

		</div>
	</div>
</div>

<?php
include 'footer.php';
?>
