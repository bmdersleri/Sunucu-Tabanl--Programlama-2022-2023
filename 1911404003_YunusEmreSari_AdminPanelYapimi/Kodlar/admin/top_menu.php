<link rel="stylesheet" type="text/css" href="css/top-menu.css">

<div class="top-menu">

    <div class="hamburger" onclick="toggleLeftMenu()">
    <a href="#">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-xmark" style="display:none; font-size: 25px"></i>
</a>
    </div>

    <div class="admin-section">
        <img src="../images/sdeals.png" alt="">
    </div>

    <div class="notification-tab anim-hover-bright">
        <i class="fa-solid fa-bell"></i>
        <h2>Notifications</h2>
    </div>

    
    <div class="notifications">

        <!-- <div class="notification-item success">
        <h3>Error</h3>
        Gothic II: Gold Edition brings together the excitement of Gothic II and the add-on Night of the Raven to your fingertips!
        <h4>2022-12-26 21:56:34</h4>
        </div> -->

    </div>

</div>

<div class="loading">
        <h1>Loading</h1>
</div>


<script>
    var isOpen = false;
    var notificationInterval = null;

    startNotificationInterval();

    function startNotificationInterval(){
        clearInterval(notificationInterval);
        updateNotifications();
        notificationInterval = setInterval(updateNotifications,10000);
    }


    function updateNotifications(){
        post_data = {
            'update_notifications' : 1,
        };

        $.ajax({
        type: "POST",
        url: 'ajax/ajax_index.php',
        data:  post_data,
        success: function(result) {
            $(".notifications").html(result);
        }
        });
    }

    $(".notification-tab ").click(function(){  
        if(!isOpen)
        {
            $(".notifications").show();
            isOpen = true;
        }
        else
        {
            // $(".notifications").hide();
            // console.log("Tıklandı biryere");
            // isOpen = false;
        }
    });  


    
    $(document).mouseup(function(e) 
    {
        var container =$('.notification-tab ');
        var container1 =$('.notifications ');

        // if the target of the click isn't the container nor a descendant of the container
        if ((!container.is(e.target) && container.has(e.target).length === 0) && (!container1.is(e.target) && container1.has(e.target).length === 0)) 
        {
            $(".notifications").hide();
            isOpen = false;
        }
    });



    async function arrayNotificationAdder(result){

        addNotification("gap","","");
        await sleep(50);
        
        var len = 0;
        if(result.length != undefined)
            len = result.length;
        else{
            addNotification(result.type,result.title,result.desc);
        }

        for (let index = 0; index < len; index++) {
            // console.log(result[index].type);
            addNotification(result[index].type,result[index].title,result[index].desc);
        }

        $(".notifications").show();
        isOpen = true;
    }


    async function multipleArrayNotificationAdder(result){

        addNotification("gap","","");
        await sleep(50);

        var lenBase = 0;
        if(result.length != undefined)
            lenBase = result.length;
        else{
            addNotification(result.type,result.title,result.desc);
        }
            
        for (let index = 0; index < lenBase; index++) {

            var lenChild = 0;
            if(result[index].length != undefined)
                lenChild = result[index].length;
            else{
                addNotification(result[index].type,result[index].title,result[index].desc);
            }

            // console.log(result[index].length+" -- "+result[index][0].type);
            for (let j = 0; j < lenChild; j++) {
                addNotification(result[index][j].type,result[index][j].title,result[index][j].desc);
            }

        }

        $(".notifications").show();
        isOpen = true;
    }


    function addNotification(notification_type,notification_title,notification_desc){

        // console.log(notification_type+" "+notification_desc);
        post_data = {
        'add_notification' :1,
        'notification_type' : notification_type,
        'notification_title' : notification_title,
        'notification_desc' : notification_desc,
        };

        $.ajax({
        type: "POST",
        url: 'ajax/ajax_index.php',
        data:  post_data,
        success: function(result) {
            $(".notification-tab").click();
            startNotificationInterval();
            // console.log(result);
        }
        });
    }


    // function updateNotificationCount(){
    //     $(".notification-tab h2").text(notificationCount+" Notification");
    // }


    function showLoadingScreen(){
        $(".loading").css("display","flex");
        $(".center").addClass("blur-item");
    }


    function hideLoadingScreen(){
        $(".loading").css("display","none");
        $(".center").removeClass("blur-item");
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }




</script>