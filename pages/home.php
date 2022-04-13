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

//sorting
$sort_asc = (bool)($_GET['sort'] ?? NULL);

//stick the parts together
if ($sort_asc) {
  $sql_query = $sql_select_part . $sql_where_part . $sql_sort_part;
}
else {
  $sql_query = $sql_select_part . $sql_where_part;
}

// http params
// $sort_query_string = http_build_query(
//   array(
//     'id' => $record['id'],
//     // 'q' => $search_terms ?: NULL,
//     // 'a' => $filter_a ?: NULL,
//     // 'b' => $filter_b ?: NULL,
//     // 'c' => $filter_c ?: NULL,
//     // 'd' => $filter_d ?: NULL,
//     // 'f' => $filter_f ?: NULL
//   )
// );

$sql_url = 'plant-details?' . $sort_query_string;

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
  <div class="sections">
  <article>
  <div class="body">
  <div class="filters">
  <div class="titles">
    <p>Filters: </p>
  </div>

  <div>
  <form>
  <div class="filter">
    <div class="select" onclick="showCheckboxes()">
      <select>
        <option>Growing Needs and Characteristics: </option>
      </select>
    <div class="choices"></div>
    </div>
    <div id="checkboxes">
      <label for="one">
        <input type="checkbox" id="one" />Perennial</label>
      <label for="two">
        <input type="checkbox" id="two" />Annual</label>
      <label for="three">
        <input type="checkbox" id="three" />Full Sun</label>
      <label for="four">
        <input type="checkbox" id="four" />Partial Shade</label>
      <label for="five">
        <input type="checkbox" id="five" />Full Shade</label>
      <label for="six">
        <input type="checkbox" id="six" />Hardiness Zone Range</label>
    </div>
  </div>
  </form>
  </div>
  </div>

  <div class="filters">
  <div class="titles">
   <p>Sort: </p>
  </div>

  <div>
  <form>
  <div class="sort">
  <div class="select" onclick="showCheckboxes()">
  <select name="name" id="name">'
    <option value="" id="asc">Colloquial Name Ascendant (A-Z)</option>
    <option value="" id="desc">Colloquial Name Descendant (Z-A)</option>
  </select>
  </div>
  </div>
  </form>
  </div>
  </div>

  </div>
      <div class="plants">
        <?php
        foreach ($records as $record) { ?>
        <!-- <div class="plant"> -->
          <div>
            <a href=<?php echo "/plant-details?" . $record['id']; ?>>
              <img src=<?php echo "/public/uploads/entries/" . $record['id'] . '.jpg'?> alt="" width="250" height="250"/>
            </a>
            <h3><?php echo htmlspecialchars($record["name_colloquial"]) ?></h3>
          </div>
        <?php } ?>
      <!-- </div> -->
      </div>
    </article>

    <div class="form">
    <aside>
    <!-- <div id="feedback" class="feedback <?php echo $feedback_class; ?>">Please choose at least one sorting/filter.</div> -->

    <div class="plants">
      <h2>Choose Tag(s)</h2>
          <h3>General Classification: </h3></div>
          <div class="buttons">
            <button class="button style">Shrub</button>
            <button class="button style">Grass</button>
            <button class="button style">Vine</button>
            <button class="button style">Tree</button>
            <button class="button style">Flower</button>
            <button class="button style">Groundcovers</button>
            <button class="button style">Other</button>
          </div>
    </div>
    </div>
    </aside>
    </div>
  </main>
</body>

</html>
