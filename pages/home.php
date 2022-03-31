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
  <article>
  <div class="body">
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
  <div class="select" onclick="showCheckboxes()">
  <select name="name" id="name">'
    <option value="" id="asc">Colloquial Name Ascendant (A-Z)</option>
    <option value="" id="desc">Colloquial Name Descendant (Z-A)</option>
  </select>
  </div>
  </div>
  </form>
  </div>
  </div>

  </div>
      <div class="plants">
        <div class="plant">
        <div>
          <a href="/plant-details">
            <img src="public/images/FL_26.jpg" alt="" width="250" height="250"/>
          </a>
          <h3>Lady's mantle</h3>
        </div>
        <div>
          <img src="public/images/FL_05.jpg" alt="" width="250" height="250"/>
          <h3>Spiked Gay-Feather</h3>
        </div>
        <div>
          <img src="public/images/GA_05.jpg" alt="" width="250" height="250"/>
          <h3>Broad-leaf Sedge</h3>
        </div>
        <div>
          <img src="public/images/SH_29.jpg" alt="" width="250" height="250"/>
          <h3>Red Osier Dogwood</h3>
        </div>
        </div>

        <div class="plant">
        <div>
          <img src="public/images/SH_33.jpg" alt="" width="250" height="250"/>
          <h3>Flowering Raspberry</h3>
        </div>
        <div>
          <img src="public/images/TR_23.jpg" alt="" width="250" height="250"/>
          <h3>River Birch</h3>
        </div>
        <div>
          <img src="public/images/SH_03.jpg" alt="" width="250" height="250"/>
          <h3>Harry Lauder's Walking stick</h3>
        </div>
        <div>
          <img src="public/images/FE_12.jpg" alt="" width="250" height="250"/>
          <h3>Christmas fern</h3>
        </div>
        </div>
      </div>
    </article>

    <div class="form">
    <aside>
    <!-- <div id="feedback" class="feedback <?php echo $feedback_class; ?>">Please choose at least one sorting/filter.</div> -->

    <div class="plants">
      <h2>Choose Tag(s)</h2>
          <h3>General Classification: </h3></div>
          <div class="buttons">
            <button class="button style">Shrub</button>
            <button class="button style">Grass</button>
            <button class="button style">Vine</button>
            <button class="button style">Tree</button>
            <button class="button style">Flower</button>
            <button class="button style">Groundcovers</button>
            <button class="button style">Other</button>
          </div>
    </div>
    </div>
    </aside>
    </div>
  </main>
</body>

</html>
