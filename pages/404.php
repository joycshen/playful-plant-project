<?php
$title = "Page Not Found";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?php echo $title; ?></title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>

  <?php include('includes/header.php'); ?>

  <main>
    <section>
      <h2><?php echo $title; ?></h2>

       <p>Sorry, the page you are looking for is not found. Please use the navigation bar above to navigate to other pages.</p>
    </section>
  </main>

</body>

</html>
