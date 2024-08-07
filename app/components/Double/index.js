import { gsap } from 'gsap';    
import Splitting from 'splitting';
import imagesLoaded from 'imagesloaded';

const wrapElements = (elems, wrapType, wrapClass) => {
    elems.forEach(char => {
        const wrapEl = document.createElement(wrapType);
        wrapEl.classList = wrapClass;
        char.parentNode.appendChild(wrapEl);
        wrapEl.appendChild(char);
    });
}

export default class DoubleSlider {
    #current = 0;

    constructor(element, reverseDirection = false) {
        this.element = element;
     
        this.reverseDirection = reverseDirection;
        this.items = [...this.element.querySelectorAll('.double-slider__item')];
        
        this.itemsInner = this.items.map(item => item.querySelector('.double-slider__item-inner'));
        // Set current
        this.items[this.current].classList.add('double-slider__item--current');
        // Total items
        this.itemsTotal = this.items.length;
        gsap.set([this.items, this.itemsInner], {'will-change': 'transform'});
    }
    next() {
        this.navigate(1);
    }
    prev() {
        this.navigate(-1);
    }
    get current() {
        return this.#current;
    }
    set current(value) {
        this.#current = value;
    }
    // direction: 1 || -1 (next || prev)
    navigate(direction) {
        
        if ( this.isAnimating ) return false;
        this.isAnimating = true;
        
        const previous = this.current;
        this.current = direction === 1 ? 
                            this.current < this.itemsTotal - 1 ? ++this.current : 0 :
                            this.current > 0 ? --this.current : this.itemsTotal - 1

        const currentItem = this.items[previous];
        const currentInner = this.itemsInner[previous];
        const upcomingItem = this.items[this.current];
        const upcomingInner = this.itemsInner[this.current];
        
        gsap
        .timeline({
            defaults: {duration: 1.1, ease: 'power3.inOut'},
            onComplete: () => {
                this.items[previous].classList.remove('double-slider__item--current');
                this.items[this.current].classList.add('double-slider__item--current');

                this.isAnimating = false;
            }
        })
       
        .to(currentItem, {
            yPercent: this.reverseDirection ? direction*100 : -direction*100,
            onComplete: () => gsap.set(currentItem, {opacity: 0})
        })
        .to(currentInner, {
            yPercent: this.reverseDirection ? -direction*30 : direction*30,
            startAt: {
                rotation: 0
            },
            rotation: -direction*15,
            scaleY: 2.8
        }, 0)
        .to(upcomingItem, {
            startAt: { 
                opacity: 1, 
                yPercent: this.reverseDirection ? -direction*80 : direction*80 
            },
            yPercent: 0
        }, 0)
        .to(upcomingInner, {
            startAt: {
                yPercent: this.reverseDirection ? direction*30 : -direction*30, 
                scaleY: 2.8, 
                rotation: direction*15
            },
            yPercent: 0,
            scaleY: 1,
            rotation: 0
        }, 0);

    }
}

// navigation controls
const navigation = {
    'next': document.querySelector('.double-slider-nav > .double-slider-nav__item--next'),
    'prev': document.querySelector('.double-slider-nav > .double-slider-nav__item--prev')
};

// Background slider
// const sliderBG = new DoubleSlider(document.querySelector('.double-slider--bg'));

// // Foreground slider (passing true as the second argument to reverse the animation)
// const sliderFG = new DoubleSlider(document.querySelector('.double-slider--fg'), true);
const sliderBGElement = document.querySelector('.double-slider--bg');
const sliderFGElement = document.querySelector('.double-slider--fg');

let sliderBG, sliderFG;

if (sliderBGElement) {
    sliderBG = new DoubleSlider(sliderBGElement);
}

if (sliderFGElement) {
    sliderFG = new DoubleSlider(sliderFGElement, true); // Pass true to reverse the animation
}

const titles = [...document.querySelectorAll('.type > .type__item')];
let chars; // Define chars in a higher scope
if (titles.length > 0) {
    titles[0].classList.add('type__item--current');

    titles.forEach(title => {
        title.dataset.splitting = '';
    });
    Splitting();

    chars = titles.map(title => {
        const titleChars = title.querySelectorAll('.char');
        wrapElements(titleChars, 'span', 'char-wrap');
        return titleChars;
    });
    gsap.set([titles, chars], {'will-change': 'transform'});
}

const navigate = action => {
    toggleTitle(action);
    sliderBG[action]();
    sliderFG[action]();
}; 


const toggleTitle = action => {
    
    if ( sliderBG.isAnimating ) return false;
    
    const current = sliderBG.current;
    const titleCurrentLetters = chars[current];

    const upcoming = action === 'next' ? 
        current < sliderBG.itemsTotal - 1 ? current+1 : 0 :
        current > 0 ? current-1 : sliderBG.itemsTotal - 1;

    const titleUpcomingLetters = chars[upcoming];

    // change title
    const duration = 1.1;
    // reverse logic for the previous action
    const reverse = action === 'next' ? -1 : 1;
    
    gsap
    .timeline({
        defaults: {duration: duration, ease: 'power3.inOut'},
        onStart: () => {
            titles[upcoming].classList.add('type__item--current');
        },
        onComplete: () => {
            titles[current].classList.remove('type__item--current');
        }
    })
    .to(titles[current], {
        startAt: {
            transformOrigin: action === 'next' ? '-50% 100%' : '-50% 0%'
        },
        yPercent: reverse*10,
        rotate: reverse*25
    })
    .to(titleCurrentLetters, {
        duration: duration/2,
        ease: 'power3.in',
        startAt: {
            transformOrigin: action === 'next' ? '50% 100%' : '50% 0%'
        },
        yPercent: reverse*50,
        scaleY: 2
    }, 0)
    .to(titleCurrentLetters, {
        duration: duration/2,
        ease: 'expo',
        yPercent: reverse*100,
        scaleY: 1
    }, duration/2)

    .to(titles[upcoming], {
        startAt: {
            transformOrigin: action === 'next' ? '-50% 0%' : '-50% 100%', 
            yPercent: reverse*-10, 
            rotate: reverse*-25
        },
        yPercent: 0,
        rotate: 0
    }, 0)
    .to(titleUpcomingLetters, {
        duration: duration/2,
        ease: 'power3.in',
        startAt: {
            transformOrigin: action === 'next' ? '50% 0%' : '50% 100%', 
            yPercent: reverse*-100, 
            scaleY: 1
        },
        yPercent: reverse*-50,
        scaleY: 2
    }, 0)
    .to(titleUpcomingLetters, {
        duration: duration/2,
        ease: 'expo',
        yPercent: 0,
        scaleY: 1
    }, duration/2);

}

if (navigation.next) {
    navigation.next.addEventListener('click', () => navigate('next'));
}

if (navigation.prev) {
    navigation.prev.addEventListener('click', () => navigate('prev'));
}
// navigation.next.addEventListener('click', () => navigate('next'));
// navigation.prev.addEventListener('click', () => navigate('prev'));

// Observer.create({
//     target: window,         // can be any element (selector text is fine)
//     type: "wheel,touch,scroll,pointer",    // comma-delimited list of what to listen for ("wheel,touch,scroll,pointer")
//     onUp : () => navigate('next'), 
//     onDown : () => navigate('prev'),
//     wheelSpeed: -1
// });

// Preload images
imagesLoaded(document.querySelectorAll('.double-slider__item-inner'), {background: true}, () => document.body.classList.remove('loading'));



