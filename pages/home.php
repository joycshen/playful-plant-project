<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";

// open database
$db = open_sqlite_db('tmp/site.sqlite');

// feedback message styling
$feedback_class = 'hidden';

// values
$exploratory_constructive_play = '';
$exploratory_sensory_play = '';
$physical_play = '';
$imaginative_play = '';
$restorative_play = '';
$play_with_rules = '';
$bio_play = '';
$sort = '';

// sticky values
$sticky_exploratory_constructive_play = '';
$sticky_exploratory_sensory_play = '';
$sticky_physical_play = '';
$sticky_imaginative_play = '';
$sticky_restorative_play = '';
$sticky_play_with_rules = '';
$sticky_bio_play = '';
$sticky_sort = '';

if (isset($_GET['submit-filter'])) {

  $exploratory_constructive_play = $_GET['exploratory_constructive_play'];
  $exploratory_sensory_play = $_GET['exploratory_sensory_play'];
  $physical_play = $_GET['physical_play'];
  $imaginative_play = $_GET['imaginative_play'];
  $restorative_play = $_GET['restorative_play'];
  $play_with_rules = $_GET['play_with_rules'];
  $bio_play = $_GET['bio_play'];
  $sort = $_GET['sort'];

  $form_valid = True;

  if (empty($sort) && empty($exploratory_constructive_play) && empty($exploratory_sensory_play) && empty($physical_play) && empty($imaginative_play) && empty($restorative_play) && empty($play_with_rules) && empty($bio_play)) {
    $form_valid = False;
    $feedback_class = '';
    $sticky_sort = (empty($sort) ? '' : 'checked');
  }

  if ($form_valid) {
    // form is valid --> sticky values
    $sticky_exploratory_constructive_play = (empty($exploratory_constructive_play) ? '' : 'checked');
    $sticky_exploratory_sensory_play = (empty($exploratory_sensory_play) ? '' : 'checked');
    $sticky_physical_play = (empty($physical_play) ? '' : 'checked');
    $sticky_imaginative_play = (empty($imaginative_play) ? '' : 'checked');
    $sticky_restorative_play = (empty($restorative_play) ? '' : 'checked');
    $sticky_play_with_rules = (empty($play_with_rules) ? '' : 'checked');
    $sticky_exploratory_constructive_play = (empty($exploratory_constructive_play) ? '' : 'checked');
    $sticky_bio_play = (empty($bio_play) ? '' : 'checked');
    $sticky_sort = (empty($sort) ? '' : 'checked');
    $feedback_class = 'hidden';
  }
}

//query pieces
$sql_select_part = 'SELECT * FROM seed ';
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
  array_push($sql_filter_array, "(exploratory_constructive_play_present = '1')");
}

if ($filter_exploratory_sensory_play) {
  array_push($sql_filter_array, "(exploratory_sensory_play_present = '1')");
}

if ($filter_physical_play) {
  array_push($sql_filter_array, "(physical_play_present = '1')");
}

if ($filter_imaginative_play) {
  array_push($sql_filter_array, "(imaginative_play_present = '1')");
}

if ($filter_restorative_play) {
  array_push($sql_filter_array, "(restorative_play_present = '1')");
}

if ($filter_play_with_rules) {
  array_push($sql_filter_array, "(play_with_rules_present = '1')");
}

if ($filter_bio_play) {
  array_push($sql_filter_array, "(bio_play_present = '1')");
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
      <?php
      foreach ($records as $record) { ?>
      <div class="catalog">
        <h2><?php echo htmlspecialchars($record["name_colloquial"]); ?></h2>
        <h3><em>Genus, species: <?php echo htmlspecialchars($record["name_genus_species"]); ?></em></h3>
        <h3>Plant ID: <?php echo htmlspecialchars($record["plant_id"]); ?></h3>
        <h3>TOPO - Play Type Categorization: </h3>
        <ul>
          <?php if ($record["exploratory_constructive_play_present"] == 1) { ?>
            <li>Supports Exploratory Constructive Play</li>
          <?php } ?>
          <?php if ($record["exploratory_sensory_play_present"] == 1) { ?>
            <li>Supports Exploratory Sensory Play</li>
          <?php } ?>
          <?php if ($record["physical_play_present"] == 1) { ?>
            <li>Supports Physical Play</li>
          <?php } ?>
          <?php if ($record["imaginative_play_present"] == 1) { ?>
            <li>Supports Imaginative Play</li>
          <?php } ?>
          <?php if ($record["restorative_play_present"] == 1) { ?>
            <li>Supports Restorative Play</li>
          <?php } ?>
          <?php if ($record["play_with_rules_present"] == 1) { ?>
            <li>Supports Play with Rules</li>
          <?php } ?>
          <?php if ($record["bio_play_present"] == 1) { ?>
            <li>Supports Bio Play </li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
    </article>

    <div class="form">
    <aside>
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
        <div class="forms label_input" role="group" aria-labelledby="TOPO">
          <div id="TOPO"><h3>TOPO-Play Type Categorization: </h3></div>

          <div>
            <div>
              <input type="checkbox" id="exploratory_constructive_play_present" name="exploratory_constructive_play" <?php echo $sticky_exploratory_constructive_play; ?>/>
              <label for="exploratory_constructive_play_present">Supports Exploratory Constructive Play</label>
            </div>
            <div>
              <input type="checkbox" id="exploratory_sensory_play_present" name="exploratory_sensory_play" <?php echo $sticky_exploratory_sensory_play; ?>/>
              <label for="exploratory_sensory_play_present">Supports Exploratory Sensory Play</label>
            </div>
            <div>
              <input type="checkbox" id="physical_play_present" name="physical_play" <?php echo $sticky_physical_play; ?>/>
              <label for="physical_play_present">Supports Physical Play</label>
            </div>
            <div>
              <input type="checkbox" id="imaginative_play_present" name="imaginative_play" <?php echo $sticky_imaginative_play; ?>/>
              <label for="imaginative_play_present">Supports Imaginative Play</label>
            </div>
            <div>
              <input type="checkbox" id="restorative_play_present" name="restorative_play" <?php echo $sticky_restorative_play; ?>/>
              <label for="restorative_play_present">Supports Restorative Play</label>
            </div>
            <div>
              <input type="checkbox" id="play_with_rules_present" name="play_with_rules" <?php echo $sticky_play_with_rules; ?>/>
              <label for="play_with_rules_present">Supports Play with Rules</label>
            </div>
            <div>
              <input type="checkbox" id="bio_play_present" name="bio_play" <?php echo $sticky_bio_play; ?>/>
              <label for="bio_play_present">Supports Bio Play</label>
            </div>
          </div>
        </div>
        <input id="filter-submit" type="submit" name="submit-filter" value="Sort and Filter"/>
      </form>
    </aside>
    </div>
    </div>
  </main>
</body>

</html>
