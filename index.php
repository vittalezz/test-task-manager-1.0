<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
	$tasks = new Tasks();
	$admin = new Admin();
	
	include($_SERVER['DOCUMENT_ROOT'] . '/login/is-logged-in.php');
	
	include($_SERVER['DOCUMENT_ROOT'] . '/parts/change-task.php');	
	include($_SERVER['DOCUMENT_ROOT'] . '/parts/add-task.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/parts/sort-tasks.php');	
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
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">Задачи</h1>
							<ul class="sort-list row flex-column flex-md-row mt-5 px-3">
								<li data-sort_by="id" data-sort_direction="<?php echo $sort_list_item_data_direction['id'] ?>" class="zindex-hover-3<?php echo ( !empty($sort_list_item_data_direction['id']) ) ? ' active' : ''; ?>"><span class="shadow-hover-add">По дате</span></li>
								<li data-sort_by="user_name" data-sort_direction="<?php echo $sort_list_item_data_direction['user_name'] ?>" class="zindex-hover-3<?php echo ( !empty($sort_list_item_data_direction['user_name']) ) ? ' active' : ''; ?>"><span class="shadow-hover-add">По имени пользователя</span></li>
								<li data-sort_by="description" data-sort_direction="<?php echo $sort_list_item_data_direction['description'] ?>" class="zindex-hover-3<?php echo ( !empty($sort_list_item_data_direction['description']) ) ? ' active' : ''; ?>"><span class="shadow-hover-add">По тексту описания</span></li>
								<li data-sort_by="user_email" data-sort_direction="<?php echo $sort_list_item_data_direction['user_email'] ?>" class="zindex-hover-3<?php echo ( !empty($sort_list_item_data_direction['user_email']) ) ? ' active' : ''; ?>"><span class="shadow-hover-add">По Email пользователя</span></li>
								<li data-sort_by="completed" data-sort_direction="<?php echo $sort_list_item_data_direction['completed'] ?>" class="zindex-hover-3<?php echo ( !empty($sort_list_item_data_direction['completed']) ) ? ' active' : ''; ?>"><span class="shadow-hover-add">По статусу</span></li>
							</ul>
							<div class="tasks-items-wrap list-group py-5">
								<?php echo $tasks_items ?>
							</div>
						</div>
					</div>
					<?php echo $tasks_pagination ?>
				</div>
			</section>
			
			<section class="py-5">
				<div class="container">
					<div class="row px-3">
						<div class="col-12 col-lg-6 mx-lg-auto form-wrap-border-with-shadow">
							<h2 class="text-center">Добавить задачу</h1>
							<form id="form_add_task" method="post" action="/" class="ajax-form">
								<input type="hidden" name="add">
								<?php if ( !empty($success) ) : ?>
								<input type="hidden" name="success">
								<?php endif ?>
								<div class="form-group">
									<label for="name">Имя</label>
									<input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Ваше Имя" value="<?php echo @$_POST['name'] ?>">
									<?php if ( !empty($errors['name']) ) : ?>
									<small id="nameHelp" class="form-text text-danger"><?php echo $errors['name'] ?></small>
									<?php endif ?>
								</div>
								
								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Ваш Email" value="<?php echo @$_POST['email'] ?>">
									<?php if ( !empty($errors['email']) ) : ?>
									<small id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?></small>
									<?php endif ?>
								</div>
								
								<div class="form-group">
									<label for="description">Описание</label>
									<textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Описание задачи"><?php echo @$_POST['description'] ?></textarea>
									<?php if ( !empty($errors['description']) ) : ?>
									<small id="descriptionHelp" class="form-text text-danger"><?php echo $errors['description'] ?></small>
									<?php endif ?>
								</div>
								<?php if ( !empty($success) ) : ?>
								<div class="alert alert-success add-alert-success" role="alert">
									<?php echo $success ?>
								</div>
								<?php endif ?>
								<button type="submit" class="btn btn-warning shadow-hover-add">Добавить</button>
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
