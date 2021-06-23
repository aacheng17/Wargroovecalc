<!DOCTYPE HTML>  
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WargrooveCalc</title>
</head>
<body>  
<script type="module" src="main.js"></script>
<link rel="stylesheet" href="style.css" type="text/css">

<?php
$unitsA = array(1, 2, 3, 4, 5, 6, 7, 9, 10, 12, 14, 15, 16, 18, 19, 20, 21, 22);
$unitNames = array("(0) villager", "(1) soldier", "(2) spearman", "(3) dog", "(4) mage", "(5) archer", "(6) giant", "(7) cavalry", "(8) wagon", "(9) ballista", "(10) trebuchet", "(11) thief", "(12) rifleman", "(13) balloon", "(14) aeronaut", "(15) sky rider", "(16) dragon", "(17) barge", "(18) turtle", "(19) harpoon ship", "(20) warship", "(21) amphibian", "(22) commander", "(23) structure", "(24) stronghold");
$unitCrits = array(1.5, 1.5, 1.5, 1.5, 1.35, 1.5, 1.5, 1.5, 2.5, 1.5, 1.25, 2, 2, 2, 1.5, 1.5, 1.5, 1, 1);
$terrainNames = array("road (0)", "bridge (0)", "plains (1)", "forest (3)", "mountain (4)", "beach (-1)", "sea (1)", "deep sea (0)", "river (-2)", "reef (2)", "flagstone (2)", "carpet (2)");
$terrainDefenses = array(0, 0, 1, 3, 4, -1, 1, 0, -2, 2, 2, 2);
$weathers = array("sun", "rain", "wind");
$damageMatrix = array(
  /*0villager*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  /*1solder*/array(60, 60, 40, 50, 60, 70, 10, 20, 40, 40, 35, 100, 75, 0, 0, 0, 0, 0, 0, 0, 0, 60, 15, 40, 22),
  /*2spearman*/array(80, 80, 60, 85, 70, 75, 15, 75, 50, 60, 55, 80, 90, 0, 0, 0, 0, 0, 0, 0, 0, 80, 20, 55, 30),
  /*3dog*/array(80, 80, 50, 70, 60, 80, 10, 15, 35, 45, 40, 90, 115, 0, 0, 0, 0, 0, 0, 0, 0, 80, 20, 25, 15),
  /*4mage*/array(105, 90, 80, 85, 40, 90, 25, 35, 60, 35, 50, 90, 100, 105, 145, 135, 85, 0, 0, 0, 0, 60, 25, 40, 22),
  /*5archer*/array(75, 75, 60, 80, 80, 70, 15, 45, 40, 35, 30, 75, 85, 25, 35, 25, 15, 25, 25, 25, 25, 75, 10, 25, 15),
  /*6giant*/array(135, 155, 105, 155, 115, 155, 50, 90, 80, 105, 110, 135, 145, 0, 0, 0, 0, 0, 0, 0, 0, 135, 40, 90, 48),
  /*7cavalry*/array(95, 95, 50, 125, 115, 105, 30, 60, 60, 90, 85, 95, 105, 0, 0, 0, 0, 0, 0, 0, 0, 90, 30, 70, 37),
  /*8wagon*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  /*9ballista*/array(45, 45, 35, 55, 45, 35, 15, 30, 35, 25, 15, 45, 55, 115, 135, 100, 90, 25, 25, 25, 25, 45, 15, 35, 20),
  /*10trebuchet*/array(105, 105, 85, 115, 95, 125, 60, 85, 75, 90, 85, 105, 115, 0, 0, 0, 0, 85, 50, 70, 80, 105, 30, 90, 48),
  /*11thief*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  /*12rifleman*/array(125, 125, 105, 25, 105, 90, 10, 15, 15, 10, 10, 105, 90, 0, 0, 0, 0, 0, 0, 0, 0, 80, 10, 10, 8),
  /*13balloon*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  /*14aeronaut*/array(70, 70, 50, 60, 30, 80, 15, 80, 40, 40, 60, 70, 80, 60, 60, 35, 40, 40, 30, 30, 50, 70, 20, 55, 30),
  /*15sky rider*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 65, 40, 40, 0, 0, 0, 0, 0, 0, 0, 0),
  /*16dragon*/array(125, 125, 125, 155, 70, 145, 70, 105, 85, 115, 110, 125, 135, 0, 0, 0, 0, 110, 75, 70, 90, 120, 40, 70, 37),
  /*17barge*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  /*18turtle*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 60, 55, 40, 85, 115, 0, 0, 0),
  /*19harpoon ship*/array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 85, 135, 85, 75, 50, 80, 35, 20, 35, 0, 0, 0),
  /*20warship*/array(105, 105, 80, 115, 85, 125, 60, 75, 65, 90, 85, 105, 115, 0, 0, 0, 0, 70, 35, 85, 60, 80, 30, 80, 43),
  /*21amphibian*/array(40, 40, 30, 50, 50, 40, 10, 20, 40, 30, 25, 40, 50, 0, 0, 0, 0, 15, 15, 35, 15, 30, 15, 20, 13),
  /*22commander*/array(100, 120, 80, 120, 85, 135, 45, 60, 75, 65, 60, 100, 110, 0, 0, 0, 0, 0, 0, 0, 0, 100, 45, 75, 40),
  /*23structure*/array(0, 35, 35, 40, 40, 35, 10, 15, 0, 0, 0, 0, 45, 0, 35, 10, 0, 0, 0, 0, 0, 35, 10, 0, 0),
  /*24stronghold*/array(0, 35, 35, 40, 40, 35, 10, 15, 0, 0, 0, 0, 45, 0, 35, 10, 0, 0, 0, 0, 0, 35, 10, 0, 0)
);

