<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// ----------- add-entry form ----------------
if (is_user_logged_in() && $is_admin) {

  define("MAX_FILE_SIZE", 1000000);

  // form initial state
  $show_confirmation = False;

  //insert new entry
  $record_inserted = False;

  //delete an entry
  $delete_entry = False;

  // feedback message styling
  $name_feedback_class = 'hidden';
  $genus_feedback_class = 'hidden';
  $plant_id_feedback_class = 'hidden';
  $topo_feedback_class = 'hidden';
  $growing_needs_feedback_class = 'hidden';
  $tag_feedback_class = 'hidden';

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
  $perennial = '';
  $full_sun = '';
  $partial_shade = '';
  $full_shade = '';
  $hardiness_zone_range = '';
  $shrub = '';
  $grass = '';
  $vine = '';
  $tree = '';
  $flower = '';
  $groundcovers = '';
  $other = '';

  // upload values
  $upload_filename = NULL;
  $upload_ext = NULL;

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
  $sticky_perennial = '';
  $sticky_full_sun = '';
  $sticky_partial_shade = '';
  $sticky_full_shade = '';
  $sticky_hardiness_zone_range = '';
  $sticky_shrub = '';
  $sticky_grass = '';
  $sticky_vine = '';
  $sticky_tree = '';
  $sticky_flower = '';
  $sticky_groundcovers = '';
  $sticky_other = '';

  if (isset($_POST['add-entry'])) {

    //add info
    $colloquial_name = trim($_POST['colloquial_name']);
    $genus_species = trim($_POST['genus_species']);
    $plant_id = trim($_POST['plant_id']);
    $exploratory_constructive_play = (!empty($_POST['exploratory_constructive_play']) ? 1 : 0);
    $exploratory_sensory_play = (!empty($_POST['exploratory_sensory_play']) ? 1 : 0);
    $physical_play = (!empty($_POST['physical_play']) ? 1 : 0);
    $imaginative_play = (!empty($_POST['imaginative_play']) ? 1 : 0);
    $restorative_play = (!empty($_POST['restorative_play']) ? 1 : 0);
    $play_with_rules = (!empty($_POST['play_with_rules']) ? 1 : 0);
    $bio_play = (!empty($_POST['bio_play']) ? 1 : 0);
    $perennial = (!empty($_POST['perennial']) ? 1 : 0);
    $full_sun = (!empty($_POST['full_sun']) ? 1 : 0);
    $partial_shade = (!empty($_POST['partial_shade']) ? 1 : 0);
    $full_shade = (!empty($_POST['full_shade']) ? 1 : 0);
    $hardiness_zone_range = trim($_POST['hardiness_zone_range']);

    //upload image
    $upload = $_FILES['img-file'];

    //add tags
    if (!empty($_POST['shrub']) ? 1 : '') {
      $shrub = 1;
      $tag_id = 1;
    }
    if (!empty($_POST['grass']) ? 2 : '') {
      $grass = 2;
      $tag_id = 2;
    }
    if (!empty($_POST['vine']) ? 3 : '') {
      $vine = 3;
      $tag_id = 3;
    }
    if (!empty($_POST['tree']) ? 4 : '') {
      $tree = 4;
      $tag_id = 4;
    }
    if (!empty($_POST['flower']) ? 5 : '') {
      $flower = 5;
      $tag_id = 5;
    }
    if (!empty($_POST['groundcovers']) ? 6 : '') {
      $groundcovers = 6;
      $tag_id = 6;
    }
    if (!empty($_POST['other']) ? 7 : '') {
      $other = 7;
      $tag_id = 7;
    }

    $form_valid = True;

    if ($upload['error'] == UPLOAD_ERR_OK) {
      $upload_filename = basename($upload['name']);

      $upload_ext = strtolower(pathinfo($upload_filename, PATHINFO_EXTENSION));
    } else {
      $form_valid = False;
    }

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

    // whether at least one check box checked, if so, form invalid
    if (empty($perennial) && empty($full_sun) && empty($partial_shade) && empty($full_shade) && empty($hardiness_zone_range)) {
      $form_valid = False;
      $growing_needs_feedback_class = '';
    }

      // whether at least one check box checked, if not, form invalid
      if (empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other)) {
        $form_valid = False;
        $tag_feedback_class = '';
      }

    if ($form_valid) {
      //securely insert new data
      $result = exec_sql_query(
      $db,
      "INSERT INTO entries (name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext) VALUES (:name_colloquial, :name_genus_species, :plant_id, :exploratory_constructive_play, :exploratory_sensory_play, :physical_play, :imaginative_play, :restorative_play, :play_with_rules, :bio_play, :perennial, :full_sun, :partial_shade, :full_shade, :hardiness_zone_range, :file_name, :img_ext);",
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
        ':file_name' => $upload_filename,
        ':img_ext' => $upload_ext,
      )
    );

      $entry_id = $db->lastInsertId('id');

      $result_tag_1 = exec_sql_query(
      $db,
      "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);",
      array(
        ':entry_id' => $entry_id,
        ':tag_id' => $tag_id,
      )
    );

    if($result && $result_tag_1) {
      $record_inserted = True;

      $record_id = $db->lastInsertId('id');

      $id_filename = 'public/uploads/entries/' . $record_id . '.' . $upload_ext;

      move_uploaded_file($upload["tmp_name"], $id_filename);
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
      $sticky_perennial = (empty($perennial) ? '' : 'checked');
      $sticky_full_sun = (empty($full_sun) ? '' : 'checked');
      $sticky_partial_shade = (empty($partial_shade) ? '' : 'checked');
      $sticky_full_shade = (empty($full_shade) ? '' : 'checked');
      $sticky_hardiness_zone_range = $hardiness_zone_range;
      $sticky_colloquial_name = $colloquial_name;
      $sticky_genus_species = $genus_species;
      $sticky_plant_id = $plant_id;
      $sticky_shrub = (empty($shrub) ? '' : 'checked');
      $sticky_grass = (empty($grass) ? '' : 'checked');
      $sticky_vine = (empty($vine) ? '' : 'checked');
      $sticky_tree = (empty($tree) ? '' : 'checked');
      $sticky_flower = (empty($flower) ? '' : 'checked');
      $sticky_groundcovers = (empty($groundcovers) ? '' : 'checked');
      $sticky_other = (empty($other) ? '' : 'checked');
    }
  }
}

  //delete entry
  if (isset($_POST['delete-entry'])) {
    $delete_id = trim($_POST['delete-entry']);
    exec_sql_query(
      $db,
      'DELETE FROM entries WHERE id = :id;',
      array(
        ':id' => $delete_id,
      )
    );

    exec_sql_query(
      $db,
      'DELETE FROM entry_tags WHERE id = :id;',
      array(
        ':id' => $delete_id,
      )
    );

    $delete_entry = True;
  }

  // filter and sort form

  // feedback message styling
  $feedback_class = 'hidden';

  // values
  $exploratory_constructive_play_1 = '';
  $exploratory_sensory_play_1 = '';
  $physical_play_1 = '';
  $imaginative_play_1 = '';
  $restorative_play_1 = '';
  $play_with_rules_1 = '';
  $bio_play_1 = '';
  $sort = '';

  // sticky values
  $sticky_exploratory_constructive_play_1 = '';
  $sticky_exploratory_sensory_play_1 = '';
  $sticky_physical_play_1 = '';
  $sticky_imaginative_play_1 = '';
  $sticky_restorative_play_1 = '';
  $sticky_play_with_rules_1 = '';
  $sticky_bio_play_1 = '';
  $sticky_sort = '';

  if (isset($_GET['submit-filter'])) {

    $exploratory_constructive_play_1 = $_GET['exploratory_constructive_play'];
    $exploratory_sensory_play_1 = $_GET['exploratory_sensory_play'];
    $physical_play_1 = $_GET['physical_play'];
    $imaginative_play_1 = $_GET['imaginative_play'];
    $restorative_play_1 = $_GET['restorative_play'];
    $play_with_rules_1 = $_GET['play_with_rules'];
    $bio_play_1 = $_GET['bio_play'];
    $sort = $_GET['sort'];


    $form_valid = True;

    if (empty($sort) && empty($exploratory_constructive_play_1) && empty($exploratory_sensory_play_1) && empty($physical_play_1) && empty($imaginative_play_1) && empty($restorative_play_1) && empty($play_with_rules_1) && empty($bio_play_1)) {
      $form_valid = False;
      $feedback_class = '';
      $sticky_sort = (empty($sort) ? '' : 'checked');
    }

    if ($form_valid) {
      // form is valid --> sticky values
      $sticky_exploratory_constructive_play_1 = (empty($exploratory_constructive_play_1) ? '' : 'checked');
      $sticky_exploratory_sensory_play_1 = (empty($exploratory_sensory_play_1) ? '' : 'checked');
      $sticky_physical_play_1 = (empty($physical_play_1) ? '' : 'checked');
      $sticky_imaginative_play_1 = (empty($imaginative_play_1) ? '' : 'checked');
      $sticky_restorative_play_1 = (empty($restorative_play_1) ? '' : 'checked');
      $sticky_play_with_rules_1 = (empty($play_with_rules_1) ? '' : 'checked');
      $sticky_exploratory_constructive_play_1 = (empty($exploratory_constructive_play_1) ? '' : 'checked');
      $sticky_bio_play_1 = (empty($bio_play_1) ? '' : 'checked');
      $sticky_sort = (empty($sort) ? '' : 'checked');
      $feedback_class = 'hidden';
    }
  }

