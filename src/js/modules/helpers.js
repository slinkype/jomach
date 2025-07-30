function toggableItemGrid() {

    /*
    - open first init - open-first
    - multiple open at a time - multiple-open
    - toggle on hover instead of click - toggle-hover
    - always one open at all times - force-open
    */

    const toggleableItemGrids = document.querySelectorAll(".ep-grid-wrapper.is-toggleable");

    if(toggleableItemGrids.length > 0 ){
        [...toggleableItemGrids].forEach((toggleableItemGrid) => { 

            const openFirst = toggleableItemGrid.classList.contains("open-first") ? true : false;
            const multipleOpen = toggleableItemGrid.classList.contains("multiple-open") ? true : false;
            const toggleEvent = toggleableItemGrid.classList.contains("toggle-hover") ? "mouseenter" : "click";
            const alwaysOneOpen = toggleableItemGrid.classList.contains("force-open") ? true : false;
            
            const items = [...toggleableItemGrid.querySelectorAll(".ep-item")];

            if(openFirst) items[0].classList.add("is-active");

            [...items].forEach((item) => {
                item.addEventListener(toggleEvent, function() {

                    if(!multipleOpen){
                        items.filter((e) => e !== this).forEach((i) => i.classList.remove('is-active'));   
                    }

                    if(!alwaysOneOpen){
                        this.classList.toggle("is-active");
                    } else {
                        this.classList.add("is-active");
                    }

                });
            });
        });
    }
}

export { toggableItemGrid };


function slidersFix() {
    function slidercb(){
        setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
        }, 200);
    }

    const elsToWatch = document.querySelectorAll(".ep-flickity-slider-wrapper");

    if(elsToWatch){

        const sliderObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach( ( entry, index ) => {
                    if(entry.isIntersecting) {
                        slidercb(entry.target)
                        observer.unobserve(entry.target);
                    }
                } );
            }, {
                root: null,
                threshold: 0,
                rootMargin: '100px 0px 100px 0px'
            }
        );

        [...elsToWatch].forEach((elToWatch) => {
            sliderObserver.observe(elToWatch);
        });
        
    }
}

export { slidersFix };