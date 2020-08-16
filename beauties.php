<?php

// variables
$page_title = 'Oriental Beauties Verification tool';
$formsubmit = false;
$round = 0;
$index = 0;

if (isset($_POST['serverseed'])) {
  $serverseed = $_POST['serverseed'];
  $clientseed = $_POST['clientseed'];
  $nonce = $_POST['nonce'];
  $round = $_POST['round'];
  $index = $_POST['index'];

  $formsubmit = true;
}


$icons = array(
  [1, 3, 4, 3, 2, 3],
  [2, 7, 2, 9, 7, 8],
  [3, 10, 9, 10, 11, 6],
  [4, 9, 8, 9, 8, 9],
  [5, 7, 10, 4, 9, 10],
  [6, 8, 8, 8, 3, 2],
  [7, 10, 9, 7, 8, 10],
  [8, 6, 11, 10, 10, 9],
  [9, 9, 5, 2, 11, 7],
  [10, 8, 9, 13, 6, 1],
  [11, 4, 8, 13, 8, 10],
  [12, 10, 10, 13, 9, 5],
  [13, 8, 8, 1, 3, 7],
  [14, 9, 5, 8, 10, 10],
  [15, 10, 10, 10, 1, 12],
  [16, 8, 13, 9, 8, 8],
  [17, 2, 13, 11, 7, 10],
  [18, 10, 13, 9, 9, 9],
  [19, 7, 13, 10, 2, 13],
  [20, 5, 7, 8, 6, 13],
  [21, 10, 5, 10, 10, 13],
  [22, 3, 4, 12, 3, 9],
  [23, 8, 7, 9, 9, 10],
  [24, 7, 6, 1, 8, 8],
  [25, 12, 10, 8, 4, 12],
  [26, 6, 5, 10, 13, 9],
  [27, 10, 6, 1, 13, 2],
  [28, 2, 10, 9, 13, 10],
  [29, 9, 1, 8, 13, 1],
  [30, 7, 10, 12, 9, 10],
  [31, 8, 11, 3, 3, 9],
  [32, 10, 7, 9, 7, 7],
  [33, 12, 10, 7, 10, 12],
  [34, 7, 4, 12, 1, 1],
  [35, 8, 9, 3, 10, 10],
  [36, 9, 11, 8, 11, 8],
  [37, 10, 6, 11, 9, 9],
  [38, 8, 9, 6, 2, 13],
  [39, 6, 1, 13, 7, 13],
  [40, 12, 6, 13, 3, 13],
  [41, 7, 8, 13, 1, 9],
  [42, 10, 10, 9, 9, 6],
  [43, 8, 3, 11, 8, 6],
  [44, 9, 2, 2, 10, 2],
  [45, 3, 10, 3, 11, 12],
  [46, 5, 7, 10, 9, 3],
  [47, 1, 11, 5, 1, 10],
  [48, 7, 6, 7, 4, 4],
  [49, 12, 5, 2, 5, 9],
  [50, 9, 13, 5, 3, 7],
  [51, 8, 13, 9, 10, 1],
  [52, 1, 13, 8, 8, 10],
  [53, 7, 13, 7, 4, 4],
  [54, 5, 1, 12, 5, 12],
  [55, 10, 8, 10, 9, 5],
  [56, 9, 9, 4, 2, 8],
  [57, 4, 10, 9, 10, 3],
  [58, 9, 4, 11, 3, 10],
  [59, 10, 3, 4, 9, 4],
  [60, 7, 5, 5, 8, 10],
  [61, 5, 10, 8, 4, 0],
  [62, 10, 9, 9, 13, 0],
  [63, 12, 11, 6, 13, 0],
  [64, 9, 8, 1, 13, 0],
  [65, 6, 9, 13, 13, 0],
  [66, 7, 7, 13, 6, 0],
  [67, 2, 6, 13, 8, 0],
  [68, 9, 9, 3, 5, 0],
  [69, 4, 7, 6, 9, 0],
  [70, 5, 8, 7, 4, 0],
  [71, 1, 10, 2, 11, 0],
  [72, 7, 3, 11, 5, 0],
  [73, 8, 5, 6, 2, 0],
  [74, 10, 10, 12, 10, 0],
  [75, 9, 9, 7, 8, 0],
  [76, 4, 7, 6, 4, 0],
  [77, 8, 8, 10, 3, 0],
  [78, 3, 3, 4, 5, 0],
  [79, 10, 7, 9, 2, 0],
  [80, 6, 2, 5, 10, 0],
  [81, 0, 10, 10, 0, 0],
  [82, 0, 6, 8, 0, 0],
  [83, 0, 10, 9, 0, 0],
  [84, 0, 8, 7, 0, 0],
  [85, 0, 4, 2, 0, 0],
  [86, 0, 3, 7, 0, 0],
  [87, 0, 0, 0, 0, 0],
  [88, 0, 0, 0, 0, 0],
  [89, 0, 0, 0, 0, 0],
  [90, 0, 0, 0, 0, 0],
  [91, 0, 0, 0, 0, 0],
  [92, 0, 0, 0, 0, 0],
  [93, 0, 0, 0, 0, 0],
  [94, 0, 0, 0, 0, 0],
  [95, 0, 0, 0, 0, 0],
  [96, 0, 0, 0, 0, 0],
  [97, 0, 0, 0, 0, 0],
  [98, 0, 0, 0, 0, 0],
  [99, 0, 0, 0, 0, 0],
  [100, 0, 0, 0, 0, 0],
  [101, 0, 0, 0, 0, 0],
  [102, 0, 0, 0, 0, 0],
  [103, 0, 0, 0, 0, 0],
  [104, 0, 0, 0, 0, 0],
  [105, 0, 0, 0, 0, 0],
  [106, 0, 0, 0, 0, 0],
);
$bounus_payout = array(
  [1, 1, 0, 0],
  [2, 1, 2, 40],
  [3, 1, 3, 90],
  [4, 1, 5, 150],
  [5, 1, 7, 180],
  [6, 1, 10, 195],
  [7, 1, 15, 205],
  [8, 2, 0, 50],
  [9, 2, 2, 85],
  [10, 2, 3, 130],
  [11, 2, 5, 185],
  [12, 2, 7, 285],
  [13, 2, 10, 315],
  [14, 2, 15, 330],
  [15, 3, 0, 150],
  [16, 3, 2, 190],
  [17, 3, 3, 240],
  [18, 3, 5, 300],
  [19, 3, 7, 360],
  [20, 3, 10, 440],
  [21, 3, 15, 500],
  [22, 4, 0, 475],
  [23, 4, 2, 495],
  [24, 4, 3, 525],
  [25, 4, 5, 565],
  [26, 4, 7, 615],
  [27, 4, 10, 855],
  [28, 4, 15, 1055]
);
$bounus_multi = array(
  '0' => 205,
  '1' => 330,
  '2' => 500,
  '3' => 1055,
);

