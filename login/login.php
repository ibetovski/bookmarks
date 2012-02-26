<?php
	html_begin($template, $title,$page="login");
	
	if (session_is_registered("username")) {
		echo "Вече си логнат";
	} else {
	
	/*$forms=new forms;*/
	$error=new error;
	$loginForm=new loginForm;
	if (isset($_POST["submit"])) {
		$loginForm->logincheck();
		extract($_POST);
	}
?>	
	<div class="main">
		<h1 class="title">
			<a href="<?=BASEDIR?>">Bookmarks</a>
			<b>Вход</b>
		</h1>
		<form method="POST" action="<?=BASEDIR?>">
			<div class="fpage_form">
			<label>Вход</label>
				<ul>
					<li><b>Потребителско име</b>
					<!--<input type="text" name="username" />//-->
					<?=$loginForm->print_input("text","username","username",$username);?>
					</li>
					<li><b>Парола</b>
					<!--<input type="password" name="password" />//-->
					<?=$loginForm->print_input("password","password","password",$password);?>
					</li>
					<li>
						<?=$loginForm->print_input("checkbox","rememberme","rememberme",$rememberme);?>
						Запомни ме
					</li>
					<li>
						<a href="<?=BASEDIR?>login/forgot.php" class="forgot">Забравена парола?</a>
					</li>
				</ul>
				<?php
					if ($loginForm->login_error && $loginForm->login_error == 1) {
						$loginForm->print_error();
					}
				?>
			</div>
			<a href="<?=BASEDIR?>login/register.php" class="register">Регистрация</a>
			<?=$loginForm->print_input("submit","submit","submit","Влез");?>
		</form>
	</div>
		<?php
	}
	
	#print_debug($str_debug);
?>