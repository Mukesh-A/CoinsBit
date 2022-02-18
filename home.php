<!DOCTYPE html>
<html>

<head>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

  <link rel="stylesheet" href="home.css">
  <!-- <script type="text/javascript" src="https://api.coingecko.com/api/v3/simple/price?ids=1%2C2%2C3&vs_currencies=usdt"></script> -->
</head>

<body>
  <?php include('navbar.php'); ?>


  <div class="container">

    <p>
      COINS BIT
    </p>
    <p class="tagline">One Crypto Trading Platform For Everyone</p>

    <div id="demo"> </div>



    <script type="text/javascript">
      // var currentLocation = window.location;
      // var str = currentLocation['href']
      // var array = str.split(".", );
      // console.log(array[1])
      // // console.log(str)

      // var str = 'hello@tlkj'

      function red() {
        var myObj, i, j, x = "";
        var myStringArray = ['BTC', 'ETH', 'BNB', 'LTC', 'ADA', 'DOT', 'XRP', 'LINK', 'SOL', 'VET', 'ZIL'];
        request('GET', 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC,BNB,ADA,DOT,ZIL,SOL,VET,THETA,LINK,MATIC,UNI,XRP&tsyms=USD')
          .then((r1) => {
            var x1 = JSON.parse(r1.target.responseText);

            var a = 'DISPLAY',
              b = 'BTC',
              c = 'USD',
              d = 'PRICE',
              e = 'IMAGEURL';

            for (i in myStringArray) {
              console.log(myStringArray[i])
              var mm = myStringArray[i]



              var bb = 910
              var nn = "chart.php?q=" + mm
              var coin = x1['DISPLAY'][myStringArray[i]][c][e]
              var cc = "icon/" + mm + ".png"
              console.log(x1['DISPLAY']['BTC']['USD']['IMAGEURL'])

              x += " <div class='diplay-coin'>" + "<img id=coinim src=" + cc + ">" + "<p id=coinname>" + mm + "</p>" + x1['DISPLAY'][myStringArray[i]][c][d] + "<button id='view-btn'><a href='" + nn + "'>VIEW</a></button></div>";

            }
            document.getElementById("demo").innerHTML = x

          })
      }
      red()
      setInterval(red, 1000)

      function request(method, url) {
        return new Promise(function(resolve, reject) {
          var xhr = new XMLHttpRequest();
          xhr.open(method, url);
          xhr.onload = resolve;
          xhr.onerror = reject;
          xhr.send();
        });
      }
    </script>












    <!-- partial -->
    <!-- <script>
                  function get_price() {
                    var el = document.getElementById('btc')
                    $4 = "BTC-USD/book"
                    var apikey = {
                        key:'f6ebae82-0cc3-4f0c-87b2-29658ca471fa'
                      }
                      fetch("https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?CMC_PRO_API_KEY=" + apikey.key)
                      .then(res => res.json())
                      .then(res => {
                        var price = res.data[0].quote.USD.price;
                        el.innerHTML = "$" + price;
                      }).catch(err => {
                        el.innerHTML = "Error";
                      });
                  }
              
                  get_price()
              
                  setInterval(get_price, 1000)
                  function request(method, url) {
        return new Promise(function (resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open(method, url);
            xhr.onload = resolve;
            xhr.onerror = reject;
            xhr.send();
        });
}
                </script> -->







    <!-- <div class="diplay-coin">
                  <img src="icon/bitcoin-btc-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">bitcoin</p>
                  <p id="c"></p>
                 
                  <script>
                    function red(){
                      var i;
    
                  request('GET','https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,LTC&tsyms=USD')
                  .then((r1) => {
                      
                          var x1 = JSON.parse(r1.target.responseText);
                      var el = document.getElementById('c')
                                  el.innerHTML = "$" + x1.RAW.BTC.USD.PRICE
                      console.log(x1.RAW.BTC.USD.PRICE);
                    

                  })
  
                    function request(method, url) {
                            return new Promise(function (resolve, reject) {
                                var xhr = new XMLHttpRequest();
                                xhr.open(method, url);
                                xhr.onload = resolve;
                                xhr.onerror = reject;
                                xhr.send();
                            });
                    }
                  }
                    red()
                     setInterval(red, 1000)
                        
                            </script>
                            <button id="submit" type="button" onclick="location.href='///F:/python/crypto/login.html'" ></a>
                              BUY</button>
                  </div>
               








                <div class="diplay-coin">
                  <img src="icon/ethereum-eth-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">ethereum</p>
                  <p id="cprices">chgchcf</p>
                            <script>
                              function red(){
                      var i;
    
                  request('GET','https://min-api.cryptocompare.com/data/pricemultifull?fsyms=ETH&tsyms=USD')
                  .then((r1) => {
                      
                          var x1 = JSON.parse(r1.target.responseText);
                      var el = document.getElementById('cprices')
                                  el.innerHTML = "$" + x1.RAW.ETH.USD.PRICE
                      console.log(x1.RAW.BTC.USD.PRICE);
                    

                  })
  
                    function request(method, url) {
                            return new Promise(function (resolve, reject) {
                                var xhr = new XMLHttpRequest();
                                xhr.open(method, url);
                                xhr.onload = resolve;
                                xhr.onerror = reject;
                                xhr.send();
                            });
                    }
                  }
                    red()
                     setInterval(red, 1000)
                            </script>
                             <button id="submit" type="button" onclick="location.href='///F:/python/crypto/login.html'" ></a>
                              BUY</button>
                </div>

               


                <div class="diplay-coin">
                  <img src="icon/binance-coin-bnb-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">binance</p>
                </div>
                <div class="diplay-coin">
                  <img src="icon/tether-usdt-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">tether</p>
                </div>
                <div class="diplay-coin">
                  <img src="icon/cardano-ada-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">cardano</p>
                </div>
                <div class="diplay-coin">
                  <img src="icon/polkadot-new-dot-logo.png" alt="Italian Trulli" class="home-coin-imgs">
                  <p class="coins-name">polkadot</p>
                </div>
                
              
              
      </div>
      -->
  </div>
  <footer id="foot">
    <p class="footer">COINS BIT COPYRIGHT &copy; 2021</p>

  </footer>
</body>
<script type="text/javascript">
  $(window).on('load', function(e) {
    $('#submitss').on('click', function(e) {
      alert('clicked')
      $("#div").load(get_price());
    });
  });
</script>

</html>