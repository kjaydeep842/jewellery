<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TATTSVI - Coming Soon</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
<link rel="apple-touch-icon" href="favicon.png">
<link rel="shortcut icon" href="favicon.ico">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    background:#000;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: 'Segoe UI', sans-serif;
    color:#fff;
    text-align:center;
    overflow:hidden;
}

/* Subtle animated glow background */
body::before{
    content:"";
    position:absolute;
    width:200%;
    height:200%;
    background: radial-gradient(circle at center, rgba(255,215,0,0.08), transparent 60%);
    animation: glow 6s infinite alternate;
}

@keyframes glow{
    from{ transform: scale(1); }
    to{ transform: scale(1.1); }
}

.container{
    position:relative;
    z-index:2;
    max-width:600px;
    padding:20px;
}

/* Logo Animation */
.logo{
    width:180px;
    margin-bottom:20px;
    animation: fadeDown 1.5s ease;
}

@keyframes fadeDown{
    from{ opacity:0; transform:translateY(-30px); }
    to{ opacity:1; transform:translateY(0); }
}

/* Heading Animation */
h1{
    font-size:48px;
    letter-spacing:4px;
    margin-bottom:15px;
    animation: fadeUp 2s ease;
}

p{
    font-size:18px;
    color:#ccc;
    margin-bottom:30px;
    animation: fadeUp 2.5s ease;
}

@keyframes fadeUp{
    from{ opacity:0; transform:translateY(30px); }
    to{ opacity:1; transform:translateY(0); }
}

.email-box{
    margin-top:20px;
    animation: fadeUp 3s ease;
}

input{
    padding:12px;
    width:65%;
    border:none;
    border-radius:5px;
    outline:none;
}

button{
    padding:12px 20px;
    border:none;
    background:linear-gradient(45deg,#FFD700,#d4af37);
    color:#000;
    font-weight:bold;
    border-radius:5px;
    cursor:pointer;
    margin-left:10px;
    transition:0.3s;
}

button:hover{
    transform:scale(1.05);
    box-shadow:0 0 15px #FFD700;
}

footer{
    margin-top:40px;
    font-size:14px;
    color:#777;
    animation: fadeUp 3.5s ease;
}

/* Responsive */
@media(max-width:600px){
    h1{
        font-size:32px;
    }
    input{
        width:100%;
        margin-bottom:10px;
    }
    button{
        width:100%;
        margin-left:0;
    }
}
</style>
</head>

<body>

<div class="container">

    <!-- Logo -->
    <img src="images/logo.png" class="logo" alt="TATTSVI Logo">

    <!-- Title -->
    <h1>COMING SOON</h1>

    <p>
        Our website is under construction.<br>
        We’re working hard to launch soon.
    </p>

    <!-- Email Box -->
    <div class="email-box">
        <input type="email" placeholder="Enter your email">
        <button>Notify Me</button>
    </div>

    <!-- Footer -->
    <footer>
        © <?php echo date("Y"); ?> TATTSVI. All Rights Reserved.
    </footer>

</div>

</body>
</html>