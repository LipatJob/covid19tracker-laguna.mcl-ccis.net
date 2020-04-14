        <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-light" id="title">
        <a style="color: white; font-size: 1.8em; font-weight: 600;">
            COVID-19 Case Tracker Dashboard
        </a>
        <div>
            <img src="imgs/DOH.png" class="logo-image" style="marigin-right: 10px;">
            <img src="imgs/DOH_calabarzon.png" class="logo-image" style="marigin-right: 10px;">
            <img src="imgs/mcl.png" class="logo-image" style="marigin-left: 10px;">
        </div>
    </nav>
    

<nav id="navtop" class=" navbar-light bg-light mb-4"> 
    <ul class="row p-2">
        <li class="" id="indexNav">
            <a class="nav-link" href="index.php"> Overview </a>
        </li>
        <li class="" id="individualNav">
            <a class="nav-link" href="individual.php"> Individual Cases </a>
        </li>
        <li class="" id="sourcesNav">
            <a class="nav-link" href="info.php"> Sources </a>
        </li>
        <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black;"></span>
    </ul>
    
</nav>

<style>
    #navtop ul{
        display: flex;
        flex-direction: row;
        list-style: none;
    }
    #navtop ul li a{
        color:rgba(0, 0, 0, .5);
        font-size: 20px;
        font-weight: 500;
    }
    #navtop ul li a:hover{
        color:rgba(0, 0, 0, .7);
    }
    
    #mcl_timer{
        margin-left: auto;
    }

    .active{
        color:black !important;
        font-weight:bold !important;
    }


    @media only screen and (max-width: 400px){
        ul li a{
            color:#505050;
            font-size: 18px;
            padding: 5px;
            font-weight: 500;
            padding-left:0 !important;
            padding-right:0 !important;

        }
    }
    @media only screen and (max-width: 600px){
        ul{
            justify-content: space-evenly;
        }

    }
    @media only screen and (max-width: 770px){
        #mcl_timer{
            visibility: hidden;
            width: 1px;
            height: 1px;
            margin: -1px;
            border: 0;
            padding: 0;
        }
    }


  
    
    
</style>
<!-- END OF NAVIGATION BAR-->