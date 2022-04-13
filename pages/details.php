<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

//query pieces
$sql_select_part = 'SELECT * FROM entries ';
$sql_where_part = '';
$sql_sort_part = ' ORDER BY name_colloquial ASC;';
$sql_filter_array = array();
$sql_array = array();


// Get HTTP request user data
$id = $_GET['id'];
// $colloquial_name = $_GET['colloquial_name'];
// $perennial = (!empty($_GET['perennial']) ? 1 : 0);
// $full_sun = (!empty($_GET['full_sun']) ? 1 : 0);
// $partial_shade = (!empty($_GET['partial_shade']) ? 1 : 0);
// $full_shade = (!empty($_GET['full_shade']) ? 1 : 0);
// $hardiness_zone_range = $_GET['hardiness_zone_range'];

//Filters
$filter_exploratory_constructive_play = (bool)($_GET['exploratory_constructive_play'] ?? NULL);
$filter_exploratory_sensory_play = (bool)($_GET['exploratory_sensory_play'] ?? NULL);
$filter_physical_play = (bool)($_GET['physical_play'] ?? NULL);
$filter_imaginative_play = (bool)($_GET['imaginative_play'] ?? NULL);
$filter_restorative_play = (bool)($_GET['restorative_play'] ?? NULL);
$filter_play_with_rules = (bool)($_GET['play_with_rules'] ?? NULL);
$filter_bio_play = (bool)($_GET['bio_play'] ?? NULL);

if ($filter_exploratory_constructive_play) {
  array_push($sql_filter_array, "(exploratory_constructive_play = '1')");
}

if ($filter_exploratory_sensory_play) {
  array_push($sql_filter_array, "(exploratory_sensory_play = '1')");
}

if ($filter_physical_play) {
  array_push($sql_filter_array, "(physical_play = '1')");
}

if ($filter_imaginative_play) {
  array_push($sql_filter_array, "(imaginative_play = '1')");
}

if ($filter_restorative_play) {
  array_push($sql_filter_array, "(restorative_play = '1')");
}

if ($filter_play_with_rules) {
  array_push($sql_filter_array, "(play_with_rules = '1')");
}

if ($filter_bio_play) {
  array_push($sql_filter_array, "(bio_play = '1')");
}

if (count($sql_filter_array) > 0) {
  $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
}


// 'WHERE' $id

//detail page info
// if ($perennial) {
//   array_push($sql_array, "(perennial = '1')");
// }

// if ($sql_array[0] = $id) {
//   $sql_where_part_1 = ' WHERE ' . implode(' AND ', $sql_array);
// }

//sorting
$sort_asc = (bool)($_GET['sort'] ?? NULL);

//stick the parts together
// if ($sort_asc) {
//   $sql_query = $sql_select_part . $sql_where_part . $sql_sort_part;
// }
// else {
//   $sql_query = $sql_select_part . $sql_where_part;
// }

$sql_query = $sql_select_part . $sql_where_part_1;

// !!id
// $records = exec_sql_query(
//   $db,
//   "SELECT * FROM grades WHERE (netid = :netid);",
//   array(
//     ':netid' => $netid
//   )
// )->fetchAll();

$records = exec_sql_query($db, $sql_query)->fetchAll();
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
     <div class="plants">
      <div class="plant">
      <article>
        <div class="detail">
        <?php foreach ($records as $record) { ?>
        <h2><?php echo htmlspecialchars($record["name_colloquial"]) ?></h2>
        <div class="buttons">
            <button class="button style">Flower</button>
        </div>
        <?php } ?>
        </div>
        <div class="plant">
            <?php foreach ($records as $record) { ?>
            <img src=<?php echo "/public/uploads/entries/" . $record['id'] . '.jpg'?> alt="" width="600" height="350"/>
            <div class="catalogs">
            <div class="catalog">
              <h3>Growing Needs and Characteristics: </h3>
              <ul>
                  <?php if ($record["perennial"] == 1) { ?>
                  <li>Perennial</li>
                  <?php } ?>
                  <?php if ($record["full_sun"] == 1) { ?>
                  <li>Full Sun</li>
                  <?php } ?>
                  <?php if ($record["partial_shade"] == 1) { ?>
                  <li>Particla Shade</li>
                  <?php } ?>
                  <?php if ($record["full_shade"] == 1) { ?>
                  <li>Full Shade</li>
                  <?php } ?>
                  <li><?php echo htmlspecialchars($record["hardiness_zone_range"]) ?></li>
              </ul>
            </div>
            <?php } ?>
        </div>
        </div>
      </article>
      </div>
      </div>
  </main>
</body>

</html>
