export default function iniciaCarousel() {
    // código informado na documentação do Owl Carousel 2
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,

        // responsivo
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
}