$unitA = $healthA = $terrainA = $unitD = $healthD = $terrainD = $weather = 0;
$healthA = $healthD = 100;
$critA = $critD = False;
$spaces = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $buf = sanitizeInput($_POST['unitA']);
  if (isValidIntInRange(0, count($unitNames)-1, $buf)) {
    $unitA = $buf;
  }

  $buf = sanitizeInput($_POST['healthA']);
  if (isValidIntInRange(1, 100, $buf)) {
    $healthA = $buf;
  }

  $buf = sanitizeInput($_POST['terrainA']);
  if (isValidIntInRange(0, count($terrainNames)-1, $buf)) {
    $terrainA = $buf;
  }

  $buf = sanitizeInput($_POST['critA']);
  $critA = !empty($buf);

  $buf = sanitizeInput($_POST['unitD']);
  if (isValidIntInRange(0, count($unitNames)-1, $buf)) {
    $unitD = $buf;
  }

  $buf = sanitizeInput($_POST['healthD']);
  if (isValidIntInRange(1, 100, $buf)) {
    $healthD = $buf;
  }

  $buf = sanitizeInput($_POST['terrainD']);
  if (isValidIntInRange(0, count($terrainNames)-1, $buf)) {
    $terrainD = $buf;
  }

  $buf = sanitizeInput($_POST['critD']);
  $critD = !empty($buf);

  $buf = sanitizeInput($_POST['weather']);
  if (isValidIntInRange(0, 2, $buf)) {
    $weather = $buf;
  }

  $buf = sanitizeInput($_POST['spaces']);
  if (isValidIntInRange(0, 10, $buf)) {
    $spaces = $buf;
  }
}

function sanitizeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function isValidIntInRange($min, $max, $data) {
  if (!empty($data)) {
    $dataInt = intval($data);
    if ($dataInt >= $min && $dataInt <= $max) {
      return TRUE;
    }
  }
  return FALSE;
}

