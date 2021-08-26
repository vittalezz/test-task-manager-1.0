<header class="bg-dark py-5 shadow">
   <div class="container">
      <div class="row">
         <div class="col-8 col-md-4 col-lg-2">
            <div class="logo">
               <a href="/">
                  <img alt class="icon-black-to-white icon-hover-black-to-yellow" src="assets/images/logo.svg">
               </a>
            </div>
         </div>
         <div class="col-4 ml-auto">
            <div id="login-wrap" class="auth d-flex">
               <a class="login ml-auto <?php echo $classes['logged_icon'] ?>" href="#">
                  <img alt width="24" height="24" class="logged-false-img icon-black-to-white icon-hover-black-to-yellow" src="assets/images/user-lock-solid.svg">
                  <img alt width="24" height="24" class="logged-true-img icon-black-to-white icon-hover-black-to-yellow" src="assets/images/user-check-solid.svg">
               </a>
               <div class="login-modal-window login-modal-window p-3 border border-dark rounded close">
                  <?php if( $admin->isLoggedIn() == 1 ) : ?>
                  <p>Вы вошли как <strong><?php echo $admin->username; ?></strong></p>
                  <form method="post" action="<?php echo base_site_url(); ?>/login/logout.php">
                     <button type="submit" name="logout" class="btn btn-warning shadow-hover-add">Выход</button>
                  </form>
                  <?php else : ?>
                  <p>Вы не авторизированы</p>
                  <a href="/login/" class="btn btn-warning shadow-hover-add">Авторизация</a>
                  <?php endif ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>