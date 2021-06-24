<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body style="padding:0;margin:0;">
        <div>
            <div onclick="openadd()"style="width:100%;height:60px;Background-color:rgba(47,85,151,1);color:white;bottom:0;left:0;position:fixed;">
                <div style="padding:15px;"><center>Add New Course</center></div>
            </div>
			<br>
			
			<div id="allcourses">
				
			</div>
        </div>
        <script>
		    window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
			if(localStorage.getItem("allcoursescode")==null || localStorage.getItem("allcoursesname")==null)
			{
				localStorage.setItem("allcoursescode","");
				localStorage.setItem("allcoursesname","");
			}
            
			function addcourses()
			{
				var coursecodes=localStorage.getItem("allcoursescode");
				var coursenames=localStorage.getItem("allcoursesname");
				var mytext='<div id="addone" align="center" style="margin-top:100px;background-color:lightgray;width:70%;height:200px;display:none;position:fixed;left:15%;box-shadow:10px 10px 8px #888888;"><div onclick="closeadd()" style="width:95%;height:10%;background-color:black;color:white;padding:5px;"><center>Cancel<center></div><br><input id="coursecode" placeholder="Course Code"><br><br><input id="coursename"placeholder="Course Name"><br><br><center><button onclick="addnewcourse()">Add</button></center></div>';
				coursecodes=coursecodes.split(",");
				coursenames=coursenames.split(",");
				coursecodes=coursecodes.reverse();
				coursenames=coursenames.reverse();
				for(var i=0;i<coursecodes.length-1;i++)
				{
					mytext=mytext+"<center><form action='tcourseprofile.php' method='get' style='background-color:#f3f3f3;border-bottom:3px solid #132743;color:black;width:90%;height:170px;box-shadow:10px 10px 8px #888888;' onsubmit='return blurbody()'><button name='courseid' style='background-color:Transparent;border:none;width:100%;height:100%;outline:none;' type='submit' value='"+coursecodes[i]+"' ><b>Course Name: </b>"+coursenames[i]+"<br><br> <b>Course Code: </b>"+coursecodes[i]+"</button></form><center><br>"
				}
				document.getElementById("allcourses").innerHTML=(mytext+"<br><br><br><br>");
				
			}
			function blurbody()
			{
			    document.body.style["filter"]="opacity(30%)";
			}
			addcourses();
			function addnewcourse()
			{
				if(document.getElementById("coursecode").value!="" && document.getElementById("coursecode").value!="")
				{
					var temp=localStorage.getItem("allcoursescode");
					temp=temp.split(",");
					
					if(!temp.includes(document.getElementById("coursecode").value))
					{
					localStorage.setItem("allcoursescode",(localStorage.getItem("allcoursescode")+","+document.getElementById("coursecode").value.toUpperCase()));
					localStorage.setItem("allcoursesname",(localStorage.getItem("allcoursesname")+","+document.getElementById("coursename").value));
					addcourses();
					}
					else
					{
					alert("Course already registered");
					}
				}
				else
				{
					alert("please fill all details");
				}
				
			}
			function closeadd()
			{
				document.getElementById("addone").style.display="none";
			}
			function openadd()
			{
				document.getElementById("addone").style.display="block";
			}
        </script>
    </body>
</html>