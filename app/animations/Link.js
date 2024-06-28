import GSAP from 'gsap'

import Component from 'classes/Component'

import { split } from 'utils/text'

export default class Link extends Component {
  constructor ({ element }) {
    super({
      element
    })
console.log('element link', element);
    this.createText()
   
  }

  createText () {
    const text = this.element.textContent

    this.elements.wrapper = this.element.querySelector('span')

    this.elements.text = document.createElement('div')
    this.elements.text.innerHTML = text
    this.elements.textSpans = split({
      append: false,
      element: this.elements.text,
      expression: ''
    })

    this.elements.hover = document.createElement('div')
    this.elements.hover.innerHTML = text
    this.elements.hoverSpans = split({
      append: false,
      element: this.elements.hover,
      expression: ''
    })

    this.elements.wrapper.innerHTML = ''
    this.elements.wrapper.appendChild(this.elements.text)
    this.elements.wrapper.appendChild(this.elements.hover)

    GSAP.set(this.elements.hover, {
      left: 0,
      position: 'absolute',
      top: 0
    })

    this.timeline = GSAP.timeline({ paused: true })

    this.timeline.to(this.elements.textSpans, {
      duration: 0.5,
      
      transform: 'rotate3d(1, 0.1, 0, -90deg)',
      stagger: 0.02
    }, 0)

    this.timeline.fromTo(this.elements.hoverSpans, {
      transform: 'rotate3d(1, 0.1, 0, 90deg)'
    }, {
      duration: 0.5,
      
      transform: 'rotate3d(0, 0, 0, 90deg)',
      stagger: 0.02
    }, 0.05)
  }
  
  onMouseEnter () {
    console.log('onMouseEnter')
    this.timeline.play()
  }

  onMouseLeave () {
    console.log('onMouseLeave')
    this.timeline.reverse()
  }

  addEventListeners () {
    console.log('Adding event listeners for:', this.element);
    this.onMouseEnterEvent = this.onMouseEnter.bind(this)
    this.onMouseLeaveEvent = this.onMouseLeave.bind(this)

    this.element.addEventListener('mouseenter', this.onMouseEnterEvent)
    this.element.addEventListener('mouseleave', this.onMouseLeaveEvent)
  }

  removeEventListeners () {
    this.element.removeEventListener('mouseenter', this.onMouseEnterEvent)
    this.element.removeEventListener('mouseleave', this.onMouseLeaveEvent)
  }
}