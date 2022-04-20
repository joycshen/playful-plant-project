<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

// if (isset($_GET['submit-sort'])) {
//   $sort = $_GET['sort'];
// }

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
$feedback_class = 'hidden';

// values
// $exploratory_constructive_play_1 = '';
// $exploratory_sensory_play_1 = '';
// $physical_play_1 = '';
// $imaginative_play_1 = '';
// $restorative_play_1 = '';
// $play_with_rules_1 = '';
// $bio_play_1 = '';
$perennial ='';
$full_sun = '';
$partial_shade = '';
$full_shade = '';
$hardiness_zone_range = '';
$shrub ='';
$grass = '';
$vine = '';
$tree = '';
$flower = '';
$groundcovers = '';
$other = '';

$sort = '';

// sticky values
// $sticky_exploratory_constructive_play_1 = '';
// $sticky_exploratory_sensory_play_1 = '';
// $sticky_physical_play_1 = '';
// $sticky_imaginative_play_1 = '';
// $sticky_restorative_play_1 = '';
// $sticky_play_with_rules_1 = '';
// $sticky_bio_play_1 = '';
$sticky_perennial ='';
$sticky_full_sun = '';
$sticky_partial_shade = '';
$sticky_full_shade = '';
$sticky_shrub ='';
$sticky_grass = '';
$sticky_vine = '';
$sticky_tree = '';
$sticky_flower = '';
$sticky_groundcovers = '';
$sticky_other = '';
$sticky_sort = '';

if (isset($_GET['submit-filter'])) {

  // $exploratory_constructive_play_1 = $_GET['exploratory_constructive_play'];
  // $exploratory_sensory_play_1 = $_GET['exploratory_sensory_play'];
  // $physical_play_1 = $_GET['physical_play'];
  // $imaginative_play_1 = $_GET['imaginative_play'];
  // $restorative_play_1 = $_GET['restorative_play'];
  // $play_with_rules_1 = $_GET['play_with_rules'];
  // $bio_play_1 = $_GET['bio_play'];
  $perennial = $_GET['perennial'];
  $full_sun = $_GET['full_sun'];
  $partial_shade = $_GET['partial_shade'];
  $full_shade = $_GET['full_shade'];
  $shrub = $_GET['shrub'];
  $grass = $_GET['grass'];
  $vine = $_GET['vine'];
  $tree = $_GET['tree'];
  $flower = $_GET['flower'];
  $groundcovers = $_GET['groundcovers'];
  $other = $_GET['other'];
  $sort = $_GET['sort'];

  // $upload = $_FILES['img-file'];

  $form_valid = True;

  if (empty($sort) && empty($perennial) && empty($full_sun) && empty($partial_shade) && empty($full_shade) && empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other)) {
    $form_valid = False;
    $feedback_class = '';
    $sticky_sort = (empty($sort) ? '' : 'checked');
  }

  if ($form_valid) {
    // form is valid --> sticky values
    // $sticky_exploratory_constructive_play_1 = (empty($exploratory_constructive_play_1) ? '' : 'checked');
    // $sticky_exploratory_sensory_play_1 = (empty($exploratory_sensory_play_1) ? '' : 'checked');
    // $sticky_physical_play_1 = (empty($physical_play_1) ? '' : 'checked');
    // $sticky_imaginative_play_1 = (empty($imaginative_play_1) ? '' : 'checked');
    // $sticky_restorative_play_1 = (empty($restorative_play_1) ? '' : 'checked');
    // $sticky_play_with_rules_1 = (empty($play_with_rules_1) ? '' : 'checked');
    // $sticky_exploratory_constructive_play_1 = (empty($exploratory_constructive_play_1) ? '' : 'checked');
    // $sticky_bio_play_1 = (empty($bio_play_1) ? '' : 'checked');
    $sticky_perennial =  (empty($perennial) ? '' : 'checked');
    $sticky_full_sun =  (empty($full_sun) ? '' : 'checked');
    $sticky_partial_shade =  (empty($partial_shade) ? '' : 'checked');
    $sticky_full_shade =  (empty($full_shade) ? '' : 'checked');
    $sticky_shrub =  (empty($shrub) ? '' : 'checked');
    $sticky_grass =  (empty($grass) ? '' : 'checked');
    $sticky_vine =  (empty($vine) ? '' : 'checked');
    $sticky_tree =  (empty($tree) ? '' : 'checked');
    $sticky_flower = (empty($flower) ? '' : 'checked');
    $sticky_groundcovers =  (empty($groundcovers) ? '' : 'checked');
    $sticky_other = (empty($other) ? '' : 'checked');
    $sticky_sort = (empty($sort) ? '' : 'checked');
    $feedback_class = 'hidden';
  }
}

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
LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id) ";
$sql_where_part = '';
$sql_sort_part = ' ORDER BY entries.name_colloquial ASC;';
$sql_filter_array = array();
// $sql_tag_array = array();

