<?php  include './connect/convert.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number to Words Converter</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        body {
    font-family: "Poppins", "Battambang", sans-serif;
    background: 
        radial-gradient(circle at center, 
            rgba(0, 0, 0, 0.9) 0%, 
            rgba(0, 0, 0, 1) 70%),
        url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><filter id="noise"><feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/></filter><rect width="100%" height="100%" filter="url(%23noise)" opacity="0.15"/></svg>'),
        linear-gradient(135deg, #000000 0%, #1a1a2e 100%);
    background-size: cover;
    animation: pulse 15s ease infinite;
    text-align: center;
    padding: 50px;
    min-height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

@keyframes pulse {
    0%, 100% {
        background-size: 100% 100%;
    }
    50% {
        background-size: 110% 110%;
    }
}

body::before {
    content: "";
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(0,0,0,0) 40%, rgba(0,150,255,0.1) 70%, rgba(0,0,0,0) 90%);
    border-radius: 50%;
    animation: blackhole 15s linear infinite;
    z-index: -1;
}

@keyframes blackhole {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0.7;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.3;
    }
    100% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0.7;
    }
 }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            width: 50%;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2),
                        0 0 30px rgba(255, 255, 255, 0.3),
                        0 0 40px rgba(0, 81, 255, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .container:hover {
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3),
                        0 0 40px rgba(255, 255, 255, 0.4),
                        0 0 50px rgba(0, 81, 255, 0.3);
            transform: translateY(-5px);
        }
        
        input, button {
            margin: 15px 0;
            padding: 15px;
            width: 80%;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            font-size: 2rem;
            transition: all 0.3s ease;
        }
        
        input {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        input:focus {
            outline: none;
            border-color: rgba(0, 81, 255, 0.5);
            box-shadow: 0 0 10px rgba(0, 81, 255, 0.2);
        }
        
        button {
            background: linear-gradient(135deg, rgb(0, 81, 255), rgb(0, 132, 255));
            color: white;
            cursor: pointer;
            font-size: 1.5rem;
            font-weight: bold;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 81, 255, 0.4);
        }
        
        button:hover {
            background: linear-gradient(135deg, rgb(0, 56, 177), rgb(0, 102, 204));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 81, 255, 0.6);
        }
        
        button:active {
            transform: translateY(0);
        }
        .result-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .result-row {
            background: rgb(145, 142, 142);
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease; /* Smooth transition for hover effect */
            color: blue
        }
        
        .result-row:hover {
            background: linear-gradient(135deg, rgb(0, 81, 255), rgb(0, 132, 255)); /* Gradient background on hover */
            color: white; /* Change text color on hover */
            transform: translateY(-2px); /* Optional: Add a slight lift effect */
            box-shadow: 0 4px 15px rgba(0, 81, 255, 0.4); /* Optional: Add a shadow effect */
        }
        
        h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>សូមធ្វើការបញ្ចូលចំនួនទិន្នន័យលេខ</h2>
    <form method="post">
        <input type="number" name="number" placeholder="Enter number" required>
        <button type="submit">Submit</button>
    </form>

    <!-- HTML Display -->
    <div class="result-container">
        <?php if (isset($result)) echo $result; ?>
    </div>
</div>
</body>
</html>