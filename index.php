<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="background fade-in">
        <video autoplay loop muted>
          <source src="./pictures/video1.mp4" type="video/mp4">
        </video>
      </div>

    <div class="nav">
        <div class="nav-logo">Smart-parking</div>
        <ul class="nav-menu">
          <li><a href="./Login/signup.php" class="nav-link">Register</a></li>
          <li>Explore</li>
          <li>About</li>
          <li class="nav-contact">Contact</li>
        </ul>
    </div>

    <div class="hero-text">
        <p id="sentence"></p>
    </div>

    <div class="hero-explore">
        <div class="explore-content">
          <a href="./view/explore.php" className ="explore">
            <p>Get Started</p>
            <img src="../pictures/arrow_btn.png" alt="" />
          </a>
        </div>
    </div>


    

    <script>
        const sentences = [
          "Enjoy the absolute Convenience",
          "Park and Explore",
          "Earn some Extra Cash"
        ];
    
        function displaySentences() {
          let index = 0;
          setInterval(() => {
            document.getElementById("sentence").textContent = sentences[index];
            index = (index + 1) % sentences.length;
          }, 5000); 
        }
    
        displaySentences();
      </script>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <script src="./js/index.js"></script>
</body>

</html>