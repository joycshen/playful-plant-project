<?php
$title = "Playful Plants Projects";
$nav_plants_data = "active_page";
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
  <div class="filters">

  <div class="titles">
    <p>Filters: </p>
  </div>

  <div>
  <form>
  <div class="filter">
    <div class="select" onclick="showCheckboxes()">
      <select>
        <option>Playing Opportunities: </option>
      </select>
    <div class="choices"></div>
    </div>
    <div id="checkboxes">
      <label for="one">
        <input type="checkbox" id="one" />Creates Nooks or Secret Spaces</label>
      <label for="two">
        <input type="checkbox" id="two" />Provides Loose Parts/Play Props</label>
      <label for="three">
        <input type="checkbox" id="three" />Provides Opportunities for Climbing & Swinging</label>
      <label for="four">
        <input type="checkbox" id="four" />Can be used to create Mazes/Labyrinths/Spirals</label>
      <label for="five">
        <input type="checkbox" id="five" />Includes Evocative or Unique Elements</label>
    </div>
  </div>
  </form>
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
  </form>
  </div>
  </div>

  <div class="filters">

  <div class="titles">
   <p>Sort: </p>
  </div>

  <div>
  <form>
  <div class="sort">
  <div class="growing" onclick="showCheckboxes()">
    <select>
      <option>Playing Opportunities: </option>
    </select>
  <div class="choices"></div>
  </div>
  <div id="checkboxes">
    <label for="one">
      <input type="checkbox" id="one" />Creates Nooks or Secret Spaces</label>
    <label for="two">
      <input type="checkbox" id="two" />Provides Loose Parts/Play Props</label>
    <label for="three">
      <input type="checkbox" id="three" />Provides Opportunities for Climbing & Swinging</label>
    <label for="four">
      <input type="checkbox" id="four" />Can be used to create Mazes/Labyrinths/Spirals</label>
    <label for="five">
      <input type="checkbox" id="five" />Includes Evocative or Unique Elements</label>
  </div>
  </div>
  </form>
  </div>
</div>

  </div>
      <div class="plants">
      <article>
        <div class="plant">
        <div>
          <img src="public/images/FL_26.jpg" alt="" width="300" height="300"/>
          <h3>Lady's mantle</h3>
        </div>
        <div>
          <img src="public/images/FL_05.jpg" alt="" width="300" height="300"/>
          <h3>Spiked Gay-Feather</h3>
        </div>
        <div>
          <img src="public/images/GA_05.jpg" alt="" width="300" height="300"/>
          <h3>Broad-leaf Sedge</h3>
        </div>
        </div>

        <div class="plant">
        <div>
          <img src="public/images/SH_29.jpg" alt="" width="300" height="300"/>
          <h3>Red Osier Dogwood</h3>
        </div>
        <div>
          <img src="public/images/SH_33.jpg" alt="" width="300" height="300"/>
          <h3>Flowering Raspberry</h3>
        </div>
        <div>
          <img src="public/images/TR_23.jpg" alt="" width="300" height="300"/>
          <h3>River Birch</h3>
        </div>
        </div>
        </div>
      </article>
      </div>
    </div>
  </main>
</body>

</html>
