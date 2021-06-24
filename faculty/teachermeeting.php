<?php
session_start();
echo '<div style="position:fixed;width:100%;height:100%;z-index:100;top:0;text-align:center;background-color:white;" id="loader"><img src="../../images/load.gif"></div>';
if(!isset($_SESSION["registeredid"]) or !isset($_SESSION["coursecode"]))
{
    header("Location:teachermenu.php");
    die;
}

?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src='https://meet.jit.si/external_api.js'></script>
    </head>
    <body style="margin:0;padding:0;">
        <div style="position:fixed;left:0;top:0;width:200px;height:250px;background-color:Transparent;z-index:10;"></div>
        
        <div id="meet" style="width:100%;height:100%;"></div>
        <script>
            $(document).ready(function(){
              document.getElementById("loader").style["display"]="none";
            });
            window.onbeforeunload=function (){
                document.body.style["filter"]="opacity(30%)";
            };
            
            const domain = 'meet.jit.si';
const options = {
    configOverwrite: { enableWelcomePage: false,prejoinPageEnabled: false},
    interfaceConfigOverwrite: { 
        DEFAULT_BACKGROUND: 'black',
        SHOW_PROMOTIONAL_CLOSE_PAGE: false,
        HIDE_KICK_BUTTON: true,
        SHOW_WATERMARK_FOR_GUESTS: false,
        HIDE_INVITE_MORE_HEADER: true,
        SHOW_JITSI_WATERMARK: false ,
        INITIAL_TOOLBAR_TIMEOUT: 3000,
        MOBILE_APP_PROMO: false,
        NATIVE_APP_NAME: 'Newra Meeting',
        APP_NAME: 'Newra Meeting',
        ENABLE_DIAL_OUT: false,
        DISPLAY_WELCOME_PAGE_CONTENT: false,
        ENFORCE_NOTIFICATION_AUTO_DISMISS_TIMEOUT: 3000,
        TOOLBAR_BUTTONS: ['microphone', 'camera', 'chat', 'videoquality', 'feedback', 'stats','tileview', 'videobackgroundblur','mute-everyone']
    },
    roomName: "NewraSGTBCourseCode-"+'<?php echo $_SESSION["coursecode"] ?>',
    parentNode: document.querySelector('#meet'),
    userInfo:
    {
        displayName: 'Instructor'
    }
};
const api = new JitsiMeetExternalAPI(domain, options);

api.addEventListener('participantRoleChanged', function(event) {
    if (event.role === "moderator") {
        document.body.style["filter"]="opacity(100%)";
        api.executeCommand('password', 'The Password');
    }
});
// join a protected channel
api.on('passwordRequired', function ()
{
    document.body.style["filter"]="opacity(30%)";
    document.getElementById("meet").blur();
    api.executeCommand('password', 'The Password');
});


        </script>
        
    </body>
</html>