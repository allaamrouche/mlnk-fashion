import axios from 'axios';
import each from 'lodash/each';

import Cursor from './components/Cursor';
import Navigation from './components/Navigation';
import NavigationOverlay from './components/NavigationOverlay'; 
import Preloader from './components/Preloader';

import Canvas from './components/Canvas';

import About from 'pages/About';   
import Booking from 'pages/Booking';
import Collections from 'pages/Collections';
import Detail from 'pages/Detail';
import Fashion from 'pages/Fashion';
import Favorites from 'pages/Favorites';
import Main from 'pages/Main';
import Intro from 'pages/Intro';
import Home from 'pages/Home';
import ProductSingle from 'pages/ProductSingle';
import Shop from 'pages/Shop';
import Store from 'pages/Store';

class App {
    constructor() {
        this.createContent();
        
        this.createPages();
        this.createCanvas();
        this.createPreloader();
        this.createNavigation();
        this.createCursor();
         
        this.addEventListeners()
        this.addLinkListeners();

        this.update();
    }

    // createNavigation() {
    //     this.navigation = new Navigation({ template: this.template });
    // }

    createNavigation() {
        if (MalankaSettings.menuStyle === 'navigation-overlay') {
            this.navigation = new NavigationOverlay();
        } else {
            this.navigation = new Navigation();
        }
    }

    createPreloader() {
        const currentTemplate = this.content.getAttribute('data-template');
    
        if (currentTemplate === 'about' || currentTemplate === 'intro') {
          
            this.preloader = new Preloader();
            this.preloader.once('completed', () => {
                this.onPreloaded();
            });
        } else {
            this.onPreloaded();
        }
    }

    createCursor() {
        const cursorElement = document.querySelector('.cursor');
        if (cursorElement) {
            this.cursor = new Cursor(cursorElement);
        }
    }

    createCanvas() {
        this.canvas = new Canvas({
            template: this.template
        });
    }


    createContent() {
        this.content = document.querySelector('.content');
        this.template = this.content.getAttribute('data-template'); 
    }

    createPages() { 
        this.pages = {
            about: new About(), 
            collections: new Collections(), 
            detail: new Detail(),
            fashion: new Fashion(),
            favorites: new Favorites(),
            main: new Main(),
            intro: new Intro(),
            'product-single': new ProductSingle(),
            shop: new Shop(),
            store: new Store(),
            home: new Home()
        } 
         
        this.page = this.pages[this.template];
        this.page.create();
    }

    onPreloaded() {
        if (this.preloader) {
            this.preloader.destroy();
        }
        this.onResize();
        if (this.page && this.page.show) {
            this.page.show();
        } 
    }

    onPopState() {
        this.onChange({
            url: window.location.pathname,
            push: false 
        });    
    }

    async onChange({url, push = true}) {
        this.canvas.onChangeStart(this.template);
        await this.page.hide();
        const request = await axios.get(url);

    if (request.status === 200 ) {
        const html = await request.data;
        
        const div = document.createElement('div');
        if (push) {
            window.history.pushState({}, '', url);
        }
        window.history.pushState({}, '', url);
        div.innerHTML = html;
        const divContent = div.querySelector('.content');
        this.template = divContent.getAttribute('data-template');

        // this.navigation.onChange(this.template);

        this.content.setAttribute('data-template', this.template);
        this.content.innerHTML = divContent.innerHTML;
        this.canvas.onChangeEnd(this.template);
      
        this.page = this.pages[this.template];
       
        this.page.create();
        this.onResize();
        this.page.show();

        this.addLinkListeners();
        } else {
            console.log('error');
        }
    }

    onResize() {
        if (this.page && this.page.onResize) {
            this.page.onResize();
        }

        window.requestAnimationFrame(_ => {
            if (this.canvas && this.canvas.onResize) {
                this.canvas.onResize();
            }
        })
    }

    onTouchDown(event) {
        if (this.canvas && this.canvas.onTouchDown) {
            this.canvas.onTouchDown(event);
        }
    }

    onTouchMove(event) {
        if (this.canvas && this.canvas.onTouchMove) {
            this.canvas.onTouchMove(event);
        }
    } 
    
    onWheel(event) {
        const deltaY = event.deltaY || -event.wheelDelta || event.detail;
        
        if (this.canvas && this.canvas.onWheel) {
            this.canvas.onWheel(event);
        }
    
        if (this.page && this.page.onWheel) {
            this.page.onWheel(event);
        }
    }

    onTouchUp(event) {
        if (this.canvas && this.canvas.onTouchUp) {
            this.canvas.onTouchUp(event);
        }   
    } 

    update () {
       if (this.page && this.page.update) {
            this.page.update();
       }

       // canvas should be always after page on update to get correct page position
       if (this.canvas && this.canvas.update) {
        this.canvas.update(this.page.scroll);
    }

        this.frame = window.requestAnimationFrame(this.update.bind(this));
    }

    addEventListeners() {
        window.addEventListener('wheel', this.onWheel.bind(this));
        window.addEventListener('mousedown', this.onTouchDown.bind(this));
        window.addEventListener('mousemove', this.onTouchMove.bind(this));
        window.addEventListener('mouseup', this.onTouchUp.bind(this));

        window.addEventListener('touchstart', this.onTouchDown.bind(this));
        window.addEventListener('touchmove', this.onTouchMove.bind(this));
        window.addEventListener('touchend', this.onTouchUp.bind(this)); 

        window.addEventListener('popstate', this.onPopState.bind(this));
        window.addEventListener('resize', this.onResize.bind(this));
    }

    // addLinkListeners() {
    //     const links = document.querySelectorAll('a');
    //     each(links, link => {
    //         // Check if the link does not have the 'item__link' class
    //         if (!link.classList.contains('item__link')) {
    //             link.onclick = event => {
    //                 const { href } = link;
    //                 event.preventDefault();
    //                 this.onChange({url: href});
    //             };
    //         }
    //     });
    // }

    addLinkListeners() {
        const links = document.querySelectorAll('.navigation__list__link');
        links.forEach(link => {
            link.onclick = event => {
                const { href } = link;
                event.preventDefault(); 
                this.onChange({url: href});
            };
        });
    }
}

new App();