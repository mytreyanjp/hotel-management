<!DOCTYPE html>
<html>

<head>
    <style>
        @font-face {
            font-family: fa;
            src: url(GreatVibes-Regular.ttf);
        }

        @font-face {
            font-family: ti;
            src: url(BLKCHCRY.TTF);
        }
       


        body {
           background-image: url('https://www.pixel4k.com/wp-content/uploads/2018/03/Venetian%20Resort%20Hotel%20Casino%20Las%20Vegas147612424.jpg');
            background-color: rgb(129, 60, 0);
            background-repeat:no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #title {
            text-align: center;
            font-size: 80px;
            font-weight: 10;
            font-family: fa;
            color: rgb(255, 186, 125);
            margin-left: -900px;
            opacity: 1;
            animation-delay: 0.5s;
            text-shadow: 2px 6px 5px rgba(0, 0, 0, 0.267);
        }

        #RealT {
            text-align: center;
            color: rgb(255, 204, 161);
            font-size: 100px;
            opacity: 1;
            margin-left: -800px;
            font-family: ti;
            text-shadow: 2px 6px 15px rgba(0, 0, 0, 0.267);
            font-weight: 1;
            position: relative;
            z-index: 10;
            margin-top: -110px;
            text-shadow: 2px 6px 15px rgba(0, 0, 0, 0.267);
        }

        #centre {
            background-image: url('https://4kwallpapers.com/images/wallpapers/planet-astronomy-outer-space-brown-black-background-5k-8k-3440x1440-1513.jpg');
            background-color:rgb(80, 39, 0);
            text-align: center;
            font-size: 80px;
            font-family: fa;
            color: rgb(255, 217, 184);
            text-shadow: 2px 6px 5px rgba(0, 0, 0, 0.267);
            margin-top: -130px;
            background-size: cover;
            height: 300px;
            width: 90%;
            margin-left: auto;
            border-radius: 100px;
            z-index: 0;
            overflow: hidden;
            margin-right: auto;
            position: relative;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.555);
        }

        #Bo {
            position: relative;
            z-index: 1;
            font-size: 60px;
            margin-top: 2px;
        }

        #overlay {
            background-color: rgba(75, 31, 0, 0.623);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #about {
            position: relative;
            z-index: 1;
            margin: 50px;
            font-size: 30px;
            margin-top: 50px;
            text-shadow: 2px 6px 5px rgba(0, 0, 0, 0.616);
            font-family: ti;
        }

        


        #bb {
    position: absolute;
    top: 10px; 
    right: 5px; 
    display: inline-block;
    padding: 30px;
    font-size: 30px;
    font-family: ti;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.267);
    color: rgb(255, 204, 161);
    text-decoration: none;
    border-radius: 5px;
    transition: font-size 0.3s ease-in-out, color 0.3s ease-in-out;
}

#bb:hover {

    color: rgb(96, 55, 0);
}
#room1::before,
#room2::before,
#room3::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
        z-index: -1;

    width: 100%;
    height: 100%;
    background-color: rgba(80, 39, 0, 0.5); 
    z-index: -1;
    transition: opacity 0.3s ease-in-out;
    opacity: 1; 
}



#room1 p, #room2 p, #room3 p {
    position: relative;
    z-index: 1; 
}
#room1,
#room2,
#room3 {
    position: relative;
    background-size: cover;
    height: 650px;
    color: rgb(255, 216, 189);
    text-align: center;
    font-family: ti;
    font-size: 30px;
    width: 400px;
    margin-left: auto;
    border-radius: 170px;
    z-index: 0;
    overflow: hidden;
    margin-right: auto;
    position: relative;
    transition: width 0.3s ease-in-out;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.555);
}

#room1 {
    margin-left: 100px;
    margin-top: 70px;
    background-image: url(room1.jpg);
}

#room2 {
    margin-left: 580px;
    background-image: url(room2.jpg);
    margin-top: -650px;
}

#room3 {
    background-image: url(room3-1.webp);
    margin-left: 1060px;
    margin-top: -650px;
}

