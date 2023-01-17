<link rel="stylesheet" type="text/css" href="css/left-menu.css">

<nav class="left-menu">
    <div class="menu-sections">
        <ul>
            <a href="index.php"><li><span><i class="fa-solid fa-table-columns"></i></span> Dashboard</li></a>
            <a href="add_games.php"><li><span><i class="fa-solid fa-plus"></i></span> Add Games</li></a>
            <a href="update_games.php"><li><span><i class="fa-solid fa-arrows-rotate"></i></span> Update Games</li></a>
            <a href="list_queries.php"><li><span><i class="fa-solid fa-list"></i></span> List Queries</li></a>
            <a href="general_settings.php"><li><span><i class="fa-sharp fa-solid fa-gear"></i></span> General Settings</li></a>
            <a href="../index.php" target="_blank"><li><span><i class="fa-sharp fa-solid fa-house"></i></span> Go Home Page</li></a>
        </ul>
    </div>
</nav>


<script>



function toggleLeftMenu(){

    if($(".left-menu").css("display") == "none")
    {
        $(".left-menu").css("display","block");
        $(".hamburger i.fa-bars").css("display","none");
        $(".hamburger i.fa-xmark").css("display","block");
    }else{
        $(".left-menu").css("display","none");
        $(".hamburger i.fa-bars").css("display","block");
        $(".hamburger i.fa-xmark").css("display","none");
    }
}


</script>