<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

//query pieces
// $sql_select_part = 'SELECT * FROM entries ';
$sql_select_part = "SELECT
entries.name_colloquial AS 'entries.name_colloquial',
entries.name_genus_species AS 'entries.name_genus_species',
entries.plant_id AS 'entries.plant_id',
entries.exploratory_constructive_play AS 'entries.exploratory_constructive_play',
entries.exploratory_sensory_play AS 'entries.exploratory_sensory_play',
entries.physical_play AS 'entries.physical_play',
entries.imaginative_play AS 'entries.imaginative_play',
entries.restorative_play AS 'entries.restorative_play',
entries.play_with_rules AS 'entries.play_with_rules',
entries.bio_play AS 'entries.bio_play',
entries.perennial AS 'entries.perennial',
entries.full_sun AS 'entries.full_sun',
entries.partial_shade AS 'entries.partial_shade',
entries.full_shade AS 'entries.full_shade',
entries.hardiness_zone_range AS 'entries.hardiness_zone_range',
entries.img_ext AS 'entries.img_ext',
tags.tag_name AS 'tags.tag_name',
entry_tags.entry_id AS 'entries.id',
entry_tags.tag_id AS 'tags.id'
FROM
entry_tags
LEFT OUTER JOIN entries ON (entry_tags.entry_id = entries.id)
LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id);";
$sql_where_part = '';
$sql_sort_part = ' ORDER BY name_colloquial ASC;';
$sql_filter_array = array();
$sql_tag_array = array();

//get tag
// $tag_id = $_GET['id'] ?? NULL;

// if ($tag_id) {
//   $tags = exec_sql_query(
//     $db,
//     "SELECT * FROM tags;",
//     array(':id' => $tag_id)
//   )->fetchAll();

//   $tag = $tags[0];
// }

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

// if (count($sql_filter_array) > 0) {
//   $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
// }

//tags
$tag_name = $_GET['tag'];
// $tag_grass = $_GET['grass'];
// $tag_vine = $_GET['vine'];
// $tag_tree = $_GET['tree'];
// $tag_flower = $_GET['flower'];
// $tag_groundcovers = $_GET['groundcovers'];
// $tag_other = $_GET['other'];
// $tag_name = $_GET['tags.tag_name'];

if ($tag_name) {
  array_push($sql_tag_array, "('tag = 'shrub')");
}

// if ($tag_grass) {
//   array_push($sql_tag_array, "('grass' = 'grass')");
// }

// if ($tag_vine) {
//   array_push($sql_tag_array, "('vine' = 'vine')");
// }

// if ($tag_tree) {
//   array_push($sql_tag_array, "('tree' = 'tree')");
// }

// if ($tag_flower) {
//   array_push($sql_tag_array, "('flower' = 'flower')");
// }

// if ($tag_groundcovers) {
//   array_push($sql_tag_array, "('groundcovers' = 'groundcovers')");
// }

// if ($tag_other) {
//   array_push($sql_tag_array, "('other' = 'other')");
// }

// tag and/or filter
if (count($sql_tag_array) > 0) {
  $sql_where_part = ' WHERE ' . implode(' AND ', $sql_tag_array);
}
elseif (count($sql_filter_array) > 0) {
  $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
}
elseif (count($sql_tag_array) > 0 && count($sql_filter_array) > 0) {
  $sql_where_part = ' WHERE ' . implode(' AND ', $sql_tag_array, ' AND ', $sql_filter_array);
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
  <div class="body-display">
  <div class="row">
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
  </div>
  </form>
  </div>

  <div class="row">
  <div class="titles">
   <p>Sort: </p>
  </div>

  <div>
  <form id="request-form" method="get" action="/" novalidate>
  <div class="sort">
  <div class="select" onclick="showCheckboxes()">
  <select name="name" id="name">'
    <option value="asc" id="asc">Colloquial Name Ascendant (A-Z)</option>
    <option value="desc" id="desc">Colloquial Name Descendant (Z-A)</option>
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
          <a href="/plant-details?<?php echo http_build_query(array('id' => $record['entries.id'])); ?>">
            <img src="/public/uploads/entries/<?php echo $record['entries.id'] . $record['entries.img_ext']; ?>" alt="" width="250" height="250"/>
            </a>
            <h3><?php echo htmlspecialchars($record["entries.name_colloquial"]) ?></h3>
            <h3 class="hidden"><?php echo htmlspecialchars($record["tags.tag_name"]) ?></h3>
        </div>
      <?php } ?>
      <!-- </div> -->
    </div>
    </article>

    <aside>
    <div class="form">
    <div class="column">
      <h2>Choose Tag(s)</h2>
          <h3>General Classification: </h3></div>
          <div class="buttons">
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="shrub">Shrub</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="grass">Grass</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="vine">Vine</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="tree">Tree</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="flower">Flower</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="groundcovers">Groundcovers</button>
          </form>
          <form id="request-form" method="get" action="/" novalidate>
             <button class="button style" type="submit" name="tag" value="other">Other</button>
          </form>
            <!-- <button class="button style">Shrub</button> -->
            <!-- <button class="button style">Grass</button>
            <button class="button style">Vine</button>
            <button class="button style">Tree</button>
            <button class="button style">Flower</button>
            <button class="button style">Groundcovers</button>
            <button class="button style">Other</button> -->
          </div>
    </div>
  </aside>

    </div>
  </main>

  <!-- <script type="text/javascript" src="public/scripts/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="public/scripts/drop-down.js"></script>
  <script type="text/javascript" src="public/scripts/hamburger.js"></script> -->
</body>
</html>