//Filters
$filter_perennial = (bool)($_GET['perennial'] ?? NULL);
$filter_full_sun = (bool)($_GET['full_sun'] ?? NULL);
$filter_partial_shade = (bool)($_GET['partial_shade'] ?? NULL);
$filter_full_shade = (bool)($_GET['full_shade'] ?? NULL);

if ($filter_perennial) {
  array_push($sql_filter_array, "(entries.perennial = '1')");
}

if ($filter_full_sun) {
  array_push($sql_filter_array, "(entries.full_sun = '1')");
}

if ($filter_partial_shade) {
  array_push($sql_filter_array, "(entries.partial_shade = '1')");
}

if ($filter_full_shade) {
  array_push($sql_filter_array, "(entries.full_shade = '1')");
}

//tags
$tag_shrub = $_GET['shrub'];
$tag_grass = $_GET['grass'];
$tag_vine = $_GET['vine'];
$tag_tree = $_GET['tree'];
$tag_flower = $_GET['flower'];
$tag_groundcovers = $_GET['groundcovers'];
$tag_other = $_GET['other'];

// $tag_shrub = $_GET['shrub'];
// $tag_grass = $_GET['grass'];
// $tag_vine = $_GET['vine'];
// $tag_tree = $_GET['tree'];
// $tag_flower = $_GET['flower'];
// $tag_groundcovers = $_GET['groundcovers'];
// $tag_other = $_GET['other'];
// $tag_name = $_GET['tags.tag_name'];

if ($tag_shrub) {
  array_push($sql_filter_array, "(tags.id = '1')");
}

if ($tag_grass) {
  array_push($sql_filter_array, "(tags.id = '2')");
}

if ($tag_vine) {
  array_push($sql_filter_array, "(tags.id = '3')");
}

if ($tag_tree) {
  array_push($sql_filter_array, "(tags.id = '4')");
}

if ($tag_flower) {
  array_push($sql_filter_array, "(tags.id = '5')");
}

if ($tag_groundcovers) {
  array_push($sql_filter_array, "(tags.id = '6')");
}

if ($tag_other) {
  array_push($sql_filter_array, "(tags.id = '7')");
}

if (count($sql_filter_array) > 0) {
  $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
}

