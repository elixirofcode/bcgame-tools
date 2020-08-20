<?php
error_reporting(E_ERROR | E_PARSE);

// variables
$page_title = 'Savior Sword verification tool';
$formsubmit = false;

$icons = array(
  [1, 5, 5, 5, 5, 5],
  [2, 15, 15, 15, 15, 15],
  [3, 30, 30, 30, 30, 30],
  [4, 55, 55, 55, 55, 55],
  [5, 105, 105, 105, 105, 105],
  [6, 205, 205, 205, 205, 205],
  [7, 355, 355, 355, 355, 355],
  [8, 855, 855, 855, 855, 855],
  [9, 1355, 1355, 1355, 1355, 1355],
  [10, 1855, 1855, 1855, 1855, 1855],
  [11, 2355, 2355, 2355, 2355, 2355],
  [12, 6225, 5355, 5355, 5355, 6225],
  [13, 10095, 8355, 8355, 8355, 10095],
  [14, 13965, 11355, 11355, 11355, 13965],
  [15, 17835, 14355, 14355, 14355, 17835],
  [16, '', 15355, 15355, 15355, ''],
  [17, '', 20355, 20355, 17150, ''],
);
$cat_icons = array(
  [1, 25],
  [2, 75],
  [3, 150],
  [4, 275],
  [5, 525],
  [6, 825],
  [7, 1125],
  [8, 1625],
  [9, 2125],
  [10, 2625],
  [11, 3125],
  [12, 0],
  [13, 0],
  [14, 0],
  [15, 0],
  [16, 0],
  [17, 5125],
);
$lucky_weights = array(
  [1, 25, 20],
  [2, 55, 30],
  [3, 75, 50],
  [4, 85, 100],
  [5, 110, 1],
  [6, 140, 2],
  [7, 170, 3],
  [8, 185, 5],
);
$respin_icons = array(
  [1, 50],
  [2, 150],
  [3, 300],
  [4, 550],
  [5, 850],
  [6, 1250],
  [7, 1650],
  [8, 2150],
  [9, 2650],
  [10, 3150],
  [11, 3650],
  [12, 4150],
  [13, 4650],
  [14, 5150],
  [15, 5650],
);

if (isset($_POST['serverseed'])) {
  $serverseed = $_POST['serverseed'];
  $clientseed = $_POST['clientseed'];
  $nonce = $_POST['nonce'];

  $formsubmit = true;
}