if ($formsubmit) {
  // hash
  $hash = hash('sha256', $serverseed);
  $hash2 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
  $splitedhash = str_split ($hash2, 2);

  // convert base 16 to 10
  $convert = array_base_converter($splitedhash);

  // byte to Reel numbers
  $reels = bytes_to_number($convert);

  $reels_final = array(
    1 => $reels[1] * 80,
    2 => $reels[2] * 86,
    3 => $reels[3] * 86,
    4 => $reels[4] * 80,
    5 => $reels[5] * 60,
  );

  // bonus
  $bonus_hash = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round .':'. ($index+1));
  $convert_bonus = array_base_converter(str_split ($bonus_hash, 2));
  $reels_bonus = bytes_to_number($convert_bonus);
  $reels_bonus_final = $reels_bonus[1] * $bounus_multi[$index];
}


// template
include 'template/header.php';
?>


<div class="page-content publicpage">

  <div class="block">
    <div class="row">
      <div class="col">
          <form class="mainform" action="beauties.php" method="post">
            <ul class="list no-hairlines-md">
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Server Seed</div>
                <div class="item-input-wrap">
                  <input type="text" name="serverseed" placeholder="Server Seed" required="required" value="<?php echo $serverseed;?>">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Client Seed</div>
                <div class="item-input-wrap">
                  <input type="text" name="clientseed" placeholder="Client Seed" required="required" value="<?php echo $clientseed;?>">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Nonce</div>
                <div class="item-input-wrap">
                  <input type="text" name="nonce" placeholder="Nonce" required="required" value="<?php echo $nonce;?>">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Rounds</div>
                <div class="item-input-wrap">
                  <input type="text" name="round" placeholder="Rounds" required="required" value="<?php echo $round;?>">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">index (for bonus only)</div>
                <div class="item-input-wrap">
                  <input type="text" name="index" placeholder="index" required="required" value="<?php echo $index;?>">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                  <div class="item-input-info"></div>
                </div>
                </div>
              </li>
            </ul>
            <div class="clear"></div>
            <div class="row">
              <div class="col-50">
                <input type="submit" class="col button button-fill color-orange" value="Verify">
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>


