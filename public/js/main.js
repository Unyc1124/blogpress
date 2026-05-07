/*
|--------------------------------------------------------------------------
| IMAGE PREVIEW
|--------------------------------------------------------------------------
*/

$('#imageInput').on('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            $('#previewImage')
                .attr('src', event.target.result)
                .show();
        };

        reader.readAsDataURL(file);
    }
});

/*
|--------------------------------------------------------------------------
| AUTO SLUG GENERATION
|--------------------------------------------------------------------------
*/

$('#title').on('keyup', function(){

    let title = $(this).val();

    let slug = title
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-');

    $('#slug').val(slug);
});

/*
|--------------------------------------------------------------------------
| IMAGE PREVIEW
|--------------------------------------------------------------------------
*/

$('#imageInput').on('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            $('#previewImage')
                .attr('src', event.target.result)
                .show();
        };

        reader.readAsDataURL(file);
    }
});

/*
|--------------------------------------------------------------------------
| AUTO SLUG GENERATION
|--------------------------------------------------------------------------
*/

$('#title').on('keyup', function(){

    let title = $(this).val();

    let slug = title
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-');

    $('#slug').val(slug);
});

/*
|--------------------------------------------------------------------------
| HERO SLIDER
|--------------------------------------------------------------------------
*/

const slides = document.querySelectorAll('.hero-slide');

let currentSlide = 0;

/*
|--------------------------------------------------------------------------
| SHOW SLIDE
|--------------------------------------------------------------------------
*/

function showSlide(index){

    slides.forEach(slide => {

        slide.classList.remove('active');

    });

    slides[index].classList.add('active');
}

/*
|--------------------------------------------------------------------------
| NEXT SLIDE
|--------------------------------------------------------------------------
*/

function nextSlide(){

    currentSlide++;

    if(currentSlide >= slides.length){

        currentSlide = 0;
    }

    showSlide(currentSlide);
}

/*
|--------------------------------------------------------------------------
| PREVIOUS SLIDE
|--------------------------------------------------------------------------
*/

function prevSlide(){

    currentSlide--;

    if(currentSlide < 0){

        currentSlide = slides.length - 1;
    }

    showSlide(currentSlide);
}

/*
|--------------------------------------------------------------------------
| AUTO SLIDE
|--------------------------------------------------------------------------
*/

setInterval(nextSlide, 5000);

/*
|--------------------------------------------------------------------------
| BUTTON EVENTS
|--------------------------------------------------------------------------
*/

document.querySelector('.next-btn')
?.addEventListener('click', nextSlide);

document.querySelector('.prev-btn')
?.addEventListener('click', prevSlide);

/*
|--------------------------------------------------------------------------
| AUTO SCROLL BLOG CAROUSEL
|--------------------------------------------------------------------------
*/

const carousel =
document.querySelector('.blog-carousel');

if(carousel){

    let scrollAmount = 0;

    function autoScroll(){

        scrollAmount += 1;

        carousel.scrollTo({

            left: scrollAmount,

            behavior: 'smooth'
        });

        /*
        |--------------------------------------------------------------------------
        | RESET LOOP
        |--------------------------------------------------------------------------
        */

        if(scrollAmount >=
            carousel.scrollWidth
            - carousel.clientWidth)
        {
            scrollAmount = 0;
        }
    }

    setInterval(autoScroll, 40);
}