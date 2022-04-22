<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
$nav_new_entry_form = "active_page";

// open database
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$plant_id = $_GET['id'] ?? NULL;

if ($plant_id) {
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
    array(':id' => $plant_id)
  )->fetchAll();

  // if (count($records) > 0) {
  $plant = $records[0];
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
  <a href="/">
    <h3 class="back">Back</h3>
  </a>
     <div class="plants">
      <div class="plant">
      <article>
        <?php if ($plant) { ?>
        <div class="detail">
        <h2><?php echo $plant['entries.name_colloquial'] ?></h2>
        <div class="buttons">
            <button class="button style"><?php echo $plant['tags.tag_name']; ?></button>
        </div>
        </div>
        <div class="plant">
            <img src="/public/uploads/entries/<?php echo $plant['entries.id'] . '.' . $plant['entries.img_ext'];  ?>" alt="<?php echo htmlspecialchars($plant['entries.name_colloquial']); ?>" width="600" height="350"/>
            <div class="catalogs">
            <div class="catalog">
              <h3>Growing Needs and Characteristics: </h3>
              <ul>
                  <?php if ($plant["entries.perennial"] == 1) { ?>
                  <li>Perennial</li>
                  <?php } ?>
                  <?php if ($plant["entries.full_sun"] == 1) { ?>
                  <li>Full Sun</li>
                  <?php } ?>
                  <?php if ($plant["entries.partial_shade"] == 1) { ?>
                  <li>Particla Shade</li>
                  <?php } ?>
                  <?php if ($plant["entries.full_shade"] == 1) { ?>
                  <li>Full Shade</li>
                  <?php } ?>
                  <li><?php echo htmlspecialchars($plant["entries.hardiness_zone_range"]) ?></li>
              </ul>
            </div>
        </div>
        </div>
        <?php } ?>
      </article>
      </div>
      </div>
  </main>
</body>

</html>
