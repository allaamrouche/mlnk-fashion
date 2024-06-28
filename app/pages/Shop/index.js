import Page from 'classes/Page';
import FavoritesIcon from 'classes/FavoritesIcon';

export default class Shop extends Page {
    constructor() {
        super({
            id: 'shop',
            element: '.shop',
            elements: {
                wrapper: '.shop__wrapper',
                icons: '.favorites-icon',
                dropdown: '.custom-dropdown', 
                dropdownList: '.custom-dropdown__list',
                dropdownSelected: '.custom-dropdown__selected',
                originalSelect: '.dropdown__select'
            }
        });
        this.favoriteIcons = [];
    }

    create() {
        super.create();
        this.initializeFavorites();
        this.setupDropdown();
    }

    initializeFavorites() {
        this.elements.icons.forEach(iconElement => {
            const icon = new FavoritesIcon(iconElement);
            this.favoriteIcons.push(icon);
        });
    }

    setupDropdown() {
        const dropdown = this.elements.dropdown[0];
        const dropdownList = this.elements.dropdownList[0];
        const dropdownSelected = this.elements.dropdownSelected[0];
        const originalSelect = this.elements.originalSelect[0];
        const form = dropdown.closest('form');

        dropdown.addEventListener('click', () => {
            dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
        });

        Array.from(dropdownList.children).forEach(item => {
            item.addEventListener('click', (event) => {
                dropdownSelected.textContent = item.textContent;
                originalSelect.value = item.getAttribute('data-value');
                dropdownList.style.display = 'none';
                form.submit();  // Submit the form after changing the value
            });
        });

        document.addEventListener('click', event => {
            if (!dropdown.contains(event.target)) {
                dropdownList.style.display = 'none';
            }
        });
    }

    destroy() {
        this.favoriteIcons.forEach(icon => icon.destroy());
        this.favoriteIcons = [];
        super.destroy();
    }
}