if ($formsubmit) {
  // round = 0
  $round = 0;
  $r0_hash = hash('sha256', $serverseed);
  $r0_hash2 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
  $r0_splitedhash = str_split ($r0_hash2, 2);

  // convert base 16 to 10
  $r0_convert = array_base_converter($r0_splitedhash);

  // byte to Reel numbers
  $r0_reels = bytes_to_number($r0_convert);

  $r0_reels_final = array(
    1 => $r0_reels[1] * 17835,
    2 => $r0_reels[2] * 20355,
    3 => $r0_reels[3] * 20352,
    4 => $r0_reels[4] * 17150,
    5 => $r0_reels[5] * 17835,
  );

  // cat spin
  $catspin = false;
  if (getClosest(floor($r0_reels_final[2]), convertarray($icons, 2)) == 16) {
    $catspin = true;    $catreel2 = true;
  }
  if (getClosest(floor($r0_reels_final[3]), convertarray($icons, 3)) == 16) {
    $catspin = true;    $catreel3 = true;
  }
  if (getClosest(floor($r0_reels_final[4]), convertarray($icons, 4)) == 16) {
    $catspin = true;    $catreel4 = true;
  }

  if ($catspin) {
    $round = 1;
    $r1_hash2 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
    $r1_splitedhash = str_split ($r1_hash2, 2);
    $r1_convert = array_base_converter($r1_splitedhash);
    $r1_reels = bytes_to_number($r1_convert);

    $r1_reels_final = array(
      1 => $r1_reels[1] * 5125,
    );
  }

  // Lucky Spin
  $luckyspin = false;

  if (getClosest(floor($r0_reels_final[2]), convertarray($icons, 2)) >= 17) {
    $luckyspinr2 = true;
  }
  if (getClosest(floor($r0_reels_final[3]), convertarray($icons, 3)) >= 17) {
    $luckyspinr3 = true;
  }
  if (getClosest(floor($r0_reels_final[4]), convertarray($icons, 4)) >= 17) {
    $luckyspinr4 = true;
  }
  if (getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) >= 17) {
    if ($catreel2) {$luckyspinr2 = true;}
    if ($catreel3) {$luckyspinr3 = true;}
    if ($catreel4) {$luckyspinr4 = true;}
  }

  if($luckyspinr2 && $luckyspinr3 && $luckyspinr4) {
    $luckyspin = true;
  }

  if ($luckyspin) {
    $round = 2;
    $r2_hash2 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
    $r2_splitedhash = str_split ($r2_hash2, 2);
    $r2_convert = array_base_converter($r2_splitedhash);
    $r2_reels = bytes_to_number($r2_convert);

    $r2_reels_final = array(
      1 => $r2_reels[1] * 185,
    );

    $lucky_weight_final = getClosest(floor($r2_reels_final[1]), convertarray($lucky_weights, 1)) -1;
  }

  // Bonus Respin
  if ($lucky_weight_final >= 4) {
    $bonusrespin = true;

    $round = 3;
    $r3_hash3 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
    $r3_splitedhash = str_split ($r3_hash3, 2);
    $r3_convert = array_base_converter($r3_splitedhash);
    $r3_reels = bytes_to_number($r3_convert);

    $r3_reels_final = array(
      1 => $r3_reels[1] * 5650,
      2 => $r3_reels[2] * 5650,
      3 => $r3_reels[3] * 5650,
      4 => $r3_reels[4] * 5650,
      5 => $r3_reels[5] * 5650,
    );
  }

  // Respin Bonus Respin
  if (getClosest(floor($r3_reels_final[1]), convertarray($respin_icons, 1)) >= 12) {
    $respin_luckyspinr1 = true; $respin_bonusrespin = true;
  }
  if (getClosest(floor($r3_reels_final[2]), convertarray($respin_icons, 1)) >= 12) {
    $respin_luckyspinr2 = true; $respin_bonusrespin = true;
  }
  if (getClosest(floor($r3_reels_final[3]), convertarray($respin_icons, 1)) >= 12) {
    $respin_luckyspinr3 = true; $respin_bonusrespin = true;
  }
  if (getClosest(floor($r3_reels_final[4]), convertarray($respin_icons, 1)) >= 12) {
    $respin_luckyspinr4 = true; $respin_bonusrespin = true;
  }
  if (getClosest(floor($r3_reels_final[5]), convertarray($respin_icons, 1)) >= 12) {
    $respin_luckyspinr5 = true; $respin_bonusrespin = true;
  }



  if ($respin_bonusrespin) {
    $round = 4;
    $r4_hash4 = hash('sha256', $serverseed .':'. $clientseed .':'. $nonce .':'. $round);
    $r4_splitedhash = str_split ($r4_hash4, 2);
    $r4_convert = array_base_converter($r4_splitedhash);
    $r4_reels = bytes_to_number($r4_convert);

    $r4_reels_final = array(
      1 => $r4_reels[1] * 5650,
      2 => $r4_reels[2] * 5650,
      3 => $r4_reels[3] * 5650,
      4 => $r4_reels[4] * 5650,
      5 => $r4_reels[5] * 5650,
    );
  }
}

//files
include 'template/header.php';


?>


<div class="page-content publicpage">

  <p class="text-center">
    <img class="img-responsive" src="assets/img/sword/banner.png" alt="sword" width="400">
  </p>

  <div class="block">
    <div class="row">
      <div class="col">
          <form class="mainform" action="sword.php" method="post">
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
            </ul>
            <div class="clear"></div>
            <div class="row">
              <div class="col-50">
                <input type="submit" class="col button button-fill button-large color-orange" value="Verify">
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>