if (is_user_logged_in()) {
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
}
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
    <article>
    <?php if (!is_user_logged_in()) { ?>
      <h3>Please login to add plants or view plant catalog.</h3>
    <?php echo_login_form('/add-new-plants-form', $session_messages); ?>

    <?php } elseif (is_user_logged_in() && $is_admin) { ?>

    <?php if ($show_confirmation) { ?>

      <section>
        <h2>Adding New Plants Confirmation</h2>

        <p>The new plant <strong>"<?php echo htmlspecialchars($colloquial_name); ?>"</strong> is successfully added to the catalog!</p>

        <p>View updated catalog in <a href="/">"Plant Information" page</a> and <a href="/add-new-plants-form">"Add New Plant" page.</a></p>
      </section>

      <?php } elseif ($delete_entry) { ?>

        <section>
          <h2>Plant Deleted Confirmation</h2>

          <h3>The plant is successfully deleted from the catalog!</h3>

          <p>View updated catalog in <a href="/">"Plant Information" page</a> and <a href="/add-new-plants-form">"Add New Plant" page.</a></p>
        </section>

    <?php } else { ?>
      <p><strong>Friendly Tips: </strong>You can scroll down to view the complete plant catalog.</p>
      <h2>Add a New Plant!</h2>
      <div class="align-center">
      <form id="request-form" method="post" action="/add-new-plants-form" enctype="multipart/form-data" novalidate>

      <div class="add-form">
        <div>
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
        </div>

        <div class="column">
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
          </div>
        </div>

        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
        <div class="column">
          <!-- <div id="feedback5" class="feedback">Please upload an image.</div> -->
          <div class="forms label_input" role="group" aria-labelledby="upload">
          <div class="label_input">
          <h3><label for="upload-file">Upload an Image:</label></h3>
          <input type="file" id="upload-file" name="img-file"/>
        </div>
        </div>
        </div>

      <div class="add-form">
      <div class="column">
          <div id="feedback4" class="feedback <?php echo $growing_needs_feedback_class; ?>">Please select at least one Growing Need and Characteristic.</div>
          <div class="forms label_input" role="group" aria-labelledby="play">
          <div id="play"><h3>Growing Needs and Characteristics: </h3></div>
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
            <div class="label_input">
             <label for="hardiness_zone_range_field">Hardiness Zone Range:</label>
             <input id="hardiness_zone_range_field" type="text" name="hardiness_zone_range" value="<?php echo htmlspecialchars($sticky_hardiness_zone_range); ?>"/>
            </div>
            </div>
          </div>
          </div>
    </div>

      <div class="add-form">
      <!-- <div class="tags"> -->
      <div>
      <h3>Choose Existing Tag(s)</h3>
      <!-- </div> -->
      <div class="column">
          <div id="feedback4" class="feedback <?php echo $tag_feedback_class; ?>">Please select at least one tag.</div>
          <div class="forms label_input" role="group" aria-labelledby="play">
          <div id="play"><h3>General Classification: </h3></div>
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
          </div>
    </div>
    </div>

    <div class="align_right">
        <input id="add-submit" class="button1" type="submit" name="add-entry" value="Add Entry" />
      </div>
      </form>
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
        <div class="align_right">
        <a class="" href="/plant-update?<?php echo http_build_query(array('id' => $record['id'])); ?>" aria-label="Edit Entry">
        <input class="button1" type="submit" name="edit-entry" value="Edit" />
        </a>

        <form method="post" action="/add-new-plants-form" novalidate>
          <input class="hidden" name="delete-entry" value="<?php echo htmlspecialchars($record['id']); ?>"/>

          <button class="button1" type="submit" aria-label="<?php echo htmlspecialchars($record['id']); ?>">Delete
          </button>
        </form>

      </div>
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
              <input type="checkbox" id="exploratory_constructive_play_present" name="exploratory_constructive_play" <?php echo $sticky_exploratory_constructive_play_1; ?>/>
              <label for="exploratory_constructive_play_present">Supports Exploratory Constructive Play</label>
            </div>
            <div>
              <input type="checkbox" id="exploratory_sensory_play_present" name="exploratory_sensory_play" <?php echo $sticky_exploratory_sensory_play_1; ?>/>
              <label for="exploratory_sensory_play_present">Supports Exploratory Sensory Play</label>
            </div>
            <div>
              <input type="checkbox" id="physical_play_present" name="physical_play" <?php echo $sticky_physical_play_1; ?>/>
              <label for="physical_play_present">Supports Physical Play</label>
            </div>
            <div>
              <input type="checkbox" id="imaginative_play_present" name="imaginative_play" <?php echo $sticky_imaginative_play_1; ?>/>
              <label for="imaginative_play_present">Supports Imaginative Play</label>
            </div>
            <div>
              <input type="checkbox" id="restorative_play_present" name="restorative_play" <?php echo $sticky_restorative_play_1; ?>/>
              <label for="restorative_play_present">Supports Restorative Play</label>
            </div>
            <div>
              <input type="checkbox" id="play_with_rules_present" name="play_with_rules" <?php echo $sticky_play_with_rules_1; ?>/>
              <label for="play_with_rules_present">Supports Play with Rules</label>
            </div>
          </div>
        </div>
        <input id="filter-submit" class="button1" type="submit" name="submit-filter" value="Sort and Filter"/>
      </form>
    </aside>
    </div>
    <?php } else { ?>
      <article>
        <h3>Sorry, the page you are trying to access is restricted to "Playful Plants Project" administrators only. </h3>
        <h3>You can view relevent information regarding plants on <a href="/">"Plants Information" page. </a></h3>
      </article>
    <?php } ?>
  </main>
</body>
</html>
