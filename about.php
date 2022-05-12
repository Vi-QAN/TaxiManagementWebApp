<!DOCTYPE html>
<html lang = en>
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>About us</title>
        <link rel='stylesheet' href='./css/styles.css' >
        <script src='./Component/NavBar.js' ></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body>
        <nav-bar></nav-bar>
        <div class="about">
            <section class="opening">
                <img src="./images/taxi.jpg" width="100%" height="100%" alt="taxt">
                <h3>About us</h3>
            </section>
            <section class="content">
                <h5>We reimagine the way the world moves for the better</h5>
                <p>Movement is what we power. It’s our lifeblood. It runs through our veins. It’s what gets us out of bed each morning. It pushes us to constantly reimagine how we can move better. For you. For all the places you want to go. For all the things you want to get. For all the ways you want to earn. Across the entire world. In real time. At the incredible speed of now.</p>
                <div class="full">
                    <div class="top"> 
                        <h6> Read our full mission </h6>
                        <button class="fa fa-plus active" id='open' onclick="expand(this.id)"></button>
                        <button class="fa fa-minus" id='close' onclick="expand(this.id)"></button>
                    </div>
                    <div class="extra" id="extra">
                        <p> We are Uber. The go-getters. The kind of people who are relentless about our mission to help people go anywhere and get anything and earn their way. Movement is what we power. It’s our lifeblood. It runs through our veins. It’s what gets us out of bed each morning. It pushes us to constantly reimagine how we can move better. For you. For all the places you want to go. For all the things you want to get. For all the ways you want to earn. Across the entire world. In real time. At the incredible speed of now.

                        We are a tech company that connects the physical and digital worlds to help make movement happen at the tap of a button. Because we believe in a world where movement should be accessible. So you can move and earn safely. In a way that’s sustainable for our planet. And regardless of your gender, race, religion, abilities, or sexual orientation, we champion your right to move and earn freely and without fear. Of course, we haven’t always gotten it right. But we’re not afraid of failure, because it makes us better, wiser, and stronger. And it makes us even more committed to do the right thing by our customers, local communities and cities, and our incredibly diverse set of international partners.

                        he idea for Uber was born on a snowy night in Paris in 2008, and ever since then our DNA of reimagination and reinvention carries on. We’ve grown into a global platform powering flexible earnings and the movement of people and things in ever expanding ways. We’ve gone from connecting rides on 4 wheels to 2 wheels to 18-wheel freight deliveries. From takeout meals to daily essentials to prescription drugs to just about anything you need at any time and earning your way. From drivers with background checks to real-time verification, safety is a top priority every single day. At Uber, the pursuit of reimagination is never finished, never stops, and is always just beginning.</p>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript">
            function expand(id){
                const openBtn = document.getElementById('open');
                const closeBtn = document.getElementById('close');
                const extra = document.getElementById('extra');
                if (id === 'open'){
                    openBtn.classList.remove('active');
                    
                    closeBtn.classList.add('active');
                    
                    extra.classList.add('active');
                }
                else {
                    closeBtn.classList.remove('active');
                    
                    openBtn.classList.add('active');

                    extra.classList.remove('active');
                }
            }

        </script>
    </body>
</html>