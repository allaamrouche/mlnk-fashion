import Page from '../../classes/Page';  
import GSAP from 'gsap';

export default class Store extends Page {
    constructor() {
       super({
        id: 'store',
        element: '.store',
        elements: {
            wrapper: '.store__wrapper',
            navigation: '.navigation__overlay',
            title: '.store__content__title',
            slider: '.store__slider',
            sliderButton: '.store__slider__content__button',
            gallery: '.store__gallery__wrapper', 
            galleryItems: '.store__gallery__media'
        }
        
    });
   
    }

    create() {
        super.create();
    
       
        GSAP.set(this.elements.sliderButton, { autoAlpha: 0 });
    
       
        this.animateButtonsIn();
      }
    
      animateButtonsIn() {
        GSAP.to(this.elements.sliderButton, {
          autoAlpha: 1, 
          delay: 1, // Delay in seconds
          duration: 1, 
          ease: "power2.out", 
        });
     
      }
    

    destroy() {
        super.destroy();
    }
}