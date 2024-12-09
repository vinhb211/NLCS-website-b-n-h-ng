
    <section id="slider">
        <div class="aspect-ratio-169">
            <img class = "image" src="./image/slider1.png" alt="Hình ảnh thời trang">
            <img class = "image" src="./image/slider2.jpg" alt="Hình ảnh thời trang">
            <img class = "image" src="./image/slider3.jpg" alt="Hình ảnh thời trang">
            <img class = "image" src="./image/slider4.jpg" alt="Hình ảnh thời trang">
            <img class = "image" src="./image/slider5.png" alt="Hình ảnh thời trang">

        </div>
        <div class="dot-container">
            <div class="dot active"></div> 
            <div class="dot"></div>  
            <div class="dot"></div>  
            <div class="dot"></div>  
            <div class="dot"></div>      
        </div>
    </section>

<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector('.aspect-ratio-169')
    const dotItem = document.querySelectorAll(".dot")
    let index = 0
    let imgNumber = imgPosition.length
    // console.log(imgPosition)
    imgPosition.forEach(function(image,index){
        image.style.left = index*100 + "%"
        dotItem[index].addEventListener("click",function(){
            slider(index)
        })
    })

    function imgSlide (){
        index++;
        console.log(index)
        if(index>=imgNumber){index=0}
            slider(index)
    }

    function slider (index) {
        imgContainer.style.left = "-" + index*100 + "%"
        const dotActive = document.querySelector(".active")
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }
    setInterval(imgSlide,5000)
</script>