<?php if ($formsubmit) : ?>

  <div class="block-title block-title-large">Basic Spin (Round 0)</div>
  <div class="block">
    <div class="row text-center">
      <div class="col"> Reel 1
        <?php echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r0_reels_final[1]), convertarray($icons, 1)) .'.png" /><br />'; ?>
      </div>
      <div class="col"> Reel 2
        <?php
          echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r0_reels_final[2]), convertarray($icons, 2)) .'.png" /><br />';
        ?>
      </div>
      <div class="col"> Reel 3
        <?php
        if (getClosest(floor($r0_reels_final[3]), convertarray($icons, 3)) == 17) {
          echo '<img class="img-responsive" src="assets/img/sword/symbol_18.png" /><br />';
        } else {
          echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r0_reels_final[3]), convertarray($icons, 3)) .'.png" /><br />';
        }
        ?>
      </div>
      <div class="col"> Reel 4
        <?php
        if (getClosest(floor($r0_reels_final[4]), convertarray($icons, 4)) == 17) {
          echo '<img class="img-responsive" src="assets/img/sword/symbol_19.png" /><br />';
        } else {
          echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r0_reels_final[4]), convertarray($icons, 4)) .'.png" /><br />';
        }
        ?>
      </div>
      <div class="col"> Reel 5
        <?php echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r0_reels_final[5]), convertarray($icons, 5)) .'.png" /><br />'; ?>
      </div>
    </div>
  </div>
  <div class="block">
      <div class="mainform">
        <ul class="list no-hairlines-md">
          <li class="item-content item-input item-input-outline">
            <div class="item-inner">
            <div class="item-title item-floating-label">Sha256(Server_Seed:Client_Seed:Nonce:Round)</div>
            <div class="item-input-wrap">
              <input type="text" placeholder="Sha256(Server_Seed:Client_Seed:Nonce:Round)" required="required" value="<?php echo $r0_hash2;?>" readonly="readonly">
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
        foreach ($r0_splitedhash as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
      <?php
        foreach ($r0_convert as $hash) {
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
        foreach ($r0_reels as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
        <td>* 17835</td><td>* 20355</td><td>* 20352</td><td>* 17150</td><td>* 17835</td>
      </tr>
      <tr>
      <?php
        foreach ($r0_reels_final as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
      <?php
        foreach ($r0_reels_final as $hash) {
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
                     <div class="item-title">REGULAR SPIN WEIGHT TABLE WEIGHT</div>
                 </div>
             </a>
             <div class="accordion-item-content">
               <div class="block tablewrapper data-table">
                 <table>
                   <th>Symbol</th><th>Reel 1</th><th>Reel 2</th><th>Reel 3</th><th>Reel 4</th><th>Reel 5</th>
                   <?php
                     foreach ($icons as $icon) {
                       echo '<tr>
                       <td><img class="img-responsive" src="assets/img/sword/symbol_'. $icon[0] .'.png" /></td>
                       <td>'. $icon[1] .'</td>
                       <td>'. $icon[2] .'</td>
                       <td>'. $icon[3] .'</td>
                       <td>'. $icon[4] .'</td>
                       <td>'. $icon[5] .'</td>
                       </tr>';
                     }
                   ?>
                   <tr><td>Total</td><td>17835</td><td>20355</td><td>20352</td><td>17150</td><td>17835</td></tr>
                 </table>
               </div>
             </div>
         </li>
     </ul>
  </div>

  <?php  if ($catspin) : ?>
  <div class="block-title block-title-large">Cat Respin (Round 1)</div>
  <div class="block">
    <div class="row text-center">
      <div class="col">Reel 1</div>
      <div class="col">  Reel 2
        <?php if ($catreel2 == true) {echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) .'.png" /><br />'; }?>
      </div>
        <div class="col">  Reel 3
          <?php
          if ($catreel3 == true) {
            if (getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) == 17) {
              echo '<img class="img-responsive" src="assets/img/sword/symbol_18.png" /><br />';
            } else {
              echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) .'.png" /><br />';
            }
          }
          ?>
        </div>
      <div class="col"> Reel 4
        <?php
        if ($catreel4 == true) {
          if (getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) == 17) {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_19.png" /><br />';
          } else {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r1_reels_final[$catspin]), convertarray($cat_icons, 1)) .'.png" /><br />';
          }
        }
        ?>
      </div>
      <div class="col">Reel 5</div>
    </div>
  </div>
  <div class="block">
      <div class="mainform">
        <ul class="list no-hairlines-md">
          <li class="item-content item-input item-input-outline">
            <div class="item-inner">
            <div class="item-title item-floating-label">Sha256(Server_Seed:Client_Seed:Nonce:Round)</div>
            <div class="item-input-wrap">
              <input type="text" placeholder="Sha256(Server_Seed:Client_Seed:Nonce:Round)" required="required" value="<?php echo $r1_hash2;?>" readonly="readonly">
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
        foreach ($r1_splitedhash as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
      <?php
        foreach ($r1_convert as $hash) {
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
        foreach ($r1_reels as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
        <td>* 5125</td>
      </tr>
      <tr>
      <?php
        foreach ($r1_reels_final as $hash) {
          echo '<td>'. $hash .'</td>';
        }
       ?>
      </tr>
      <tr>
      <?php
        foreach ($r1_reels_final as $hash) {
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
                     <div class="item-title">REGULAR SPIN WEIGHT TABLE WEIGHT</div>
                 </div>
             </a>
             <div class="accordion-item-content">
               <div class="block tablewrapper data-table">
                 <table>
                   <tr>
                     <th>Symbol</th><th>Cat</th>
                   </tr>
                   <?php
                     foreach ($cat_icons as $icon) {
                       if ($icon[1] > 0) {
                       echo '<tr>
                       <td><img class="img-responsive" src="assets/img/sword/symbol_'. $icon[0] .'.png" /></td>
                       <td>'. $icon[1] .'</td>
                       </tr>';
                       }
                     }
                   ?>
                   <tr><td>Total</td><td>5125</td></tr>
                 </table>
               </div>
             </div>
         </li>
     </ul>
  </div>
  <?php endif; ?>

  <?php  if ($luckyspin) : ?>
    <div class="block-title block-title-large">Lucky Spin (Round 2)</div>
    <div class="block block-title-large">
      <?php
        if ($lucky_weight_final >= 5) {
          echo 'You won payout x' . $lucky_weights[$lucky_weight_final][2];
        } else {
          echo 'You won respin with payout x' . $lucky_weights[$lucky_weight_final][2];
        }
       ?>
    </div>
    <div class="block">
        <div class="mainform">
          <ul class="list no-hairlines-md">
            <li class="item-content item-input item-input-outline">
              <div class="item-inner">
              <div class="item-title item-floating-label">Sha256(Server_Seed:Client_Seed:Nonce:Round)</div>
              <div class="item-input-wrap">
                <input type="text" placeholder="Sha256(Server_Seed:Client_Seed:Nonce:Round)" required="required" value="<?php echo $r2_hash2;?>" readonly="readonly">
              </div>
              </div>
            </li>
          </ul>
        </div>
    </div>
    <div class="block tablewrapper data-table">
      <table class="yellow">
        <tr>
        <?php
          foreach ($r2_splitedhash as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r2_convert as $hash) {
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
          foreach ($r2_reels as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
          <td>* 185</td>
        </tr>
        <tr>
        <?php
          foreach ($r2_reels_final as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r2_reels_final as $hash) {
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
                       <div class="item-title">LUKCY RESPIN WEIGHT TABLE</div>
                   </div>
               </a>
               <div class="accordion-item-content">
                 <div class="block tablewrapper data-table">
                   <table>
                     <tr>
                       <th></th><th>Prize</th><th>Weight</th>
                     </tr>
                     <tr><td rowspan="4">PAYOUT</td><td>20</td><td>25</td></tr>
                     <tr><td>30</td><td>55</td></tr>
                     <tr><td>50</td><td>75</td></tr>
                     <tr><td>100</td><td>85</td></tr>

                     <tr><td rowspan="4">BONUS RESPIN</td><td>1</td><td>110</td></tr>
                     <tr><td>2</td><td>140</td></tr>
                     <tr><td>3</td><td>170</td></tr>
                     <tr><td>5</td><td>185</td></tr>

                     <tr><td>Total</td><td></td><td>185</td></tr>
                   </table>
                 </div>
               </div>
           </li>
       </ul>
    </div>
  <?php endif; ?>

  <?php if ($bonusrespin): ?>
    <div class="block-title block-title-large">BONUS RESPIN (Round 3)</div>
    <div class="block">
      <div class="row text-center">
        <div class="col">Reel 1
          <?php echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r3_reels_final[1]), convertarray($respin_icons, 1)) .'.png" /><br />'; ?>
        </div>
        <div class="col">Reel 2
          <?php
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r3_reels_final[2]), convertarray($respin_icons, 1)) .'.png" /><br />';
          ?>
        </div>
        <div class="col">Reel 3
          <?php
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r3_reels_final[3]), convertarray($respin_icons, 1)) .'.png" /><br />';
          ?>
        </div>
        <div class="col">Reel 4
          <?php
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r3_reels_final[4]), convertarray($respin_icons, 1)) .'.png" /><br />';
          ?>
        </div>
        <div class="col">Reel 5
          <?php echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r3_reels_final[5]), convertarray($respin_icons, 1)) .'.png" /><br />'; ?>
        </div>
      </div>
    </div>
    <div class="block">
        <div class="mainform">
          <ul class="list no-hairlines-md">
            <li class="item-content item-input item-input-outline">
              <div class="item-inner">
              <div class="item-title item-floating-label">Sha256(Server_Seed:Client_Seed:Nonce:Round)</div>
              <div class="item-input-wrap">
                <input type="text" placeholder="Sha256(Server_Seed:Client_Seed:Nonce:Round)" required="required" value="<?php echo $r3_hash3;?>" readonly="readonly">
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
          foreach ($r3_splitedhash as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r3_convert as $hash) {
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
          foreach ($r3_reels as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
          <td>* 5650</td><td>* 5650</td><td>* 5650</td><td>* 5650</td><td>* 5650</td>
        </tr>
        <tr>
        <?php
          foreach ($r3_reels_final as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r3_reels_final as $hash) {
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
                       <div class="item-title"> BONUS RESPIN WEIGHT TABLE </div>
                   </div>
               </a>
               <div class="accordion-item-content">
                 <div class="block tablewrapper data-table">
                   <table>
                     <th>Symbol</th><th>Reel 1</th><th>Reel 2</th><th>Reel 3</th><th>Reel 4</th><th>Reel 5</th>
                     <?php
                       foreach ($respin_icons as $icon) {
                         echo '<tr>
                         <td><img class="img-responsive" src="assets/img/sword/symbol_'. $icon[0] .'.png" /></td>
                         <td>'. $icon[1] .'</td>
                         <td>'. $icon[1] .'</td>
                         <td>'. $icon[1] .'</td>
                         <td>'. $icon[1] .'</td>
                         <td>'. $icon[1] .'</td>
                         </tr>';
                       }
                     ?>
                     <tr><td>Total</td><td>5650</td><td>5650</td><td>5650</td><td>5650</td><td>5650</td></tr>
                   </table>
                 </div>
               </div>
           </li>
       </ul>
    </div>
  <?php endif; ?>

  <?php if ($respin_bonusrespin): ?>
    <div class="block-title block-title-large">RESPIN BONUS RESPIN (Round 4)</div>
    <div class="block">
      <div class="row text-center">
        <div class="col">Reel 1
          <?php
          if ($respin_luckyspinr1) {
          echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r4_reels_final[1]), convertarray($respin_icons, 1)) .'.png" /><br />';
          }?>
        </div>
        <div class="col">Reel 2
          <?php
            if ($respin_luckyspinr2) {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r4_reels_final[2]), convertarray($respin_icons, 1)) .'.png" /><br />';
          }?>
        </div>
        <div class="col">Reel 3
          <?php if ($respin_luckyspinr3) {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r4_reels_final[3]), convertarray($respin_icons, 1)) .'.png" /><br />';
          } ?>
        </div>
        <div class="col">Reel 4
          <?php if ($respin_luckyspinr4) {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r4_reels_final[4]), convertarray($respin_icons, 1)) .'.png" /><br />';
          } ?>
        </div>
        <div class="col">Reel
          <?php if ($respin_luckyspinr5) {
            echo '<img class="img-responsive" src="assets/img/sword/symbol_'. getClosest(floor($r4_reels_final[5]), convertarray($respin_icons, 1)) .'.png" /><br />';
          }?>
        </div>
      </div>
    </div>
    <div class="block">
        <div class="mainform">
          <ul class="list no-hairlines-md">
            <li class="item-content item-input item-input-outline">
              <div class="item-inner">
              <div class="item-title item-floating-label">Sha256(Server_Seed:Client_Seed:Nonce:Round)</div>
              <div class="item-input-wrap">
                <input type="text" placeholder="Sha256(Server_Seed:Client_Seed:Nonce:Round)" required="required" value="<?php echo $r4_hash4;?>" readonly="readonly">
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
          foreach ($r4_splitedhash as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r4_convert as $hash) {
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
          foreach ($r4_reels as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
          <td>* 5650</td><td>* 5650</td><td>* 5650</td><td>* 5650</td><td>* 5650</td>
        </tr>
        <tr>
        <?php
          foreach ($r4_reels_final as $hash) {
            echo '<td>'. $hash .'</td>';
          }
         ?>
        </tr>
        <tr>
        <?php
          foreach ($r4_reels_final as $hash) {
            echo '<td><strong class="yellow-color">'. floor($hash) .'</strong></td>';
          }
         ?>
        </tr>
      </table>
    </div>
  <?php endif; ?>

<?php endif; ?>

<div class="block">
  <a class="github-button" href="https://github.com/elixirofcode/bcgame" data-color-scheme="no-preference: light; light: light; dark: light;" data-size="large" aria-label="Follow @elixirofcode on GitHub">GitHub</a>
</div>

</div>


<?php
//files
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

function getClosest($search, $arr)
{
   $closest = null;
   foreach ($arr as $item) {
      if ($search <= $item) {
         $closest = $item;
         break;
      }
   }
   $key = array_search($closest, $arr);

   return $key+1;
}

function convertarray($array, $col)
{
  $return = null;
  foreach ($array as $row) {
    $return[] = $row[$col];
  }

  return $return;
}

?>
