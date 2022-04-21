<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$update_plant = $_POST['update-plant'] ?? NULL;

$plant_id = $_GET['id'] ?? NULL;

if ($update_plant) {
  $records = exec_sql_query(
    $db,
    "SELECT
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
    LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id) WHERE entries.id = :id;",
    array(':id' => $update_plant)
  )->fetchAll();

if (count($records) > 0) {
    $record = $records[0];
  }
} else if ($plant_id) {

  $plant_id = strtolower(trim($plant_id));

  // Locate plant in database
  $records = exec_sql_query(
    $db,
    "SELECT
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
    LEFT OUTER JOIN tags ON (entry_tags.tag_id = tags.id) WHERE entries.id = :id;",
    array(
      ':id' => $plant_id
    )
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
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
    <?php if ($show_confirmation) { ?>

      <section>
        <h2>Adding New Plants Confirmation</h2>

        <p>The new plant <strong>"<?php echo htmlspecialchars($colloquial_name); ?>"</strong> is successfully added to the catalog!</p>

        <p>View new catalog in <a href="/">Playful Plant Data</a></p>
      </section>

    <?php } else { ?>
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

      <div class="align_right">
        <input id="add-submit" class="button1" type="submit" name="update-plant" value="Edit Entry" />
      </div>
      </form>
      </div>

<!-- add tag form -->
    <div class="align-center">
      <form id="request-form" method="post" action="/add-new-plants-form" novalidate>
      <div class="add-form">
      <div>
      <div id="feedback1" class="feedback <?php echo $tag_name_feedback_class; ?>">Please enter a valid tag name.</div>
      <h3>Add a New Tag</h3>
        <div class="label_input">
        <h3><label for="name_field">Tag Name:</label></h3>
          <input id="name_field" type="text" name="tag_name" value="<?php echo htmlspecialchars($sticky_tag_name); ?>"/>
        </div>
    </div>
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
