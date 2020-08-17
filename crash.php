<?php

// variables
$page_title = 'Crash Verification tool';


//files
include 'template/header.php';

?>

<div class="page-content publicpage">

  <p class="text-center">
    <img class="img-responsive" src="assets/img/crash.png" alt="crash" width="400">
  </p>

  <div class="block">
    <div class="row">
      <div class="col">
          <div class="mainform">
            <ul class="list no-hairlines-md">
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Game Hash</div>
                <div class="item-input-wrap">
                  <input id="gamehash" type="text" name="gamehash" placeholder="Game Hash" required="required" value="">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
              <li class="item-content item-input item-input-outline">
                <div class="item-inner">
                <div class="item-title item-floating-label">Salt</div>
                <div class="item-input-wrap">
                  <input id="salt" type="text" name="salt" placeholder="Salt" required="required" value="0000000000000000000e3a66df611d6935b30632f352e4934c21059696117f28">
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
            </ul>
            <div class="clear"></div>
            <div class="row">
              <div class="col-50">
                <input id="verify_submit" type="submit" class="col button button-fill button-large color-orange" value="Verify">
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="block">
    <div class="bignumber" id="bugnum"></div>
  </div>

  <div class="block">
    <div class="block-title">Last 50 games</div>
    <div class="data-table crash">
      <table>
        <thead><tr><th>Bust</th><th>Game's hash</th></tr></thead>
        <tbody id="verify_table"></tbody>
      </table>
    </div>
  </div>

  <div class="block">
    <a class="github-button" href="https://github.com/elixirofcode/bcgame" data-color-scheme="no-preference: light; light: light; dark: light;" data-size="large" aria-label="Follow @elixirofcode on GitHub">GitHub</a>
  </div>

</div>

<script type="text/javascript">
  $('#verify_submit').on('click', () => {
    var inputhash = $('#gamehash').val();
    var inputsalt = $('#salt').val();

    $('#verify_table').html('');

    var prevHash = null;
    for (let i = 0; i < 50; i++) {
      let hash = String(prevHash ? CryptoJS.SHA256(String(prevHash)) : inputhash);
      let bust = gameResult(hash, inputsalt);
      setTimeout(function() {
        addTableRow(hash, bust, i)
      }, i * 1);
      prevHash = hash;
    }
  });

  function addTableRow(hash, bust, index) {
    var tdclass = null;

    if (bust > 10) {
      tdclass = 'moon';
    } else if (bust > 1.99) {
      tdclass = 'green';
    } else {
      tdclass = 'red';
    }

    if (index === 0) {
      document.getElementById('bugnum').innerHTML = "<span class="+ tdclass +">" + bust + "</span>";
    }

    var newRow=document.getElementById('verify_table').insertRow();
    newRow.innerHTML = "<td class="+ tdclass +">" + bust + "</td><td>" + hash + "</td>";
  };

  const gameResult = (seed, salt) => {
    const nBits = 52; // number of most significant bits to use

    // 1. HMAC_SHA256(message=seed, key=salt)
    if (salt) {
      hmac = CryptoJS.HmacSHA256(CryptoJS.enc.Hex.parse(seed), salt);
      seed = hmac.toString(CryptoJS.enc.Hex);
    }

    // 2. r = 52 most significant bits
    seed = seed.slice(0, nBits / 4);
    const r = parseInt(seed, 16);

    // 3. X = r / 2^52
    let X = r / Math.pow(2, nBits); // uniformly distributed in [0; 1)
    X = parseFloat(X.toPrecision(9));

    // 4. X = 99 / (1-X)
    X = 99 / (1 - X);

    // 5. return max(trunc(X), 100)
    const result = Math.floor(X);

    return Math.max(1, result / 100);
  };

</script>

<?php
//files
include 'template/footer.php';

?>
