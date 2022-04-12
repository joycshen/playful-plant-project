<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

// add-entry form

// form initial state
$show_confirmation = False;

//insert new entry
$record_inserted = False;

// feedback message styling
$name_feedback_class = 'hidden';
$genus_feedback_class = 'hidden';
$plant_id_feedback_class = 'hidden';
$topo_feedback_class = 'hidden';

// values
$colloquial_name = '';
$genus_species = '';
$plant_id = '';
$exploratory_constructive_play = '';
$exploratory_sensory_play = '';
$physical_play = '';
$imaginative_play = '';
$restorative_play = '';
$play_with_rules = '';
$bio_play = '';

// sticky values
$sticky_colloquial_name = '';
$sticky_genus_species = '';
$sticky_plant_id = '';
$sticky_exploratory_constructive_play = '';
$sticky_exploratory_sensory_play = '';
$sticky_physical_play = '';
$sticky_imaginative_play = '';
$sticky_restorative_play = '';
$sticky_play_with_rules = '';
$sticky_bio_play = '';

if (isset($_POST['add-entry'])) {

  // Get HTTP request user data
  $colloquial_name = $_POST['colloquial_name'];
  $genus_species = $_POST['genus_species'];
  $plant_id = $_POST['plant_id'];
  $exploratory_constructive_play = (!empty($_POST['exploratory_constructive_play']) ? 1 : 0);
  $exploratory_sensory_play = (!empty($_POST['exploratory_sensory_play']) ? 1 : 0);
  $physical_play = (!empty($_POST['physical_play']) ? 1 : 0);
  $imaginative_play = (!empty($_POST['imaginative_play']) ? 1 : 0);
  $restorative_play = (!empty($_POST['restorative_play']) ? 1 : 0);
  $play_with_rules = (!empty($_POST['play_with_rules']) ? 1 : 0);
  $bio_play = (!empty($_POST['bio_play']) ? 1 : 0);

  $form_valid = True;

  // whether at least one check box checked, if not, form invalid
  if (empty($exploratory_constructive_play) && empty($exploratory_sensory_play) && empty($physical_play) && empty($imaginative_play) && empty($restorative_play) && empty($play_with_rules) && empty($bio_play)) {
    $form_valid = False;
    $topo_feedback_class = '';
  }

  // whether colloquial name is empty, if so, form invalid
  if (empty($colloquial_name)) {
    $form_valid = False;
    $name_feedback_class = '';
  }

   // whether genus, speicies is empty, if so, form invalid
  if (empty($genus_species)) {
    $form_valid = False;
    $genus_feedback_class = '';
  }

   // whether plant id is empty, if so, form invalid
   if (empty($plant_id)) {
    $form_valid = False;
    $plant_id_feedback_class = '';
  }

  if ($form_valid) {
    //securely insert new data
    $result = exec_sql_query(
    $db,
    "INSERT INTO entries (name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range) VALUES (:name_colloquial, :name_genus_species, :plant_id, :exploratory_constructive_play, :exploratory_sensory_play, :physical_play, :imaginative_play, :restorative_play, :play_with_rules, :bio_play, :perennial, :full_sun, :partial_shade, :full_shade, :hardiness_zone_range);",
    array(
      ':name_colloquial' => $colloquial_name,
      ':name_genus_species' => $genus_species,
      ':plant_id' => $plant_id,
      ':exploratory_constructive_play' => $exploratory_constructive_play,
      ':exploratory_sensory_play' => $exploratory_sensory_play,
      ':physical_play' => $physical_play,
      ':imaginative_play' => $imaginative_play,
      ':restorative_play' => $restorative_play,
      ':play_with_rules' => $play_with_rules,
      ':bio_play' => $bio_play,
      ':perennial' => $perennial,
      ':full_sun' => $full_sun,
      ':partial_shade' => $partial_shade,
      ':full_shade' => $full_shade,
      ':hardiness_zone_range' => $hardiness_zone_range,
    )
  );

  if($result) {
    $record_inserted = True;
  }
    // form is valid, hide form and show confirmation message
    $show_confirmation = True;
  } else {
    // form is invalid, apply sticky values
    $sticky_exploratory_constructive_play = (empty($exploratory_constructive_play) ? '' : 'checked');
    $sticky_exploratory_sensory_play = (empty($exploratory_sensory_play) ? '' : 'checked');
    $sticky_physical_play = (empty($physical_play) ? '' : 'checked');
    $sticky_imaginative_play = (empty($imaginative_play) ? '' : 'checked');
    $sticky_restorative_play = (empty($restorative_play) ? '' : 'checked');
    $sticky_play_with_rules = (empty($play_with_rules) ? '' : 'checked');
    $sticky_bio_play = (empty($bio_play) ? '' : 'checked');
    $sticky_colloquial_name = $colloquial_name;
    $sticky_genus_species = $genus_species;
    $sticky_plant_id = $plant_id;
  }
}

// filter and sort form

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
$perennial ='';
$full_sun = '';
$partial_shade = '';
$full_shade = '';
$hardiness_zone_range = '';
$sort = '';

