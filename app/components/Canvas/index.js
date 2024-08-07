import { Camera, Renderer, Transform } from 'ogl'

import About from './About'
import Collections from './Collections'
import Intro from './Intro'
import Slides from './Slides'

export default class Canvas {
    constructor({ template }) {
        this.template = template
        this.x = {
            start: 0,
            distance: 0,    
            end: 0
        }

        this.y = {  
            start: 0,
            distance: 0,    
            end: 0
        }

        this.createRenderer();
        this.createCamera();
        this.createScene();

        this.onResize()

        this.onChangeEnd(this.template)
    }

    createRenderer() {
        this.renderer = new Renderer({
            alpha: true,
            antialias: true
        })
        this.gl = this.renderer.gl

        document.body.appendChild(this.gl.canvas)
       
    }

    createCamera() {
        this.camera = new Camera(this.gl)
        this.camera.position.z = 5
    }

    createScene() {
        this.scene = new Transform()
    }

    createIntro () {
        this.intro = new Intro({ 
            gl: this.gl, 
            scene: this.scene,
            sizes: this.sizes
        })
    }

    destroyIntro() {
        if (!this.intro) return
        this.intro.destroy()
        this.intro = null
    }

    createAbout() {
        this.about = new About({ 
            gl: this.gl, 
            scene: this.scene,
            sizes: this.sizes
        })
    }

    destroyAbout() {
        if (!this.about) return
        this.about.destroy()
        this.about = null
    }

    createCollections() {
        this.collections = new Collections({ 
            gl: this.gl, 
            scene: this.scene,
            sizes: this.sizes
        })
    }

    destroyCollections() {
        if (!this.collections) return
        this.collections.destroy()
        this.collections = null
    }

    createSlides() {
        this.slides = new Slides({ 
            gl: this.gl, 
            scene: this.scene,
            sizes: this.sizes
        })
    }

    destroySlides() {
        if (!this.slides) return
        this.slides.destroy()
        this.slides = null
    }

    onChangeStart() {
        if (this.about) {
            this.about.hide()
        }

        if (this.collections) {
            this.collections.hide()
        }

        if (this.intro) {
            this.intro.hide()
        }

        if (this.slides) {
            this.slides.hide()
        }
    }

    onChangeEnd(template) {
        if (template === 'about') {
            this.createAbout()
        } else {
            this.destroyAbout()   
        }

        if (template === 'collections') {
            this.createCollections()
        } else {
            this.destroyCollections()   
        }

        if (template === 'intro') {
            this.createIntro()
        } else {
            this.destroyIntro()  
        }

        if (template === 'store') {
            this.createSlides()
        } else {
            this.destroySlides()  
        }
    }


    onResize () {
        this.renderer.setSize(window.innerWidth, window.innerHeight)
        this.camera.perspective({
            aspect: window.innerWidth / window.innerHeight
        })

        const fov = this.camera.fov * (Math.PI / 180);
        const height = 2 * Math.tan(fov / 2) * this.camera.position.z;
        const width = height * this.camera.aspect;

        this.sizes = { 
            height, 
            width 
        };

         const values = {
            sizes: this.sizes
        }
        if (this.about) {
            this.about.onResize(values)
        }

        if (this.collections) {
            this.collections.onResize(values)
        }

        if (this.intro) {
            this.intro.onResize(values)
        }

        if (this.slides) {
            this.slides.onResize(values)
        }
    }
  
    onTouchDown(event) {
        this.isDown = true;
        this.x.start = event.touches ? event.touches[0].clientX : event.clientX; 
        this.y.start = event.touches ? event.touches[0].clientY : event.clientY;
        
        const values = {    
            x: this.x,
            y: this.y
        }

        if (this.about) {
            this.about.onTouchDown(values)
        }

        if (this.collections) {
            this.collections.onTouchDown(values)
        }

        if (this.intro) {
            this.intro.onTouchDown(values)
        }

        if (this.slides) {
            this.slides.onTouchDown(values)
        }
    }

    onTouchMove(event) {
        if (!this.isDown) return;   
        const x = event.touches ? event.touches[0].clientX : event.clientX; 
        const y = event.touches ? event.touches[0].clientY : event.clientY;

        this.x.end = x;
        this.y.end = y;
         
        const values = {
            x: this.x,
            y: this.y
        }   

        if (this.about) {
            this.about.onTouchMove(values)
        }
        
        if (this.collections) {
            this.collections.onTouchMove(values)
        }

        if (this.intro) {
            this.intro.onTouchMove(values)
        }

        if (this.slides) {
            this.slides.onTouchMove(values)
        }
    }

    onTouchUp(event) {
        this.isDown = false;
        const x = event.touches ? event.touches[0].clientX : event.clientX; 
        const y = event.touches ? event.touches[0].clientY : event.clientY;

        this.x.end = x;
        this.y.end = y;

        const values = {
            x: this.x,
            y: this.y
        }   

        if (this.about) {
            this.about.onTouchUp(values)
        }

        if (this.collections) {
            this.collections.onTouchUp(values)
        }
        
        if (this.intro) {
            this.intro.onTouchUp(values)
        }

        if (this.slides) {
            this.slides.onTouchUp(values)
        }
    } 

    onWheel(event) {
        if (this.collections) {
            this.collections.onWheel(event)
        }

        if (this.intro) {
            this.intro.onWheel(event)
        }

        if (this.slides) {
            this.slides.onWheel(event)
        }
    }

    update(scroll) {
        if (this.about) {
            this.about.update(scroll)
        }

        if (this.collections) {
            this.collections.update()
        }

        if (this.intro) {
            this.intro.update()
        }

        if (this.slides) {
            this.slides.update(scroll)
        }

        if (this.mesh) {
            this.mesh.rotation.y += 0.01;
            this.mesh.rotation.x += 0.01;
        }

        this.renderer.render({ camera: this.camera, scene: this.scene });
    }
}