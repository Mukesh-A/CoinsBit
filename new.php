<html>
    <head>
        <link rel="stylesheet" href="new.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="demo"></div>
        <p id="demos"></p>
       
        
        <script type="text/javascript">

var currentLocation = window.location;
var str = currentLocation['href']
var array = str.split(".", );
console.log(array[1])
// console.log(str)

var str = 'hello@tlkj'

            function red(){
            var myObj, i, j, x = "";
            var myStringArray = ['BTC','ETH','LTC'];
            request('GET','https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC&tsyms=USD')
                  .then((r1) => {
                          var x1 = JSON.parse(r1.target.responseText);
                    //   var el = document.getElementById('c')
                    var a = 'DISPLAY', b = 'BTC', c='USD', d='PRICE';
                    // console.log(x1['DISPLAY']['BTC']['USD']['HIGHDAY'])
                    var a = 'DISPLAY', b = 'BTC', c='USD', d='PRICE', e='IMAGEURL';
            for (i in myStringArray) 
            {
                console.log(myStringArray[i])
                var mm = myStringArray[i]

                
                console.log(x1['DISPLAY']['BTC']['USD']['HIGHDAY'])
                var bb = 910
                var nn = "hh.html?" + mm
               
                
                x += "<div class='diplay-coin'>"+ x1['DISPLAY'][myStringArray[i]][c][d] + "<a href='" + nn + "'>Google</a></div>";
                // y += "<a href='" + nn + "'>Google</a>";
                // document.write("<div class='diplay-coin'>"+ x1['DISPLAY'][myStringArray[i]][c][d] + "</div>");
                // document.write('<a href="' + nn + '">Google</a>');
                // document.getElementById("a").href = mm;
                //<a href="' + loc + '">Google</a>
               

                        // echo "<a href='approve.php?id={$mm}'>MORE</a>";
                      
               
                
                // for (j in myObj.cars[i].models) 
                // {
                //     x += myObj.cars[i].models[j] + "<br>";
                // }
            }
                document.getElementById("demo").innerHTML = x 
                // document.getElementById("demo").innerHTML = y;
                  })
                }
                red()
                //  setInterval(red, 1000)

                  function request(method, url) {
                            return new Promise(function (resolve, reject) {
                                var xhr = new XMLHttpRequest();
                                xhr.open(method, url);
                                xhr.onload = resolve;
                                xhr.onerror = reject;
                                xhr.send();
                            });
                    }

                   
            </script>
            
 // 
      
    </body>
</html>


<!-- this code is for realtime display of total sum of INR to b paid for particular  trade -->

<!-- function calculate() {
		var myBox1 = document.getElementById('box1').value;	
		var myBox2 = document.getElementById('box2').value;
		var result = document.getElementById('result');	
		var myResult = myBox1 * myBox2;
		result.value = myResult;
      
		
	} -->  


<!-- this code is for adding sum of cur value of btc and usdt final value to database -->

    <!-- <script>
var p1 = "success";
</script>

</*?php 
$x ="<script>document.writeln(p1);</script>";
echo $x;
?> */
