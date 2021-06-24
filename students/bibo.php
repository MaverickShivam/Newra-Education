<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <br>
        <br>
        <center style="height:250px;">
        <div style="width:150px;height:150px;background-color:#f1c5c5;border-radius:100px;transition:5s;" id="circle">
            
        </div>
        </center>
        <center style="font-size:20px;transition:5s;" id="mytext">Breath Out</center>
        <br>
        <br>
        <center>
            <img src="https://newra.in/dss/images/medit.jpg" width="100%" height="auto">
        </center>
        <script>
            var i=0
            var mycolors=["#f9b384","#efee9d","#bbf1c8","#fce8d5","#f4f7c5","#74d4c0","#c7e2b2","#f6d743","#e4e3e3","#f1c5c5"];
            breathout();
            var bointerval=window.setInterval(breathout,10000);
            function breathout()
            {
                window.setTimeout(breathin,5000);
                document.getElementById("mytext").innerHTML="Breath Out";
                document.getElementById("circle").style["width"]="40px";
                document.getElementById("circle").style["height"]="40px";
            }
            function breathin()
            {
                document.getElementById("mytext").innerHTML="Breath In";
                document.getElementById("circle").style["background-color"]=mycolors[i%10];
                document.getElementById("circle").style["width"]="200px";
                document.getElementById("circle").style["height"]="200px";
                i=i+1;
            }
        </script>
    </body>
</html>