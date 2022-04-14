<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$plant_id = $_GET['id'] ?? NULL;

if ($plant_id) {
  $records = exec_sql_query(
    $db,
    "SELECT * FROM entries WHERE id = :id;",
    array(':id' => $plant_id)
  )->fetchAll();

  // if (count($records) > 0) {
  $plant = $records[0];
}
  //   $title = $plant[''] . '';
  // } else {
  //   $plant = NULL;

  //   $title = '';
  // }

// Get HTTP request user data
// $id = $_GET['id'];

// $records = exec_sql_query(
//   $db,
//   "SELECT * FROM entries WHERE (id = :id);",
//   array(
//     ':id' => $id
//   )
// )->fetchAll();


// // locate plant
// if (count($records) > 0) {
//   $record = $records[0];
// }

// if ($record) {
//   $id = $record['id'];
// }

// $records = exec_sql_query($db, $sql_query)->fetchAll();

// --------- could disregard -----------

// //query pieces
// $sql_select_part = 'SELECT * FROM entries ';
// $sql_where_part = '';
// $sql_sort_part = ' ORDER BY name_colloquial ASC;';
// $sql_filter_array = array();
// $sql_array = array();


// // $colloquial_name = $_GET['colloquial_name'];
// // $perennial = (!empty($_GET['perennial']) ? 1 : 0);
// // $full_sun = (!empty($_GET['full_sun']) ? 1 : 0);
// // $partial_shade = (!empty($_GET['partial_shade']) ? 1 : 0);
// // $full_shade = (!empty($_GET['full_shade']) ? 1 : 0);
// // $hardiness_zone_range = $_GET['hardiness_zone_range'];

// //Filters
// $filter_exploratory_constructive_play = (bool)($_GET['exploratory_constructive_play'] ?? NULL);
// $filter_exploratory_sensory_play = (bool)($_GET['exploratory_sensory_play'] ?? NULL);
// $filter_physical_play = (bool)($_GET['physical_play'] ?? NULL);
// $filter_imaginative_play = (bool)($_GET['imaginative_play'] ?? NULL);
// $filter_restorative_play = (bool)($_GET['restorative_play'] ?? NULL);
// $filter_play_with_rules = (bool)($_GET['play_with_rules'] ?? NULL);
// $filter_bio_play = (bool)($_GET['bio_play'] ?? NULL);

// if ($filter_exploratory_constructive_play) {
//   array_push($sql_filter_array, "(exploratory_constructive_play = '1')");
// }

// if ($filter_exploratory_sensory_play) {
//   array_push($sql_filter_array, "(exploratory_sensory_play = '1')");
// }

// if ($filter_physical_play) {
//   array_push($sql_filter_array, "(physical_play = '1')");
// }

// if ($filter_imaginative_play) {
//   array_push($sql_filter_array, "(imaginative_play = '1')");
// }

// if ($filter_restorative_play) {
//   array_push($sql_filter_array, "(restorative_play = '1')");
// }

// if ($filter_play_with_rules) {
//   array_push($sql_filter_array, "(play_with_rules = '1')");
// }

// if ($filter_bio_play) {
//   array_push($sql_filter_array, "(bio_play = '1')");
// }

// if (count($sql_filter_array) > 0) {
//   $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
// }


// //stick the parts together
// if ($sort_asc) {
//   $sql_query = $sql_select_part . $sql_where_part . $sql_sort_part;
// }
// else {
//   $sql_query = $sql_select_part . $sql_where_part;
// }

// $sql_query = $sql_select_part . $sql_where_part;

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
        <?php if ($plant) { ?>
        <div class="detail">
        <h2><?php echo $record['name_colloquial'] ?></h2>
        <div class="buttons">
          <!-- need to get tags here -->
            <button class="button style">Flower</button>
        </div>
        </div>
        <div class="plant">
            <img src="/public/uploads/entries/<?php echo $plant['id'] . $plant['img_ext'];  ?>" alt="<?php echo htmlspecialchars($plant['name_colloquial']); ?>" width="600" height="350"/>
            <div class="catalogs">
            <div class="catalog">
              <h3>Growing Needs and Characteristics: </h3>
              <ul>
                  <?php if ($plant["perennial"] == 1) { ?>
                  <li>Perennial</li>
                  <?php } ?>
                  <?php if ($plant["full_sun"] == 1) { ?>
                  <li>Full Sun</li>
                  <?php } ?>
                  <?php if ($plant["partial_shade"] == 1) { ?>
                  <li>Particla Shade</li>
                  <?php } ?>
                  <?php if ($plant["full_shade"] == 1) { ?>
                  <li>Full Shade</li>
                  <?php } ?>
                  <li><?php echo htmlspecialchars($plant["hardiness_zone_range"]) ?></li>
              </ul>
            </div>
        </div>
        </div>
        <?php } ?>
      </article>
      </div>
      </div>
  </main>
</body>

</html>
