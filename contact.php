<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - AlveFood</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="logo.png" alt="Logo" class="logo-image">
            <div class="logo-text">AlveFood</div>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="service.php">Service</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero animate-fade-in">
       
        <!-- CTA -->
    <section id="cta" class="cta"> 
        <h2>Contact Us</h2>
        <div class="container">
            <form action="save_message.php" method="POST">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">
            <label for="email">Your Mail</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
            <label for="message">Your Message</label>
            <textarea id="message" name="message" placeholder="Enter your message"></textarea>
            <button type="submit">Submit</button>
        </form>

    </div>
    </section>
    
    </section>

    <footer>
        <p>@2024 By Ariantonius Sagala. All rights reserved.</p>
    </footer>
</body>
</html>
