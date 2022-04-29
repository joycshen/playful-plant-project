<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

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

$update_plant = $_POST['update-plant'] ?? NULL;

$plant_id = $_GET['id'] ?? NULL;

if ($update_plant) {
  $records = exec_sql_query(
    $db,
    "SELECT
    entries.id AS 'entries.id',
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
    tags.tag_name AS 'tags.tag_name',
    entry_tags.entry_id AS 'entries.id',
    entry_tags.tag_id AS 'tags.id'
    FROM
    entry_tags
    LEFT OUTER JOIN entries ON (entry_tags.entry_id = entries.id)
    LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id)
    WHERE (entries.id = :id);",
    array(':id' => $update_plant)
  )->fetchAll();

if (count($records) > 0) {
    $record = $records[0];
  }
} else if ($plant_id) {

  $plant_id = strtolower(trim($plant_id));

  $records = exec_sql_query(
    $db,
    "SELECT
    entries.id AS 'entries.id',
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
    tags.tag_name AS 'tags.tag_name',
    entry_tags.entry_id AS 'entries.id',
    entry_tags.tag_id AS 'tags.id'
    FROM
    entry_tags
    LEFT OUTER JOIN entries ON (entry_tags.entry_id = entries.id)
    LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id)
    WHERE (entries.id = :id);",
    array(
      ':id' => $plant_id
    )
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
  }
}

if ($record) {
  $id = $record['entries.id'];
  $colloquial_name = $record['entries.name_colloquial'];
  $genus_species = $record['entries.name_genus_species'];
  $plant_id = $record['entries.plant_id'];
  $hardiness_zone_range = $record['entries.hardiness_zone_range'];
  $exploratory_constructive_play = $record['entries.exploratory_constructive_play'];
  $exploratory_sensory_play = $record['entries.exploratory_sensory_play'];
  $imaginative_play = $record['entries.imaginative_play'];
  $restorative_play = $record['entries.restorative_play'];
  $play_with_rules = $record['entries.play_with_rules'];
  $bio_play = $record['entries.bio_play'];
  $perennial = $record['entries.perennial'];
  $full_sun = $record['entries.full_sun'];
  $partial_shade = $record['entries.partial_shade'];
  $full_shade = $record['entries.full_shade'];
  $shrub = $record['tags.id'];
  $grass = $record['tags.id'];
  $vine = $record['tags.id'];
  $tree = $record['tags.id'];
  $flower = $record['tags.id'];
  $groundcovers = $record['tags.id'];
  $other = $record['tags.id'];

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
  $sticky_shrub = ($shrub != 1 ? '' : 'checked');
  $sticky_grass = ($grass != 2 ? '' : 'checked');
  $sticky_vine = ($vine != 3 ? '' : 'checked');
  $sticky_tree = ($tree != 4 ? '' : 'checked');
  $sticky_flower = ($flower != 5 ? '' : 'checked');
  $sticky_groundcovers = ($groundcovers != 6 ? '' : 'checked');
  $sticky_other = ($other != 7 ? '' : 'checked');

  // feedback message styling
  $name_feedback_class = 'hidden';
  $genus_feedback_class = 'hidden';
  $plant_id_feedback_class = 'hidden';
  $topo_feedback_class = 'hidden';
  $growing_needs_feedback_class = 'hidden';
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
          WHERE (id = $id);",
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
          ':hardiness_zone_range' => $hardiness_zone_range
        )
      );

      // $entry_id = $db->lastInsertId('id');

      $result_tag_1 = exec_sql_query(
      $db,
      "UPDATE entry_tags SET
        entry_id = :entry_id,
        tag_id = :tag_id
      WHERE (id = $id);",
      array(
        ':entry_id' => $id,
        ':tag_id' => $tag_id,
      )
    );

      if ($result && $result_tag_1) {
        $record_updated = True;
      }
        // $show_confirmation = True;
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

        <p>View updated catalog in <a href="/">"Plant Information" page</a> and <a href="/add-new-plants-form">"Add New Plant" page.</a></p>
      </section>

    <?php } else { ?>
      <a href="/add-new-plants-form">
        <h3 class="back">Back</h3>
      </a>
      <h2>Edit the Plant!</h2>
      <div class="align-center">
      <form id="request-form" method="post" action="/plant-update?<?php echo http_build_query(array('id' => $record['entries.id'])); ?>" novalidate>

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
          <div id="feedback5" class="feedback <?php echo $growing_needs_feedback_class; ?>">Please select at least one Growing Need and Characteristic.</div>
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
      <div>
      <h3>Choose Existing Tag(s)</h3>
      <div class="column">
          <div id="feedback6" class="feedback <?php echo $tag_feedback_class; ?>">Please select at least one tag.</div>
          <div class="forms label_input" role="group" aria-labelledby="general">
          <div id="general"><h3>General Classification: </h3></div>
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


    <input type="hidden" name="update-plant" value="<?php echo htmlspecialchars($id); ?>" />

      <div class="align_right">
          <button type="submit" class="button1">Save Changes</button>
        </div>
      </form>
      </div>

    </article>
    <?php } ?>
  </main>
</body>

</html>
