import Page from '../../classes/Page';  
import gsap from 'gsap';

export default class ProductSingle extends Page {
    constructor() {
        super({
            id: 'product-single',
            element: '.product-single',
            elements: {
                wrapper: '.product-single__wrapper',
                navigation: '.navigation',
                tabs: '.woocommerce-tabs ul.tabs li',
                tabPanels: '.woocommerce-Tabs-panel', 
                mainImage: '.element__reveal__img.product-single--image-media',
                thumbnails: '.product-single--thumbnails .woocommerce-product-gallery__image',
                attributeOptions: '.attribute-option'
            }
        });
    }

    create() {
        super.create();
      
        this.addThumbnailClickHandlers();
        this.addTabToggleHandlers(); 
        this.addAttributeOptionHandlers();
    }

    addThumbnailClickHandlers() {
        this.elements.thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', (event) => {
                const imgDiv = thumbnail.querySelector('.product-single--thumbnails-image');
                if (imgDiv) {
                    const newImageUrl = imgDiv.style.backgroundImage;
                    if (newImageUrl && this.elements.mainImage && this.elements.mainImage.length > 0) {
                        const mainImageContainer = this.elements.mainImage[0];
                        gsap.set(mainImageContainer, {
                            backgroundImage: newImageUrl,
                            backgroundSize: '70%'
                        });
                        gsap.to(mainImageContainer, {
                            duration: 1,
                            ease: 'power2.out',
                            backgroundSize: '100%',
                            opacity: 1,
                            onStart: function() {
                                gsap.set(mainImageContainer, {opacity: 0});
                            }
                        });
                    } else {
                        console.error('Error: New image URL is undefined, or main image element not found or has no elements.');
                    }
                } else {
                    console.error('Error: Thumbnail image div not found.');
                }
            });
        });
    }

    addTabToggleHandlers() {
        this.elements.tabs.forEach(tab => {
            const targetPanel = document.getElementById(tab.getAttribute('aria-controls'));
            tab.addEventListener('click', (e) => {
                e.preventDefault(); 
    
                // Ensure all panels are closed initially, except the target panel
                this.elements.tabPanels.forEach(panel => {
                    if (panel !== targetPanel) {
                        gsap.to(panel, {duration: 0.5, display: 'none', opacity: 0});
                    }
                });
    
                // Toggle the target panel
                if (targetPanel) {
                    if (targetPanel.style.display === 'none' || targetPanel.style.display === '') {
                        gsap.to(targetPanel, {duration: 0.5, display: 'block', opacity: 1});
                    } else {
                        gsap.to(targetPanel, {duration: 0.5, display: 'none', opacity: 0});
                    }
                }
            });
        });
    }

    addAttributeOptionHandlers() {
        const attributeOptions = this.elements.attributeOptions;
        if (attributeOptions) {
            attributeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Get corresponding select element
                    const selectId = this.parentNode.id.replace('div_', '');
                    const selectElement = document.getElementById(selectId);

                    // Update select value
                    if (selectElement) {
                        selectElement.value = this.dataset.value;
                        selectElement.dispatchEvent(new Event('change'));  // Trigger change to update WooCommerce

                        // Manage selected visuals for buttons
                        this.parentNode.querySelectorAll('.attribute-option').forEach(opt => {
                            opt.classList.remove('selected');
                            opt.style.textDecoration = 'none';
                        });

                        this.classList.add('selected');
                        this.style.textDecoration = 'underline';
                    }
                });
            });
        }
    }

    

    show() {
        return new Promise(resolve => {
            super.show().then(() => {
                this.removeActiveClasses();
                resolve();
            });
        });
    }

    removeActiveClasses() {
        if (this.elements.tabs && this.elements.tabPanels) {
            this.elements.tabs.forEach(tab => tab.classList.remove('active'));
            this.elements.tabPanels.forEach(panel => panel.style.display = 'none');
        }
    }

    destroy() {
        super.destroy();
        if (this.elements.thumbnails) {
            this.elements.thumbnails.forEach(thumbnail => {
                thumbnail.removeEventListener('click', this.handleThumbnailClick);
            });
        }
    }
}