<?php if ($formsubmit) : ?>
  <div class="block-title block-title-large">Final Result</div>
  <div class="block">
    <div class="row">
      <div class="col-20"></div>
      <div class="col-60">
        <div class="row">
          <div class="col">
            <img class="img-responsive" src="assets/img/beauties/Icon_placeholder.png" alt="">
            <?php
            foreach (reeldisplay($reels_final[1], 1, 3, $icons) as $iconnumber) {
              echo '<img class="img-responsive" src="assets/img/beauties/Icon_'. $iconnumber .'.png" /><br />';
            } ?>
          </div>
          <div class="col">
            <?php
            foreach (reeldisplay($reels_final[2], 2, 4, $icons) as $iconnumber) {
              echo '<img class="img-responsive" src="assets/img/beauties/Icon_'. $iconnumber .'.png" /><br />';
            } ?>
          </div>
          <div class="col">
            <img class="img-responsive" src="assets/img/beauties/Icon_placeholder.png" alt="">
            <?php
            foreach (reeldisplay($reels_final[3], 3, 3, $icons) as $iconnumber) {
              echo '<img class="img-responsive" src="assets/img/beauties/Icon_'. $iconnumber .'.png" /><br />';
            } ?>
          </div>
          <div class="col">
            <?php
            foreach (reeldisplay($reels_final[4], 4, 4, $icons) as $iconnumber) {
              echo '<img class="img-responsive" src="assets/img/beauties/Icon_'. $iconnumber .'.png" /><br />';
            } ?>
          </div>
          <div class="col">
            <img class="img-responsive" src="assets/img/beauties/Icon_placeholder.png" alt="">
            <?php
            foreach (reeldisplay($reels_final[5], 5, 3, $icons) as $iconnumber) {
              echo '<img class="img-responsive" src="assets/img/beauties/Icon_'. $iconnumber .'.png" /><br />';
            } ?>
          </div>
        </div>
      </div>
      <div class="col-20"></div>
    </div>
  </div>
  <div class="block-title">Details</div>
  <div class="block">
      <div class="mainform">
        <ul class="list no-hairlines-md">
          <li class="item-content item-input item-input-outline">
            <div class="item-inner">
            <div class="item-title item-floating-label">Sha256(server_seed)</div>
            <div class="item-input-wrap">
              <input type="text" placeholder="Sha256(server_seed)" required="required" value="<?php echo $hash;?>" readonly="readonly">
            </div>
            </div>
          </li>
          <li class="item-content item-input item-input-outline">
            <div class="item-inner">
            <div class="item-title item-floating-label">Sha256(server_seed:client_seed:nonce:rounds)</div>
            <div class="item-input-wrap">
              <input type="text" placeholder="Sha256(server_seed:client_seed:nonce:rounds)" required="required" value="<?php echo $hash2;?>" readonly="readonly">
            </div>
            </div>
          </li>
        </ul>
      </div>
  </div>
  <div class="block-title">Bytes</div>
  <div class="block tablewrapper data-table">
    <table class="yellow">
      <tr>
      <?php
        foreach ($splitedhash as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
      <?php
        foreach ($convert as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
     </table>
  </div>

   <div class="block-title">Bytes to Number</div>
   <div class="block tablewrapper data-table">
     <table class="yellow">
       <tr>
       <?php
         foreach ($reels as $hash) {
           echo '<td>'. $hash .'</td>';
         }
        ?>
       </tr>
       <tr>
         <td>* 80</td><td>* 86</td><td>* 86</td><td>* 80</td><td>* 60</td>
       </tr>
       <tr>
       <?php
         foreach ($reels_final as $hash) {
           echo '<td>'. $hash .'</td>';
         }
        ?>
       </tr>
       <tr>
       <?php
         foreach ($reels_final as $hash) {
           echo '<td><strong class="yellow-color">'. floor($hash) .'</strong></td>';
         }
        ?>
       </tr>
     </table>
   </div>

   <div class="list accordion-list inset">
      <ul>
          <li class="accordion-item">
              <a href="" class="item-link item-content">
                  <div class="item-inner">
                      <div class="item-title">weight Table</div>
                  </div>
              </a>
              <div class="accordion-item-content">
                <div class="block">
                  <table>
                    <?php
                      foreach ($icons as $icon) {
                        if ($icon[0] < 87) {
                        echo '<tr><td>'. (intval($icon[0])-1) .'</td>
                        <td><img class="img-responsive" src="assets/img/beauties/Icon_'. $icon[1] .'.png" /></td>
                        <td><img class="img-responsive" src="assets/img/beauties/Icon_'. $icon[2] .'.png" /></td>
                        <td><img class="img-responsive" src="assets/img/beauties/Icon_'. $icon[3] .'.png" /></td>
                        <td><img class="img-responsive" src="assets/img/beauties/Icon_'. $icon[4] .'.png" /></td>
                        <td><img class="img-responsive" src="assets/img/beauties/Icon_'. $icon[5] .'.png" /></td>
                        </tr>';
                        }
                      }
                    ?>
                  </table>
                </div>
              </div>
          </li>
      </ul>
   </div>

   <div class="list accordion-list inset">
      <ul>
          <li class="accordion-item">
              <a href="" class="item-link item-content">
                  <div class="item-inner">
                      <div class="item-title">Bonus</div>
                  </div>
              </a>
              <div class="accordion-item-content">
                <div class="block">
                  <ul class="list no-hairlines-md">
                    <li class="item-content item-input item-input-outline">
                      <div class="item-inner">
                      <div class="item-title item-floating-label">Index</div>
                      <div class="item-input-wrap">
                        <input type="text" placeholder="Index" required="required" value="<?php echo $index;?>" readonly="readonly">
                      </div>
                      </div>
                    </li>
                    <li class="item-content item-input item-input-outline">
                      <div class="item-inner">
                      <div class="item-title item-floating-label">Sha256(server_seed:client_seed:nonce:rounds:index)</div>
                      <div class="item-input-wrap">
                        <input type="text" placeholder="Sha256(server_seed:client_seed:nonce:rounds)" required="required" value="<?php echo $bonus_hash;?>" readonly="readonly">
                      </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="block">
                  <div class="block-title">Bytes</div>
                </div>
                <div class="block tablewrapper data-table">
                  <table class="yellow">
                    <tr>
                    <?php
                      foreach (str_split ($bonus_hash, 2) as $hash) {
                        echo '<td>'. $hash .'</td>';
                      }
                     ?>
                    </tr>
                    <tr>
                    <?php
                      foreach ($convert_bonus as $hash) {
                        echo '<td>'. $hash .'</td>';
                      }
                     ?>
                    </tr>
                   </table>
                </div>

                <div class="block">
                  <div class="block-title">Bytes to Number</div>
                </div>
                <div class="block tablewrapper data-table">
                  <table class="yellow">
                    <tr>
                    <?php
                      foreach ($reels_bonus as $hash) {
                        echo '<td>'. $hash .'</td>';
                      }
                     ?>
                    </tr>
                    <tr>
                      <td><?php echo $bounus_multi[$index]; ?></td>
                    </tr>
                    <tr>
                    <?php
                      echo '<td><strong class="yellow-color">'. floor($reels_bonus[1] * $bounus_multi[$index]) .'</strong></td>';
                     ?>
                    </tr>
                  </table>
                </div>

                <div class="block">
                  <div class="block-title">bonus table</div>
                </div>
                <div class="block tablewrapper data-table">
                  <table class="yellow">
                    <tr><td>index</td><td>payout</td><td>range</td></tr>
                    <?php
                      $lastrange = 0;
                      $floor_bonus = floor($reels_bonus[1] * $bounus_multi[$index]);
                      foreach ($bounus_payout as $bounus_num) {
                        if ($bounus_num[2] == 0) {
                          $lastrange = 0;
                        }
                        if ($index == (intval($bounus_num[1])-1) AND ($floor_bonus >= $lastrange AND $floor_bonus < $bounus_num[3])) {
                          echo '<tr class="highlight">';
                        } else {echo '<tr>';}

                        echo '<td>'. (intval($bounus_num[1])-1) .'</td><td>'. $bounus_num[2] .'</td><td>'. $lastrange .' - '. $bounus_num[3] .'</td></tr>';
                        $lastrange = $bounus_num[3];
                      }
                     ?>
                  </table>
                </div>


              </div>
          </li>
      </ul>
   </div>
<?php endif; ?>

  <div class="block">
    <a class="github-button" href="https://github.com/elixirofcode/bcgame" data-color-scheme="no-preference: light; light: light; dark: light;" data-size="large" aria-label="Follow @elixirofcode on GitHub">GitHub</a>
  </div>


</div>


<?php
// template
include 'template/footer.php';

// convert array to new base
function array_base_converter($array)
{
  $new_base_array = null;
  foreach ($array as $byte) {
    $new_base_array[] = base_convert($byte, 16, 10);
  }

  return $new_base_array;
}

// Reel numbers
function bytes_to_number($array)
{
  $reels = array_chunk($array, 4);
  $finalreels = null;

  $j = 1;
  foreach ($reels as $reel) {
    $finalreels[$j] = null;
    $i = 1;

    foreach ($reel as $reelnum) {
      $finalreels[$j] += round($reelnum / pow(256, $i) , 9);

      $i++;
    }

    $j++;
    $i = 0;

  }
  $j = 0;

  return $finalreels;
}

//
function reeldisplay($reel_final, $reelnumber, $number, $icons)
{
  $reel1 = floor($reel_final);
  $return = null;

  $rownum = $reel1;
  for ($i=$reel1; $i < $reel1+$number; $i++) {

    if ($icons[$rownum][$reelnumber] == 0) {
      $rownum = 0;
    }

    $return[] = $icons[$rownum][$reelnumber];
    $rownum++;
  }

  return $return;
}

?>
