<?php


// variables
$page_title = 'Keno Verification tool';

//files
include 'template/header.php';
?>


<div class="page-content publicpage">

  <p class="text-center">
    <img class="img-responsive" src="assets/img/keno/keno_bg.png" alt="keno" width="400">
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
                  <input id="salt" type="text" name="salt" placeholder="Salt" required="required" value="000000000000000000076973be291d219d283d4af9135601ff37df46491cca7e" readonly>
                  <div class="item-input-error-message">Please fill out this field.</div>
                  <span class="input-clear-button"></span>
                </div>
                </div>
              </li>
            </ul>
            <div class="clear"></div>
            <div class="row">
              <div class="col-50">
                <input id="game_verify_submit" type="submit" class="col button button-fill button-large color-orange" value="Verify">
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="block">
    <div class="data-table keno">
      <table>
        <tr>
          <td id="keno1" class="">1</td><td id="keno2" class="">2</td><td id="keno3" class="">3</td><td id="keno4" class="">4</td>
          <td id="keno5" class="">5</td><td id="keno6" class="">6</td><td id="keno7" class="">7</td><td id="keno8" class="">8</td>
        </tr>
        <tr>
          <td id="keno9" class="">9</td><td id="keno10" class="">10</td><td id="keno11" class="">11</td><td id="keno12" class="">12</td>
          <td id="keno13" class="">13</td><td id="keno14" class="">14</td><td id="keno15" class="">15</td><td id="keno16" class="">16</td>
        </tr>
        <tr>
          <td id="keno17" class="">17</td><td id="keno18" class="">18</td><td id="keno19" class="">19</td><td id="keno20" class="">20</td>
          <td id="keno21" class="">21</td><td id="keno22" class="">22</td><td id="keno23" class="">23</td><td id="keno24" class="">24</td>
        </tr>
        <tr>
          <td id="keno25" class="">25</td><td id="keno26" class="">26</td><td id="keno27" class="">27</td><td id="keno28" class="">28</td>
          <td id="keno29" class="">29</td><td id="keno30" class="">30</td><td id="keno31" class="">31</td><td id="keno32" class="">32</td>
        </tr>
        <tr>
          <td id="keno33" class="">33</td><td id="keno34" class="">34</td><td id="keno35" class="">35</td><td id="keno36" class="">36</td>
          <td id="keno37" class="">37</td><td id="keno38" class="">38</td><td id="keno39" class="">39</td><td id="keno40" class="">40</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="list accordion-list inset">
     <ul>
         <li class="accordion-item">
             <a href="" class="item-link item-content">
                 <div class="item-inner">
                     <div class="item-title">Code</div>
                 </div>
             </a>
             <div class="accordion-item-content">
               <div class="block">
                 <code>
 const CryptoJS = require("crypto-js");

 function seedGenerator(hash, salt) {
     const hmac = CryptoJS.HmacSHA256(CryptoJS.enc.Hex.parse(hash), salt);
     return hmac.toString(CryptoJS.enc.Hex);
 }

 function createNums(allNums, hash) {
     const nums = [];
     let h = CryptoJS.SHA256(hash).toString(CryptoJS.enc.Hex)
     allNums.forEach((c) => {
         nums.push({
             num: c,
             hash: h
         });
         h = h.substring(1) + h.charAt(0);
     });
     nums.sort(function(o1, o2) {
         if (o1.hash < o2.hash) {
             return -1;
         } else if (o1.hash === o2.hash) {
             return 0;
         } else {
             return 1;
         }
     });
     return nums;
 }

 function keno(hash) {
     const salt = '000000000000000000076973be291d219d283d4af9135601ff37df46491cca7e';
     const allNums = [1, 30, 11, 40, 2, 29, 12, 39, 3, 28, 13, 38, 4, 27, 14, 37, 5, 26, 15, 36, 6, 25, 16, 35, 7, 24, 17, 34, 8, 23, 18, 33, 9, 22, 19, 32, 10, 21, 20, 31]
     let seed = seedGenerator(hash, salt);
     let finalNums = createNums(allNums, seed);
     seed = String(CryptoJS.SHA256(seed));
     finalNums = createNums(finalNums, seed);
     return finalNums.slice(0, 10).map(m => m.num)
 }


 console.log('result =>', keno(hash).map(item => item.num).join(","));
                 </code>
               </div>
             </div>
         </li>
     </ul>
  </div>


  <div class="block">
    <a class="github-button" href="https://github.com/elixirofcode/bcgame" data-color-scheme="no-preference: light; light: light; dark: light;" data-size="large" aria-label="Follow @elixirofcode on GitHub">GitHub</a>
  </div>

</div>

<script type="text/javascript">

$('#game_verify_submit').on('click', () => {
  var hash = $('#gamehash').val();
  var salt = $('#salt').val();

  $(".highlight").removeClass("highlight");
  keno(hash).map(item => item.num).forEach(table_highlighter);


});

function table_highlighter(finalnumber) {
  document.getElementById('keno'+finalnumber).classList.add('highlight');
}


function seedGenerator(hash, salt) {
    const hmac = CryptoJS.HmacSHA256(CryptoJS.enc.Hex.parse(hash), salt);
    return hmac.toString(CryptoJS.enc.Hex);
}

function createNums(allNums, hash) {
    const nums = [];
    let h = CryptoJS.SHA256(hash).toString(CryptoJS.enc.Hex)
    allNums.forEach((c) => {
        nums.push({
            num: c,
            hash: h
        });
        h = h.substring(1) + h.charAt(0);
    });
    nums.sort(function(o1, o2) {
        if (o1.hash < o2.hash) {
            return -1;
        } else if (o1.hash === o2.hash) {
            return 0;
        } else {
            return 1;
        }
    });
    return nums;
}

function keno(hash) {
    const salt = '000000000000000000076973be291d219d283d4af9135601ff37df46491cca7e';
    const allNums = [1, 30, 11, 40, 2, 29, 12, 39, 3, 28, 13, 38, 4, 27, 14, 37, 5, 26, 15, 36, 6, 25, 16, 35, 7, 24, 17, 34, 8, 23, 18, 33, 9, 22, 19, 32, 10, 21, 20, 31]
    let seed = seedGenerator(hash, salt);
    let finalNums = createNums(allNums, seed);
    seed = String(CryptoJS.SHA256(seed));
    finalNums = createNums(finalNums, seed);
    return finalNums.slice(0, 10).map(m => m.num)
}
</script>


<?php
//files
include 'template/footer.php';

?>
