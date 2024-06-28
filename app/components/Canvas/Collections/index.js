import { Plane, Transform } from 'ogl' 
import GSAP from 'gsap'
import map from 'lodash/map'

import Media from './Media'

export default class Collections {
    constructor({ gl, scene, sizes }) {
        
        this.gl = gl
        this.sizes = sizes
        this.scene = scene
        this.group = new Transform()

        this.galleryElement = document.querySelector('.collections__gallery__wrapper')
        this.mediaElements = document.querySelectorAll('.collections__gallery__media')
        
        this.createGeometry()
        this.createGallery()

        this.group.setParent(scene)

        this.scroll = {
            start: 0,
            current: 0,
            target: 0,
            lerp: 0.1,
            velocity: 1
        }
        this.show()
    }

    show() {
        map(this.medias, media => media.show())
    }

    hide() {
        map(this.medias, media => media.hide())
    }

        createGeometry() {
            this.geometry = new Plane(this.gl)
        }   

        createGallery() {
            this.medias = map(this.mediaElements, (element, index) => {
                return new Media({ 
                    element,
                    geometry: this.geometry,
                    index,
                    gl: this.gl,
                    scene: this.group, 
                    sizes: this.sizes
                })
            })
        }

        onResize(event) {
            this.sizes = event.sizes
            this.bounds = this.galleryElement.getBoundingClientRect()
            // this.scroll.limit = this.bounds.width
            // this.scroll.last = this.scroll.target = 0
             this.scroll.limit = this.bounds.width - this.sizes.width
            map(this.medias, media => media.onResize(event))
        }

        onTouchDown({ x, y }) {
            this.scroll.last = this.scroll.current
        }

        onTouchMove({ x}) {
           const distance = x.start - x.end
           
           this.scroll.target = this.scroll.last - distance
        }

        onTouchUp({ x, y }) {
            
        }

        onWheel(event) {
            const pixelY = event.deltaY || -event.wheelDelta || event.detail || 0; // Fallback to 0 if all are undefined
        
            this.scroll.target += pixelY;
         
        }

        update() {
            if (!this.bounds) return

            this.scroll.target = GSAP.utils.clamp(-this.scroll.limit, 0, this.scroll.target)

            this.scroll.current = GSAP.utils.interpolate(this.scroll.current, this.scroll.target, this.scroll.lerp)
            
           if (this.scroll.last < this.scroll.current) {
              this.scroll.direction = 'right'
           } else if (this.scroll.last > this.scroll.current) {
             this.scroll.direction = 'left'
           }

           this.scroll.last = this.scroll.current

            map(this.medias, (media, index) => {
                media.update(this.scroll.current)
            }) 

            const index = Math.floor(Math.abs(this.scroll.current / this.scroll.limit) * this.medias.length)
           if (this.index !== index) {
            console.log(index)
               this.index = index
           }
        }  
        
        destroy() {
           this.scene.removeChild(this.group)
        }
    }

