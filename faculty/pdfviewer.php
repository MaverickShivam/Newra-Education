<?php 

//header("Location:https://docs.google.com/viewer?url=".$_GET["pdflink"]);
?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <meta name="viewport" content="width=device-width,user-scalable=yes">
        <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
        <style>
            body
            {
                margin:0;
                padding:0;
                
            }
        </style>
    </head>
    <body>
        <div style="position:fixed;width:100%;height:100%;z-index:100;top:0;text-align:center;background-color:white;" id="loader"><img src="../../images/load.gif"></div>
        <script>
            var currPage = 1; //Pages are 1-based not 0-based
            var numPages = 0;
            var thePDF = null;
            
            //This is where you start
            pdfjsLib.getDocument("<?php echo $_GET["pdflink"] ?>").then(function(pdf) {
            
                    //Set PDFJS global object (so we can easily access in our page functions
                    thePDF = pdf;
            
                    //How many pages it has
                    numPages = pdf.numPages;
            
                    //Start with first page
                    pdf.getPage( 1 ).then( handlePages );
            });
            
            
            
            function handlePages(page)
            {
                //This gives us the page's dimensions at full scale
                var viewport = page.getViewport( 2 );
            
                //We'll create a canvas for each page to draw it on
                var canvas = document.createElement( "canvas" );
                canvas.style.display = "block";
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.style["max-width"]="100%";
                //Draw it on the canvas
                page.render({canvasContext: context, viewport: viewport});
            
                //Add it to the web page
                document.body.appendChild( canvas );
            
                //Move to next page
                currPage++;
                if ( thePDF !== null && currPage <= numPages )
                {
                    thePDF.getPage( currPage ).then( handlePages );
                }
                if(currPage == numPages)
                {
                    document.getElementById("loader").style["display"]="none";
                }
                
            }
            
            
        </script>
    </body>
</html>
