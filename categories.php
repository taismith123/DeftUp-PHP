<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Categories</title>
<link rel= "stylesheet" href = "Styles.css">
<style>
    h1 {text-align: center}
</style>
<body>
<div class = "container1">
    <div class = "navigationbar1">
        <div class = "left-side1">
            <div class = "image-brand1"> <!-- LOGO-->
                <div> <img src="./img/DeftUp1.PNG" alt = "DeftUp" width="65" height="65"> </div>
            </div>
        </div>

        <div class = "right-side"> <!-- LINKS-->
            <div class = "link-navbar1"> <a href = "DeftUpPro.html">Home</a> </div>
            <div class = "link-navbar1"> <a href = "Register.html">Register</a> </div>
            <div class = "link-navbar1"> <a href = "Categories.html"> Categories </a> </div>
            <div class = "link-navbar1"> <a href = "AboutUs.html"> About Us </a> </div>
            <div class = "link-navbar1"> <a href = "Help.html"> Help </a>  </div>
        </div>
    </div>
    <h1 class = "middle" style = "text-align: center"> C A T E G O R I E S </h1>
    <div class = "content-wrapper">
        <div class = "portfolio-items-wrapper">
            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Bed2.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title" > Bed Assembly </h1>
                        <!--<img src = "img/Bed.jpg">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Plumming.jpg)"> </div>

                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title" > Plumbing </h1>
                        <!--<img src = "img/Painting.jpg">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Electrical.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Electrical </h1>
                        <!--<img src = "img/Desk.jpg">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Moving.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Moving </h1>
                        <!--<img src = "img/Mounting.jpg">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Yardwork.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Yard-Work </h1>
                        <!--<img src = "img/Yardwork.jpg">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Cleaning.png)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Cleaning </h1>
                        <!--<img src = "img/Cleaning.png">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Painting2.jpeg)"> </div>

                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Painting </h1>
                        <!--<img src = "img/Cleaning.png">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Mounting3.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> TV Mounting </h1>
                        <!--<img src = "img/Cleaning.png">-->
                    </div>
                </div>
            </div>

            <div class = "portfolio-item-wrapper">
                <div class = "portfolio-img-background" style = "background-image: url(img/Desk3.jpg)"> </div>
                <div class = "img-text-wrapper">
                    <div class = "logo-wrapper">
                        <h1 class = "category-title"> Desk Assembly </h1>
                        <!--<img src = "img/Cleaning.png">-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    const portfolioItems = document.querySelectorAll('.portfolio-item-wrapper')
    portfolioItems.forEach(portfolioItem => {
        portfolioItem.addEventListener('mouseover', () =>{
            //console.log(portfolioItem.childNodes[1].classList);
            portfolioItem.childNodes[1].classList.add('img-darken');
        })
        portfolioItem.addEventListener('mouseout', () =>{
            //console.log(portfolioItem.childNodes[1].classList);
            portfolioItem.childNodes[1].classList.remove('img-darken');
        })
    })
</script>


</html>