<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
	$admin = new Admin();

	include($_SERVER['DOCUMENT_ROOT'] . '/login/authorization.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/login/is-logged-in.php');
?>


<!DOCTYPE html>
<html lang="ru">
	<?php
		include($_SERVER['DOCUMENT_ROOT'] . '/parts/head.php');	
	?>
	
	<body>
		
		<div class="page">
			
			<?php
				include($_SERVER['DOCUMENT_ROOT'] . '/parts/header.php');	
			?>
			
			<section class="py-5">
				<div class="container">
					<div class="row px-3">
						<div class="col-12 col-lg-6 mx-lg-auto form-wrap-border-with-shadow">
							<h1 class="text-center">Авторизация</h1>
							<form id="form-login" method="post" action="<?php echo base_site_url(); ?>/login/" class="ajax-form">
								<input type="hidden" name="login">
								<?php if ( !empty($success) ) : ?>
								<input type="hidden" name="success">
								<?php endif ?>
								<div class="form-group">
									<label for="username">Логин</label>
									<input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Логин" value="<?php echo @$_POST['username'] ?>">
									<?php if ( !empty($errors['username']) ) : ?>
									<small id="usernameHelp" class="form-text text-danger"><?php echo $errors['username'] ?></small>
									<?php endif ?>
								</div>
								<div class="form-group">
									<label for="password">Пароль</label>
									<input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Пароль" value="<?php echo @$_POST['password'] ?>">
									<?php if ( !empty($errors['password']) ) : ?>
									<small id="passwordHelp" class="form-text text-danger"><?php echo $errors['password'] ?></small>
									<?php endif ?>
								</div>
								<?php if ( !empty($errors['username_or_password']) ) : ?>
								<div class="alert alert-danger" role="alert">
									<?php echo $errors['username_or_password'] ?>
								</div>
								<?php elseif ( !empty($success) ) : ?>
								<div class="alert alert-success" role="alert">
									<?php echo $success ?>
								</div>
								<?php endif ?>
								<button type="submit" class="btn btn-warning shadow-hover-add">Войти</button>
							</form>
						</div>
					</div>
				</div>
			</section>
			
			<?php
				include($_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php');	
			?>
			
		</div>

	</body>
</html>