#room1:hover,
#room2:hover,
#room3:hover {
    width: 450px;
    color:rgb(255, 234, 220);
}
#details{
    opacity: 0;
    transition: opacity 0.3s ease-in-out ;
    font-size:25px;
    padding:40px;
    color:rgb(255, 255, 255);
  margin-top: -50px;


}
#details:hover{
    opacity:1;
}
#booking {


            text-align: center;

            font-weight: 10px;
            font-family: ti;
            color: rgb(255, 217, 184);
            text-shadow: 2px 6px 5px rgba(0, 0, 0, 0.267);
            margin-top:70px;
            background-size: cover;
            height: 800px;
            width: 90%;
            margin-left: auto;
            border-radius: 80px;
            z-index: 0;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.547);
            margin-right: auto;
            position: relative;
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.576);

        }
#booking form {
    text-align:center;
    margin-top: 30px;
  
}

#booking label {
    display: block;
    margin-left: -900px ;
    font-size: 35px;
    color: rgb(255, 217, 184);
    text-shadow: 20px 20px 10px solid black;
}

#booking select,
#booking input {
    width: 80%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid rgb(255, 217, 184);
    border-radius: 5px;
    background-color: rgba(0, 0, 0, 0.5);
    color: rgb(255, 217, 184);
    font-size: 16px;
}

#booking input[type="submit"] {
    background-color: rgb(96, 55, 0);
    color: rgb(255, 217, 184);
    cursor: pointer;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
}

#booking input[type="submit"]:hover {
    background-color: rgb(255, 204, 161);
    color: rgb(0, 0, 0);
}

    </style>
</head>
<?php
  

    session_start();

   
        echo "<h1>Welcome, {$_SESSION['username']}!</h1>";
       
    
    ?>
<body>
    
    <a href="#booking" id="bb">Book Now</a>
    <h1 id="title">Welcome to</h1>
    <h2 id="RealT">The Continental</h2>

    <div id="centre">
  
        <div id="overlay"></div>

        <p id="about">
            The Continental is a luxurious destination that welcomes you to a world of comfort and sophistication. Nestled
            in the heart of breathtaking landscapes, our hotel offers a unique blend of elegance and modern amenities.
            Whether you are here for business or leisure, our dedicated staff is committed to ensuring your stay is truly
            exceptional. From the moment you step through our doors, you'll experience unparalleled hospitality and a
            warm, inviting atmosphere. Explore the wonders of The Continental and make your visit an unforgettable journey.
        </p>

    </div>
<div id="room1"><p>Infrastructure</p>
<p id="details">The infrastructure of The Continental Hotel is a testament to luxury and sophistication. 
    Designed with meticulous attention to detail, our establishment boasts a state-of-the-art architectural marvel. 
    The moment you step through our doors, you'll be greeted by an ambiance of elegance and modernity. 
    The structural design seamlessly integrates with the surrounding landscapes, creating a harmonious blend of comfort and aesthetics.
  
</p></div>
<div id="room2"><p>Rooms</p>
    <p id="details"> Our accommodation options consist of three distinct types of rooms, each providing a distinctive experience.<br><br>
Standard Rooms: Perfect for those seeking a comfortable and cozy retreat, our standard rooms offer a harmonious blend of simplicity and elegance.<br>
Deluxe Suites: For those desiring a touch of luxury, our deluxe suites are meticulously designed to exude sophistication. <br>
Executive Penthouses:  With panoramic views of the surroundings, private balconies, and exclusive services.</p></div>
<div id="room3"><p>Facilities</p>
<p id="details" > Facilities at The Continental Hotel:<br><br>

    Swimming Area:
    
    Serene pool for relaxation<br>
    Dining:
    
    With a variety of culinary delights.<br>
    Check-in Assistance:
    
    Dedicated team of clerks<br>
    Butler Service:
    
    Attentive butlers For assistance.<br>
    Fitness Center:
    
    Gym with modern exercise equipment.<br>

</p></div>
<div id="booking">
    <h1>Book a Room</h1>
    <form action="book_room.php" method="post">
        <label for="guests">Number of Guests:</label>
        <input type="number" id="guests" name="guests" required>

        <label for="room_type">Room Type:</label>
        <select name="room_type" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Twin">Twin</option>
            <option value="Suite">Suite</option>
        </select>

        <label for="checkin_date">Check-in Date:</label>
        <input type="date" id="checkin_date" name="checkin_date" required>

        <label for="checkout_date">Check-out Date:</label>
        <input type="date" id="checkout_date" name="checkout_date" required>

        <label for="include_breakfast">Include Breakfast:</label>
        <select name="breakfast_type" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
    
        </select>
        

        <button type="submit">Book Now</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</div>

    <script>

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

    </script>
</body>

</html>
