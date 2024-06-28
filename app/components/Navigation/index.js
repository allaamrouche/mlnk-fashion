import Component from "../../classes/Component";

import { each } from "lodash";
import Link from "../../animations/Link";

export default class Navigation extends Component {
   constructor() {
      super({
         element: '.navigation',
         elements: {
            items: '.navigation__list__item',
            links: '.navigation__list__link'
         }
      })
      this.links = each(this.elements.links, element => {
         return new Link({
           element
         })
       })
   
   }
}