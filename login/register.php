<?php
	include("../lib/config.php");
	html_begin($template,$title,$page="login");
	
	if (session_is_registered("username")) {
		echo "Вече си логнат";
	} else {
	
		$error=new error;
		$register_form=new register_form;
		if (isset($_POST["submit"])) {
			extract($_POST);
			$is_all_ok = $register_form->add_user($u_nick, $u_email, $password, $password1);
			if ($is_all_ok == 1) {
				$db_users->add_user($u_nick,$u_email,$md5password);
				$send_mail = $register_form->send_approve_mail($u_nick, $u_email, $password, $uniq_id);
				$send_adminmail = $register_form->send_mailtoAmin($u_nick, $u_email);
				$done = true;
			}
		}
		if (isset($_GET["app"])) {
			($db_users ? false : $db_users=new db_users);
			$approve = $db_users->approve_user($_GET["app"]);
		}
?>	
	<div class="main">
		<h1 class="title">
			<a href="<?=BASEDIR?>">Bookmarks</a>
			<b>Регистрация</b>
		</h1>
			<form method="POST" action="">
				<div class="fpage_form">
				<?php if (!$done && !isset($_GET["app"])) { ?>
					<label>Регистрация</label>
						<ul>
							<li><b>Потребителско име</b><?=$register_form->print_input("text","u_nick","u_nick",$u_nick);?></li>
							<li><b>E-mail адрес</b><?=$register_form->print_input("text","u_email","u_email",$u_email);?></li>
							<li><b>Парола</b><?=$register_form->print_input("password","password","password",$password);?></li>
							<li><b>Повторете паролата</b><?=$register_form->print_input("password","password1","password1",$password1);?></li>
						</ul>
						<?php
							if ($register_form->login_error && $register_form->login_error == 1) {
								$error->print_error($error->er_empty);
							}
						?>
				<?php
					} elseif ($done) {
						print "<h3>Поздравления!</h3>";
						print "<p>Регистрацията беше успешна. Ще получите писмо на адрес <a href=\"mailto:$u_email\">$u_email</a> за активация на акаунта Ви.</p>";
					} elseif (isset($_GET["app"])) {
						print ($approve == true ? "<h3>Поздравления!</h3><p>Вашият акаунт беше успешно активиран</p>\n" : "<h3>Грешка!</h3><p>Акаунтът не съществува или вече е активиран</p>");
					}
				
				?>
				</div>
				<a href="<?=BASEDIR?>" class="register">Вход</a>
				<!--<input class="submit" type="submit" name="submit" value="Влез" />//-->
				<?=$register_form->print_input("submit","submit","submit","Прати");?>
			</form>
		<?php
			(isset($register_form->error_msg) ? $register_form->print_error() : false);
		?>
	</div>
		<?php
	}
	#include(ROOTDIR."/lib/footer.php");
?>