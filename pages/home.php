<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

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

  $perennial = $_GET['perennial'];
  $full_sun = $_GET['full_sun'];
  $partial_shade = $_GET['partial_shade'];
  $full_shade = $_GET['full_shade'];
  $sort = $_GET['sort'];

  $form_valid = True;

  if (empty($sort) && empty($perennial) && empty($full_sun) && empty($partial_shade) && empty($full_shade)){
    $form_valid = False;
    $feedback_class = '';
    $sticky_sort = (empty($sort) ? '' : 'checked');
  }

  if ($form_valid) {
    $sticky_perennial =  (empty($perennial) ? '' : 'checked');
    $sticky_full_sun =  (empty($full_sun) ? '' : 'checked');
    $sticky_partial_shade =  (empty($partial_shade) ? '' : 'checked');
    $sticky_full_shade =  (empty($full_shade) ? '' : 'checked');
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
entries.file_name AS 'entries.file_name',
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
$tag_shrub = $_GET['tag-shrub'];
$tag_grass = $_GET['tag-grass'];
$tag_vine = $_GET['tag-vine'];
$tag_tree = $_GET['tag-tree'];
$tag_flower = $_GET['tag-flower'];
$tag_groundcovers = $_GET['tag-groundcovers'];
$tag_other = $_GET['tag-other'];

if ($tag_shrub) {
  array_push($sql_filter_array, "(tags.id = '1')");

  $form_valid = True;
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
  <p>Friendly Tips: You can view plant details by clicking the images.</p>
  <div class="body-display">
  <div class="row">
    <div class="plants">
      <?php
      foreach ($records as $record) { ?>
      <!-- <div class="plant"> -->
      <div class="catalog">
        <div>
        <div class="row">
            <h3><?php echo htmlspecialchars($record["entries.name_colloquial"]) ?></h3>
            <button class="home-tag"><?php echo htmlspecialchars($record['tags.tag_name']); ?></button>
        </div>
          <a href="/plant-details?<?php echo http_build_query(array('id' => $record['entries.id'])); ?>">
            <img src="/public/uploads/entries/<?php echo $record['entries.id'] . '.' . $record['entries.img_ext']; ?>" alt="" width="250" height="250"/>
            </a>
        <div class="align_right">

        <a class="" href="/plant-update?<?php echo http_build_query(array('id' => $record['entries.id'])); ?>" aria-label="Edit Entry">
        <input class="button1" type="submit" name="edit-entry" value="Edit" />
      </a>
        <input class="button1" type="submit" name="delete-entry" value="Delete" />
      </div>
      </div>
      </div>
      <?php } ?>
      </div>
    </div>
      </article>
      <!-- </div> -->

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

        <input id="filter-submit" class="button1" type="submit" name="submit-filter" value="Sort and Filter"/>

        <div class="forms label_input" role="group" aria-labelledby="growing needs">
        <div id="TOPO"><h2>Choose Tag(s)</h2>
          <h3>General Classification: </h3></div>

            <!-- <div>
              <input type="checkbox" id="shrub" name="shrub" <?php echo $sticky_shrub; ?>/>
              <label for="shrub">Shrub</label>
            </div> -->
            <!-- <div>
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
            </div> -->
            <!-- <div>
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
            </div> -->

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-shrub" value="shrub"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-grass" value="grass"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-vine" value="vine"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-tree" value="tree"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-flower" value="flower"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-groundcovers" value="groundcovers"/>
        </a>

        <a href="/?<?php echo http_build_query(array('tag' => $record['tags.id'])); ?>">
          <input id="tag-submit" class="button style" type="submit" name="tag-other" value="other"/>
        </a>
        </div>
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
      </div>
    </div>
  </main>

  <!-- <script type="text/javascript" src="public/scripts/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="public/scripts/drop-down.js"></script>
  <script type="text/javascript" src="public/scripts/hamburger.js"></script> -->
</body>
</html>