function calc($unitA, $healthA, $terrainA, $critA, $unitD, $healthD, $terrainD, $critD, $weather, $spaces) {
  global $damageMatrix, $unitCrits, $terrainDefenses;
  $cPower = $damageMatrix[$unitA][$unitD];
  $cCrit = $critA ? $unitCrits[$unitA] : 1;
  $cWeather = 1;
  if ($unitA >= 14 && $unitA <= 16 && $weather != 0) {
    $cWeather = $weather == 1 ? 0.8 : 1.2;
  }
  $cAtkHealth = $healthA / 100;
  $cDefense = $terrainDefenses[$terrainD];
  $cDefHealth = ($cDefense >= 0 ? $healthD : 1) / 100;
  $cx = $cPower * $cCrit * $cWeather;
  $cz = $cAtkHealth * (1 - ($cDefHealth * $cDefense / 10));
  $minAttack = ($cx - 5) * $cz;
  $maxAttack = ($cx + 5) * $cz;
  $possibleAttacks = range(round($minAttack), round($maxAttack));

  $rands = array(-5);
  foreach(range(round($minAttack), round($maxAttack) - 1) as $attack) {
    $rand = ($attack + 0.5) / $cz - $cx;
    array_push($rands, $rand);
  }
  array_push($rands, 5);

  $probs = array();
  foreach(range(0, count($rands)-2) as $i) {
    $prob = ($rands[$i+1] - $rands[$i]) * 10;
    if ($prob > 0) {
      array_push($probs, $prob);
    }
  }

  $ret = array()
  foreach(range(0, count($possibleAttacks)) as $i) {
    $ret[$possibleAttacks[i]] = $probs[i];
  }

  return ret;
}
?>

<form id="calc-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <div id="div-attack" class="main-div">
    <select name="unitA" id="unitA" form="calc-form"><?php
      $i = 0;
      foreach($unitNames as $unitName) {
        if (in_array($i, $unitsA)) {
          echo '<option value=' . $i . ($i == $unitA ? ' selected' : '') .  '>' . $unitName . '</option>';
        }
        $i++;
      }
    ?></select>
    <?php echo '<input type="number" id="healthA" name="healthA" min="1" max="100" value="' . $healthA . '">' ?>
    <select name="terrainA" id="terrainA" form="calc-form"><?php
      $i = 0;
      foreach($terrainNames as $terrainName) {
        echo '<option value=' . $i . ($i == $terrainA ? ' selected' : '') .  '>' . $terrainName . '</option>';
        $i++;
      }
    ?></select>
    <label><?php echo '<input type="checkbox" id="critA" name="critA"' . ($critA ? " checked" : "") . '>' ?>Crit</label>
  </div>

  <img src="icon-attack.png" alt="Attack" width="75px" height="75px">

  <div id="div-defend" class="main-div">
    <select name="unitD" id="unitD" form="calc-form"><?php
      $i = 0;
      foreach($unitNames as $unitName) {
        echo '<option value=' . $i . ($i == $unitD ? ' selected' : '') .   '>' . $unitName . '</option>';
        $i++;
      }
    ?></select>
    <?php echo '<input type="number" id="healthD" name="healthD" min="1" max="100" value="' . $healthD . '">' ?>
    <select name="terrainD" id="terrainD" form="calc-form"><?php
      $i = 0;
      foreach($terrainNames as $terrainName) {
        echo '<option value=' . $i . ($i == $terrainD ? ' selected' : '') .  '>' . $terrainName . '</option>';
        $i++;
      }
    ?></select>
    <label><?php echo '<input type="checkbox" id="critD" name="critD"' . ($critD ? ' checked' : '') . '>' ?>Crit</label>
  </div>

  <div id="div-conditions" class="main-div">
    Spaces apart: (put 0 for always in range)
    <?php echo '<input type="number" id="spaces" name="spaces" min="1" max="10" value="' . $spaces . '">' ?>
    <br/>
    <select name="weather" id="weather" form="calc-form"><?php
      $i = 0;
      foreach($weathers as $weatherName) {
        echo '<option value=' . $i . ($i == $weather ? ' selected' : '') .  '>' . $weatherName . '</option>';
        $i++;
      }
    ?></select>
  </div>
  
  <div id="div-submit" class="main-div">
    <input id="button-calc" type="submit" name="submit" value="Calc">
  </div>
</form>

<div id="div-result" class="main-div">
  <?php
  echo '<h2>Result:</h2>';
  echo 'Attack damage possibilities:<br/>';
  $calcResults = calc($unitA, $healthA, $terrainA, $critA, $unitD, $healthD, $terrainD, $critD, $weather, $spaces);
  foreach($calcResults as $damage => $prob) {
    echo $damage . '(' . $prob . ') ';
  }
  ?>
</div>

</body>
</html>