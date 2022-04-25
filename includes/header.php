<header>
  <h1 class="main"><?php echo $title; ?></h1>
  <?php if (is_user_logged_in()) { ?>
  <div class="log">
  <h4><a href="<?php echo logout_url(); ?>">Log out</a></h4>
  </div>
  <?php } ?>

  <nav>
    <ul class="menu">
        <li class="<?php echo $nav_plants_data; ?>"><a class="menuItem" href="/">Plants Information</a>
        <li class="<?php echo $nav_new_entry_form; ?>"><a class="menuItem" href="/add-new-plants-form">Add New Plants</a>
    </ul>
  </nav>
</header>