// sticky values
$sticky_exploratory_constructive_play = '';
$sticky_exploratory_sensory_play = '';
$sticky_physical_play = '';
$sticky_imaginative_play = '';
$sticky_restorative_play = '';
$sticky_play_with_rules = '';
$sticky_bio_play = '';
$sticky_perennial ='';
$sticky_full_sun = '';
$sticky_partial_shade = '';
$sticky_full_shade = '';
$sticky_hardiness_zone_range = '';
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
  <div class="form2">
    <article>
    <?php if ($show_confirmation) { ?>

      <section>
        <h2>Adding New Plants Confirmation</h2>

        <p>The new plant <strong>"<?php echo htmlspecialchars($colloquial_name); ?>"</strong> is successfully added to the catalog!</p>

        <p>View new catalog in <a href="/">Playful Plant Data</a></p>
      </section>

    <?php } else { ?>
      <h2>Add a New Plant!</h2>
      <form id="request-form" method="post" action="/add-new-plants-form" novalidate>

        <div id="feedback1" class="feedback <?php echo $name_feedback_class; ?>">Please enter a valid colloquial name.</div>
        <div class="label_input">
        <h3><label for="name_field">Plant Name (Colloquial):</label></h3>
          <input id="name_field" type="text" name="colloquial_name" value="<?php echo htmlspecialchars($sticky_colloquial_name); ?>"/>
        </div>

        <div id="feedback2" class="feedback <?php echo $genus_feedback_class; ?>">Please enter a valid genus, species name.</div>
        <div class="label_input">
          <h3><label for="genus_species_field">Plant Name (Genus, Species):</label></h3>
          <input id="genus_species_field" type="text" name="genus_species" value="<?php echo htmlspecialchars($sticky_genus_species); ?>"/>
        </div>

        <div id="feedback3" class="feedback <?php echo $plant_id_feedback_class; ?>">Please enter a valid plant ID.</div>
        <div class="label_input">
          <h3><label for="plant_id_field">Plant ID:</label></h3>
          <input id="plant_id_field" type="text" name="plant_id" value="<?php echo htmlspecialchars($sticky_plant_id); ?>"/>
        </div>

        <div id="feedback4" class="feedback <?php echo $topo_feedback_class; ?>">Please select at least one TOPO-Play Type Categorization.</div>
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

          <div id="feedback4" class="feedback <?php echo $topo_feedback_class; ?>">Please select at least one Growing Need and Characteristic.</div>
          <div class="forms label_input" role="group" aria-labelledby="play">
          <div id="play"><h3>Growing Needs and Characteristics: </h3></div>
          <div>
            <div>
              <input type="checkbox" id="perennial" name="perennial" <?php echo $sticky_exploratory_constructive_play; ?>/>
              <label for="perennial">Perennial</label>
            </div>
            <div>
              <input type="checkbox" id="annual" name="annual" <?php echo $sticky_exploratory_sensory_play; ?>/>
              <label for="annual">Annual</label>
            </div>
            <div>
              <input type="checkbox" id="full_sun" name="full_sun" <?php echo $sticky_physical_play; ?>/>
              <label for="full_sun">Full Sun</label>
            </div>
            <div>
              <input type="checkbox" id="partial_shade" name="partial_shade" <?php echo $sticky_imaginative_play; ?>/>
              <label for="partial_shade">Partial Shade</label>
            </div>
            <div>
              <input type="checkbox" id="full_shade" name="full_shade" <?php echo $sticky_restorative_play; ?>/>
              <label for="full_shade">Full Shade</label>
            </div>
            <div class="label_input">
             <label for="hardiness_zone_range_field">Hardiness Zone Range:</label>
             <input id="hardiness_zone_range_field" type="text" name="hardiness_zone_range" value="<?php echo htmlspecialchars($sticky_colloquial_name); ?>"/>
            </div>
          </div>
          </div>
        <div class="align_right">
          <input id="add-submit" type="submit" name="add-entry" value="Add Entry" />
        </div>
      </form>

      <div class="plants">
      <h3>Choose Tag(s)</h3>
          <label>General Classification: </label></div>
          <div class="plant">
            <button class="button style">Shrub</button>
            <button class="button style">Grass</button>
            <button class="button style">Vine</button>
            <button class="button style">Tree</button>
            <button class="button style">Flower</button>
            <button class="button style">Groundcovers</button>
            <button class="button style">Other</button>
          </div>
    </article>
    </div>
    <?php } ?>

    <div class="sections">
    <article>
      <?php
      foreach ($records as $record) { ?>
      <div class="catalog">
        <h2><?php echo htmlspecialchars($record["name_colloquial"]) ?></h2>
        <h3><em>Genus, species: <?php echo htmlspecialchars($record["name_genus_species"]) ?></em></h3>
        <h3>Plant ID: <?php echo htmlspecialchars($record["plant_id"]) ?></h3>
        <h3>TOPO - Play Type Categorization: </h3>
        <ul>
          <?php if ($record["exploratory_constructive_play"] == 1) { ?>
            <li>Supports Exploratory Constructive Play</li>
          <?php } ?>
          <?php if ($record["exploratory_sensory_play"] == 1) { ?>
            <li>Supports Exploratory Sensory Play</li>
          <?php } ?>
          <?php if ($record["physical_play"] == 1) { ?>
            <li>Supports Physical Play</li>
          <?php } ?>
          <?php if ($record["imaginative_play"] == 1) { ?>
            <li>Supports Imaginative Play</li>
          <?php } ?>
          <?php if ($record["restorative_play"] == 1) { ?>
            <li>Supports Restorative Play</li>
          <?php } ?>
          <?php if ($record["play_with_rules"] == 1) { ?>
            <li>Supports Play with Rules</li>
          <?php } ?>
          <?php if ($record["bio_play"] == 1) { ?>
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
      <form id="request-form" method="get" action="/add-new-plants-form" novalidate>

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
            <div id="feedback1" class="feedback <?php echo $name_feedback_class; ?>">Please enter a valid colloquial name.</div>
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
