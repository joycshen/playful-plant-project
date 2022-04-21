<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

// values
$id = '';
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
$tag_name = '';

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
$sticky_tag_name = '';

$update_plant = $_POST['update-plant'] ?? NULL;

$plant_id = $_GET['id'] ?? NULL;

if ($update_plant) {
  $records = exec_sql_query(
    $db,
    "SELECT * FROM entries WHERE (id = :id);",
    array(':id' => $update_plant)
  )->fetchAll();

if (count($records) > 0) {
    $record = $records[0];
  }
} else if ($plant_id) {

  $plant_id = strtolower(trim($plant_id));

  $records = exec_sql_query(
    $db,
    "SELECT * FROM entries WHERE (id = :id);",
    array(
      ':id' => $plant_id
    )
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
  }
}

if ($record) {
  $id = $record['id'];
  $colloquial_name = $record['name_colloquial'];
  $genus_species = $record['name_genus_species'];
  $plant_id = $record['plant_id'];
  $hardiness_zone_range = $record['hardiness_zone_range'];
  $exploratory_constructive_play = $record['exploratory_constructive_play'];
  $exploratory_sensory_play = $record['exploratory_sensory_play'];
  $imaginative_play = $record['imaginative_play'];
  $restorative_play = $record['restorative_play'];
  $play_with_rules = $record['play_with_rules'];
  $bio_play = $record['bio_play'];
  $perennial = $record['perennial'];
  $full_sun = $record['full_sun'];
  $partial_shade = $record['partial_shade'];
  $full_shade = $record['full_shade'];

  $sticky_colloquial_name = $colloquial_name;
  $sticky_genus_species = $genus_species;
  $sticky_plant_id = $plant_id;
  $sticky_hardiness_zone_range = $hardiness_zone_range;

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

  // feedback message styling
  $name_feedback_class = 'hidden';
  $genus_feedback_class = 'hidden';
  $plant_id_feedback_class = 'hidden';
  $topo_feedback_class = 'hidden';
  $growing_needs_feedback_class = 'hidden';
  $tag_name_feedback_class = 'hidden';
  $tag_feedback_class = 'hidden';

  $record_updated = False;

  if ($update_plant) {

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
    $tag_name = trim($_POST['tag_name']);
    $shrub = (!empty($_POST['shrub']) ? 1 : '');
    $grass = (!empty($_POST['grass']) ? 2 : '');
    $vine = (!empty($_POST['vine']) ? 3 : '');
    $tree = (!empty($_POST['tree']) ? 4 : '');
    $flower = (!empty($_POST['flower']) ? 5 : '');
    $groundcovers = (!empty($_POST['groundcovers']) ? 6 : '');
    $other = (!empty($_POST['other']) ? 7 : '');

    $form_valid = True;

    if (empty($exploratory_constructive_play) && empty($exploratory_sensory_play) && empty($physical_play) && empty($imaginative_play) && empty($restorative_play) && empty($play_with_rules) && empty($bio_play)) {
        $form_valid = False;
        $topo_feedback_class = '';
      }

      if (empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other)) {
        $form_valid = False;
        $tag_feedback_class = '';
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

    if ($form_valid) {
      $result = exec_sql_query(
        $db,
        "UPDATE entries SET
            name_colloquial = :name_colloquial,
            name_genus_species = :name_genus_species,
            plant_id = :plant_id,
            exploratory_constructive_play = :exploratory_constructive_play,
            exploratory_sensory_play = :exploratory_sensory_play,
            physical_play = :physical_play,
            imaginative_play = :imaginative_play,
            restorative_play = :restorative_play,
            play_with_rules = :play_with_rules,
            bio_play = :bio_play,
            perennial = :perennial,
            full_sun = :full_sun,
            partial_shade = :partial_shade,
            full_shade = :full_shade,
            hardiness_zone_range = :hardiness_zone_range
          WHERE (id = :id);",
        array(
        //   ':id' => $id,
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
          ':hardiness_zone_range' => $hardiness_zone_range
        )
      );

      if ($result) {
        $record_updated = True;
      }
    } else {
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
    }
  }
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
    <?php if ($record_updated) { ?>

      <section>
        <h2>Plant Updated Confirmation</h2>

        <p>The plant <strong>"<?php echo htmlspecialchars($colloquial_name); ?>"</strong> is successfully updated in the catalog!</p>

        <p>View updated catalog in <a href="/">Playful Plant Data</a></p>
      </section>

    <?php } else { ?>
      <h2>Edit the Plant!</h2>
      <div class="align-center">
      <form id="request-form" method="post" action="/plant-update?<?php echo http_build_query(array('id' => $record['id'])); ?>" novalidate>

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

    <input type="hidden" name="update-plant" value="<?php echo htmlspecialchars($id); ?>" />

      <div class="align_right">
          <button type="submit">Save Changes</button>
        </div>
      </form>
      </div>

<!-- add tag form -->
    <div class="align-center">
      <form id="request-form" method="post" action="/add-new-plants-form" novalidate>
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
        <input id="add-submit" class="button1" type="submit" name="add-tag" value="Add Tag" />
      </div>
    </form>
    </div>
    </article>
    </div>
    <?php } ?>
  </main>
</body>

</html>