// tag and/or filter
// if (count($sql_tag_array) > 0) {
//   $sql_where_part = ' WHERE ' . implode(' AND ', $sql_tag_array);
// }
// elseif (count($sql_filter_array) > 0) {
//   $sql_where_part = ' WHERE ' . implode(' AND ', $sql_filter_array);
// }
// elseif (count($sql_tag_array) > 0 && count($sql_filter_array) > 0) {
//   $sql_where_part = ' WHERE ' . implode(' AND ', $sql_tag_array, ' AND ', $sql_filter_array);
// }

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
  <!-- <div class="titles">
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
  <form id="request-form" method="get" action="/" name="submit-sort" novalidate>
  <div class="sort">
  <div class="select">
  <select id="name" name="sort">
    <option name="sort" id="asc">Colloquial Name Ascendant (A-Z)</option>
    <option name="sort" id="desc">Colloquial Name Descendant (Z-A)</option>
  </select>
  <div class="forms label_input" role="group" aria-labelledby="sorting">
        <div>
              <input type="submit" id="sorting" name="sort"/>
              <label for="sorting">Sort by Colloquial Name Alphabetically</label>
            </div>
        </div>
  </div>
  </div>
  <input id="filter-submit" class="button1" type="submit" name="submit-sort" value="Sort"/>
  </form>
  </div> -->
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
            <div class="row">
            <h3><?php echo htmlspecialchars($record["entries.name_colloquial"]) ?></h3>
            <button class="home-tag"><?php echo htmlspecialchars($record['tags.tag_name']); ?></button>
        </div>
        </div>
      <?php } ?>
      <!-- </div> -->
    </div>
    </article>

    <aside>
    <div class="form">
    <div class="column">
    <div id="feedback" class="feedback <?php echo $feedback_class; ?>">Please choose at least one sorting/filter.</div>
      <h2>Sort by...</h2>
      <form id="request-form" method="get" action="/" novalidate>

        <div class="forms label_input" role="group" aria-labelledby="sorting">
        <div>
              <input type="checkbox" id="sorting" name="sort" <?php echo $sticky_sort; ?>/>
              <label for="sorting">Sort by Colloquial Name Alphabetically (A-Z)</label>
            </div>
        </div>

      <h2>Filter by...</h2>
        <div class="forms label_input" role="group" aria-labelledby="growing needs">
          <div id="TOPO"><h3>Growing Needs and Characteristic: </h3></div>

          <div>
            <div>
              <input type="checkbox" id="perennial" name="perennial" <?php echo $sticky_perennial; ?>/>
              <label for="perennial">Perennial</label>
            </div>
            <div>
              <input type="checkbox" id="full_sun" name="full_sun" <?php echo $sticky_full_sun; ?>/>
              <label for="full_sun">Full Sun</label>
            </div>
            <div>
              <input type="checkbox" id="partial_shade" name="partial_shade" <?php echo $sticky_partial_shade; ?>/>
              <label for="partial_shade">Partial Shade</label>
            </div>
            <div>
              <input type="checkbox" id="full_shade" name="full_shade" <?php echo $sticky_full_shade; ?>/>
              <label for="full_shade">Full Shade</label>
            </div>
          </div>
        </div>

        <div class="forms label_input" role="group" aria-labelledby="growing needs">
        <div id="TOPO"><h2>Choose Tag(s)</h2>
          <h3>General Classification: </h3></div>

          <div>
            <div>
              <input type="checkbox" id="shrub" name="shrub" <?php echo $sticky_shrub; ?>/>
              <label for="shrub">Shrub</label>
            </div>
            <div>
              <input type="checkbox" id="grass" name="grass" <?php echo $sticky_grass; ?>/>
              <label for="grass">Grass</label>
            </div>
            <div>
              <input type="checkbox" id="vine" name="vine" <?php echo $sticky_vine; ?>/>
              <label for="vine">Vine</label>
            </div>
            <div>
              <input type="checkbox" id="tree" name="tree" <?php echo $sticky_tree; ?>/>
              <label for="tree">Tree</label>
            </div>
            <div>
              <input type="checkbox" id="flower" name="flower" <?php echo $sticky_flower; ?>/>
              <label for="flower">Flower</label>
            </div>
            <div>
              <input type="checkbox" id="groundcovers" name="groundcovers" <?php echo $sticky_groundcovers; ?>/>
              <label for="groundcovers">Groundcovers</label>
            </div>
            <div>
              <input type="checkbox" id="other" name="other" <?php echo $sticky_other; ?>/>
              <label for="other">Other</label>
            </div>
          </div>
        </div>

        <input id="filter-submit" class="button1" type="submit" name="submit-filter" value="Sort and Filter"/>
      </form>

          <!-- <div class="buttons">
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
          </div> -->
    </div>
  </aside>

    </div>
  </main>

  <!-- <script type="text/javascript" src="public/scripts/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="public/scripts/drop-down.js"></script>
  <script type="text/javascript" src="public/scripts/hamburger.js"></script> -->
</body>
</html>
